<?php

/* 
 * inputData.php
 * データを入力する
 */

/*
 * データを入力するクラス
 */
 Class Input {

    /* 
     * データを入力し、返す
     * 
     * @return inputValue
     */
    function inputValue() {
        // 数値を入力する
        $inputValue = trim(fgets(STDIN));

        return $inputValue;
    }

 }

