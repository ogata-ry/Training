<?php

/*
 * セッションモデル
 *
 */
class Model_Session {

    /*
     * セッションデータ設定
     *
     * @param フィールド
     */
    public function setSession($fields) {

        foreach ($fields as $field) {
            Session::set_flash($field, Input::post($field));
        }

    }

    /*
     * セッションデータ取得
     *
     * @param フィールド
     */
    public function getSession($fields) {
        $data = array();

        foreach ($fields as $field) {
            $data[$field] = Session::get_flash($field);
        }

        return $data;
    }

    /*
     * セッションデータ継続
     *
     * @param フィールド
     */
    public function keepSession($fields) {

        foreach ($fields as $field) {
            Session::keep_flash($field);
        }

    }


}