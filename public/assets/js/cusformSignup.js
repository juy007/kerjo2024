document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("signupForm");
    const message = document.getElementById("message");

    form.addEventListener("submit", (event) => {
        const password = document.getElementById("password-input").value;
        const confirmPassword =
            document.getElementById("password-input1").value;

        // Cek panjang password
        if (password.length < 8) {
            message.textContent =
                "Password must be at least 8 characters long.";
            message.className = "message error";
            message.classList.remove("hidden");
            event.preventDefault(); // Prevent form submission
            return; // Hentikan eksekusi lebih lanjut
        }

        // Cek kecocokan password
        if (password !== confirmPassword) {
            message.textContent = "Passwords do not match.";
            message.className = "message error";
            message.classList.remove("hidden");
            event.preventDefault(); // Prevent form submission
        } else {
            message.textContent = "Passwords match!";
            message.className = "message success";
            message.classList.remove("hidden");
            // Optional: Allow form submission or handle success case
        }
    });
});
