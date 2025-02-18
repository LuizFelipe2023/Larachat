@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-4 mb-4">
        <div class="card shadow-lg border rounded-4 p-4 w-100" style="max-width: 800px; width: 100%;">
            <div class="card-header text-center bg-dark text-white border-bottom-0 rounded-3">
                <h2 class="fw-bold mt-2 mb-2">{{ __('Perfil') }}</h2>
            </div>
            <div class="card-body bg-light rounded-3 p-4">
                <div class="mb-4 p-3 bg-white shadow-sm rounded">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <hr class="my-4 border-dark">
                <div class="mb-4 p-3 bg-white shadow-sm rounded">
                    @include('profile.partials.update-password-form')
                </div>
                <hr class="my-4 border-dark">
                <div class="p-3 bg-white shadow-sm rounded">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
