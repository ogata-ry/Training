<?php
/*
 * バリデーションモデルクラス
 */
class Model_Validation {

    /* バリデーションオブジェクト */
    private $_validator;

    /*
     * 初期設定
     * バリデーションのオブジェクトを生成し、メンバ変数にオブジェクトを保持
     */
    public function __construct(){

        $validator = Validation::forge();

        // 各項目にバリデーションの基準を付与する
        $validator->add('user', '差出人')->add_rule('required')->add_rule('max_length', 30);
        $validator->add('category', 'カテゴリ')->add_rule('required')->add_rule('max_length', 20);
        $validator->add('title', 'タイトル')->add_rule('required')->add_rule('max_length', 50);
        $validator->add('content', '内容')->add_rule('required')->add_rule('max_length', 10000);
        $validator->add('checker', '確認者')->add_rule('required')->add_rule('max_length', 10);
        $validator->add('date', '日付');

        $this->_validator = $validator;
    }

    /*
     * POSTデータをチェックする
     * 
     * @param array session
     * 
     * @return bool チェック結果
     */
    public function postDataIsValid(){

        if ($this->_validator->run()) {
            return true;
        } else {
            return false;
        }

    }

    /*
     * バリデーションのエラーメッセージを生成する
     * 
     * $param array フィールド
     * $return array エラーメッセージ
     */
    public function getErrMsg(){
        $messages = array();

        foreach (Config::get('daily.fields') as $field) {
            $messages[$field] = $this->_validator->error($field);
        }

        return $messages;
    }
}