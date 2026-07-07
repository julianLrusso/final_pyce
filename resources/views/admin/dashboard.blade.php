<x-layout>
    <x-slot:title>Admin - Panel de control</x-slot:title>
    <div class="my-3 text-center mb-5">
        <h2>Panel de control del administrador</h2>
    </div>
    <div class="row">
        <div class="col-md-6 gap-2 mb-3">
            <a href="{{route('admin.users')}}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-4x text-primary mb-3"></i>
                        <h3 class="card-title">Administrar Usuarios</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 gap-2 mb-3">
            <a href="{{route('admin.blogs')}}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-blog fa-4x text-primary mb-3"></i>
                        <h3 class="card-title">Administrar Blogs</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 gap-2 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-4x text-danger mb-3"></i>
                    <h5 class="card-title">Compras Abandonadas</h5>
                    <p class="card-text">Porcentaje de compras no completadas: <strong>{{$abandonedPercentage}}%</strong></p>
                </div>
            </div>
        </div>

        <!-- Card: Juego Más Vendido -->
        <div class="col-md-6 gap-2 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-gamepad fa-4x text-info mb-3"></i>
                    <h5 class="card-title">Juego Más Vendido</h5>
                    <p class="card-text">El juego más vendido es: <strong>{{$mostSoldGameName}}</strong></p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
