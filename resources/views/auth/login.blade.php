<!DOCTYPE html>
<html>
<head>
    <title>Login - Employee Self Service Politeknik Astra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
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
                    {{ csrf_field() }}
                    
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

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html> 