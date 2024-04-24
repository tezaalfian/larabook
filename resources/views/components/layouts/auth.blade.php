<x-layouts.base className="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark h1">
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.base>
