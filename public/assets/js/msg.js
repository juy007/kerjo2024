document.addEventListener("DOMContentLoaded", () => {
    const currentUserId = window.ChatConfig.currentUserId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const chatBox = document.getElementById("chat-box");
    const messagesContainer = document.getElementById("messages");
    const loader = document.getElementById("loader");
    const messageForm = document.getElementById("messageForm");
    const chatContent = document.getElementById("chatContent");
    const toId = document.getElementById('userId').value;

    let page = 1;
    let hasMore = true;
    let sendTimeout;
    let lastSendTime = 0;
    const MIN_SEND_INTERVAL = 1000; // 1 detik minimum interval

    // Fungsi sanitization untuk mencegah XSS
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Validasi input pesan
    function validateMessage(message) {
        if (!message || message.trim().length === 0) {
            return { valid: false, error: 'Pesan tidak boleh kosong' };
        }
        
        if (message.length > 1000) {
            return { valid: false, error: 'Pesan terlalu panjang (maksimal 1000 karakter)' };
        }
        
        const suspiciousPatterns = [
            /<script/i,
            /javascript:/i,
            /on\w+\s*=/i,
            /data:text\/html/i
        ];
        
        for (let pattern of suspiciousPatterns) {
            if (pattern.test(message)) {
                return { valid: false, error: 'Pesan mengandung konten yang tidak diizinkan' };
            }
        }
        
        return { valid: true };
    }

    // Error handling yang lebih baik
    function handleApiError(response, errorMessage) {
        if (response.status === 401) {
            alert('Sesi Anda telah berakhir. Silakan login kembali.');
            window.location.href = '/login';
            return;
        }
        
        if (response.status === 403) {
            alert('Anda tidak memiliki izin untuk melakukan aksi ini.');
            return;
        }
        
        if (response.status === 429) {
            alert('Terlalu banyak request. Silakan tunggu sebentar.');
            return;
        }
        
        if (response.status >= 500) {
            alert('Terjadi kesalahan pada server. Silakan coba lagi nanti.');
            return;
        }
        
        alert(errorMessage);
    }

    function renderMessageHTML(msg, currentUserId) {
        const d = new Date(msg.createdAt);
        const dateStr = d.toLocaleDateString('id-ID', {
            day: '2-digit', month: 'short', year: 'numeric'
        });
        const timeStr = d.toLocaleTimeString('id-ID', {
            hour: '2-digit', minute: '2-digit', hour12: false
        });

        const formattedDateTime = `${dateStr}, ${timeStr}`;
        const isCurrentUser = msg.user === currentUserId;
        
        // Sanitize message content
        const sanitizedContent = escapeHtml(msg.content);

        let readStatus = '';
        if (!isCurrentUser) {
            readStatus = `
                <span class="read-status ms-2">
                    ${msg.status === 'read'
                        ? '<i class="fas fa-check-double" title="Dibaca"></i>'
                        : '<i class="fas fa-check text-muted" title="Terkirim, belum dibaca"></i>'}
                </span>`;
        }

        return `
<li class="${isCurrentUser ? 'left' : 'right'}">
    <div class="d-flex">
        <div class="flex-1">
            <div class="ctext-wrap position-relative">
                <div class="ctext-wrap-content">
                    <div class="conversation-name d-flex justify-content-between align-items-center">
                        <span class="time">${formattedDateTime}</span>
                        ${readStatus}
                    </div>
                    <p class="mb-0">${sanitizedContent}</p>
                </div>
            </div>
        </div>
    </div>
</li>`;
    }

    function loadMoreMessages() {
        if (!hasMore) return;
        loader.style.display = 'block';
        const prevScrollHeight = chatBox.scrollHeight;
        const prevScrollTop = chatBox.scrollTop;
        page++;

        // Gunakan relative URL
        fetch(`/read/${toId}?page=${page}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) {
                throw new Error(`HTTP ${res.status}`);
            }
            return res.json();
        })
        .then(data => {
            loader.style.display = 'none';

            if (!data.messages || data.messages.length === 0) {
                hasMore = false;
                return;
            }

            data.messages.reverse().forEach(msg => {
                const liHTML = renderMessageHTML(msg, currentUserId);
                messagesContainer.insertAdjacentHTML('afterbegin', liHTML);
            });

            const newScrollHeight = chatBox.scrollHeight;
            chatBox.scrollTop = newScrollHeight - prevScrollHeight + prevScrollTop;
        })
        .catch(err => {
            console.error('Gagal memuat pesan:', err);
            loader.style.display = 'none';
            handleApiError(err, 'Gagal memuat pesan');
        });
    }

    function sendMessage(event) {
        event.preventDefault();

        const now = Date.now();
        if (now - lastSendTime < MIN_SEND_INTERVAL) {
            alert('Tunggu sebentar sebelum mengirim pesan lagi');
            return;
        }

        const message = chatContent.value.trim();
        const validation = validateMessage(message);
        
        if (!validation.valid) {
            alert(validation.error);
            return;
        }

        const sendButton = messageForm.querySelector('button[type="submit"]');
        const originalButtonHTML = sendButton.innerHTML;

        // Clear previous timeout
        if (sendTimeout) {
            clearTimeout(sendTimeout);
        }

        sendButton.disabled = true;
        sendButton.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Mengirim...`;

        sendTimeout = setTimeout(() => {
            // Gunakan relative URL
            fetch('/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    toId,
                    content: message
                })
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error(`HTTP ${res.status}`);
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    const newMsg = {
                        content: message,
                        createdAt: new Date().toISOString(),
                        user: toId,
                        status: 'unread'
                    };

                    const liHTML = renderMessageHTML(newMsg, currentUserId);
                    messagesContainer.insertAdjacentHTML('beforeend', liHTML);
                    chatContent.value = '';
                    chatBox.scrollTop = chatBox.scrollHeight;
                    lastSendTime = Date.now();
                } else {
                    alert('Gagal mengirim pesan');
                }
            })
            .catch(err => {
                console.error('Terjadi kesalahan saat mengirim pesan:', err);
                handleApiError(err, 'Terjadi kesalahan saat mengirim pesan');
            })
            .finally(() => {
                sendButton.disabled = false;
                sendButton.innerHTML = originalButtonHTML;
            });
        }, 300); // 300ms debounce
    }

    function init() {
        chatBox.scrollTop = chatBox.scrollHeight;

        chatBox.addEventListener('scroll', () => {
            if (chatBox.scrollTop <= 50 && hasMore) {
                loadMoreMessages();
            }
        });

        messageForm.addEventListener('submit', sendMessage);
    }

    init();
});