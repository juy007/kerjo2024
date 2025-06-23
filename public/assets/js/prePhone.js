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

function formatRupiahSimplified(value) {
    const num = parseFloat(value.replace(/[^\d]/g, ''));
    if (isNaN(num)) return '';

    const juta = num / 1_000_000;
    if (juta >= 1) {
        return juta % 1 === 0 ? `${juta} Jt` : `${juta.toFixed(1)} Jt`;
    }

    const ribu = num / 1_000;
    return ribu >= 1 ? `${ribu.toFixed(0)} Rb` : num.toString();
}

function previewPhone() {
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

    const statusJobs = getSelectedValue("form_status");
    const statusText = getSelectedText("form_status");

    const editor1Content = document.getElementById("editor1")?.querySelector(".ck-editor__editable")?.innerHTML || '';
    const editor2Content = document.getElementById("editor2")?.querySelector(".ck-editor__editable")?.innerHTML || '';
    const editor3Content = document.getElementById("editor3")?.querySelector(".ck-editor__editable")?.innerHTML || '';

    // ======= Gaji & Frekuensi Pembayaran =======
    const mataUangText = getSelectedText("mata-uang");
    const gajiMin = document.getElementById("gaji_min")?.value.trim() || '';
    const gajiMax = document.getElementById("gaji_max")?.value.trim() || '';
    const frekuensiText = getSelectedText("form_frekuensi_pembayaran");

    const mataUangMatch = mataUangText.match(/\((.*?)\)/);
    const mataUangFinal = mataUangMatch ? mataUangMatch[1] : 'Rp';

    const gajiMinFormatted = gajiMin ? formatRupiahSimplified(gajiMin) : '';
    const gajiMaxFormatted = gajiMax ? formatRupiahSimplified(gajiMax) : '';

    let gajiFormatted = '';
    if (gajiMinFormatted && gajiMaxFormatted) {
        gajiFormatted = `${mataUangFinal} ${gajiMinFormatted} - ${gajiMaxFormatted}/${frekuensiText}`;
    } else if (gajiMinFormatted) {
        gajiFormatted = `${mataUangFinal} ${gajiMinFormatted}/${frekuensiText}`;
    } else if (gajiMaxFormatted) {
        gajiFormatted = `${mataUangFinal} ${gajiMaxFormatted}/${frekuensiText}`;
    }

    // ======= Set ke preview =======
    document.getElementById("job_title_pre").innerHTML = jobTitle;
    const cleanKotaText = kotaText.replace(/^(Kota|Kabupaten)\s*/i, '');
    document.getElementById("lokasi_pre").innerHTML = `${cleanKotaText}${kotaValue && provinsiValue ? ', ' : ''}${provinsiText}`;
    document.getElementById("tipe_pekerjaan_pre").innerHTML = getSelectedText("form_tipe_pekerjaan");
    document.getElementById("status_karyawan_pre").innerHTML = getSelectedText("form_tipe_status_karyawan");
    document.getElementById("posisi_level_pre").innerHTML = getSelectedText("form_posisi_level");
    document.getElementById("kategori_pekerjaan_pre").innerHTML = `${kategoriText}${kategoriValue && subKategoriValue ? ' - ' : ''}${subKategoriText}`;
    document.getElementById("job_description_pre").innerHTML = editor1Content;
    document.getElementById("job_detail_pre").innerHTML = editor2Content;
    document.getElementById("job_kualifikasi_pre").innerHTML = editor3Content;
    document.getElementById("gaji_pre").innerHTML = gajiFormatted;
    document.getElementById("status_pre").innerHTML = statusText;

    // ======= Validasi semua field yang harus diisi =======
    let missingFields = [];

    if (!jobTitle) missingFields.push("Judul Pekerjaan");
    if (!kotaValue) missingFields.push("Kota");
    if (!provinsiValue) missingFields.push("Provinsi");
    if (!tipePekerjaanValue) missingFields.push("Tipe Pekerjaan");
    if (!statusKaryawanValue) missingFields.push("Status Karyawan");
    if (!posisiLevelValue) missingFields.push("Level Posisi");
    if (!kategoriValue) missingFields.push("Kategori");
    if (!subKategoriValue) missingFields.push("Subkategori");
    if (!statusJobs) missingFields.push("Status Pekerjaan");
    if (!frekuensiText) missingFields.push("Frekuensi Pembayaran");
    if (!mataUangFinal) missingFields.push("Mata Uang");
    if (!gajiMin && !gajiMax) missingFields.push("Gaji Minimal atau Maksimal");

    if (isCKEEmpty(editor1Content)) missingFields.push("Deskripsi Pekerjaan");
    if (isCKEEmpty(editor2Content)) missingFields.push("Detail Pekerjaan");
    if (isCKEEmpty(editor3Content)) missingFields.push("Kualifikasi Pekerjaan");

    if (missingFields.length > 0) {
        Swal.fire({
            icon: "warning",
            title: "Form Tidak Lengkap",
            html: `<p>Form berikut wajib diisi sebelum preview:</p><ul style="text-align:left;">${missingFields.map(f => `<li>${f}</li>`).join('')}</ul>`,
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6",
        });
        return;
    }

    // ======= Tampilkan modal preview =======
    new bootstrap.Modal(document.getElementById("modal-preview"), {
        keyboard: false,
    }).show();
}