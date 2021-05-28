var data = 'Hello World！'; // 渡したいデータ
var send_data = {"name":"ふれい","like":"アニメ"};
 
$.ajax({
    type: "POST", //　GETでも可
    url: "POST.php", //　送り先
    data: { 'データ': send_data }, //　渡したいデータをオブジェクトで渡す
    dataType : "json", //　データ形式を指定
    scriptCharset: 'utf-8' //　文字コードを指定
})
.then(
    function(param){　 //　paramに処理後のデータが入って戻ってくる
        console.log(param); //　帰ってきたら実行する処理
    },
    function(XMLHttpRequest, textStatus, errorThrown){
        console.log(errorThrown); //　エラー表示
});