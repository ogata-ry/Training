<?php
/*
 * メールモデル - ベース
 */
\Package::load('email');

/*
 * すべてのメールモデルが継承する抽象クラス
 */
abstract Class Model_Mail_Base extends \Model {
    
    /* 定数 */
    protected $constant = array();
    
    /* メール送信オブジェクト */
    protected $sendMailObj;
    
    /*
     * 初期設定
     */
    public function __construct() {
        $this->constant = Config::get('mail');
        $this->sendMailObj = \Email::forge();
    }

    /*
     * メールを送信する
     * 
     * @param array メールで使用する情報
     */
    public function send($sendInfo){

        $this->prepare($sendInfo);

        $this->execute();

    }
    
    /*
     * メール送信を実行する
     */
    protected function execute() {
        try {
            $this->sendMailObj->send();
        } catch (\EmailValidationFailedException $e) {
            throw new Exception($this->constant['mail']['errMsg']['validationFailed']);
        } catch(\EmailSendingFailedException $e) {
            throw new Exception($this->constant['mail']['errMsg']['sendingFailed']);
        }
    }
    
    /*
     * メール送信の準備をする
     * 
     * @param array メールで使用する情報
     */
    abstract protected function prepare($sendInfo);

    /* 
     * csvファイルを生成しメールに添付する。
     * 当メソッドは機能の拡張を見越して実装したものであり、現時点で使用していない。
     * 
     * @param array フォーム情報
     */
    protected function attachCsv($formInfo) {
        // 見出し
        $head = '業種・業態, 企業名, 部署・所属名, 役職, ご担当者名, 電話番号, メールアドレス, お問い合わせ種別, お問い合わせ内容' . PHP_EOL;

        // 内容
        $content = '';

        $content .= $formInfo['business_type'] . ', ';
        $content .= $formInfo['company'] . ', ';
        $content .= $formInfo['belong'] . ', ';
        $content .= $formInfo['class'] . ', ';
        $content .= $formInfo['client'] . ', ';
        $content .= $formInfo['tel'] . ', ';
        $content .= $formInfo['mail'] . ', ';
        $content .= $formInfo['category'] . ', ';
        $content .= $formInfo['detail_info'];

        $csv = mb_convert_encoding($head . $content, 'SJIS', 'utf-8');

        $this->sendMailObj->string_attach($csv, 'clientInfo.csv');

    }

}