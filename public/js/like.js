var p = document.getElementById('like');
function hogehoge(){
    console.log("like");
}

function like(){
    console.log("like");
}

function unlike(){
    console.log("unlike");
}



var product_id;
var like_product;
var click_button;
var count;
var user;

window.addEventListener('DOMContentLoaded', function(){
    //「toggle_wish」というクラスを持つタグがクリックされたときに以下の処理が走る
    $('.fa-heart').on('click', function (){
        //表示しているプロダクトのIDと状態、押下し他ボタンの情報を取得
        click_button = $(this);
        post_id = $(this)[0].getAttribute("post_id");
        like_product = $(this)[0].getAttribute("like_product");
        user = $(this)[0].getAttribute("user");
        if(user==1){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  //基本的にはデフォルトでOK
            },
            url: '/like_product',  //route.phpで指定したコントローラーのメソッドURLを指定
            type: 'POST',   //GETかPOSTメソットを選択
            data: { 'post_id': post_id, 'like_product': like_product, }, //コントローラーに送るに名称をつけてデータを指定
            })
            //正常にコントローラーの処理が完了した場合
            .done(function (data){ //コントローラーからのリターンされた値をdataとして指定
                var link = 'likeCount_'+post_id;
                var a = document.getElementsByClassName(link); 
                if ( data == 0 ){
                    //クリックしたタグのステータスを変更
                    click_button.attr("like_product", "1");
                    //クリックしたタグの子の要素を変更(表示されているハートの模様を書き換える)
                    click_button.attr("class", "fas fa-heart");
                    //likeCountの数字を+1
                    count = Number(a[0].textContent) + 1;
                    a[0].innerHTML = count;
                }
                if ( data == 1 ){
                    //クリックしたタグのステータスを変更
                    click_button.attr("like_product", "0");
                    //クリックしたタグの子の要素を変更(表示されているハートの模様を書き換える)
                    click_button.attr("class", "far fa-heart");
                    //likeCountの数字を-1
                    count = Number(a[0].textContent) - 1;
                    a[0].innerHTML = count;
                }
            })
            ////正常に処理が完了しなかった場合
            .fail(function (data){
                alert('いいね処理失敗');
                alert(JSON.stringify(data));
            });
        }
    });
});
