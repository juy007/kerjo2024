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

$(document).ready(function() {
    // Inisialisasi DataTable
    const table = $('#datatable').DataTable();

    // Mendapatkan elemen dropdown filter
    const lokasiEl = document.querySelector('#lokasiFilter');
    const gajiEl = document.querySelector('#gajiFilter');
    const pekerjaanEl = document.querySelector('#pekerjaanFilter');

    // Fungsi pencarian kustom
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            // Mendapatkan nilai filter
            var lokasi = lokasiEl.value.toLowerCase(); // Convert ke lowercase untuk pencocokan tidak sensitif
            var gaji = gajiEl.value.toLowerCase(); // Convert ke lowercase untuk pencocokan tidak sensitif
            var pekerjaan = pekerjaanEl.value.toLowerCase(); // Convert ke lowercase untuk pencocokan tidak sensitif

            // Mendapatkan nilai kolom
            var rowLokasi = data[2].toLowerCase(); // Lokasi ada di kolom kedua (index 2)
            var rowGaji = data[3].toLowerCase(); // Gaji ada di kolom ketiga (index 3)
            var rowPekerjaan = data[4].toLowerCase(); // Pekerjaan ada di kolom keempat (index 4)

            // Filter untuk lokasi: Cek apakah nilai filter ada di dalam nilai kolom (substring match)
            var isLokasiValid = lokasi === '' || rowLokasi.includes(lokasi);

            // Filter untuk gaji: Cek apakah nilai filter ada di dalam nilai kolom (substring match)
            var isGajiValid = gaji === '' || rowGaji.includes(gaji);

            // Filter untuk pekerjaan: Cek apakah nilai filter ada di dalam nilai kolom (substring match)
            var isPekerjaanValid = pekerjaan === '' || rowPekerjaan.includes(pekerjaan);

            // Mengembalikan true jika semua filter valid, berarti baris akan ditampilkan
            if (isLokasiValid && isGajiValid && isPekerjaanValid) {
                return true;
            }

            // Mengembalikan false jika ada filter yang tidak cocok, berarti baris akan disembunyikan
            return false;
        }
    );

    // Event listener untuk tombol "Apply"
    document.querySelector('#applyFilters').addEventListener('click', function() {
        table.draw(); // Redraw tabel untuk menerapkan filter
    });

    // Event listener untuk tombol "Reset"
    document.querySelector('#resetFilters').addEventListener('click', function() {
        // Mengatur ulang filter ke nilai kosong
        lokasiEl.value = '';
        gajiEl.value = '';
        pekerjaanEl.value = '';

        // Redraw tabel setelah reset
        table.draw();
    });
});