$(document).ready(function() {

    $("#exampleModal").on("change", "#filefoto", function() {
        // alert("test");
        var maxSize = 100000 / 1000; // 100kb
        var _this = $('#filefoto');
        var filesize = _this[0].files[0].size;
        filesize = filesize / 1000;
        console.log(filesize)
        if (filesize > maxSize) {
            alert('File Lebih Besar dari 100kb')
        }
    })
})