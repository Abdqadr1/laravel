const formFile = document.querySelector("#formFile");
const thumbnailsDiv = document.querySelector("#thumbnails-div");

formFile?.addEventListener('change', function (e) {
    const files = e.target.files;
    const className = 'mb-3 rounded mx-auto d-block thumbnail';
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const image = document.createElement('img');
        image.className = className;
        previewImage(file, data => {
            image.src = data;
        });
        thumbnailsDiv.appendChild(image);
    }
    
});

function isFileValid(file, accept, size = 1048576) {
    const ret ={validity: true}
    if (file.size > size) {
        ret.validity = false;
        const maxSize = Number(size/1000).toFixed(2);
        ret.message = `File size is too large, max size is ${maxSize} KB`;
        return ret;
    }
    const findIndex = accept.findIndex(c => c === file.type || file.type.includes(c));
    ret.validity = findIndex > -1;
    ret.message = "File type not supported";
    return ret;
}

//image handler function
function previewImage(file, cb) {
    const fileReader = new FileReader();
    fileReader.onload = (event) => {
        cb(event.target.result);
    }
    fileReader.readAsDataURL(file);
}