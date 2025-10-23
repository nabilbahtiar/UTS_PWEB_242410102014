@extends('layouts.app')

@section('title', 'Pengelolaan Paket Trip — OpenTrip Banyuwangi')

@section('content')

  <div class="grid grid-2" style="margin-bottom:16px;">
    <div class="card" style="margin:0; text-align:center; background:var(--primary); color:#fff;">
      <div style="font-size:14px; opacity:.95;">Paket Aktif</div>
      <div style="font-size:34px; font-weight:800; margin-top:4px;">{{ $stats['paket_aktif'] }}</div>
    </div>
    <div class="card" style="margin:0; text-align:center;">
      <div style="font-size:14px;" class="muted">Paket Penuh</div>
      <div style="font-size:34px; font-weight:800; margin-top:4px;">{{ $stats['paket_penuh'] }}</div>
    </div>
    <div class="card" style="margin:0; text-align:center;">
      <div class="muted" style="font-size:14px;">Total Terisi</div>
      <div style="font-size:30px; font-weight:800;">{{ $stats['total_terisi'] }}</div>
    </div>
    <div class="card" style="margin:0; text-align:center;">
      <div class="muted" style="font-size:14px;">Total Sisa Kuota</div>
      <div style="font-size:30px; font-weight:800;">{{ $stats['total_sisa'] }}</div>
    </div>
  </div>

  <div class="card" style="margin-bottom:16px;">
    <form id="tooling" style="display:grid; gap:12px; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); align-items:end;">
      <div>
        <label class="muted">Cari Paket</label>
        <input id="q" type="text" placeholder="ketik nama paket…" style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:10px;">
      </div>
      <div>
        <label class="muted">Kategori</label>
        <select id="kat" style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:10px;">
          <option value="">Semua</option>
          <option>Gunung</option>
          <option>Laut</option>
          <option>Budaya</option>
        </select>
      </div>
      <div>
        <label class="muted">Status</label>
        <select id="st" style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:10px;">
          <option value="">Semua</option>
          <option>Tersedia</option>
          <option>Penuh</option>
        </select>
      </div>
      <div>
        <label class="muted">Urutkan</label>
        <select id="sort" style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:10px;">
          <option value="">Default</option>
          <option value="harga_asc">Harga Termurah</option>
          <option value="harga_desc">Harga Termahal</option>
          <option value="tgl_asc">Tanggal Terdekat</option>
          <option value="tgl_desc">Tanggal Terjauh</option>
        </select>
      </div>
      <div>
        <button type="button" id="reset" class="btn" style="width:100%;">Reset</button>
      </div>
    </form>
  </div>

  <div class="card">
    <table id="tabelTrip">
      <thead>
        <tr>
          <th>Nama Paket</th>
          <th>Kategori</th>
          <th>Tanggal</th>
          <th>Durasi</th>
          <th>Kuota</th>
          <th>Status</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        @forelse($trips as $t)
          @php
            $hargaFmt = 'Rp '.number_format($t['harga'],0,',','.');
            $tanggal = \Carbon\Carbon::parse($t['tanggal'])->translatedFormat('d M Y');
          @endphp
          <tr
            data-nama="{{ Str::lower($t['title']) }}"
            data-kat="{{ $t['kategori'] }}"
            data-st="{{ $t['status'] }}"
            data-harga="{{ $t['harga'] }}"
            data-tgl="{{ $t['tanggal'] }}"
          >
            <td>
              <strong>{{ $t['title'] }}</strong><br>
              <small class="muted">Meet: {{ $t['meeting_point'] }}</small>
            </td>
            <td>{{ $t['kategori'] }}</td>
            <td>{{ $tanggal }}</td>
            <td>{{ $t['durasi_hari'] }} hari</td>
            <td>
              {{ $t['kuota_terisi'] }}/{{ $t['kuota_total'] }}
              <span style="margin-left:6px; background:#0ea5e9; color:#fff; padding:2px 8px; border-radius:999px; font-size:12px;">
                sisa {{ $t['sisa_kuota'] }}
              </span>
            </td>
            <td>
              @if($t['status']==='Tersedia')
                <span style="background:#198754;color:#fff;padding:4px 10px;border-radius:999px;font-weight:600;">Tersedia</span>
              @else
                <span style="background:#dc2626;color:#fff;padding:4px 10px;border-radius:999px;font-weight:600;">Penuh</span>
              @endif
            </td>
            <td>{{ $hargaFmt }}</td>
          </tr>
        @empty
          <tr><td colspan="7" class="muted">Belum ada paket.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <script>
    (function(){
      const q    = document.getElementById('q');
      const kat  = document.getElementById('kat');
      const st   = document.getElementById('st');
      const sort = document.getElementById('sort');
      const reset= document.getElementById('reset');
      const tbody= document.querySelector('#tabelTrip tbody');

      function apply(){
        let rows = Array.from(tbody.querySelectorAll('tr'));
        // filter
        rows.forEach(tr=>{
          const nama = tr.dataset.nama || '';
          const okQ  = q.value ? nama.includes(q.value.toLowerCase()) : true;
          const okK  = kat.value ? tr.dataset.kat === kat.value : true;
          const okS  = st.value  ? tr.dataset.st  === st.value  : true;
          tr.style.display = (okQ && okK && okS) ? '' : 'none';
        });

        // sort
        let visible = rows.filter(tr => tr.style.display !== 'none');
        let key = sort.value;
        if(key){
          visible.sort((a,b)=>{
            if(key==='harga_asc')  return (+a.dataset.harga) - (+b.dataset.harga);
            if(key==='harga_desc') return (+b.dataset.harga) - (+a.dataset.harga);
            if(key==='tgl_asc')    return a.dataset.tgl.localeCompare(b.dataset.tgl);
            if(key==='tgl_desc')   return b.dataset.tgl.localeCompare(a.dataset.tgl);
            return 0;
          });
          visible.forEach(tr=>tbody.appendChild(tr));
        }
      }

      [q,kat,st,sort].forEach(el=>el.addEventListener('input', apply));
      reset.addEventListener('click', ()=>{
        q.value=''; kat.value=''; st.value=''; sort.value='';
        apply();
      });

      apply();
    })();
  </script>
@endsection
