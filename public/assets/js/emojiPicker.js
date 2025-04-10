const btn = document.getElementById('emoji-btn');
const picker = document.getElementById('picker');
const textarea = document.getElementById('chatContent');
const container = document.getElementById('messageForm');

btn.addEventListener('click', () => {
  container.classList.toggle('show-picker');
});

picker.addEventListener('emoji-click', event => {
  const emoji = event.detail.unicode;
  textarea.value += emoji;
  container.classList.remove('show-picker');
  textarea.focus();
});

document.addEventListener('click', function(e) {
  if (!container.contains(e.target)) {
    container.classList.remove('show-picker');
  }
});