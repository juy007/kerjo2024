function getSelectedText(selectId) {
    var selectElement = document.getElementById(selectId);
    return selectElement.options[selectElement.selectedIndex]?.text || '';
}

function previewPhone() {
    var isFieldEmpty = false;

    // Ambil value untuk posisi lowongan
    var jobTitle = document.getElementById("form_lowongan").value.trim();
    document.getElementById("job_title_pre").innerHTML = jobTitle;
    if (!jobTitle) isFieldEmpty = true;

    // Gabung lokasi: kota + provinsi
    var kota = getSelectedText("form_kota");
    var provinsi = getSelectedText("form_provinsi");
    var lokasiGabungan = `${kota}${kota && provinsi ? ', ' : ''}${provinsi}`;
    document.getElementById("lokasi_pre").innerHTML = lokasiGabungan;
    if (!kota || !provinsi) isFieldEmpty = true;

    // Tipe pekerjaan
    var tipePekerjaan = getSelectedText("form_tipe_pekerjaan");
    document.getElementById("tipe_pekerjaan_pre").innerHTML = tipePekerjaan;
    if (!tipePekerjaan) isFieldEmpty = true;

    // Status karyawan
    var statusKaryawan = getSelectedText("form_tipe_status_karyawan");
    document.getElementById("status_karyawan_pre").innerHTML = statusKaryawan;
    if (!statusKaryawan) isFieldEmpty = true;

    // Posisi level
    var posisiLevel = getSelectedText("form_posisi_level");
    document.getElementById("posisi_level_pre").innerHTML = posisiLevel;
    if (!posisiLevel) isFieldEmpty = true;

    // Gabung kategori + sub kategori
    var kategori = getSelectedText("kategori");
    var subKategori = getSelectedText("sub_kategori");
    var kategoriGabungan = `${kategori}${kategori && subKategori ? ' - ' : ''}${subKategori}`;
    document.getElementById("kategori_pekerjaan_pre").innerHTML = kategoriGabungan;
    if (!kategori || !subKategori) isFieldEmpty = true;

    // CKEditor content
    var editor1Content = document
        .getElementById("editor1")
        .querySelector(".ck-editor__editable").innerHTML;
    var editor2Content = document
        .getElementById("editor2")
        .querySelector(".ck-editor__editable").innerHTML;
    var editor3Content = document
        .getElementById("editor3")
        .querySelector(".ck-editor__editable").innerHTML;

    document.getElementById("job_description_pre").innerHTML = editor1Content;
    document.getElementById("job_detail_pre").innerHTML = editor2Content;
    document.getElementById("job_kualifikasi_pre").innerHTML = editor3Content;

    const isCKEEmpty = content => content.trim() === '<p><br data-cke-filler="true"></p>';

    if (
        isCKEEmpty(editor1Content) ||
        isCKEEmpty(editor2Content) ||
        isCKEEmpty(editor3Content) ||
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
