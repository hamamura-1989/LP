// メールを送信するsendDocメソッドの内容
const sendDoc = (email, email2 ,text) => {
    Email.send({
        Host : "smtp.elasticemail.com",
        Username : "hamamura.ryohe@rexcross.com",
        Password : "D9498FC3D2BF6DD829213B2262C046C8DDCC",
        To : email,
        Cc : email2, 
        From : "hamamura.ryohe@rexcross.com",
        Subject : "登録完了",
        Body : text
    }).then(
    message => alert(message)
    );
}

// 登録完了ボタンを取得して、イベントリスナーでクリック時にsendDocメソッドを起動
const btn = document.getElementById('btn_send');

btn.addEventListener('click', function() {
    const email = document.getElementById("email").value;
    const email2 = 'hamamura.ryohe@rexcross.com';
    const familyName = document.getElementById("familyName").value;
  
    const text = `${familyName}様<br>資料請求ありがとうございます。<br><br><br>
    ========================<br>
    　株式会社〇〇<br>
    　〒100-0001
    　東京都千代田区千代田1-1<br>
    ========================`;
  
    sendDoc(email,email2,text);
  }, false)