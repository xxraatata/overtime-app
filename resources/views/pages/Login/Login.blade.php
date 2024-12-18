@extends('layouts.Layout.Layout')

@section('content')
    <div class="login-page">
        <div class="login-header">
            <img 
                src="https://pmb.polytechnic.astra.ac.id/Images/IMG_Logo.png?v=20230623" 
                alt="ASTRAtech" 
            />
        </div>

        <div class="login-container">
            <div class="login-box">
                <h2 class="login-title">Selamat Datang</h2>
                
                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="kry_username">Nama Akun</label>
                        <input
                            type="text"
                            id="kry_username"
                            name="kry_username"
                            value="{{ old('kry_username') }}"
                            required
                            autocomplete="username"
                            placeholder="Masukkan nama akun"
                        />
                    </div>
                    
                    <div class="form-group">
                        <label for="kry_password">Kata Sandi</label>
                        <input
                            type="password"
                            id="kry_password"
                            name="kry_password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan kata sandi"
                        />
                    </div>
                    
                    <button type="submit" class="btn-masuk">
                        Masuk
                    </button>
                </form>
            </div>
        </div>

        <div class="login-footer">
            <p>Copyright © 2024 - Employee Self Service Politeknik Astra</p>
        </div>
    </div>
@endsection