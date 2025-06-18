document.getElementById('kategori').addEventListener('change', function () {
    const kategoriId = this.value;
    const subkategori = document.getElementById('sub_kategori');
    const categoriesDetailUrl = 'https://company.carikerjo.id/detail-categories-json';//document.querySelector('meta[name="route-categories-detail-json"]').content;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    subkategori.innerHTML = '<option>Loading...</option>';

    if (kategoriId) {
        fetch(categoriesDetailUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                id_categories: kategoriId
            })
        })
        .then(response => response.json())
        .then(data => {
            subkategori.innerHTML = '<option selected value="">Pilih Sub Kategori</option>';
            if (data.success && data.subCategories.length > 0) {
                data.subCategories.forEach(sub => {
                    subkategori.innerHTML += `<option value="${sub._id}">${sub.name}</option>`;
                });
            } else {
                subkategori.innerHTML = '<option value="">Sub kategori tidak ditemukan</option>';
            }
        })
        .catch(error => {
            subkategori.innerHTML = '<option value="">Gagal mengambil sub kategori</option>';
        });
    } else {
        subkategori.innerHTML = '<option value="">Pilih Sub kategori</option>';
    }
});

document.getElementById('form_provinsi').addEventListener('change', function () {
    const provinsiId = this.value;
    const kotaSelect = document.getElementById('form_kota');
    const provincesDetailUrl = 'https://company.carikerjo.id/detail-provinces-json';//document.querySelector('meta[name="route-provinces-detail-json"]').content;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    kotaSelect.innerHTML = '<option>Loading...</option>';

    if (provinsiId) {
        fetch(provincesDetailUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                id_provinces: provinsiId // Ganti ke id_province kalau perlu
            })
        })
        .then(response => response.json())
        .then(data => {
            kotaSelect.innerHTML = '<option selected value="">Pilih Kota/Kabupaten</option>';
            if (data.success && data.regencies.length > 0) {
                data.regencies.forEach(kota => {
                    kotaSelect.innerHTML += `<option value="${kota._id}">${kota.name}</option>`;
                });
            } else {
                kotaSelect.innerHTML = '<option value="">Kota/Kabupaten tidak ditemukan</option>';
            }
        })
        .catch(error => {
            kotaSelect.innerHTML = '<option value="">Gagal mengambil data Kota/Kabupaten</option>';
        });
    } else {
        kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
    }
});