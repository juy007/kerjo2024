function formatCurrency(input) {
    let rawValue = input.value.replace(/[^0-9]/g, '');

    // Format tampilan dengan ribuan
    let formatted = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0
    }).format(rawValue);

    input.value = formatted;

    // Set nilai asli ke input hidden
    if (document.getElementById('gaji')) {
        document.getElementById('gaji').value = rawValue;
    }

}

function number(evt) {
    const charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode < 48 || charCode > 57) {
        evt.preventDefault();
        return false;
    }
    return true;
}

// Trigger format saat halaman load jika ada nilai
document.addEventListener('DOMContentLoaded', function () {
    const viewInput = document.getElementById('gaji_view');
    if (viewInput?.value) {
        formatCurrency(viewInput);
    }
});


