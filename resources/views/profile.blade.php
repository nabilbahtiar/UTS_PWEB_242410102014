@extends('layouts.app')

@section('title', 'Profil Admin — OpenTrip Banyuwangi')

@section('content')
@php
  $name   = $username ?? 'Admin';
  $init   = strtoupper(substr(trim($name), 0, 1));
  $email  = strtolower(preg_replace('/\s+/', '', $name)).'@gmail.com'; 
  $joined = \Carbon\Carbon::parse('2024-09-01')->translatedFormat('d M Y');
@endphp

  <div class="card" style="padding:24px 24px;">
    <div style="display:flex; gap:18px; align-items:center; flex-wrap:wrap;">
      <div style="
          width:64px; height:64px; border-radius:50%;
          background:linear-gradient(135deg,#0d6efd 0%, #4ea9ff 100%);
          color:#fff; display:flex; align-items:center; justify-content:center;
          font-size:26px; font-weight:800; box-shadow:0 8px 24px rgba(13,110,253,.25);
      ">{{ $init }}</div>

      <div style="min-width:260px">
        <h2 style="margin:0 0 4px 0; font-weight:800;">{{ $name }}</h2>
        <div class="muted" style="margin:0;">Administrator • OpenTrip Banyuwangi</div>
      </div>
    </div>
  </div>

  <div class="card" style="margin:0;">
    <h3 style="margin-top:0;">Informasi Akun</h3>
    <div style="display:grid; gap:0 24px; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));">
      <div style="padding:8px 0; border-bottom:1px solid #e2e8f0;">
        <div class="muted" style="font-size:12px;">Username</div>
        <div style="font-weight:700;">{{ $name }}</div>
      </div>

      <div style="padding:8px 0; border-bottom:1px solid #e2e8f0;">
        <div class="muted" style="font-size:12px;">Email</div>
        <div style="font-weight:700;">{{ $email }}</div>
      </div>

      <div style="padding:8px 0; border-bottom:1px solid #e2e8f0;">
        <div class="muted" style="font-size:12px;">Peran</div>
        <div style="font-weight:700;">Administrator / Tour Organizer</div>
      </div>

      <div style="padding:8px 0; border-bottom:1px solid #e2e8f0;">
        <div class="muted" style="font-size:12px;">Status Akun</div>
        <div style="font-weight:700;">Aktif</div>
      </div>

      <div style="padding:8px 0;">
        <div class="muted" style="font-size:12px;">Bergabung Sejak</div>
        <div style="font-weight:700;">{{ $joined }}</div>
      </div>
    </div>
  </div>
@endsection