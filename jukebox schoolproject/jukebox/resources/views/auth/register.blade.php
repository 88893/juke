@extends('layouts.app')

@section('title', 'Registreren')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>Registreren
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Naam</label>
                        <input type="text" class="form-control bg-dark text-light @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres</label>
                        <input type="email" class="form-control bg-dark text-light @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Wachtwoord</label>
                        <input type="password" class="form-control bg-dark text-light @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Bevestig wachtwoord</label>
                        <input type="password" class="form-control bg-dark text-light"
                            id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Registreren
                        </button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <p>Heb je al een account? <a href="{{ route('login') }}" class="text-primary">Log hier in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection