// チェックボックスが一つもチェックされていないときfalseを返す処理
function isCheck(){
    // 相談内容の配列を取得する
    const consultation = document.getElementsByClassName("consultation");
    // チェックされている数をカウントする変数を定義する
    let count = 0;
    // チェックの数をカウントする
    for (let i = 0; i < consultation.length; i++) {
        if (consultation[i].checked) {
            count++;
        }
    }
    // チェックが一つもされていなければ、falseを返す（イベント取り消しのため）
    if (count <= 0) {
        window.alert("ご相談の内容を一つ以上選択してください");
        return false;
    }

}

// ボタンを取得してイベントを実行
const btn_send = document.getElementById("btn_send");
btn_send.addEventListener('keypress', enterCheck);
btn_send.addEventListener('click', clickCheck);
// エンターキーが押されたらチェックを実行してカウントゼロならイベント中止
function enterCheck(e){
    if (e.keyCode === 13 && isCheck() === false) {
        e.preventDefault();
    }
}
// クリックやタップをされたらチェックを実行してカウントゼロならイベント中止
function clickCheck(e){
    if (isCheck() === false) {
        e.preventDefault();
    }
}









// function isCheck() { var arr_checkBoxes = document.getElementsByClassName("check"); var count = 0; 
// for (var i = 0; i < arr_checkBoxes.length; i++) { if (arr_checkBoxes[i].checked) { count++; } } 
// if (count > 0) { return true; } else { window.alert("1つ以上選択してください。"); return false; }; }


// 以下は使わなくなったのでなし
// // メールを送信するsendDocメソッドの内容
// const sendDoc = (email, email2 ,text) => {
//     Email.send({
//         Host : "smtp.elasticemail.com",
//         Username : "hamamura.ryohe@rexcross.com",
//         Password : "D9498FC3D2BF6DD829213B2262C046C8DDCC",
//         To : email,
//         Cc : email2, 
//         From : "hamamura.ryohe@rexcross.com",
//         Subject : "登録完了",
//         Body : text
//     }).then(
//     message => alert(message)
//     );
// }

// // 登録完了ボタンを取得して、イベントリスナーでクリック時にsendDocメソッドを起動
// const btn = document.getElementById('btn_send');

// btn.addEventListener('click', function() {
//     const email = document.getElementById("email").value;
//     const email2 = 'hamamura.ryohe@rexcross.com';
//     const familyName = document.getElementById("familyName").value;
  
//     const text = `${familyName}様<br>資料請求ありがとうございます。<br><br><br>
//     ========================<br>
//     　株式会社〇〇<br>
//     　〒100-0001
//     　東京都千代田区千代田1-1<br>
//     ========================`;
  
//     sendDoc(email,email2,text);
//   }, false)