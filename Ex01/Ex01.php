<?php
/* 
 * Ex01.php
 * 入力した10進数を11進数に変換する
 */

require_once(dirname(__FILE__)."/inputData.php");

/*
 * 入力した10進数を11進数に変換するクラス
 */
Class Convert {

    /* 変換のために使う数値 */
    const VALUE_FOR_CONVERT = "11";
    /* "A"と表記される数値 */
    const VALUE_A = "10";
    /* 入力上限値 */
    const INPUT_MAX = "1000000000";
    /* 入力下限値 */
    const INPUT_MIN = "1";

    /*
     * メインメソッド
     */
    static public function main() {

        // 処理の説明を表示
        self::displayDescription();

        // 数値を入力
        $inputValue = Input::inputValue();

        // 0が入力されるまで繰り返し
        while ($inputValue !== "0") {

            // 入力値が有効かどうか確認する
            $valueIsValid = self::confirmInputValue($inputValue);

            // 入力値が有効であれば変換する
            if ($valueIsValid === true) {

            // 入力値を11進数に変換する
            $result = self::convertValue($inputValue);

            // 変換結果を表示する
            self::displayResult($inputValue, $result);

            // 処理の説明を表示
            self::displayDescription();

            } else {
                echo "\n無効な入力値です。\n";
                echo "もう一度入力して下さい。\n";
            }

            // 数値を入力
            $inputValue = Input::inputValue();
        }

    echo "終了します。\n";
    }

    /* 
     * 11進数に変換する
     * 
     * @param decimalValue 10進数の数値
     * @return result 11進数の数値
     */
    static public function convertValue($decimalValue) {
        $result = ""; // 変換結果

        // 入力数値が0より上なら計算
        if ($decimalValue !== "0") {

            // 10進数を変換する
            while ($decimalValue !== "0") {
                // 変換するためにあまりを計算
                $remain = bcmod($decimalValue, self::VALUE_FOR_CONVERT);

                // 余りが10なら"A"を代入
                if ($remain === "10") {
                    $remain = "A";
                }

                // 変換結果を形成
                $result = $remain . $result;

                // 変換するために商を計算
                $decimalValue = bcdiv($decimalValue, self::VALUE_FOR_CONVERT);
            }

        } else {
            // 変換結果に0を代入
            $result = "0";
        }

        return $result;
    }

    /*
     * 変換結果を表示する
     */
     static public function displayResult($inputValue, $result) {
         // 変換結果を表示する
         echo "\n入力した数値（10進数）：{$inputValue}\n";
         echo "変換した数値（11進数）：{$result}\n";
         echo "\n";
     } 

     /*
      * 処理の説明を表示する
      */
      static public function displayDescription() {
        echo "10進数の数値を11進数の数値に変換します。\n";
        echo "10進数の数値を入力してください。\n";
        echo "'0'を入力すると終了します。\n";
      }

    /*
     * 入力値が有効かどうか確認する
     * 
     * @param inputValue 入力値
     * @return valueIsValid 入力値が有効かどうか
     */
    private function confirmInputValue($inputValue) {
        // 入力値が有効ならtrue
        $valueIsValid = true;

        // 入力値が半角数字かどうか判定する
        if (!preg_match("/[^0-9]/", $inputValue) === false) {
            $valueIsValid = false;
        // 入力値が0から始まるかどうか判定する
        } else if (!preg_match("/^0/", $inputValue) === false) {
            $valueIsValid = false;
        // 入力値(N)が1 ≦ N ≦ 1000000000かどうか判定する
        } else if (self::INPUT_MIN > $inputValue || self::INPUT_MAX < $inputValue) {
            $valueIsValid = false;
        }

        return $valueIsValid;
    }

}

// プログラム実行
Convert::main();