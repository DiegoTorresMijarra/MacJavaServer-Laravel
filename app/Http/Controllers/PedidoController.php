<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use App\Http\Resources\PedidoResource;
use App\Models\Pedido;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PedidoController extends Controller
{
    private function getById($id)
    {
        if( $id && uuid_is_valid($id))
        {
            $res = Pedido::find($id);

            if($res && $res->user_id==Auth::id()
            )
            {
                //  throw new AuthorizationException('No puedes acceder a direcciones que no te pertenecen') //damos menos info al atacante si no le decimos q existe
                return $res;
            }
            throw new NotFoundHttpException('Pedido no encontrado');
        }
        throw new BadRequestException('El id no es valido');
    }
    public function index()
    {
        return PedidoResource::collection(Pedido::all());
    }

    public function store(PedidoRequest $request)
    {
        return new PedidoResource(Pedido::create($request->validated()));
    }

    public function show($id)
    {
        $pedido = $this->getById($id);
        $pedidoResource = new PedidoResource($pedido);

        return view('pedidos.show')->with('pedido', $pedidoResource->data());
    }

    public function update(PedidoRequest $request, Pedido $pedido)
    {
        $pedido->update($request->validated());

        return new PedidoResource($pedido);
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return response()->json();
    }


    public function toPdf($id)
    {
        $dompdf = new Dompdf();

        $pedido = $this->getById($id);
        $pedidoResource = new PedidoResource($pedido);

        $html =  view('pedidos.pdf')->with('pedido', $pedidoResource->data())->render();

        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->stream('Pedido_'.$id.'pdf');
    }
}
