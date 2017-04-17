<?php

/*
 * controller.php 名前きまらん
 */
require_once('syntaxFactory.php');

Class Controller {

    /* クエリ */
    private $_query = array();

    /* 構文オブジェクト */
    private $_syntaxObj = null;

    /* バリデートオブジェクト */
    private $_validator = null;

    /* 半角スペース */
    const HALF_SPACE = ' ';


    /*
     * クエリをセットする
     * 
     * @param query クエリ
     */
    public function setQuery($query) {
//        $queryIsValid = $this->_validator->queryIsValid($query);

//        if ($queryIsValid === false) {
//            throw new Exception('クエリが不正です。'); // $this->_validator->getErrMsg()とかでメッセージを可変にしても可
//        }
//        $rowQuery = str_replace(';', '', $query);
//        $this->_query = $query;
        $this->_query = $query;
    }

    /*
     * 処理実行
     */
    public function run() {

        $this->setSyntaxObj();

        $this->_syntaxObj->prepare($this->_query);

        $this->_syntaxObj->execute();

        $this->_syntaxObj->getResult();
    }

    /*
     * 構文タイプを取得する
     */
    private function setSyntaxObj() {
//        $query = explode(self::HALF_SPACE, $this->_query);

        $result = array();
        $readPoint = 0;

        // 先頭の動詞部分で構文タイプを判断する
        preg_match('/^[a-zA-Z]* +/', $this->_query, $result);

        $verb = mb_strtolower($result[0]);
        $readPoint += mb_strlen($verb);

//        if ($this->syntaxTypeIsValid($syntaxType) === false) {
//            throw new Exception('構文の指定が不正です。');
//        }

        $syntaxFactory = new SyntaxFactory();
        $this->_syntaxObj = $syntaxFactory->getObjectByParam($verb, $this->_query);

    }

}

$obj = new Controller();
$obj->setQuery('CREATE TABLE db1.table1 (int id, str name, int age);');
$obj->run();