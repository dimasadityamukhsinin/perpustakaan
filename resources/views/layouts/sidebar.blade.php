<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(Auth::user()->role === 'admin')
          <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
              <span>Dashboard</span>
            </a>
          </li>
          <li class="{{ Route::is('admin.anggota.*') ? 'active' : '' }}">
            <a href="{{ route('admin.anggota.index') }}">
              <span>Data Anggota</span>
            </a>
          </li>
          <li class="{{ Route::is('admin.buku.*') ? 'active' : '' }}">
            <a href="{{ route('admin.buku.index') }}">
              <span>Data Buku</span>
            </a>
          </li>
          <li class="{{ Route::is('admin.kategori_buku.*') ? 'active' : '' }}">
            <a href="{{ route('admin.kategori_buku.index') }}">
              <span>Data Kategori Buku</span>
            </a>
          </li>
          <li class="{{ Route::is('admin.rak_buku.*') ? 'active' : '' }}">
            <a href="{{ route('admin.rak_buku.index') }}">
              <span>Data Rak Buku</span>
            </a>
          </li>
          <li class="{{ Route::is('admin.peminjaman.*') ? 'active' : '' }}">
            <a href="{{ route('admin.peminjaman.index') }}">
              <span>Data Pemimjaman</span>
            </a>
          </li>
          <li class="{{ Route::is('admin.pengembalian.*') ? 'active' : '' }}">
            <a href="{{ route('admin.pengembalian.index') }}">
              <span>Data Pengembalian</span>
            </a>
          </li>
        @else
          <li class="{{ Route::is('anggota.dashboard') ? 'active' : '' }}">
            <a href="{{ route('anggota.dashboard') }}">
              <span>Dashboard</span>
            </a>
          </li>
          <li class="{{ Route::is('anggota.peminjaman.*') ? 'active' : '' }}">
            <a href="{{ route('anggota.peminjaman.index') }}">
              <span>Peminjaman</span>
            </a>
          </li>
          <li class="{{ Route::is('anggota.pengembalian.*') ? 'active' : '' }}">
            <a href="{{ route('anggota.pengembalian.index') }}">
              <span>Histori Pengembalian</span>
            </a>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>