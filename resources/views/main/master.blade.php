<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ $title }} | {{ $subtitle }}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('custom-style')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white p-3">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{ asset('dist/img/logo-unsyiah-2.png') }}" alt="{{ $title }} Logo" class="brand-image"
             style="opacity: .8" width="40em">
        <span class="brand-text font-weight-bold text-muted ml-2">{{ $title }}</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('main.dashboard') }}" class="nav-link{{ $nav_item_active == 'dashboard' ? ' text-bold' : '' }}">Dashboard</a>
          </li>
          {{--@if (isset($role->admin))
            <li class="nav-item">
              <a href="{{ route('main.admin.cek-data') }}" class="nav-link{{ $nav_item_active == 'cek-data' ? ' text-bold' : '' }}">Cek Data</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('main.admin.akun') }}" class="nav-link{{ $nav_item_active == 'akun' ? ' text-bold' : '' }}">Akun</a>
            </li>
          @endif--}}
          @if ($category != 'tamu')
            @if (isset($role->admin) | isset($role->koor_prodi) | isset($role->pembahas) | isset($role->ketua_kel_keahlian) | isset($role->pembimbing) | isset($role->mhs))
              <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link{{ $nav_item_active == 'kp' ? ' text-bold' : '' }} dropdown-toggle">KP</a>
                <ul class="dropdown-menu border-0 shadow">
                  <li><a href="{{ route('main.kp.disposisi') }}" class="dropdown-item">Disposisi</a></li>
                  @if (isset($role->mhs))
                    <li><a href="{{ route('main.kp.mahasiswa.input-usul') }}" class="dropdown-item">Input Usul KP</a></li>
                  @endif
                  @if (isset($role->admin))
                    <li><a href="{{ route('main.kp.admin.info-rekap-nilai-kp') }}" class="dropdown-item">Info Rekap Nilai KP</a></li>
                    <li><a href="{{ route('main.kp.admin.usulan-kp') }}" class="dropdown-item">1. Usulan KP</a></li>
                    <li><a href="{{ route('main.kp.admin.usulan-surat-permohonan-ke-proyek') }}" class="dropdown-item">2. Usulan Surat Permohonan Ke Proyek</a></li>
                    <li><a href="{{ route('main.kp.admin.usulan-surat-balasan-dari-proyek') }}" class="dropdown-item">3. Usulan Surat Balasan Dari Proyek</a></li>
                    <li><a href="{{ route('main.kp.admin.usulan-surat-ke-proyek') }}" class="dropdown-item">4. Usulan Surat Ke Proyek</a></li>
                    <li><a href="{{ route('main.kp.admin.usulan-sk-pembimbing-pembahas') }}" class="dropdown-item">5. Usulan SK Pembimbing/Pembahas</a></li>
                    <li><a href="{{ route('main.kp.admin.usulan-pengisian-masa-kp') }}" class="dropdown-item">6. Usulan Pengisian Masa KP</a></li>
                  @endif
                  @if (isset($role->koor_prodi))
                    <li><a href="{{ route('main.kp.koor-prodi.persetujuan-usulan-kp') }}" class="dropdown-item">1. Persetujuan Usulan KP</a></li>
                    <li><a href="{{ route('main.kp.koor-prodi.penetapan-sk-pembimbing-pembahas') }}" class="dropdown-item">2. Penetapan SK Pembimbing/Pembahas</a></li>
                    <li><a href="{{ route('main.kp.koor-prodi.pengisian-rekap-nilai-kp') }}" class="dropdown-item">3. Pengisian Rekap Nilai KP</a></li>
                    <li><a href="{{ route('main.kp.koor-prodi.persetujuan-usulan-kelengkapan-dokumen-administrasi') }}" class="dropdown-item">4. Persetujuan Usulan Kelengkapan Dokumen Administrasi</a></li>
                  @endif
                  @if (isset($role->pembimbing))
                    <li><a href="{{ route('main.kp.pembimbing.pemeriksaan-berkas-kp') }}" class="dropdown-item">1. Pemeriksaan Berkas KP</a></li>
                    <li><a href="{{ route('main.kp.pembimbing.penilaian-kp') }}" class="dropdown-item">2. Penilaian KP (Pembimbing)</a></li>
                    <li><a href="{{ route('main.kp.pembimbing.pemeriksaan-kelengkapan-dokumen-kp') }}" class="dropdown-item">3. Pemeriksaan Kelengkapan Dokumen KP</a></li>
                  @endif
                  @if (isset($role->pembahas))
                    <li><a href="{{ route('main.kp.pembahas.penilaian-kp') }}" class="dropdown-item">4. Penilaian KP (Pembahas)</a></li>
                  @endif
                  @if (isset($role->ketua_kel_keahlian))
                    <li><a href="{{ route('main.kp.ketua-kel-keahlian.pengusulan-pembimbing-pembahas') }}" class="dropdown-item">1. Pengusulan Pembimbing dan Pembahas</a></li>
                    {{--<li><a href="{{ route('main.kp.ketua-kel-keahlian.pengubahan-pembimbing') }}" class="dropdown-item">2. Pengubahan Pembimbing dan Co</a></li>--}}
                  @endif
                </ul>
              </li>
            @endif
            @if (isset($role->mhs))
              <li class="nav-item">
                <a href="{{ route('main.mahasiswa.biodata') }}" class="nav-link{{ $nav_item_active == 'biodata' ? ' text-bold' : '' }}">Biodata</a>
              </li>
            @endif
          @endif
          <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link{{ $nav_item_active == 'dosen' ? ' text-bold' : '' }} dropdown-toggle">Dosen</a>
            <ul class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('main.dosen.info') }}" class="dropdown-item">Info Dosen</a></li>
              <li><a href="{{ route('main.dosen.rekap') }}" class="dropdown-item">Rekap Dosen</a></li>
              @if (!isset($role->mhs))
                <li><a href="{{ route('main.dosen.info-mahasiswa') }}" class="dropdown-item">Info Mahasiswa KP</a></li>
              @endif
            </ul>
          </li>

          {{--@if (in_array($category, ['admin', 'mahasiswa']))
            <li class="nav-item">
              <a href="#" class="nav-link{{ $nav_item_active == 'nilai-mahasiswa' ? ' text-bold' : '' }}">Nilai Mahasiswa</a>
            </li>
          @endif--}}
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown ml-2 align-middle" id="user-info">
            <a class="nav-link" data-toggle="dropdown" href="#" style="display: inline;">
              <span class="text-bold"><b>{{ $nama }}</b>&nbsp;</span>
              <i class="fas fa-caret-down"></i>
              {{--<img src="{{ asset('dist/img/figure/default-user.jpg') }}" class="img-circle elevation-2 ml-2" alt="User Image">--}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">
                <h5>{{ mb_strimwidth($nama, 0, 20, "...") }}</h5>
                {{ $identity }}
              </span>
              @if ($category != 'tamu')
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#rubah-password-1">
                  <i class="fa fa-key mr-2"></i> Ubah Password
                </a>
              @endif
              <div class="dropdown-divider"></div>
              <a href="{{ route('auth.logout') }}" class="dropdown-item text-danger">
                <i class="fa fa-door-open mr-2"></i> Keluar
              </a>
            </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Ubah Password -->
  <div class="modal fade" id="rubah-password-1" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Ubah Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="{{ route('auth.password.change') }}" method="post">
            <div class="modal-body">
              @method('put')
              @csrf
              <table class="table table-light">
                <tr>
                  <td colspan="2" class="align-middle text-center">
                    <input type="password" class="form-control" name="old-password" placeholder="Masukkan password lama">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle text-center">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
                  </td>
                  <td class="align-middle text-center">
                    <input type="password" class="form-control" name="password-repeat" placeholder="Ulangi password baru">
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Kirim</button>
              </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> {{ $subtitle }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{--<ol class="breadcrumb float-sm-right">
              @yield('breadcumb')
            </ol>--}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content pb-4">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      PSTS Unsyiah (TGA) v1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://technosaber.com">Technosaber</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@if ( session('error') != null | session('warning') != null | session('success') != null | $errors->any() )
  <script>
    $(document).ready(function () {
      @if (session('error'))
        toastr.error('{{ session('error') }}')
      @endif
      @if (session('warning'))
        toastr.warning('{{ session('warning') }}')
      @endif
      @if (session('success'))
        toastr.success('{{ session('success') }}')
      @endif
      @if ($errors->any())
        var timeout = 0
        @foreach ($errors->all() as $error)
          setTimeout(function () {
            toastr.error('{{$error}}')
          }, timeout)
          timeout = timeout+300
        @endforeach
      @endif
    });
  </script>
@endif
@yield('custom-script')
</body>
</html>
