<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //Login
    public function login()
    {
        return view('login');
    }

    //Login ke dashboard
    public function handleLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'password' => 'required|string|min:3',
        ]);

        return redirect()->route('dashboard', ['username' => $request->username]);
    }

    //Dashboard
    public function dashboard(Request $request)
    {
        $username = $request->query('username', 'Admin');
        return view('dashboard', compact('username'));
    }

    //Profile
    public function profile(Request $request)
    {
        $username = $request->query('username', 'Admin');
        return view('profile', compact('username'));
    }

    //Pengelolaan
    public function pengelolaan(Request $request)
    {
        $username = $request->query('username', 'Admin');
        $trips = [
            [
                'title'         => 'Open Trip Kawah Ijen Blue Fire',
                'kategori'      => 'Gunung',
                'durasi_hari'   => 1,
                'tanggal'       => '2025-11-05',
                'harga'         => 350000,
                'status'        => 'Tersedia',
                'kuota_total'   => 25,
                'kuota_terisi'  => 18,
                'meeting_point' => 'Basecamp Paltuding',
            ],
            [
                'title'         => 'Open Trip Baluran + Pantai Bama',
                'kategori'      => 'Laut',
                'durasi_hari'   => 1,
                'tanggal'       => '2025-11-12',
                'harga'         => 400000,
                'status'        => 'Tersedia',
                'kuota_total'   => 20,
                'kuota_terisi'  => 7,
                'meeting_point' => 'Gerbang Taman Nasional Baluran',
            ],
            [
                'title'         => 'Open Trip Desa Wisata Osing Kemiren',
                'kategori'      => 'Budaya',
                'durasi_hari'   => 1,
                'tanggal'       => '2025-11-09',
                'harga'         => 300000,
                'status'        => 'Penuh',
                'kuota_total'   => 30,
                'kuota_terisi'  => 30,
                'meeting_point' => 'Tugu Blambangan',
            ],
            [
                'title'         => 'Open Trip Pulau Merah Sunset',
                'kategori'      => 'Laut',
                'durasi_hari'   => 1,
                'tanggal'       => '2025-11-20',
                'harga'         => 320000,
                'status'        => 'Tersedia',
                'kuota_total'   => 15,
                'kuota_terisi'  => 5,
                'meeting_point' => 'Pantai Pulau Merah Gate',
            ],
        ];

        foreach ($trips as $i => $t) {
            $trips[$i]['sisa_kuota'] = max(0, ($t['kuota_total'] ?? 0) - ($t['kuota_terisi'] ?? 0));
        }

        //Statistik
        $aktifCount  = count(array_filter($trips, fn($t) => ($t['status'] ?? '') === 'Tersedia'));
        $penuhCount  = count(array_filter($trips, fn($t) => ($t['status'] ?? '') === 'Penuh'));
        $sisaTotal   = array_sum(array_map(fn($t) => $t['sisa_kuota'], $trips));
        $terisiTotal = array_sum(array_map(fn($t) => $t['kuota_terisi'], $trips));
        $hargaAvail  = array_map(fn($t) => $t['harga'], array_filter($trips, fn($t) => $t['status'] === 'Tersedia'));
        $termurah    = !empty($hargaAvail) ? min($hargaAvail) : null;

        $stats = [
            'paket_aktif'    => $aktifCount,
            'paket_penuh'    => $penuhCount,
            'total_terisi'   => $terisiTotal,
            'total_sisa'     => $sisaTotal,
            'harga_termurah' => $termurah,
        ];

        return view('pengelolaan', compact('username', 'trips', 'stats'));
    }
}
