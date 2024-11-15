function getSelectedText(selectId) {
    var selectElement = document.getElementById(selectId);
    return selectElement.options[selectElement.selectedIndex].text;
}

function previewPhone() {
    // Daftar ID elemen yang perlu diambil nilainya atau teksnya
    var fields = ['form-lowongan', 'form-lokasi', 'form-tipe-pekerjaan', 'form-tipe-status-karyawan', 'form-posisi-level', 'kategori'];
    // ID elemen preview yang sesuai dengan `fields`
    var previews = ['job_title_pre', 'lokasi_pre', 'tipe_pekerjaan_pre', 'status_karyawan_pre', 'posisi_level_pre', 'kategori_pekerjaan_pre'];

    // Ambil elemen select untuk langsung mengambil selectedText dan value untuk selain select
    fields.forEach(function(field, index) {
        var fieldElement = document.getElementById(field);
        if (fieldElement.tagName === 'SELECT') {
            // Jika elemen adalah select, ambil teks yang dipilih
            document.getElementById(previews[index]).innerHTML = getSelectedText(field);
        } else {
            // Jika bukan select, ambil value langsung
            document.getElementById(previews[index]).innerHTML = fieldElement.value || "";
        }
    });

    // Ambil konten CKEditor hanya sekali
    var editor1Content = document.getElementById('editor1').querySelector('.ck-editor__editable').innerHTML;
    var editor2Content = document.getElementById('editor2').querySelector('.ck-editor__editable').innerHTML;
    var editor3Content = document.getElementById('editor3').querySelector('.ck-editor__editable').innerHTML;

    document.getElementById('job_description_pre').innerHTML = editor1Content;
    document.getElementById('job_detail_pre').innerHTML = editor2Content;
    document.getElementById('job_kualifikasi_pre').innerHTML = editor3Content;

    // Menampilkan modal
    new bootstrap.Modal(document.getElementById('modal-preview'), {
        keyboard: false
    }).show();
}