window.onload = function () {
    var img1 = document.getElementById('img1');
    var img2 = document.getElementById('img2');
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    var width = img2.width;
    var height = img2.height;
    canvas.width = width;
    canvas.height = height;

    context.drawImage(img1, 0, 1, width, height);
    var image1 = context.getImageData(0, 0, width, height);
    var imageData1 = image1.data;
    context.drawImage(img2, 0, 0, width, height);
    var image2 = context.getImageData(0, 0, width, height);
    var imageData2 = image2.data;
};

function downloadCanvas(link, canvasId, filename) {
    link.href = document.getElementById(canvasId).toDataURL();
    link.download = filename;
}

document.getElementById('download').addEventListener('click', function() {
    downloadCanvas(this, 'canvas', 'wfi-twibbon.png');
}, false);