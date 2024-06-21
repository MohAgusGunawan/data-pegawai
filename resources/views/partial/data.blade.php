@stack('script')
<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Load DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const deptChartCtx = document.getElementById('deptChart').getContext('2d');
    const jobChartCtx = document.getElementById('jobChart').getContext('2d');

    // Departemen
    var HR = '{{ $hr }}';
    var HRint = parseInt(HR);
    var IT = '{{ $it }}';
    var ITint = parseInt(IT);
    var Marketing = '{{ $marketing }}';
    var Marketingint = parseInt(Marketing);

    // Jabatan
    var Manajer = '{{ $manajer }}';
    var Manajerint = parseInt(Manajer);
    var Staff = '{{ $staff }}';
    var Staffint = parseInt(Staff);
    var Intern = '{{ $intern }}';
    var Internint = parseInt(Intern);

    const deptChart = new Chart(deptChartCtx, {
        type: 'pie',
        data: {
            labels: ['HR', 'IT', 'Marketing'],
            datasets: [{
                label: 'Pegawai per Departemen',
                data: [HRint, ITint, Marketingint],
                backgroundColor: ['#3498db', '#2ecc71', '#e74c3c']
            }]
        }
    });

    const jobChart = new Chart(jobChartCtx, {
        type: 'bar',
        data: {
            labels: ['Manager', 'Staff', 'Intern'],
            datasets: [{
                label: 'Pegawai per Jabatan',
                data: [Manajerint, Staffint, Internint],
                backgroundColor: ['#3498db', '#2ecc71', '#e74c3c']
            }]
        }
    });

    // data table
    var tabel;
    // read data pengguna
    $(document).ready(function () {
        tabel = $('#tbDashboard').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard') }}",
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
                {
                    data: 'nama_depan'
                },
                {
                    data: 'nama_belakang'
                },
                {
                    data: 'email'
                },
                {
                    data: 'nomor_telepon',
                    render: function (data, type, row, meta) {
                        return '<a href="https://wa.me/' + data + '" target="_blank">' + data +
                            '</a>';
                    },
                },
                {
                    data: 'nama_departemen'
                },
                {
                    data: 'nama_jabatan'
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

        $('#tbDashboard').each(function () {
            var datatable = $(this);
            var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
            search_input.attr('placeholder', 'Cari');
            search_input.removeClass('form-control-sm');
            var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
            length_sel.removeClass('form-control-sm');
        });
    });
</script>