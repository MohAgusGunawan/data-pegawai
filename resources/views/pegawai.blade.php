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
  
  <div class="table-container">
    <table id="tbDashboard" class="table table-responsive table-hover">
      <h4>Data Pegawai</h4>
      <thead>
        <tr>
          <th>No</th>
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
          <th>Departemen</th>
          <th>Jabatan</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>  

<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
  var tabel = $('#tbDashboard').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('pegawai') }}",
    columns: [
      { 
        data: null,
        name: 'id',
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
          return meta.row + 1;
        }
      },
      { data: 'nama_depan' },
      { data: 'nama_belakang' },
      { data: 'tanggal_lahir' },
      { data: 'tanggal_masuk' },
      { data: 'jenis_kelamin' },
      { data: 'alamat' },
      { data: 'kota' },
      { data: 'provinsi' },
      { data: 'kode_pos' },
      { 
        data: 'nomor_telepon',
        render: function (data, type, row, meta) {
          return '<a href="https://wa.me/' + data + '" target="_blank">' + data + '</a>';
        }
      },
      { data: 'email' },
      { data: 'nama_departemen' },
      { data: 'nama_jabatan' },
      {
    data: null,
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return '<a href="/pegawais/' + row.id + '/edit" class="btn btn-primary">Edit</a>' +
               ' <button type="button" class="btn btn-danger delete-btn" data-id="' + row.id + '">Delete</button>';
    }
}

    ],
    aLengthMenu: [
      [5, 10, 15, -1],
      [5, 10, 15, "All"]
    ],
    iDisplayLength: 10,
    language: {
      paginate: {
        previous: "Sebelumnya",
        next: "Selanjutnya"
      },
      info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ entri",
      zeroRecords: "Tidak ada data pegawai!",
      infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
      infoFiltered: "(disaring dari _MAX_ entri keseluruhan)"
    },
    responsive: true,
    columnDefs: [
      {
        orderable: false,
        targets: 0
      }
    ]
  });
});

</script>

@endsection