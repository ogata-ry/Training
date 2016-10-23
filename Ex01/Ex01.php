<?php
/* 
 * Ex01.php
 * 入力した10進数を11進数に変換する
 *
 * ●仕様
 *
 *  - 半角数字以外が入力されたら入力し直しさせる
 *  - 空行を入力するとプログラムが終了する
 *  - 入力数値の行頭に0が1つ以上ある場合は、0が無視される
 *  - 
 */

require_once(dirname(__FILE__)."/inputData.php");

/*
 * 入力した10進数を11進数に変換するクラス
 */
Class ValueConverter {

    /* 変換のために使う数値 */
    const VALUE_FOR_CONVERT = 11;
    /* "A"と表記される数値 */
    const VALUE_A = 10;
    /* 入力上限値 */
    const INPUT_MAX = 1000000000;
    /* 入力下限値 */
    const INPUT_MIN = 1;

    /*
     * メインメソッド
     */
    public function main() {
        
        while (true) {
            
            // 処理の説明を表示
            self::displayDescription();

            // 数値を入力
            $inputValue = Inputter::inputData();

            // 入力値が空行であればプログラムを終了する
            if ($inputValue === "") { exit("終了します。\n"); }

            // 半角数字かどうかを判定する
            $inputValueIsInt = ctype_digit($inputValue);

            // 半角数字以外はやり直し
            if ($inputValueIsInt === false) { 
                echo "\n### エラー：半角数字を入力して下さい。 ###\n\n";
                continue;
                }

            // 入力数値を整数型に変換する
            $inputValue = intval($inputValue);

            // 入力数値を11進数に変換する
            $result = self::convertValue($inputValue);

            // 変換結果を表示する
            self::displayResult($inputValue, $result);

        }

    }

    /* 
     * 11進数に変換する
     * 
     * @param decimalValue 10進数の数値
     * @return result 11進数の数値
     */
    public function convertValue($decimalValue) {

        // 入力数値が0なら変換不要なので0を返す
        if ($decimalValue === 0) { return $decimalValue; }

        $result; // 変換結果

        // 10進数を11進数に変換する
        while ($decimalValue !== 0) {

            // 10進数を11で割った剰余を用いて変換する
            $remain = $decimalValue % self::VALUE_FOR_CONVERT;

            // 余りが10なら"A"を代入する
            if ($remain === 10) {
                $remain = "A";
            }

            // 変換結果を形成
            $result = $remain . $result;

            // 続けて変換をするために11で割った商を変換対象に代入する
            $decimalValue = intval($decimalValue / self::VALUE_FOR_CONVERT);

        }

        return $result;
    }

    /*
     * 変換結果を表示する
     */
     private function displayResult($inputValue, $result) {
         // 変換結果を表示する
         echo "\n入力した数値（10進数）：{$inputValue}\n";
         echo "変換した数値（11進数）：{$result}\n";
         echo "\n";
     } 

     /*
      * 処理の説明を表示する
      */
      private function displayDescription() {
        echo "10進数の数値を11進数の数値に変換します。\n";
        echo "10進数の数値を半角数字で入力してください。\n";
        echo "空行でエンターを押すと終了します。\n";
      }

    // /*
    //  * 入力値が有効かどうか確認する
    //  * 
    //  * @param inputValue 入力値
    //  * @return valueIsValid 入力値が有効かどうか
    //  */
    //  private function confirmInputValue($inputValue) {
    //     // 入力値が有効ならtrue
    //     $valueIsValid = true;

    //     // 入力値が半角数字かどうか判定する
    //     if (!preg_match("/[^0-9]/", $inputValue) === false) {
    //         $valueIsValid = false;
    //     // 入力値が0から始まるかどうか判定する
    //     } else if (!preg_match("/^0/", $inputValue) === false) {
    //         $valueIsValid = false;
    //     // 入力値(N)が1 ≦ N ≦ 1000000000かどうか判定する
    //     } else if (self::INPUT_MIN > $inputValue || self::INPUT_MAX < $inputValue) {
    //         $valueIsValid = false;
    //     }

    //     return $valueIsValid;
    // }

}

// プログラム実行
$converter = new ValueConverter();

$converter -> main();