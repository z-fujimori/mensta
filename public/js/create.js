
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


function multipleaction(u){
    var f = document.querySelector("form");
    var a = f.setAttribute("action", u);
    document.querySelector("form").submit();
}






