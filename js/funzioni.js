function previewFile() {
    const preview = document.getElementById('imageProfile');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();
  
    reader.addEventListener("load", function () {
      // convert image file to base64 string
      preview.src = reader.result;
    }, false);
  
    if (file) {
      reader.readAsDataURL(file);
    }
  }

  function disable(){
    document.getElementById('salva').disabled=false;
    document.getElementById('salva').classList.remove('grey');
    document.getElementById('salva').classList.add('btn-success');
  }