// Validasi form checkbox industries
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("industryForm");
    const message = document.getElementById("message");

    form.addEventListener("submit", (event) => {
        const checkboxes = document.querySelectorAll(
            'input[name="industries[]"]'
        );
        let isChecked = false;

        // Loop untuk mengecek apakah ada checkbox yang dipilih
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        // Jika tidak ada checkbox yang dipilih
        if (!isChecked) {
            message.textContent = "Please select at least one industry.";
            message.className = "message error";
            message.classList.remove("hidden");
            event.preventDefault(); // Prevent form submission
            return; // Stop further execution
        } else {
            message.textContent = "Validation successful, continue!";
            message.className = "message success";
            message.classList.remove("hidden");
            // Tidak perlu memanggil event.preventDefault() karena validasi berhasil
        }
    });
});
