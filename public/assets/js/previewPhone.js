function getSelectedText(selectId) {
    var selectElement = document.getElementById(selectId);
    return selectElement.options[selectElement.selectedIndex].text;
}

function previewPhone() {
    // Daftar ID elemen yang perlu diambil nilainya atau teksnya
    var fields = [
        "form-lowongan",
        "form-lokasi",
        "form-tipe-pekerjaan",
        "form-tipe-status-karyawan",
        "form-posisi-level",
        "kategori",
    ];
    // ID elemen preview yang sesuai dengan `fields`
    var previews = [
        "job_title_pre",
        "lokasi_pre",
        "tipe_pekerjaan_pre",
        "status_karyawan_pre",
        "posisi_level_pre",
        "kategori_pekerjaan_pre",
    ];

    var isFieldEmpty = false; // Flag untuk mengecek apakah ada field yang kosong

    // Ambil elemen select untuk langsung mengambil selectedText dan value untuk selain select
    fields.forEach(function (field, index) {
        var fieldElement = document.getElementById(field);
        if (fieldElement.tagName === "SELECT") {
            // Jika elemen adalah select, ambil teks yang dipilih
            var selectedText = getSelectedText(field);
            document.getElementById(previews[index]).innerHTML = selectedText;
            if (!selectedText) isFieldEmpty = true; // Tandai jika ada field yang kosong
        } else {
            // Jika bukan select, ambil value langsung
            var fieldValue = fieldElement.value || "";
            document.getElementById(previews[index]).innerHTML = fieldValue;
            if (!fieldValue) isFieldEmpty = true; // Tandai jika ada field yang kosong
        }
    });

    // Ambil konten CKEditor hanya sekali
    var editor1Content = document
        .getElementById("editor1")
        .querySelector(".ck-editor__editable").innerHTML;
    var editor2Content = document
        .getElementById("editor2")
        .querySelector(".ck-editor__editable").innerHTML;
    var editor3Content = document
        .getElementById("editor3")
        .querySelector(".ck-editor__editable").innerHTML;

    // Set konten editor preview
    document.getElementById("job_description_pre").innerHTML = editor1Content;
    document.getElementById("job_detail_pre").innerHTML = editor2Content;
    document.getElementById("job_kualifikasi_pre").innerHTML = editor3Content;

    if (
        editor1Content.trim() === '<p><br data-cke-filler="true"></p>' ||
        editor2Content.trim() === '<p><br data-cke-filler="true"></p>' ||
        editor3Content.trim() === '<p><br data-cke-filler="true"></p>' ||
        isFieldEmpty
    ) {
        Swal.fire({
            icon: "warning",
            title: "Form Tidak Lengkap",
            text: "Semua form harus diisi sebelum preview!",
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6",
        });
    } else {
        new bootstrap.Modal(document.getElementById("modal-preview"), {
            keyboard: false,
        }).show();
    }
}
