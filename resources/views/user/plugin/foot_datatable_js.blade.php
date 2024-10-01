<!-- Datatable=========================================================================== -->
<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    $(document).ready(function() {
        let tagfilter = document.getElementById('filter');
        let tagsearch = document.querySelector('#datatable_filter input[type="search"]');

        if (tagfilter && tagsearch) {
            tagfilter.appendChild(tagsearch);
        } else {
            console.error("Elemen tidak ditemukan!");
        }
        $('input[type="search"]').attr('placeholder', 'Search');
        $('input[type="search"]').removeClass('form-control-sm');
        document.getElementById('datatable_filter').innerHTML = "";

        let show_data = document.getElementById('show_data');
        let f_show_data = document.querySelector('#dataTables_length');
        show_data.appendChild(f_show_data);
        console.log(f_show_data);
    });
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        const table = $('#datatable').DataTable();

        // Mendapatkan elemen dropdown
        const statusEl = document.querySelector('#statusFilter');

        // Fungsi pencarian kustom
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                // Mendapatkan nilai filter
                var status = statusEl.value;
                var rowStatus = data[5]; // Asumsi kolom status ada di index ke-5

                // Mengembalikan true jika baris harus ditampilkan
                if (status === '' || rowStatus === status) {
                    return true;
                }

                // Mengembalikan false jika baris harus disembunyikan
                return false;
            }
        );

        // Event listener untuk filter
        statusEl.addEventListener('change', function() {
            table.draw(); // Redraw tabel untuk menerapkan filter
        });
    });
</script>