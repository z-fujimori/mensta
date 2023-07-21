document.getElementById('comment_btn').addEventListener('click', function() {
    const btn = document.getElementById('comment_btn');
    btn.id = "comment";
    btn.className = "comment";
    const comme_input = document.getElementById("comment_input");
    let comment = document.createElement('input');
    comment.id = "come_in";
    comment.className = "come_in";
    comment.setAttribute("name", "com");
    comment.setAttribute("placeholder", "ここにコメントを入力");
    comme_input.appendChild(comment);
    
});

function multipleaction(u){
    var f = document.querySelector("form");
    var a = f.setAttribute("action", u);
    document.querySelector("form").submit();
}