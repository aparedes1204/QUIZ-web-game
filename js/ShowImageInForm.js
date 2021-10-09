function loadFile(event) {
    var elem = document.getElementById("img-preview")
    elem.parentNode.removeChild(elem)
    var image = document.createElement("img")
    image.id='img-preview'
    image.style.display='inline'
    image.style.height = '300px'
    image.src = URL.createObjectURL(event.target.files[0])
    document.getElementById("form-with-image").appendChild(image)
};

function resetForm(){
    var elem = document.getElementById("img-preview")
    elem.parentNode.removeChild(elem)
    document.getElementById("galderenF").reset()
    document.getElementById("choose-file").reset()
};
