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

p.attachEvent('onclick', hogehoge());

/*
var product_id;
var like_product;
var click_button;

$(function ()
{
    //「toggle_wish」というクラスを持つタグがクリックされたときに以下の処理が走る
    $('.toggle_wish').on('click', function ()
    {
        //表示しているプロダクトのIDと状態、押下し他ボタンの情報を取得
        product_id = $(this).attr("product_id");
        like_product = $(this).attr("like_product");
        click_button = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  //基本的にはデフォルトでOK
            },
            url: '/like_product',  //route.phpで指定したコントローラーのメソッドURLを指定
            type: 'POST',   //GETかPOSTメソットを選択
            data: { 'product_id': product_id, 'like_product': like_product, }, //コントローラーに送るに名称をつけてデータを指定
                })
            //正常にコントローラーの処理が完了した場合
            .done(function (data) //コントローラーからのリターンされた値をdataとして指定
            {
                if ( data == 0 )
                {
                    //クリックしたタグのステータスを変更
                    click_button.attr("like_product", "1");
                    //クリックしたタグの子の要素を変更(表示されているハートの模様を書き換える)
                    click_button.children().attr("class", "fas fa-heart");
                }
                if ( data == 1 )
                {
                    //クリックしたタグのステータスを変更
                    click_button.attr("like_product", "0");
                    //クリックしたタグの子の要素を変更(表示されているハートの模様を書き換える)
                    click_button.children().attr("class", "far fa-heart");
                }
            })
            ////正常に処理が完了しなかった場合
            .fail(function (data)
            {
                alert('いいね処理失敗');
                alert(JSON.stringify(data));
            });
    });
});

*/
