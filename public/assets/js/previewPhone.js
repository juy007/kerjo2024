function getSelectedText(selectId) {
    const selectElement = document.getElementById(selectId);
    return selectElement?.options[selectElement.selectedIndex]?.text || '';
}

function getSelectedValue(selectId) {
    const selectElement = document.getElementById(selectId);
    return selectElement?.value || '';
}

function isCKEEmpty(content) {
    return content.trim() === '' || content.trim() === '<p><br data-cke-filler="true"></p>';
}

function previewPhone() {
    let isFieldEmpty = false;

    const jobTitle = document.getElementById("form_lowongan")?.value.trim() || '';
    const kotaValue = getSelectedValue("form_kota");
    const provinsiValue = getSelectedValue("form_provinsi");
    const kotaText = getSelectedText("form_kota");
    const provinsiText = getSelectedText("form_provinsi");

    const tipePekerjaanValue = getSelectedValue("form_tipe_pekerjaan");
    const statusKaryawanValue = getSelectedValue("form_tipe_status_karyawan");
    const posisiLevelValue = getSelectedValue("form_posisi_level");
    const kategoriValue = getSelectedValue("kategori");
    const subKategoriValue = getSelectedValue("sub_kategori");

    const kategoriText = getSelectedText("kategori");
    const subKategoriText = getSelectedText("sub_kategori");

    const statusJobs = getSelectedText("form_status");

    const editor1Content = document.getElementById("editor1")?.querySelector(".ck-editor__editable")?.innerHTML || '';
    const editor2Content = document.getElementById("editor2")?.querySelector(".ck-editor__editable")?.innerHTML || '';
    const editor3Content = document.getElementById("editor3")?.querySelector(".ck-editor__editable")?.innerHTML || '';

    // Set ke preview
    document.getElementById("job_title_pre").innerHTML = jobTitle;
    document.getElementById("lokasi_pre").innerHTML = `${kotaText}${kotaValue && provinsiValue ? ', ' : ''}${provinsiText}`;
    document.getElementById("tipe_pekerjaan_pre").innerHTML = getSelectedText("form_tipe_pekerjaan");
    document.getElementById("status_karyawan_pre").innerHTML = getSelectedText("form_tipe_status_karyawan");
    document.getElementById("posisi_level_pre").innerHTML = getSelectedText("form_posisi_level");
    document.getElementById("kategori_pekerjaan_pre").innerHTML = `${kategoriText}${kategoriValue && subKategoriValue ? ' - ' : ''}${subKategoriText}`;
    document.getElementById("job_description_pre").innerHTML = editor1Content;
    document.getElementById("job_detail_pre").innerHTML = editor2Content;
    document.getElementById("job_kualifikasi_pre").innerHTML = editor3Content;

    // Validasi semua field yang harus diisi
    if (
        !jobTitle || !kotaValue || !provinsiValue || !tipePekerjaanValue ||
        !statusKaryawanValue || !posisiLevelValue || !kategoriValue || !subKategoriValue || !statusJobs ||
        isCKEEmpty(editor1Content) || isCKEEmpty(editor2Content) || isCKEEmpty(editor3Content)
    ) {
        Swal.fire({
            icon: "warning",
            title: "Form Tidak Lengkap",
            text: "Semua form harus diisi sebelum preview!",
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6",
        });
        return;
    }

    // Jika semua valid, tampilkan modal
    new bootstrap.Modal(document.getElementById("modal-preview"), {
        keyboard: false,
    }).show();
}
