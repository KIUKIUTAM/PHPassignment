const imageInput = document.getElementById('part_image_input');
const imagePreview = document.getElementById('part_image_preview');
imageInput.addEventListener('change', function(){
    if (this.files && this.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
        imagePreview.style.display = 'block';
        imagePreview.src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
    }
});