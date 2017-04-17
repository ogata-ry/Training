<?php

/*
 * creater.php
 * 
 * CREATE文の処理を担うクラス
 */
require_once('syntaxBase.php');

Class Creater extends SyntaxBase {

    /*
     * コンストラクタ
     */
    public function __construct($query) {
        parent::__construct($query);
    }

    /*
     * 構文処理の実行準備
     * 
     * @param $query クエリ
     */
    public function prepare() {

        $readPoint = 0;

        var_dump($this->_query);
        // 先頭の動詞部分は捨てる
        preg_match('/^[a-zA-Z]+ */', $this->_query, $result);

        $verb = mb_strtolower($result[0]);
        $readPoint += mb_strlen($verb);

        preg_match('/[a-zA-Z]+ */', $this->_query, $result, 0, $readPoint);

        $this->_object = trim(mb_strtolower($result[0]));
        $readPoint += mb_strlen($result[0]);

        $prepareMethodName = 'prepareCreate' . ucfirst($this->_object);
        $this->$prepareMethodName($readPoint);

    }

    /*
     * データベース作成の準備
     */
    private function prepareCreateDatabase($readPoint) {
        preg_match('/[a-zA-Z1-9]+ */', $this->_query, $result, 0, $readPoint);

        $this->_complement = trim(mb_strtolower($result[0]));
        $readPoint += mb_strlen($result[0]);

        if (strpos($this->_query, ';') !== $readPoint) {
            exit('woops. something wrong.');
        }
    }

    /*
     * テーブル作成の準備
     */
    private function prepareCreateTable($readPoint) {
        preg_match('/[a-zA-Z1-9.]+ */', $this->_query, $result, 0, $readPoint);

        $tempComp = explode('.', trim(mb_strtolower($result[0])));

        $this->_database = $tempComp[0];
        $this->_complement = $tempComp[1];
        $readPoint += mb_strlen($result[0]);

        $tableInfo[$this->_complement] = array();

        preg_match('/\((.*)\)/', $this->_query, $result, 0, $readPoint);

        if (preg_match('/ {2}/', $result[0])) { 
            exit('so many spaces are coming. then process shutdown.');
        }

        $elements = explode(', ', $result[1]);

        foreach ($elements as $element) {
            $tempTableInfo = array();
            $tempTableInfo = explode(' ', $element);
            $tableInfo[$this->_complement][$tempTableInfo[1]] = array();
            // validate
            $tableInfo[$this->_complement][$tempTableInfo[1]]['style'] = $tempTableInfo[0];
            $tableInfo[$this->_complement][$tempTableInfo[1]]['num'] = 0;
            $tableInfo[$this->_complement][$tempTableInfo[1]]['record'] = array();
        }

        var_dump($this->_object);
        var_dump($this->_complement);
        var_dump($this->_database);
        var_dump($tableInfo);
        exit();
    }

    /*
     * CREATE情報を元に処理を実行
     */
    public function execute() {
        if ($this->_object === 'database') {

            $this->createDatabase();

        } else if ($this->_object === 'table') {
            exit('oops, i cant create table. sorry.');

//            if ($this->createInfoIsValid($createInfo) === false) {
//                throw new Exception(Validator::getErrMsg());
//            }

        }
    }

    private function createDatabase() {
        echo 'object:' . $this->_object . '<br />';
        echo 'complement:' . $this->_complement . '<br /><br />';

        echo 'i can create ' . $this->_object . ' ' . $this->_complement;
        exit();
    }

    /*
     * CREATE文で入力された情報をバリデートする
     * 
     * @param CREATE文の情報
     */
    private function createInfoIsValid($createInfo) {

        if (Validator::ParamIsValidDbName($createInfo[0]) === false) {
            return false;
        }

        if (Validator::ParamIsValidTableName($createInfo[1]) === false) {
            return false;
        }

        return true;
    }

}