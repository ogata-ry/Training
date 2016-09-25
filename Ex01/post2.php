<!--
 Ex01 post2.php
10進数を11進数に変換します。
 -->
<!DOCTIYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Ex01</title>
    </head>
    <body>

        <?php

            /* 割り算に使う値 */
            const DIV_VALUE = 11;
            /* 'a'と表記される数値 */
            const VALUE_A = "10";

            // 10進数の値
            $deciValue = 0;
            $deciValue = $_POST['inputValue'];

            // 答え
            $result = "";

            // 入力数値が0かどうかで分岐
            if ($deciValue !== "0") {

                // 商が0になるまで繰り返し処理
                while ($deciValue !== "0") {

                    // あまりを計算
                    $remain = "";
                    $remain = bcmod($deciValue, DIV_VALUE);

                    // １０であれば'a'を代入
                    if ($remain === VALUE_A) {
                        $remain = "a";
                    }

                    // あまりを答えに追加
                    $result = "$remain" . "$result";

                    // 商を計算
                    $quot = "";
                    $quot = bcdiv($deciValue, DIV_VALUE);

                    $deciValue = $quot;
                }

            } else {
                // 0が入力されたときの処理
                $result = "0";
            }

            // 結果を表示
            echo "入力した値（１０進数）：{$_POST['inputValue']}　</br>";
            echo "変換した値（１１進数）：{$result} </br>";

        ?>

    </body>
</html>