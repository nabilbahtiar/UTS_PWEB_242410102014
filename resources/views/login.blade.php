@extends('layouts.app')

@section('title', 'Login — OpenTrip Banyuwangi')

@section('content')
  <div class="card" style="max-width:480px; margin:auto; text-align:center;">
    <h2 style="margin-bottom:20px;">Login Admin</h2>
    <p style="font-size:14px; opacity:0.8; margin-bottom:20px;">
      Masuk untuk mengelola paket Open Trip Banyuwangi
    </p>

    <form method="POST" action="{{ route('handleLogin') }}">
      @csrf

      <div style="text-align:left; margin-bottom:15px;">
        <label>Username</label>
        <input type="text"
          name="username"
          style="width:100%; padding:10px 14px; border:1px solid #ccc; border-radius:var(--radius); margin-top:5px;">
      </div>

      <div style="text-align:left; margin-bottom:20px;">
        <label>Password</label>
        <input type="password"
          name="password"
          style="width:100%; padding:10px 14px; border:1px solid #ccc; border-radius:var(--radius); margin-top:5px;">
      </div>

      <button type="submit"
        style="width:100%; padding:12px; background:var(--primary); color:white; border:none; border-radius:var(--radius); cursor:pointer; font-size:16px;">
        Masuk Sekarang
      </button>

      @error('username')
        <p style="color:#dc2626; margin-top:10px;">{{ $message }}</p>
      @enderror
      @error('password')
        <p style="color:#dc2626; margin-top:10px;">{{ $message }}</p>
      @enderror
    </form>
  </div>
@endsection