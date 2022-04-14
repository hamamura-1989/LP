<!DOCTYPE html>
<html lang="ja">
<head>
    <?php
        echo '<meta charset="UTF-8">';
        echo "<title>送信確認画面</title>";
    ?>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../css/sp_stylesheet.css">
</head>

<body>    
    <h2>送信確認画面</h2>
    <div class="confirm-message">
        <p>以下の内容でお間違い無いでしょうか。</p>
        <p>間違いなければ、「送信」を押してください</p>
    </div>
    <form action="send.php" class="s7-a3">
        <div class="s7-b3"><!-- お名前 -->
            <p class="s7-c3">
                お名前：
            </p> 
            <div class="s7-2c3">山田</div>
            <div class="s7-3c3">太郎</div>
        </div>
        <div class="s7-2b3"><!-- ふりがな -->
            <p class="s7-4c3">
                ふりがな：
            </p> 
            <div class="s7-5c3">やまだ</div>
            <div class="s7-6c3">たろう</div>
        </div>
        <div class="s7-3b3"><!-- 電話番号 -->
            <p class="s7-7c3">
                電話番号：
            </p> 
            <div class="s7-8c3">000-0000-0000</div>
        </div>
        <div class="s7-4b3"><!-- メールアドレス -->
            <p class="s7-9c3">
                メールアドレス：
            </p> 
            <div class="s7-5c3">gmail</div>
        </div>
        <div class="s7-5b3"><!-- 相談内容 -->
            <p class="s7-11c3">
                ご相談の内容：
            </p> 
            <div class="s7-12c3">
                <div class="s7-6d3">1</div>
                <div class="s7-7d3">2</div>
                <div class="s7-8d3">3</div>
            </div>
        </div>
        <div class="s7-6b3"><!-- 本文 -->
            <p class="s7-13c3">
                本文：
            </p> 
            <div class="s7-14c3">内容たくさん</div>
        </div>
        <input type="submit" value="送信">
    </form>
</body>