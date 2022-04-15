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

<body class="confirm">    
    <h2>送信確認画面</h2>
    <div class="confirm-message">
        <p>以下の内容でお間違いないでしょうか。</p>
        <p>よろしければ、「送信」を押してください</p>
    </div>
    <form action="send.php" class="confirmForm">
        <div class="confirmFormBox">
            <div class="confirmForm-item confirmForm-item1"><!-- お名前 -->
                <p class="confirmForm-item-left confirmForm-item-left1">
                    お名前：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right1">
                    <div class="confirmForm-item-right1-1">山田</div>
                    <div class="confirmForm-item-right1-2">太郎</div>
                </div>
            </div>
            <div class="confirmForm-item confirmForm-item2"><!-- ふりがな -->
                <p class="confirmForm-item-left confirmForm-item-left2">
                    ふりがな：
                </p>
                <div class="confirmForm-item-right confirmForm-item-right2">
                    <div class="confirmForm-item-right2-1">やまだ</div>
                    <div class="confirmForm-item-right2-2">たろう</div>
                </div> 
            </div>
            <div class="confirmForm-item confirmForm-item3"><!-- 電話番号 -->
                <p class="confirmForm-item-left confirmForm-item-left3">
                    電話番号：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right3">000-0000-0000</div>
            </div>
            <div class="confirmForm-item confirmForm-item4"><!-- メールアドレス -->
                <p class="confirmForm-item-left confirmForm-item-left4">
                    メールアドレス：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right4">oooooooooooo@gmail.com</div>
            </div>
            <div class="confirmForm-item confirmForm-item5"><!-- 相談内容 -->
                <p class="confirmForm-item-left confirmForm-item-left5">
                    ご相談の内容：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right5">
                    <div class="confirmForm-item-right5List">1ああああああああああああ</div>
                    <div class="confirmForm-item-right5List">2いいいいいいいいいいい</div>
                    <div class="confirmForm-item-right5List">3うううううううううううううう</div>
                </div>
            </div>
            <div class="confirmForm-item confirmForm-item6"><!-- 本文 -->
                <p class="confirmForm-item-left confirmForm-item-left6">
                    本文：
                </p> 
                <div class="confirmForm-item-right confirmForm-item-right6">Fjgせあっふぐ亜F不FhじゃdsjF非gせうrwfmんゔぁfhjfdさf。fskfskfヒアfjsh不hっファhfjdsh不rfjなfデュfhファhfjカウr奈kんりあkつsけんsgんかんしょうほうがかアイウエオかきくけコリアン寝具hfkvネモsっも亜kしgにsじるksこghさい</div>
            </div>
        </div>
        <input type="submit" class="btn_send" value="送信する">
    </form>
</body>