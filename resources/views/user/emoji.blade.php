<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Message dengan Emoji Picker</title>
  <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
  <style>
    body {
      font-family: sans-serif;
      padding: 20px;
    }
    textarea {
      width: 100%;
      height: 100px;
      font-size: 16px;
      padding: 10px;
    }
    .emoji-container {
      position: relative;
      display: inline-block;
    }
    emoji-picker {
      position: absolute;
      bottom: 40px;
      right: 0;
      z-index: 100;
      display: none;
    }
    .show-picker emoji-picker {
      display: block;
    }
  </style>
</head>
<body>

  <h2>Kirim Pesan</h2>
  <form action="#" method="post">
    <label for="message">Pesan:</label><br>

    <div class="emoji-container" id="emoji-container">
      <textarea id="message" name="message" placeholder="Tulis pesan kamu di sini..."></textarea>
      <button type="button" id="emoji-btn">😊</button>
      <emoji-picker id="picker"></emoji-picker>
    </div>

    <br><br>
    <button type="submit">Kirim</button>
  </form>

  <script>
    const btn = document.getElementById('emoji-btn');
    const picker = document.getElementById('picker');
    const textarea = document.getElementById('message');
    const container = document.getElementById('emoji-container');

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
  </script>

</body>
</html>
