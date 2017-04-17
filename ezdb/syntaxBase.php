<?php

/*
 * 構文オブジェクトの抽象クラス
 */
abstract class SyntaxBase {

    /* クエリ */
    protected $_query = '';

    /* 構文の目的語 */
    protected $_object = '';

    /* 構文の補語 */
    protected $_complement = '';

    /* 指定のデータベース */
    protected $_database = '';

    // エラーメッセージ
    private $_errMsgs = '';

    /*
     * 
     */
    public function __construct($query) {
        $this->_query = $query;
    }

    /*
     * 構文処理の実行準備
     * 
     * @param クエリ
     */
    abstract function prepare();

    /*
     * 構文処理の実行
     */
    abstract function execute();

    /*
     * エラーメッセージを保持する
     * 保持するのは継承元となるこのクラス
     * 
     * @param $message エラーメッセージ
     */
    protected function reportError($message) {
        $this->_errMsgs = $message;
    }

    /*
     * エラーメッセージを返す。
     * エラーメッセージがなければfalseを返す
     */
    protected function getErrorMessage() {

        if ($this->_errMsgs) {
            return $this->_errMsgs;
        } else {
            return false;
        }

    }
}