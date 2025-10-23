<nav aria-label="Navigasi utama" style="width:100%; display:flex; align-items:center;">}
  <div class="brand">
    OpenTrip.<span style="color:var(--primary)">Banyuwangi</span>
  </div>

  @php $u = request('username'); @endphp
  <div class="menu">
    <a href="{{ route('dashboard', $u ? ['username'=>$u] : []) }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('pengelolaan', $u ? ['username'=>$u] : []) }}" class="{{ request()->routeIs('pengelolaan') ? 'active' : '' }}">Paket Trip</a>
    <a href="{{ route('profile', $u ? ['username'=>$u] : []) }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Logout</a>
  </div>
</nav>