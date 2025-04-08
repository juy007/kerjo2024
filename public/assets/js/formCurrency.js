function formatCurrency(input) {
    // Hapus semua karakter selain angka
    let value = input.value.replace(/[^0-9]/g, '');

    // Tambahkan tanda pemisah ribuan
    value = new Intl.NumberFormat('id-ID', {
        /*style: 'currency',
        currency: 'IDR',*/
        minimumFractionDigits: 0
    }).format(value);

    // Tampilkan hasil format di dalam input
    input.value = value;
}

function number(evt) {
    const charCode = evt.which ? evt.which : evt.keyCode;
    // Izinkan hanya angka (0-9)
    if (charCode < 48 || charCode > 57) {
        evt.preventDefault();
        return false;
    }
    return true;
}