<!--
 Ex01 post1.php
10進数を11進数に変換します。
 -->

<!DOCTIYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Ex01</title>
    </head>
    <body>
        10進数を11進数に変換します。</br>
        10進数の数値を入力してください。</br>
        </br>
        <!--action属性にはポストデータの送信先を指定-->
        <form method = "POST" action = "post2.php">
        <input id = "inputValue" type = "int" name = "inputValue" size="15" />
        <input type = "submit" value = "送信" />
        </br>
        ※ 半角数字で入力して下さい。</br>
        </form>
    </body>
<html>