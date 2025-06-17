document.addEventListener("DOMContentLoaded", () => {
    const currentUserId = window.ChatConfig.currentUserId;
    const detailMessageUrl = window.ChatConfig.detailMessageUrl;
    const sendMessageUrl = window.ChatConfig.sendMessageUrl;
    const csrfToken = window.ChatConfig.csrfToken;

    const chatBox = document.getElementById("chat-box");
    const messagesContainer = document.getElementById("messages");
    const loader = document.getElementById("loader");
    const messageForm = document.getElementById("messageForm");
    const chatContent = document.getElementById("chatContent");
    const toId = document.getElementById('userId').value;

     let page = 1;
    let hasMore = true;

    function renderMessageHTML(msg, currentUserId) {
        const d = new Date(msg.createdAt);
        const dateStr = d.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });

        const timeStr = d.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        const formattedDateTime = `${dateStr}, ${timeStr}`;
        const isCurrentUser = msg.from === currentUserId;
        const isRead = msg.is_read;

        const readStatus = isCurrentUser
            ? `<span class="read-status ms-2">
                    ${isRead
                        ? '<i class="fas fa-check-double text-primary" title="Dibaca"></i>'
                        : '<i class="fas fa-check text-muted" title="Terkirim, belum dibaca"></i>'}
               </span>`
            : '';

        return `
<li class="${isCurrentUser ? 'right' : 'left'}">
    <div class="">
        <div class="d-flex">
            <div class="flex-1">
                <div class="ctext-wrap position-relative">
                    <div class="ctext-wrap-content">
                        <div class="conversation-name d-flex justify-content-between align-items-center">
                            <span class="time">${formattedDateTime}</span>
                            ${readStatus}
                        </div>
                        <p class="mb-0">${msg.content}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>`;
    }

    function loadMoreMessages() {
        loader.style.display = 'block';
        const prevScrollHeight = chatBox.scrollHeight;
        page++;

        fetch(`${detailMessageUrl}?page=${page}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
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

            chatBox.scrollTop = chatBox.scrollHeight - prevScrollHeight;
        })
        .catch(err => {
            console.error('Gagal memuat pesan:', err);
            loader.style.display = 'none';
        });
    }

    function sendMessage(event) {
        event.preventDefault();

        const message = chatContent.value.trim();
        const sendButton = messageForm.querySelector('button[type="submit"]');
        const originalButtonHTML = sendButton.innerHTML;

        if (!message) return;

        sendButton.disabled = true;
        sendButton.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Sending...`;

        fetch(sendMessageUrl, {
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
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const newMsg = {
                    content: message,
                    createdAt: new Date().toISOString(),
                    from: currentUserId,
                    is_read: false
                };
                const liHTML = renderMessageHTML(newMsg, currentUserId);
                messagesContainer.insertAdjacentHTML('beforeend', liHTML);
                chatContent.value = '';
                chatBox.scrollTop = chatBox.scrollHeight;
            } else {
                alert('Gagal mengirim pesan');
            }
        })
        .catch(err => {
            console.error('Error saat mengirim pesan:', err);
            alert('Terjadi kesalahan saat mengirim pesan');
        })
        .finally(() => {
            sendButton.disabled = false;
            sendButton.innerHTML = originalButtonHTML;
        });
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