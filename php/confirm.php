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

<!-- 入力データを受け取る -->
<?php
$familyName = filter_input(INPUT_POST, 'familyName');
$firstName = filter_input(INPUT_POST, 'firstName');
$familyHiraganaName = filter_input(INPUT_POST, 'familyHiraganaName');
$firstHiraganaName = filter_input(INPUT_POST, 'firstHiraganaName');
$phoneNumber = filter_input(INPUT_POST, 'phoneNumber');
$email = filter_input(INPUT_POST, 'email');
$consultationContent = filter_input(INPUT_POST, 'consultationContent');
//  ご相談内容は複数あるので配列で取得する
$consultation = array();
$consultation = filter_input(INPUT_POST, 'consultation',FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

// 入力データのエスケープ処理関数を定義しておく(入力データにプログラムへの命令文があると悪意のある動作命令を受けてしまうため)
function esc($input){
    return htmlspecialchars($input,ENT_QUOTES, "UTF-8");
}
?>

<!-- ここから表示画面本文 -->
<body class="confirm">    
    <h2>送信確認画面</h2>
    <div class="confirm-message">
        <p>以下の内容でお間違いないでしょうか。</p> 
        <p>よろしければ「送信」を押してください。</p>
    </div>
    <form action="send.php" class="confirmForm" method="post">
        <div class="confirmFormBox">
            <div class="confirmForm-item confirmForm-item1"><!-- お名前 -->
                <p class="confirmForm-item-left confirmForm-item-left1">
                    お名前：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right1">
                    <div class="confirmForm-item-right1-1"><?php echo esc($familyName); ?></div>
                    <div class="confirmForm-item-right1-2"><?php echo esc($firstName); ?></div>
                </div>
            </div>
            <div class="confirmForm-item confirmForm-item2"><!-- ふりがな -->
                <p class="confirmForm-item-left confirmForm-item-left2">
                    ふりがな：
                </p>
                <div class="confirmForm-item-right confirmForm-item-right2">
                    <div class="confirmForm-item-right2-1"><?php echo esc($familyHiraganaName); ?></div>
                    <div class="confirmForm-item-right2-2"><?php echo esc($firstHiraganaName); ?></div>
                </div> 
            </div>
            <div class="confirmForm-item confirmForm-item3"><!-- 電話番号 -->
                <p class="confirmForm-item-left confirmForm-item-left3">
                    電話番号：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right3"><?php echo esc($phoneNumber); ?></div>
            </div>
            <div class="confirmForm-item confirmForm-item4"><!-- メールアドレス -->
                <p class="confirmForm-item-left confirmForm-item-left4">
                    メールアドレス：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right4"><?php echo esc($email); ?></div>
            </div>
            <div class="confirmForm-item confirmForm-item5"><!-- 相談内容 -->
                <p class="confirmForm-item-left confirmForm-item-left5">
                    ご相談の内容：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right5">
                    <?php for ($i=0;$i<count($consultation);$i++) { ?>
                        <div class="confirmForm-item-right5List">・<?php echo esc($consultation[$i]); ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="confirmForm-item confirmForm-item6"><!-- 本文 -->
                <p class="confirmForm-item-left confirmForm-item-left6">
                    本文：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right6"><?php echo esc($consultationContent); ?></div>
            </div>
        </div>

        <!-- パラメータを次の送信画面へ渡しておく -->
        <input type="hidden" name="familyName" value="<?php echo $familyName; ?>">
        <input type="hidden" name="firstName" value="<?php echo $firstName; ?>">
        <input type="hidden" name="familyHiraganaName" value="<?php echo $familyHiraganaName; ?>">
        <input type="hidden" name="firstHiraganaName" value="<?php echo $firstHiraganaName; ?>">
        <input type="hidden" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <?php for ($i=0; $i<count($consultation); $i++) { ?>
            <input type="hidden" name="consultation[]" value="<?php echo $consultation[$i]; ?>">
        <?php } ?>
        <input type="hidden" name="consultationContent" value="<?php echo $consultationContent; ?>">
        
        <!-- 送信 -->
        <input type="submit" class="btn_send" value="送信する">

    </form>
</body>