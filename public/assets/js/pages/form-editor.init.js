ClassicEditor
.create(document.querySelector("#form-deskripsi-pekerjaan"), {
    toolbar: [
        'heading', // Menambahkan opsi heading
        '|',
        'bold',
        'italic',
        'underline',
        '|',
        'link',
        '|',
        'bulletedList',
        'numberedList',
        '|',
        'fontSize' // pastikan plugin fontSize telah diimpor
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
    },
})
.then(editor => {
    editor.ui.view.editable.element.style.height = "200px";
})
.catch(error => {
    console.error(error);
});
//ClassicEditor.create(document.querySelector("#form-deskripsi-pekerjaan")).then(function(e){e.ui.view.editable.element.style.height="200px"}).catch(function(e){console.error(e)});
//ClassicEditor.create(document.querySelector("#ckeditor-classic"))