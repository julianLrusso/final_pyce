<x-layout>
    <x-slot:title>Home</x-slot:title>

    <h1 class="text-center my-3 fw-bold">Lo de Akara</h1>

    <section>
        <div class="row mb-5 d-flex align-items-center">
            <div class="col-12"><img src="{{url('img/fogata.png')}}" class="d-block mx-auto img-fluid w-50 max-w-400" alt="fogata de bienvenida"></div>
            <div class="col-12">
                <div class="fs-5">
                    <p>Soy Akara, suma sacerdotisa de la Hermandad del Ojo Ciego. Te doy la bienvenida a nuestro campamento, caminante, pero me temo que poco refugio puedo ofrecerte entre estos desvencijados muros.</p>
                    <p>Verás, nuestra antigua hermandad ha caído bajo una extraña maldición. La poderosa ciudadela desde la que hemos recibido juegos durante generaciones ha sido profanada por la malvada inflación Argentina.</p>
                    <p>Te lo suplico, ayúdanos. Encuentra la forma de levantar esta terrible maldición y te seremos leales para siempre.</p>
                    <p>Mientras tanto, puedo entretenerte vendiéndote algún que otro juego que ha quedado por aquí. Disfrútalo.</p>
                    <a class="btn btn-warning w-100" href="{{route('games.index')}}">Ver catálogo</a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
