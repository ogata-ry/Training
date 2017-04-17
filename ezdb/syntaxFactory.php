<?php

/*
 * 構文オブジェクトに関するクラス
 */
require_once('creater.php');

Class SyntaxFactory {

    /* オブジェクト設定メソッドの前置詞 */
    const SET_OBJ_METHOD_PREPOS = 'getObjectOf';

    /*
     * 引数の動詞より構文オブジェクトを生成し、返す
     * 
     * @param $verb 構文の動詞
     */
    public function getObjectByParam($verb, $query) {
        // メソッド名を生成
        $verb = trim(ucfirst($verb));
        $getObjMethodName = self::SET_OBJ_METHOD_PREPOS . $verb;

        return $this->$getObjMethodName($query);
    }

    /*
     * CREATE文のオブジェクトを返す
     */
    public function getObjectOfCreate($query) {
        return new Creater($query);
    }
}