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
     * 入力されたデータを返す。
     * 処理の内容を検討しているためコメントアウトが複数存在しています。
     *
     * @return 入力値
     */
    function inputData() {

        // 半角数字が入力されるまで無限ループ
        // while (true) {
            // 数値を入力する
            $inputValue = trim(fgets(STDIN));

            // 空行エンターの場合はそのまま返す(この機能は汎用性が低くなる可能性があるので保留とする)
            // if ($inputValue === "") { return $inputValue; }

            // // 半角数字であるか確認する
            // $inputValueIsInt = ctype_digit($inputValue);

            // // 入力値が半角数字であればループを終了する
            // if ($inputValueIsInt === true) {

            //     // 入力数値をintegerに変換する
            //     $inputValue = intval($inputValue);

            //     return $inputValue;
            // } else {
            //     echo "半角数字を入力して下さい。\n";
            // }

        // }

        return $inputValue;

    }

 }

