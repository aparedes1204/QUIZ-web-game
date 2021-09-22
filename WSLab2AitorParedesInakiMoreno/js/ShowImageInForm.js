function loadFile(event) {
    var image = document.getElementById('img-preview')
    image.style.display='inline'
    image.style.width = '35%'
    image.style.height = 'auto'
	image.src = URL.createObjectURL(event.target.files[0])
};