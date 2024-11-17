const openCameraButton = document.getElementById("openCamera");
const closeCameraButton = document.getElementById("closeCamera");
const video = document.getElementById("video");
const snapButton = document.getElementById("snap");
const previewContainer = document.getElementById("previewContainer");
const fileInput = document.getElementById("fileInput");
const canvas = document.createElement("canvas");
const context = canvas.getContext("2d");
let stream;

// Buka kamera saat tombol ditekan
openCameraButton.addEventListener("click", () => {
    navigator.mediaDevices
        .getUserMedia({
            video: true,
        })
        .then((mediaStream) => {
            stream = mediaStream;
            video.srcObject = stream;
            video.style.display = "block";
            snapButton.style.display = "block";
            openCameraButton.style.display = "none"; // Sembunyikan tombol "Buka Kamera" setelah kamera dibuka
            closeCameraButton.style.display = "block"; // Tampilkan tombol "Matikan Kamera"
        })
        .catch((err) => {
            console.log("Terjadi kesalahan: " + err);
        });
});

// Ambil gambar dari video dan tampilkan di canvas
snapButton.addEventListener("click", () => {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageDataURL = canvas.toDataURL("image/png");

    // Tampilkan preview gambar
    const img = document.createElement("img");
    img.src = imageDataURL;
    previewContainer.appendChild(img);

    // Buat objek File dari Data URL dan tambahkan ke input file
    fetch(imageDataURL)
        .then((res) => res.blob())
        .then((blob) => {
            const file = new File([blob], `image_${Date.now()}.png`, {
                type: "image/png",
            });
            const dataTransfer = new DataTransfer();
            Array.from(fileInput.files).forEach((f) =>
                dataTransfer.items.add(f)
            );
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
        });
});

// Tampilkan preview gambar yang dipilih dari file
fileInput.addEventListener("change", (event) => {
    const files = event.target.files;
    previewContainer.innerHTML = ""; // Kosongkan preview container
    Array.from(files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});

// Fungsi untuk menghentikan stream video
function stopCamera() {
    if (stream) {
        stream.getTracks().forEach((track) => track.stop());
        video.style.display = "none";
        snapButton.style.display = "none";
        openCameraButton.style.display = "block"; // Tampilkan tombol "Buka Kamera" lagi
        closeCameraButton.style.display = "none"; // Sembunyikan tombol "Matikan Kamera"
    }
}

// Hentikan kamera ketika tombol "Matikan Kamera" ditekan
closeCameraButton.addEventListener("click", stopCamera);

// Hentikan kamera ketika halaman ditutup atau dimuat ulang
window.addEventListener("beforeunload", stopCamera);
