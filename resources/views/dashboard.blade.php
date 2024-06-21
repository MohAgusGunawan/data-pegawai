@extends('partial.main')
@section('title', 'Dashboard Data Pegawai')
<head>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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

<div class="charts-row">
    <div class="chart-container">
        <h4>Departemen</h4>
        <canvas id="deptChart"></canvas>
    </div>
    <div class="chart-container">
        <h4>Jabatan</h4>
        <canvas id="jobChart"></canvas>
    </div>
</div>
<div class="table-container">
<table id="tbDashboard" class="table table-responsive table-hover">
  <div class="head d-flex justify-content-between align-items-center mb-2">
    <h4 class="mb-0">Data Pegawai</h4>
    <form action="" method="POST" class="mb-0">
      <button type="button" class="btn btn-success d-flex align-items-center text-light" id="bt-download">
        <i class="fa-solid fa-file-arrow-down p-2" style="width: 35px"></i>
        <span style="font-size: 1rem;">Download Laporan</span>
      </button>
    </form>
  </div>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Depan</th>
        <th>Nama Belakang</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Departemen</th>
        <th>Jabatan</th>
      </tr>
    </thead>
</table>  
</div>
@include('partial.data')

@endsection