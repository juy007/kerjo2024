// Fungsi untuk inisialisasi CKEditor
function initCKEditor(elementId) {
    ClassicEditor
        .create(document.querySelector(`#${elementId}`), {
            toolbar: [
                'heading', 
                '|',
                'bold',
                'italic',
                'underline',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'fontSize'
            ],
            fontSize: {
                options: [
                    9,
                    11,
                    13,
                    17,
                    'default',
                    19,
                    21,
                    25,
                    27,
                    35,
                    40
                ]
            }
        })
        .then(editor => {
            editor.ui.view.editable.element.style.height = "200px";
        })
        .catch(error => {
            console.error(error);
        });
}

// Inisialisasi CKEditor pada semua form
initCKEditor("form-deskripsi-pekerjaan");
initCKEditor("form-detail");
initCKEditor("form-kualifikasi");