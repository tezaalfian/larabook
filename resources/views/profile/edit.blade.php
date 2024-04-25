@if (Auth::user()->role == 'client')
    <x-layouts.client>
        <x-slot:heading>
            <div class="page-pretitle">
                Profil
            </div>
            <h2 class="page-title">
                Edit Profil
            </h2>
        </x-slot:heading>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profil</h3>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Edit Password</h3>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.client>
@endif
@if (Auth::user()->role == 'admin')
    <x-layouts.admin>
        <x-slot:heading>
            <div class="page-pretitle">
                Profil
            </div>
            <h2 class="page-title">
                Edit Profil
            </h2>
        </x-slot:heading>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profil</h3>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Edit Password</h3>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.admin>
@endif
