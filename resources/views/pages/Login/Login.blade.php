@extends('layouts.Layout.Layout')

@section('content')
<div class="container">
    <div class="breadcrumb">
        <a href="#">Employee Self Service Politeknik Astra</a>
    </div>
    
    <div class="header">
        <div class="form-title">Login</div>
    </div>
    
    @if ($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <div class="form-group">
            <div class="col col-12">
                <label>Username <span class="required">*</span></label>
                <input 
                    type="text" 
                    name="kry_username" 
                    value="{{ old('kry_username') }}"
                    required
                    autocomplete="username"
                    placeholder="Masukkan username"
                />
            </div>
        </div>
        
        <div class="form-group">
            <div class="col col-12">
                <label>Password <span class="required">*</span></label>
                <input 
                    type="password" 
                    name="kry_password" 
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan password"
                />
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Login</button>
        </div>
    </form>
</div>
@endsection
