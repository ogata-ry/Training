<?php
/* leapYearJudgement.php
 *
 * 入力値がうるう年かどうか判定する。
 * 詳細は下記URL参照
 * http://paiza.jp/challenges/practice
 */

require_once dirname(dirname(__FILE__)) . "/lib/inputData.php";

 Class LeapYearJudgement {
 
     /* 閏年の判定のための計算で使う値1 */
     const CALCURATE_VALUE_FIRST = 400;

     /* 閏年の判定のための計算で使う値2 */
     const CALCURATE_VALUE_SECOND = 100;

     /* 閏年の判定のための計算で使う値3 */
     const CALCURATE_VALUE_THIRD = 4;

     /*
      * メインメソッド
      */
     public function main() {
        $inputYears = array();  // 入力した西暦

        // 入力する行数を指定する。ここで入力した値の回数だけ西暦の入力を受け付ける。
        echo "入力する行数を指定して下さい。\n";
        $inputLines = Inputter::inputDigit();

        for ($i = 0; $i < $inputLines; $i++) {
            $inputYears[] = Inputter::inputDigit();
        }

        foreach ($inputYears as $inputYear) {
            // 閏年かどうか判定する
            $inputYearIsLeapYear = self::judgeLeapYear($inputYear);
    
            // 判定結果を表示する
            self::displayResult($inputYearIsLeapYear, $inputYear);
        }

     }

     /*
      * 閏年かどうか判定をする
      * @param 西暦
      * @return 判定結果
      */
     private function judgeLeapYear($year) {
         $result; // 判定結果

         // 閏年かどうか判定する
         if ($year % self::CALCURATE_VALUE_FIRST === 0) { 
             $result = true;
         } else if($year % self::CALCURATE_VALUE_SECOND === 0) {
             $result = false;   
         } else if ($year % self::CALCURATE_VALUE_THIRD === 0) {
             $result = true;
         } else {
             $result = false;
         }

         return $result;

     }

     /*
      * 判定結果を表示する
      * @param 閏年の判定結果
      */
     private function displayResult($result, $inputYear) {

         // 判定結果を表示する
         if ($result === true) {
            echo "{$inputYear}年は閏年です。\n"; 
         } else {
            echo "{$inputYear}年は閏年ではありません。\n"; 
         }

     }

 }

 // インスタンスの生成
 $leapYearJudgement = new LeapYearJudgement();

 // 実行
 $leapYearJudgement -> main();
?>