@extends('partial.main')
@section('title', 'Dashboard Data Pegawai')
<head>
    <link rel="stylesheet" href="{{ asset('css/pegawai.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
@section('content')
@if(Session::has('success'))
      <script>
          document.addEventListener('DOMContentLoaded', function () {
            const Toast = Swal.mixin({
              toast: true,
              position: "top",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
              }
            });
            Toast.fire({
              icon: 'success',
              title: '{{ Session::get('success') }}'
            });
          });
      </script>
  @endif
  
  <div class="table-container">
    <div class="head d-flex justify-content-between align-items-center mb-2">
      <h4 class="mb-0">Data Pegawai</h4>
      <div class="head d-flex justify-content-between align-items-center mb-2">
        <a href="{{ route('pegawai.create') }}" class="btn btn-outline-info btn-sm d-flex align-items-center" id="btnTambah" style="margin-right: 10px;">
          <i class="fa-solid fa-plus pluss p-2"></i>
        </a>
        <form action="{{ route('pegawai.downloadReport') }}" method="GET" class="mb-0">
          <button type="submit" class="btn btn-outline-success btn-sm d-flex align-items-center" id="bt-download">
            <i class="fa-solid fa-file-excel p-2"></i>
          </button>
        </form>
      </div>
    </div>

    <div class="table-wrapper">
    <table id="tbDashboard" class="table table-responsive table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Foto</th>
          <th>Nama Depan</th>
          <th>Nama Belakang</th>
          <th>Tanggal Lahir</th>
          <th>Tanggal Masuk</th>
          <th>Jenis Kelamin</th>
          <th>Alamat</th>
          <th>Kota</th>
          <th>Provinsi</th>
          <th>Kode Pos</th>
          <th>Telepon</th>
          <th>Email</th>
          <th>Nip</th>
          <th>Departemen</th>
          <th>Jabatan</th>
          <th>Gaji</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>  
  </div>  

@include('pegawai.data')

@endsection