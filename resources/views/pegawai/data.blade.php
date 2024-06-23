<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
  var tabel = $('#tbDashboard').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    scrollX: true,
    fixedHeader: {
        header: true,
        footer: true
    },
    ajax: "{{ route('pegawai.index') }}",
    columns: [
      { 
          data: null,
          name: 'id',
          orderable: false,
          searchable: false,
          render: function (data, type, row, meta) {
            var pageInfo = $('#tbDashboard').DataTable().page.info();
            return pageInfo.start + meta.row + 1;
          }
      },
      {
        data: 'foto_pegawai_url',
        render: function(data, type, row) {
            return '<img src="' + data + '" alt="Foto Pegawai" width="50" height="50"/>';
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
      { data: 'nip' },
      { data: 'nama_departemen' },
      { data: 'nama_jabatan' },
      { data: 'gaji' },
      {
        data: null,
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
            return '<a href="/pegawai/' + row.id + '/edit" class="btn btn-primary">Edit</a>' +
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

$('#tbDashboard').on('click', '.delete-btn', function() {
    var id = $(this).data('id');
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Anda tidak akan dapat mengembalikan ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus saja!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/pegawai/' + id,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            // Tampilkan pesan SweetAlert bahwa data berhasil dihapus
            Swal.fire(
              'Terhapus!',
              'Data pegawai berhasil dihapus.',
              'success'
            );
            // Reload tabel setelah berhasil menghapus
            $('#tbDashboard').DataTable().ajax.reload();
          },
          error: function(xhr, status, error) {
            console.error(xhr);
            Swal.fire(
              'Gagal!',
              'Terjadi kesalahan saat menghapus data: ' + error,
              'error'
            );
          }
        });
      }
    });
  });
</script>