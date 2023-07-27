if (showModal) {
    $('#loginModal').modal({
        keyboard: false,
        show: true,
        backdrop: 'static'
    });
}

function previewPhoto() {
    const photo = document.querySelector('#foto');
    const photoPreview = document.querySelector('#preview-foto');
    const file = new FileReader();
    file.readAsDataURL(photo.files[0]);
    file.onload = function(e) {
        photoPreview.src = e.target.result;
    }
}