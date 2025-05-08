@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="mb-0">
                    <i class="fas fa-sign-in-alt me-2"></i>Inloggen
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres</label>
                        <input type="email" class="form-control bg-dark text-light @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required autofocus>
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

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Onthoud mij</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-1"></i> Inloggen
                        </button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <p>Nog geen account? <a href="{{ route('register') }}" class="text-primary">Registreer hier</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection