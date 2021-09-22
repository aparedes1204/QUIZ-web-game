function loadFile(event) {
    var image = document.getElementById('img-preview')
    image.style.display='inline'
	image.src = URL.createObjectURL(event.target.files[0])
};