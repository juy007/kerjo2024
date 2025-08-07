document.addEventListener('DOMContentLoaded', function() {
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        const modalToId = document.getElementById('modalToId');
        const modalName = document.getElementById('modalName');
        const modalAvatar = document.getElementById('modalAvatar');
        const chatContent = document.getElementById('chatContent');
        const alertContainer = document.getElementById('modalAlertContainer'); // Container untuk alert di dalam modal

        // Event listener untuk tombol membuka modal
        document.querySelectorAll('.openMessageModal').forEach(button => {
            button.addEventListener('click', function() {
                const toId = this.getAttribute('data-toId');
                const userName = this.getAttribute('data-name');
                const userAvatar = this.getAttribute('data-avatar');

                modalToId.value = toId;
                modalName.textContent = userName;
                modalAvatar.src = userAvatar;

                // Clear previous message dan alert
                chatContent.value = '';
                alertContainer.innerHTML = '';

                // Show the modal
                messageModal.show();
            });
        });

        // Event listener untuk form submit
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const chatMessage = chatContent.value.trim(); // Trim untuk menghapus spasi berlebih

            // Validasi jika form kosong
            if (chatMessage === '') {
                showModalAlert('danger', 'Pesan tidak boleh kosong!');
                return; // Stop pengiriman jika kosong
            }

            // Ubah tombol menjadi "Mengirim..."
            submitButton.textContent = 'Mengirim...';
            submitButton.disabled = true;

            // Simulasi AJAX (ganti dengan endpoint API sebenarnya)
            fetch('/send', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        toId: modalToId.value,
                        content: chatMessage
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showModalAlert('success', 'Pesan berhasil dikirim!');
                        chatContent.value = ''; // Reset textarea setelah sukses
                    } else {
                        showModalAlert('danger', 'Terjadi kesalahan, silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showModalAlert('danger', 'Terjadi kesalahan jaringan, silakan coba lagi.');
                })
                .finally(() => {
                    // Kembalikan tombol ke teks awal
                    submitButton.textContent = 'Kirim';
                    submitButton.disabled = false;
                });
        });

        // Fungsi untuk menampilkan alert di dalam modal
        function showModalAlert(type, message) {
            const alertHTML = `
            <div class="alert alert-${type} alert-border-left alert-dismissible fade show" role="alert">
                <i class="mdi ${type === 'success' ? 'mdi-check-all' : 'mdi-block-helper'} me-3 align-middle"></i>
                <strong>${type === 'success' ? 'Success' : 'Error'}</strong> - ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
            alertContainer.innerHTML = alertHTML;
        }
    });