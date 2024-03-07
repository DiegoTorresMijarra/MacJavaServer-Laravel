<footer class="mt-4 text-center" style="height: 100%; color: #413f3d; border-top: 2px solid white; padding: 20px 0">
    <hr>
    <div class="row" style="width: 100%; padding: 10px">
        <div class="col-4 d-flex align-items-center">
            <h6><a href="https://github.com/DiegoTorresMijarra/MacJavaServer-Laravel" target="_blank">Repositorio Github</a></h6>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center shadow" style="border-radius: 50%;padding-left: 20px">
            <a class="navbar-brand" style="color: coral; font-size: 30px; font-family: 'Rowdies';" href="{{ url('/') }}">
                {{ config('name', 'MacJava') }}
            </a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <h6><a href="{{route('index')}}#contact" target="_self">Contactanos</a></h6>
        </div>
    </div>
</footer>
