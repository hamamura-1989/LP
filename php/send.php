<!DOCTYPE html>
<html lang="ja">
<head>
<?php
// echo で出力する方法
echo '<meta charset="UTF-8">';
// 文字列リテラルとして書く方法（このままでは出力されません）
$title = 'php で HTML を書く方法';
// 文字列操作でつなげることも出来ます
echo "<title>{$title}</title>";
// 一時的に php タグから脱出する方法
?>
</head>

<!-- 本文表示 -->
<body>
<!-- 表示のための値取得 -->
<?php


?>
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
  $google_email = 'hamamura.ryohe@rexcross.com';
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
  $mail->setFrom($google_email, mb_encode_mimeheader('差出人名'));  //  ### 変更 ### 
  // 送信先アドレス, 受信者名（受信者名はオプション）
  $mail->addAddress('r.hamamura1989@gmail.com', mb_encode_mimeheader("受信者名")); 
  // 追加の受信者（受信者名は省略可能）
//   $mail->addAddress('xxxxxx@xxxxxx.com'); 
  //返信用アドレス（差出人以外に必要であれば）
//   $mail->addReplyTo('info@example.com', mb_encode_mimeheader("お問い合わせ"));  
  //Cc 受信者の指定
  $mail->addCC('hamamura.ryohe@rexcross.com'); 

 
  //コンテンツ設定
  $mail->isHTML(true);   // HTML形式を指定
  //メール表題（タイトル）
  $mail->Subject = mb_encode_mimeheader('問い合わせ完了メール'); 
  //本文（HTML用）
  $mail->Body  = mb_convert_encoding("こんにちは","JIS","UTF-8");  
  //テキスト表示の本文
  $mail->AltBody = mb_convert_encoding('プレインテキストメッセージ non-HTML mail clients',"JIS","UTF-8"); 
 

  $mail->send();  //送信
  echo 'Message has been sent';


//   ここまでtryの終了
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>