<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信確認画面</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../css/sp_stylesheet.css">
</head>


<!-- 本文表示のための値取得 -->
<?php
// 各値の取得
$familyName = $_POST["familyName"];
$firstName = $_POST["firstName"];
$familyHiraganaName = $_POST["familyHiraganaName"];
$firstHiraganaName = $_POST["firstHiraganaName"];
$phoneNumber = $_POST["phoneNumber"];
$email = $_POST["email"];
$consultation = $_POST["consultation"];
$consultationContent = $_POST["consultationContent"];

// メール本文の繰り返し部分を事前に変数へ設定
$mailBodyParts = "";
for($i=0;$i<count($consultation);$i++) { 
  $mailBodyParts .= "・";
  $mailBodyParts .= $consultation[$i];
  if ($i>=count($consultation)) {
    break;
  }
  $mailBodyParts .= "<br>";
};

// メール本文の文字列作成
$mailBody = "
以下の内容で受付いたしました。<br><br>
お名前：{$familyName}{$firstName}<br>
ふりがな：{$familyHiraganaName}{$firstHiraganaName}<br>
電話番号：{$phoneNumber}<br>
メールアドレス：{$email}<br>
ご相談の内容：<br>{$mailBodyParts}<br>
本文：{$consultationContent}
";

// メールタイトル指定
$subject = "問い合わせを受付いたしました";
// メール宛先指定
$toMail = $email;
// メールの送り元指定(XOAUTH認証に使うメールアドレス)
$fromMail = "hamamura.ryohe@rexcross.com";
// Ccで送るメール宛先指定
$mailCc = "hamamura.ryohe@rexcross.com";
// Bccで送るメール宛先指定
$mailBcc = "";
?>


