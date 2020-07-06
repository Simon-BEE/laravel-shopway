const previewDiv = document.getElementById('imagesPreview');
const inputForUpload = document.getElementById('imagesInput');
if (previewDiv && inputForUpload) {
    const resetButton = document.getElementById('resetImages');

    function previewImages() {
        if (this.files) {
            [].forEach.call(this.files, readAndPreview);
        }
        function readAndPreview(file) {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                createAlert('error', file.name + " is not an image", Math.floor(Math.random() * 111));
                resetInputFiles();
                return;
            }
            if (file.size >= 2000000) {
                createAlert('error', file.name + " is too big", Math.floor(Math.random() * 112));
                resetInputFiles();
                return;
            }

            if (previewDiv.classList.contains('hidden')) {
                previewDiv.classList.remove('hidden');
                resetButton.classList.remove('hidden');
            }

            const reader = new FileReader();
            reader.addEventListener("load", function() {
                var image = new Image();
                image.title  = file.name;
                image.src    = this.result;
                previewDiv.appendChild(image);
            });
            reader.readAsDataURL(file);
        }
    }

    function resetInputFiles(){
        previewDiv.classList.add('hidden');
        resetButton.classList.add('hidden');
        previewDiv.innerHTML = '';
        inputForUpload.value = '';

        let alertElement = document.querySelector('.alert-flash');
        if (alertElement) {
            alertTransition(alertElement);
        }
    }

    inputForUpload.addEventListener('change', previewImages);
    resetButton.addEventListener('click', resetInputFiles);
}