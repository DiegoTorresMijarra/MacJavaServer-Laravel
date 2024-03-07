<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarritoRequest;
use App\Http\Requests\LineaPedidoProvisionalRequest;
use App\Http\Requests\LineaPedidoRequest;
use App\Http\Requests\PedidoRequest;
use App\Http\Resources\DireccionPersonalResource;
use App\Http\Resources\PedidoResource;
use App\Models\LineaPedido;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Redirect;
use Session;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CarritoController extends Controller
{
    public static function singletonPedido()
    {
        $carrito = Session::get('carrito');

        if (!$carrito)
        {
            Session::put('carrito',[]);
        }
        return $carrito;
    }

    public function addLinea(LineaPedidoProvisionalRequest $request)
    {
        $carrito = CarritoController::singletonPedido();

        $lineaConIndex = $this->getLineaProducto($request->producto_id);
        if($lineaConIndex)
        {
            $carrito[$lineaConIndex['index']]['stock'] += $request->stock;

            flash('Cantidad del Pedido Actualizada')->success()->important();
        }else{
            $carrito[] = [
                'precio' => $request->precio,
                'stock' => $request->stock,
                'producto_id' => $request->producto_id
            ];
            flash('Producto Añadido al carrito correctamente')->success()->important();
        }
        Session::put('carrito', $carrito);

        return Redirect::back();
    }

    public static function getLineaProducto($producto_id)
    {
        $carrito = CarritoController::singletonPedido();

        if(!empty($carrito)){
            foreach ($carrito as $index => $linea) {
                if ($linea['producto_id'] == $producto_id) {
                    return ['index'=>$index, 'linea'=>$linea];
                }
            }
        }

        return null;
    }

    public static function getStockSession($producto_id)
    {
        $linea = CarritoController::getLineaProducto($producto_id);

        if($linea){
            return $linea['linea']['stock'];
        }
        return 0;
    }

    public function getCarritoSession()
    {
        $carritoSession = CarritoController::singletonPedido();

        $lineas = [];
        $total = 0;

        if(!empty($carritoSession))
        {
            foreach ($carritoSession as $linea)
            {
                $producto = Producto::findOrFail($linea['producto_id']);
                $subtotal = $linea['precio']*$linea['stock'];

                $total += $subtotal;
                $lineas[] = [
                    'producto' => $producto,
                    'precio' => $linea['precio'],
                    'stock' => $linea['stock'],
                    'subtotal'=> $subtotal,
                ];
            }
        }

        $direcciones = DireccionPersonalResource::collection(Auth::user()->direcciones()->paginate(6));


        return view('carrito')->with('carrito',['total'=>$total, 'lineas'=>$lineas])->with('direcciones', $direcciones);
    }

    public function deleteLinea($producto_id)
    {
        $carrito = CarritoController::singletonPedido();

        $linea = CarritoController::getLineaProducto($producto_id);

        if ($linea) {
            unset($carrito[$linea['index']]);
            Session::put('carrito', $carrito);

            flash('Producto eliminado del carrito correctamente')->success()->important();
        } else {
            flash('El producto seleccionado no está en el carrito')->error()->important();
        }

        return redirect()->back();
    }


    public function createPedido(CarritoRequest $request)
    {
        $request->validarYTransformar();

        $carrito = CarritoController::singletonPedido();

        if (empty($carrito))
        {
            flash('El carrito está vacío')->error()->important();
            return redirect(route('carrito'));
        }

        $pedido = null;

        try
        {
            $pedidoRequest =  PedidoRequest::createFrom($request);

            $data = array_merge(
                $request->all(),
                ['estado' => Pedido::$ESTADOS_POSIBLES[0],'user_id'=>Auth::user()->id],
                $this->calculoTotales()
            );

            $pedidoRequest->merge($data);

            $pedidoRequest->validar();

            $pedido = Pedido::create($pedidoRequest->all());

            $lineas = $this->requestLineasConIdPedido($pedido->id);

            foreach ($lineas as $linea)
            {
                LineaPedido::create($linea);
            }

            if(!$pedido->actualizarStockLineas())
            {
               throw new Exception('Error al actualizar el stock, intentelo mas tarde');
            }

            flash('Pedido creado correctamente')->success()->important();
            Session::forget('carrito');

            return redirect(route('pedido.details', $pedido->id));

        }catch (Exception $exception){
            $pedido->forceDelete();//podriamos ponerlo a error tb

            throw new BadRequestException('Algo a salido mal al crear el pedido: '.$exception->getMessage().' ');
        }
    }


    private function calculoTotales()
    {
        $carrito = CarritoController::singletonPedido();

        $precioTotal = 0.00;
        $stockTotal = 0;

        if (empty($carrito))
        {
            //exception?
            return [$precioTotal, $stockTotal];
        }else{
            foreach ($carrito as $linea)
            {
                $precioTotal += $linea['precio']*$linea['stock'];
                $stockTotal += $linea['stock'];
            }
            return ['precioTotal'=>number_format($precioTotal, 2, '.', ''),'stockTotal'=> $stockTotal];
        }
    }

    private function requestLineasValidadas():bool
    {
        $carrito = CarritoController::singletonPedido();

        if (empty($carrito)){
            return false;
        }
        try {
            foreach ($carrito as $linea)
            {
                $validando = new LineaPedidoRequest();
                $validando->merge($linea);

                $validando->validar();
            }
            return true;
        }catch (ValidationException $exception){
            return false;
        }
    }
    private function requestLineasConIdPedido($id)
    {
        $carrito = CarritoController::singletonPedido();

        if(empty(!$carrito) && $this->requestLineasValidadas() && $id && uuid_is_valid($id)){
            $requestLineas = [];
            foreach ($carrito as $linea)
            {
                $validando = new LineaPedidoRequest();
                $validando->merge(array_merge($linea, ['pedido_id'=>$id]));

                $validando->validar();

                $requestLineas [] = $validando->all();
            }
            return $requestLineas;
        }
        throw new Exception('Error al crear el request de las lineas de pedido');
    }
}
