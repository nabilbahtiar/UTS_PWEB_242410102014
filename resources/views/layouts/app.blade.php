<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'OpenTrip Banyuwangi')</title>

  <style>
    :root{
      --primary:#0d6efd; --gray:#f1f5f9; --dark:#1e293b;
      --radius:14px; --max-width:1080px; --muted:#64748b;
    }
    *{box-sizing:border-box}
    body{font-family:system-ui,Segoe UI,Arial,sans-serif;margin:0;background:var(--gray);color:var(--dark)}
    .container{max-width:var(--max-width);margin:auto;padding:20px}

    header.site-header{
      position:fixed; inset:0 0 auto 0; z-index:9999;
      background:rgba(0,0,0,.35);
      -webkit-backdrop-filter:saturate(160%) blur(12px);
      backdrop-filter:saturate(160%) blur(12px);
      border-bottom:1px solid rgba(255,255,255,.08);
    }
    .nav-inner{max-width:none; padding:0; width:100%;}
    nav{display:flex;align-items:center;width:100%}
    .brand{padding:14px 0 14px 24px; font-weight:800; font-size:1.2rem; color:#fff;}
    .menu{margin-left:auto; padding:8px 24px 8px 0; display:flex; gap:10px;}
    nav a{padding:10px 14px; text-decoration:none; color:#fff; border-radius:999px; font-weight:700; transition:all .2s}
    nav a:hover{background:rgba(255,255,255,.18)}
    nav a.active{background:#fff; color:var(--primary); box-shadow:0 8px 22px rgba(13,110,253,.25)}

    .card{background:#fff;border-radius:var(--radius);padding:20px;margin-bottom:20px;border:1px solid #e2e8f0;box-shadow:0 4px 20px rgba(0,0,0,.05)}
    table{width:100%;border-collapse:collapse;background:#fff;border-radius:var(--radius);overflow:hidden}
    th,td{padding:12px;border-bottom:1px solid #e2e8f0;text-align:left}
    thead th{background:var(--primary);color:#fff}

    .btn{display:inline-block;padding:12px 20px;border-radius:999px;background:var(--primary);color:#fff;text-decoration:none;font-weight:700;transition:transform .06s, box-shadow .2s}
    .btn:hover{box-shadow:0 6px 14px rgba(13,110,253,.25)}
    .btn:active{transform:translateY(1px)}
    .muted{color:var(--muted)}

    main.container{padding-top:92px}
  </style>
</head>
<body>

  <header class="site-header">
    <div class="nav-inner">
      <x-navbar />
    </div>
  </header>

  <main class="container">
    @yield('content')
  </main>

  <footer>
    <div class="container">
      @include('components.footer')
    </div>
  </footer>
</body>
</html>