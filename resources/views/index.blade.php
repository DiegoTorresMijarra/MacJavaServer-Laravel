@php use App\Models\Producto; @endphp
@extends('main')

@section('title', 'Inicio')

@section('content')
    <div class="row shadow" style="width: 100%; height: 100%; background: linear-gradient(to right, coral, transparent); padding: 20px; border-radius: 10px; border: 2px solid coral">
        <div class="col-6" style="padding: 0; margin: 0">
            <div class="row" style="width: 100%; height: 50%; margin: 0">
                <div class="col-12">
                    <h1 style="color: white">Creativa y sabrosa?<br><h4>Asi es la cocina de MacJava</h4></h1>
                    <p style="color: #413f3d">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt. Donec est purus, placerat sit amet iaculis a, fringilla non justo.</p>
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit!
                </div>
            </div>
            <div class="row d-flex justify-conten-center" style="width: 100%; height: 50%; margin: 0">
                <div class="col-12" style="display: flex; flex-direction: column; justify-content: center;">
                    <h5 style="color: white">Testea nuestros Ofertones</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur placerat urna id tortor vulputate tincidunt.</p>
                    <form action="{{ route('productos.index') }}" method="get" class="row" style="display: flex; justify-content: end;padding: 0 40px;">
                        <button class="delete-button">Comprar aqui</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <img src="https://create.vista.com/s3-static/create/uploads/2022/09/cool-menu-examples.webp" height="500px" width="500px">
        </div>
    </div>

    <br>
@endsection

@section('restaurantes')
    <div class="row" style="background-color: #413f3d; width: 100%; padding: 20px 0; border-bottom: 3px solid white">
        <div class="row" style="height: 20%; width: 100%; display: flex; justify-content: end">
            <form action="{{ route('restaurantes.index') }}" method="get" class="row" style="display: flex; justify-content: start;padding: 0 40px;">
                <button class="btn" style="background-color: coral; color: white">Ver mas</button>
            </form>
        </div>
        <div class="row" style="height: 80%; width: 100%; display: flex; justify-content: center; padding-left: 70px;">
            @if ($restaurantes !== null && count($restaurantes) > 0)
                @foreach ($restaurantes as $restaurante)
                    <div class="col-3 d-flex flex-column align-items-start" style=" color: white">
                        <img src="https://imag.bonviveur.com/salon-del-restaurante-tragabuches-marbella_800.jpg" height="100px" width="100px" style="margin-bottom: 10px">
                        <h6>{{ $restaurante->nombre }}</h6>
                        <p>{{ $restaurante->direccion->municipio .' / '. $restaurante->direccion->calle .' '. $restaurante->direccion->numero }}</p>
                    </div>
                @endforeach

            @else
                <p class='lead'><em>No se ha encontrado datos de restaurantes.</em></p>
            @endif
        </div>
    </div>
@endsection

@section('contact')
    <div class="row page-section" id="contact" style="width: 100%; height: 100%; background-color: rgba(255,127,80,0.82);
  background-image: url('https://cdn.pixabay.com/photo/2015/11/14/07/09/map-of-the-world-1042847_960_720.png');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Contactanos</h2>
                <h3 class="section-subheading">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <form id="contactForm" action="#" method="get">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="nombre" type="text" placeholder="Nombre *"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="email" type="email" placeholder="Email *"/>
                        </div>
                        <div class="form-group mb-md-0">
                            <input class="form-control" id="telefono" type="tel" placeholder="Telefono *"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <textarea class="form-control" id="message" placeholder="Tu Mensaje *"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-xl text-uppercase disabled" type="submit" style="background-color: #d63838;">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
