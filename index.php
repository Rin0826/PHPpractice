<?php

$comment_array = array();
$pdo = null;
$stmt = null;

//DB接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbc-yt', "root1234test", "root1234test");
} catch (PDOException $e) {
    echo $e->getMessage();
}


//フォームを打ち込んだ時
if(!empty($_POST["submitButton"])) {

    $postDate = date("Y-m-d H:i:s");
    
    try {
        $stmt = $pdo->prepare("INSERT INTO `bbc-table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate);");
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':comment', $_POST['comment']);
        $stmt->bindParam(':comment', $postDate);

        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
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
                    <?php foreach($comment_array as $comment) : ?>
                    <article>
                        <div class="wrapper">
                            <div class="nameArea">
                                <span>名前：</span>
                                <p class="username"><?php echo $comment["username"]; ?></p>
                                <time>:<?php echo $comment["postDate"]; ?></time>
                            </div>
                            <p class="comment"><?php echo $comment["comment"]; ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
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