<!-- 本文表示 -->
<!-- ここから表示画面本文 -->
<body class="confirm">    
    <h2>送信完了</h2>
    <div class="confirm-message">
        <p>以下の内容で受付いたしました。</p>
        <p>受付完了メールをお送りしておりますので、ご確認ください。</p>
    </div>
    <div class="confirmForm">
        <div class="confirmFormBox">
            <div class="confirmForm-item confirmForm-item1"><!-- お名前 -->
                <p class="confirmForm-item-left confirmForm-item-left1">
                    お名前：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right1">
                    <div class="confirmForm-item-right1-1"><?php echo $familyName; ?></div>
                    <div class="confirmForm-item-right1-2"><?php echo $firstName; ?></div>
                </div>
            </div>
            <div class="confirmForm-item confirmForm-item2"><!-- ふりがな -->
                <p class="confirmForm-item-left confirmForm-item-left2">
                    ふりがな：
                </p>
                <div class="confirmForm-item-right confirmForm-item-right2">
                    <div class="confirmForm-item-right2-1"><?php echo $familyHiraganaName; ?></div>
                    <div class="confirmForm-item-right2-2"><?php echo $firstHiraganaName; ?></div>
                </div> 
            </div>
            <div class="confirmForm-item confirmForm-item3"><!-- 電話番号 -->
                <p class="confirmForm-item-left confirmForm-item-left3">
                    電話番号：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right3"><?php echo $phoneNumber; ?></div>
            </div>
            <div class="confirmForm-item confirmForm-item4"><!-- メールアドレス -->
                <p class="confirmForm-item-left confirmForm-item-left4">
                    メールアドレス：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right4"><?php echo $email; ?></div>
            </div>
            <div class="confirmForm-item confirmForm-item5"><!-- 相談内容 -->
                <p class="confirmForm-item-left confirmForm-item-left5">
                    ご相談の内容：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right5">
                    <?php for ($i=0;$i<count($consultation);$i++) { ?>
                        <div class="confirmForm-item-right5List">・<?php echo $consultation[$i]; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="confirmForm-item confirmForm-item6"><!-- 本文 -->
                <p class="confirmForm-item-left confirmForm-item-left6">
                    本文：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right6"><?php echo $consultationContent; ?></div>
            </div>
        </div>
    </div>
</body>
</html>



<!-- メール送信処理 -->
<?php
// PHPMailer のクラスをグローバル名前空間（global namespace）にインポート
// スクリプトの先頭で宣言する必要があります
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth; //  ### 追加 ### 

// Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;//  ### 追加 ### 

// Composer のオートローダーの読み込み（ファイルの位置によりパスを適宜変更）
require '../php_mailer/vendor/autoload.php';

//mbstring の日本語設定
mb_language("japanese");
mb_internal_encoding("UTF-8");

// インスタンスを生成（引数に true を指定して例外 Exception を有効に）
$mail = new PHPMailer(true);

//日本語用設定
$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";

try {
  //サーバの設定
  $mail->SMTPDebug = 0;  // デバグの出力を有効に（テスト環境での検証用）
  $mail->isSMTP();   // SMTP を使用
  $mail->Host       = 'smtp.gmail.com';  // ★★★ Gmail SMTP サーバーを指定
  $mail->SMTPAuth   = true;   // SMTP authentication を有効に
  $mail->AuthType = 'XOAUTH2';//  ### 追加 ###   AuthType を XOAUTH2 に指定
//   $mail->Username   = 'hamamura.ryohe@rexcross.com';  // ★★★ Gmail ユーザ名
//   $mail->Password   = 'hamamura1989';  // ★★★ Gmail パスワード
//   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ★★★ 暗号化（TLS)を有効に 
//   $mail->Port = 587;  //★★★ ポートは 587 
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
  $mail->Port = 465;  //ポートの指定
 
// ###  OAUTH2 の設定  ### 
  //Gmail メールアドレス
  $google_email = $fromMail;
  //クライアント ID
  $clientId = '583713080528-pgpnofh6331nemjjutkqddbqbiipfufg.apps.googleusercontent.com';
  //クライアントシークレット
  $clientSecret = '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';
  //トークン（Refresh Token）
  $refreshToken = '1//04xpB517ieCWpCgYIARAAGAQSNwF-L9IrM-iSQh9kvLDHLnDl2EVMNJxXHoqpDP6eHP_knynbX2k-s6JaX1bOm7nZcSiBa3WnYCg';
 
  //OAuth2 プロバイダのインスタンスの生成 
  $provider = new Google(
    [
      'clientId' => $clientId,
      'clientSecret' => $clientSecret,
    ]
  );
 
  //OAuth プロバイダのインスタンスを PHPMailer へ渡す
  $mail->setOAuth(
    new OAuth(
      [
        'provider' => $provider,
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
        'refreshToken' => $refreshToken,
        'userName' => $google_email,
      ]
    )
  );
// ###  OAUTH2 の設定 ここまで  ### 



//受信者設定
  //差出人アドレス（Gmail のアドレス）, 差出人名 
  $mail->setFrom($fromMail, mb_encode_mimeheader('差出人名'));  //  ### 変更 ### 
  // 送信先アドレス, 受信者名（受信者名はオプション）
  $mail->addAddress($toMail, mb_encode_mimeheader("受信者名")); 
  // 追加の受信者（受信者名は省略可能）
//   $mail->addAddress('xxxxxx@xxxxxx.com'); 
  //返信用アドレス（差出人以外に必要であれば）
//   $mail->addReplyTo('info@example.com', mb_encode_mimeheader("お問い合わせ"));  
  //Cc 受信者の指定
  $mail->addCC($mailCc); 

  //コンテンツ設定
  $mail->isHTML(true);   // HTML形式を指定→取り消し
  //メール表題（タイトル）
  $mail->Subject = mb_encode_mimeheader($subject); 
  //本文（HTML用）
  $mail->Body  = mb_convert_encoding($mailBody,"JIS","UTF-8");  
  //テキスト表示の本文
  $mail->AltBody = mb_convert_encoding($mailBody,"JIS","UTF-8"); 
 
  $mail->send();  //送信
  
//   ここまでtryの終了
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>