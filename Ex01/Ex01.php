<?php
/* 
 * Ex01.php
 * 入力した10進数を11進数に変換する
 */

require_once(dirname(__FILE__)."/inputData.php");

/*
 * 入力した10進数を11進数に変換するクラス
 *
 * @param args
 */
Class Convert {

    /* 変換に使う数値 */
    const DIVIDE_VALUE = "11";
    /* "A"と表記される数値 */
    const VALUE_A = "10";

    /*
     * メインメソッド
     */
    static public function main() {
        // 処理の説明を表示
        self::displayDescription();

        // 数値を入力
        $inputValue = Input::inputValue();

        while ($inputValue !== "0") {
            // 入力値を10進数の値として設定
            $decimalValue = $inputValue;

            // 11進数に変換する
            $result = self::convertValue($decimalValue);

            // 結果を表示する
            self::displayResult($inputValue, $result);

            // 処理の説明を表示
            self::displayDescription(); 

            // 数値を入力
            $inputValue = Input::inputValue();
        }

        echo "終了します。\n";
    }

    /* 
     * 11進数に変換する
     * 
     * @return result
     */
    static public function convertValue($decimalValue) {
        $result = ""; // 変換結果

        // 入力数値が0より上なら計算
        if ($decimalValue !== "0") {

            // 10進数を変換する
            while ($decimalValue !== "0") {
                // 変換するためにあまりを計算
                $remain = bcmod($decimalValue, self::DIVIDE_VALUE);

                // 余りが10なら"A"を代入
                if ($remain === "10") {
                    $remain = "A";
                }

                // 変換結果を形成
                $result = $remain . $result;

                // 変換するために商を計算
                $decimalValue = bcdiv($decimalValue, self::DIVIDE_VALUE);
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
         echo "入力した数値（10進数）：{$inputValue}\n";
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

}

// プログラム実行
Convert::main();