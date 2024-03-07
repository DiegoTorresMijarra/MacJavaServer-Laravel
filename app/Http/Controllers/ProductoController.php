<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Categoria;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductoController extends Controller
{
    public function inicio(){
        return view('index');
    }

    public function index(Request $request)
    {
        $productos = Producto::search($request->search)->where('oferta', false)->orderBy('id', 'asc')->paginate(6);
        ProductoResource::collection($productos);
        return view('productos.index')->with('productos', $productos);
    }

    public function offers(Request $request)
    {
        $productos = Producto::search($request->search)->where('oferta', true)->orderBy('id', 'asc')->paginate(6);
        ProductoResource::collection($productos);
        return view('productos.offers')->with('productos', $productos);
    }

    public function show($id)
    {
        $producto = Producto::find($id);
        $producto = new ProductoResource($producto);
        return view('productos.show')->with('producto', $producto);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create')->with('categorias', $categorias);
    }

    public function store(ProductoRequest $request)
    {
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $producto = new Producto($request->all());
            $producto->oferta = $request->has('oferta');
            $producto->save();
            flash('Producto creado con éxito.')->success()->important();
            return redirect()->route('productos.index');
        } catch (Exception $e) {
            flash('Error al crear el producto' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('productos.edit')
            ->with('producto', $producto)
            ->with('categorias', $categorias);
    }

    public function update(ProductoRequest $request, $id)
    {
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $producto = Producto::find($id);
            $producto->update($request->all());
            $producto->categoria_id = $request->categoria_id;
            $producto->save();
            flash('Producto actualizado con éxito.')->warning()->important();
            return redirect()->route('productos.index');
        } catch (Exception $e) {
            flash('Error al actualizar el producto' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function editImage($id)
    {
        $producto = Producto::find($id);
        return view('productos.image')->with('producto', $producto);
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $producto = Producto::find($id);
            if ($producto->imagen != Producto::$IMAGE_DEFAULT && Storage::exists($producto->imagen)) {
                Storage::delete($producto->imagen);
            }
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $fileToSave = $extension;
            $producto->imagen = $fileToSave;
            $producto->save();
            flash('Imagen del producto actualizado con éxito.')->warning()->important();
            return redirect()->route('productos.index');
        } catch (Exception $e) {
            flash('Error al actualizar el producto' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::find($id);
            if ($producto->imagen != Producto::$IMAGE_DEFAULT && Storage::exists($producto->imagen)) {
                Storage::delete($producto->imagen);
            }
            $producto->delete();
            flash('Producto eliminado con éxito.')->error()->important();
            return redirect()->route('productos.index');
        } catch (Exception $e) {
            flash('Error al eliminar el producto' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }
}
