<?php

$comment_array = array();

if(!empty($_POST["submitButton"])) {
    echo $_POST["username"];
    echo $_POST["comment"];
}

//DB接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbc-yt', "root1234test", "root1234test");
} catch (PDOException $e) {
    echo $e->getMessage();
}

//DBからコメントデータを取得する
$sql = "SELECT `id`, `username`, `comment`, `postDate` FROM `bbc-table`;";
$comment_array = $pdo->query($sql);

//DBの接続を閉じる
$pdo = null;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP掲示板</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1 class="title">PHPで掲示板アプリ</h1>
        <hr>
        <div class="boardWrapper">
            <form class="formWrapper" method="POST">
                <section>
                    <article>
                        <div class="wrapper">
                            <div class="nameArea">
                                <span>名前：</span>
                                <p class="username">shinCode</p>
                                <time>2024/7/28</time>
                            </div>
                            <p class="comment">手書きコメントです</p>
                        </div>
                    </article>
                </section>

                <div>
                    <input type="submit" value="書き込む" name="submitButton">
                    <label for="">名前：</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <textarea class="commentTextArea" name="comment"></textarea>
                </div>
            </form>
        </div>
    </body>
</html>