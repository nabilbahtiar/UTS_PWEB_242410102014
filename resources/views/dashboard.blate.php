@extends('layouts.app')

@section('title', 'Dashboard — OpenTrip Banyuwangi')

@section('content')
  <section style="
    background-image:
      linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)),
      url(/images/ijen.jpg);
    background-size: cover;
    background-position: center;
    min-height: 360px;
    padding: 120px 20px;
    border-radius: var(--radius);
    color: #fff;
    text-align: center;
    margin-bottom: 30px;
    display: flex; align-items: center; justify-content: center; flex-direction: column;
  ">
    <h1 style="font-size: 36px; font-weight:700; margin-bottom:10px;">
       Trip Banyuwangi
    </h1>
    <p style="font-size: 18px; max-width:600px; margin:auto; opacity:0.95;">
      From the mystical blue fire of Kawah Ijen to stunning beaches and explore the hidden paradise of East Java.
    </p>

    <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="btn" style="margin-top:20px;">
      Lihat Paket Open Trip →
    </a>
  </section>

  <div class="card">
    <h2 style="margin-bottom:10px;">Selamat Datang, {{ $username ?? 'Admin' }}! </h2>
    <p class="muted" style="margin-bottom:20px;">
      Ringkasan aktivitas OpenTrip Banyuwangi saat ini.
    </p>

    <div style="display:grid; gap:20px; grid-template-columns:repeat(auto-fit, minmax(240px,1fr));">
      <div class="card" style="text-align:center; background:var(--primary); color:#fff;">
        <h3 style="margin:0; font-size:20px;">Paket Aktif</h3>
        <p style="font-size:36px; font-weight:bold; margin:10px 0;">3</p>
        <small>Paket Open Trip yang sedang dibuka</small>
      </div>

      <div class="card" style="text-align:center;">
        <h3 style="margin:0; font-size:20px;">Pendaftar Baru</h3>
        <p style="font-size:36px; font-weight:bold; margin:10px 0;">14</p>
        <small>Jumlah Wisatawan mendaftar minggu ini</small>
      </div>
    </div>
  </div>
@endsection