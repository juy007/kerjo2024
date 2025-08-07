// Tambahkan validasi dan sanitization untuk emoji picker
const btn = document.getElementById('emoji-btn');
const picker = document.getElementById('picker');
const textarea = document.getElementById('chatContent');
const container = document.getElementById('messageForm');

// Validasi elemen sebelum menambahkan event listener
if (btn && picker && textarea && container) {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        container.classList.toggle('show-picker');
    });

    picker.addEventListener('emoji-click', event => {
        const emoji = event.detail.unicode;
        
        // Validasi emoji sebelum ditambahkan
        if (emoji && typeof emoji === 'string' && emoji.length <= 10) {
            textarea.value += emoji;
            container.classList.remove('show-picker');
            textarea.focus();
        }
    });

    // Close picker when clicking outside
    document.addEventListener('click', function(e) {
        if (!container.contains(e.target)) {
            container.classList.remove('show-picker');
        }
    });

    // Prevent XSS through emoji input
    textarea.addEventListener('input', function(e) {
        const value = e.target.value;
        // Remove any script tags or dangerous content
        const sanitizedValue = value.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
        if (value !== sanitizedValue) {
            e.target.value = sanitizedValue;
        }
    });
} else {
    console.warn('Emoji picker elements not found');
}