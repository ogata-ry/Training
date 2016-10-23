<?php

/* 
 * inputData.php
 * データを入力する
 */

/*
 * データを入力するクラス
 */
 Class Inputter {

    /* 
     * データを入力し、返す
     * 
     * @return inputValue 入力値
     */
    function inputValue() {
        // 数値を入力する
        $inputValue = trim(fgets(STDIN));

        return $inputValue;
    }

    /*
    * 入力値を判定し、数字のみを返す
    * @return 数字
    */
    function inputDigit() {
        $inputValueIsInt = false; // 入力値が整数かどうか

        while ($inputValueIsInt === false) {
            // 数値を入力する
            $inputValue = trim(fgets(STDIN));

            // 入力値が半角数字かどうか判定する
            $inputValueIsInt = ctype_digit($inputValue);
    
            // 入力値が半角数字であれば入力値を返す。そうでない場合は再入力させる。
            if ($inputValueIsInt === true) {
                $inputYear = intval($inputValue);
                return $inputYear;
            } else {
                echo "半角数字で入力して下さい。\n";
            }

        }

     }

 }

