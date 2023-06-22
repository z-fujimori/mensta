
document.getElementById('image').addEventListener('change', function (e) {
    // 1枚だけ表示する
    var file = e.target.files;
    // ファイルのブラウザ上でのURLを取得する
    //console.log(file);
    var len = file.length;
    var blobUrl = [];
    var img = document.getElementById('preview');
    for (var i=0;i<len;i++){
        blobUrl.push(window.URL.createObjectURL(file[i]));
        var url = window.URL.createObjectURL(file[i]);
        img.insertAdjacentHTML('afterend','<img id="pre" src="'+ url +'" class=pre>');
    }
});


/*
let key = 0;
function loadImage(obj) {
    for (var i = 0; i < obj.files.length; i++) {
        var fileReader = new FileReader();
        fileReader.onload = (function (e) {
            var field = document.getElementById("imgPreviewField");
            var figure = document.createElement("figure");
            var rmBtn = document.createElement("input");
            var img = new Image();
            img.src = e.target.result;
            rmBtn.type = "button";
            rmBtn.name = key;
            rmBtn.value = "削除";
            rmBtn.onclick = (function () {
                var element = document.getElementById("img-" + String(rmBtn.name)).remove();
            });
            figure.setAttribute("id", "img-" + key);
            figure.appendChild(img);
            figure.appendChild(rmBtn)
            field.appendChild(figure);
            key++;
        });
        fileReader.readAsDataURL(obj.files[i]);
    }
}
*/


