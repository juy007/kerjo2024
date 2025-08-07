document.getElementById("searchInput").addEventListener("input", function () {
    const filter = this.value.toLowerCase();
    const list = document.getElementById("contactList");
    const items = list.getElementsByTagName("li");

    Array.from(items).forEach((item) => {
        // Ambil nama kontak dari elemen a.title di col-mail-1
        const senderName = item
            .querySelector(".col-mail-1 a.title")
            .textContent.toLowerCase();

        if (senderName.includes(filter)) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    });
});
