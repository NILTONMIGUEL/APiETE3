const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');

imageInput.addEventListener('change', function () {

    const file = this.files[0];

    if (file) {
        imagePreview.src = URL.createObjectURL(file);
        imagePreview.style.display = 'block';

        uploadPlaceholder.style.display = 'none';
    }

});