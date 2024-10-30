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