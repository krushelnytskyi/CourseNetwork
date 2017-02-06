function uploadFile(name) {
    /**
        copy file name and check size
     */
    var oFile = document.getElementById("upload").files[0];

    if (oFile.size > 1000000) // 2 mb for bytes.
    {
        alert("File size must under 2mb!");
        return;

    } else
    $('.fileform input').val(name)
}

