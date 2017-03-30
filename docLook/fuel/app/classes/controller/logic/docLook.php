<?php

/*
 * 
 * ドキュメント確認ツール - ロジックコントローラー
 * 
 * @author ogata-ry
 */

Class Controller_Logic_Daily extends Controller {

    /* モデルから受け取ったエラーメッセージ */
    private $_errMsgs = array();

    /* バリデーションモデル */
    private $_validationModel = NULL;
    
    /* セッションモデル */
    private $_sessionModel = NULL;

    /* フォームデータファイルの保存先 */
    private $_formDataFilePath = './files/';

    /* アップロードファイル名 */
    private $_responseFilePath = './responses/';
    
    /* スタックリストの保存先 */
    private $_stackListPath = './stacklist/stackList.txt';

    /* メールアドレスのベース */
    const MAIL_ADDRESS_BASE = '@xxxxxxx.jp';

    /*
     * フォームで送信されたデータが有効かどうかを確認し、結果を返す
     * 
     * @return bool 確認結果
     */
    protected function formDataIsValid() {
        $this->_validationModel = new Model_Validation();

        if ($this->_validationModel->postDataIsValid()) {
            return true;
        } else {
            $this->_errMsgs = $this->_validationModel->getErrMsg();
            return false;
        }

    }

    /*
     * フォームデータを取得
     * 
     * @return array フォームデータ
     */
    protected function getFormData() {

        $fields = Config::get('doclook.fields');

        $formData = $this->_sessionModel->getSession($fields);

        // フラッシュセッション継続
        $this->_sessionModel->keepSession($fields);

        $formData['id'] = Str::random('alnum', 8);
        $formData['viewContent'] = $this->insertSpaceToLine(explode("\n", $formData['content']));

        return $formData;
    }

    /*
     * 1文字以下の行に空白を入れる
     * ※ 表示するときに行のみの所が表示されないことがあるため
     * 
     * @param array 文章内容
     * @return array 編集した文章内容
     */
    private function insertSpaceToLine($content) {

        foreach($content as &$line) {
            
            if(mb_strlen($line) <= 1) {
                $line .= '　';
            }

        }

        return $content;
    }

    /*
     * フォームデータファイルを削除
     * 
     * @param string ID
     */
    protected function deleteFormDataFile($id) {
        $filePath = $this->_formDataFilePath . $id;

        unlink($filePath);
    }

    /*
     * モデルから受け取ったエラーメッセージを返す
     * 
     * @return array エラーメッセージ
     */
    protected function getErrMsg() {
        return $this->_errMsgs;
    }

    /*
     * フォームデータをファイルに保存する
     * 
     * @param array フォームデータ
     */
    protected function saveFormData($formData) {
        // fileディレクトリに登録情報を保存する
        $filePath = $this->_formDataFilePath . $formData['id'];

        touch($filePath);
        file_put_contents($filePath, serialize($formData));

        // stackListに一覧表示用のデータを表示する
        $stackList = unserialize(file_get_contents($this->_stackListPath));

        $stackList[] = array(
            'id' => $formData['id'],
            'user' => $formData['user'],
            'title' => $formData['title'],
            'checker' => $formData['checker'],
            'date' => $formData['date'],
        );

        file_put_contents($this->_stackListPath, serialize($stackList));
    }

    /*
     * 受付したデータを取得する
     */
    protected function getAdmittedData() {
        return $formData = array(
                'id' => Input::post('id'),
                'date' => Input::post('date'),
                'user' => Input::post('user'),
                'category' => Input::post('category'),
                'title' => Input::post('title'),
                'content' => Input::post('content'),
                'checker' => Input::post('checker'),
        );
    }

    /*
     * スタックリストを取得する
     * 
     * @return array スタックリスト
     */
    protected function getStackList() {
        $stackList['stacklist'] = array_reverse(unserialize(file_get_contents($this->_stackListPath)));

        return $stackList;
    }

    /*
     * IDよりチェック情報を取得する
     * 
     * @param ID
     */
    protected function getCheckInfo($id) {

        $filePath = $this->_formDataFilePath . $id;

        $checkInfo = unserialize(file_get_contents($filePath));

        $checkInfo['content'] = explode("\n", $checkInfo['content']);
        $checkInfo['content'] = $this->insertSpaceToLine($checkInfo['content']);

        $checkInfo['responses'] = $this->getResponses($id);

        return $checkInfo;
    }

    /*
     * レスポンス情報を得る
     * 
     * @param ID
     */
    protected function getResponses($id) {
        $filePath = $this->_responseFilePath . $id;

        if (file_exists($filePath) === false) {
            return array();
        }

        $responses = unserialize(file_get_contents($filePath));

        return $responses;

    }

    /*
     * レスポンスをファイルに保存
     */
    protected function writeResponse() {
        $id = Input::post('id');
        $urlId = Input::post('urlId');
        $commenter = Input::post('commenter');
        $response = Input::post('response');
        $response = $this->insertSpaceToLine(explode("\n", $response));

        $responseInfo = array(
            'commenter' => $commenter,
            'response' => $response,
            'date' => date('Y/m/d H:i:s'),
        );

        $filePath = $this->_responseFilePath . $urlId;

        // レスポンスの履歴がなければ空ファイルを生成
        if (file_exists($filePath) === false) {
            touch($filePath);
            file_put_contents($filePath, serialize(array()));
        }

        $contentArray = unserialize(file_get_contents($filePath));
        $contentArray[$id] = $responseInfo;
        file_put_contents($filePath, serialize($contentArray));
    }
    
    /*
     * 確認者にメール送信
     * 
     * @param array フォームデータ
     */
    protected function sendMailToChecker($formData) {
        $mailer = new Model_Mail_Checker();

        $formData['mail'] = $formData['checker'] . self::MAIL_ADDRESS_BASE;

        $mailer->send($formData);
    }

    /*
     * ユーザにメール送信
     */
    protected function sendMailToUser() {
        $id = Input::post('urlId');
        $response = Input::post('response');
        $checkInfo = $this->getCheckInfo($id);

        $checkInfo['mail'] = $checkInfo['user'] . self::MAIL_ADDRESS_BASE;
        $checkInfo['response'] = $this->insertSpaceToLine(explode("\n", $response));
        $checkInfo['commenter'] = Input::post('commenter');

        $mailer = new Model_Mail_User();
        $mailer->send($checkInfo);

    }

    /*
     * 指定のスタックを削除
     */
    protected function deleteFile() {
        $id = filter_input(INPUT_GET, 'id');

        // 登録ファイルとレスポンスファイル削除
        $filePath = $this->_formDataFilePath . $id;
        $responsePath = $this->_responseFilePath . $id;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        if (file_exists($filePath)) {
            unlink($responsePath);
        }

        // スタックリストから削除
        $stackList = unserialize(file_get_contents($this->_stackListPath));
        $deleteKey = '';
        foreach($stackList as $key => $stack) {

            if ($stack['id'] == $id) {
                $deleteKey = $key;
                break;
            }

        }

        unset($stackList[$deleteKey]);

        unlink($this->_stackListPath);
        touch($this->_stackListPath);
        file_put_contents($this->_stackListPath, serialize($stackList));

    }

    /*
     * レスポンスの削除
     */
    protected function deleteResponse() {
        $urlId = filter_input(INPUT_GET, 'urlId');
        $id = intval(filter_input(INPUT_GET, 'id'));

        $filePath = $this->_responseFilePath . $urlId;

        $responses = unserialize(file_get_contents($filePath));

        foreach($responses as $key => $response) {

            if ($key === $id) {
                unset($responses[$key]);
                break;
            }

        }

        file_put_contents($filePath, serialize($responses));
    }


}