// public/assets/js/firebase-notifications.js
import firebase from 'firebase/app';
import 'firebase/messaging';

// Konfigurasi Firebase
const firebaseConfig = {
    apiKey: "{{ env('FIREBASE_API_KEY') }}",
    authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
    databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}",
    projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
    storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
    messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
    appId: "{{ env('FIREBASE_APP_ID') }}",
};

// Inisialisasi Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

// Minta izin untuk menerima notifikasi
messaging.requestPermission()
    .then(() => {
        console.log('Notification permission granted.');
        return messaging.getToken();
    })
    .then((token) => {
        console.log('Token:', token);
        // Kirim token ke server untuk disimpan
        fetch('/save-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ token: token })
        });
    })
    .catch((err) => {
        console.error('Unable to get permission to notify.', err);
    });

// Mendengarkan pesan saat aplikasi aktif
messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
    // Tampilkan notifikasi
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon
    };

    // Tampilkan notifikasi
    new Notification(notificationTitle, notificationOptions);
});