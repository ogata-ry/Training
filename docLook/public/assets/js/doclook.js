window.addEventListener("keydown", handleKeydown);

function handleKeydown(event){
  // キーコード
    var keyCode = event.keyCode;
    
    if(keyCode === 27) {
        deleteForm();
    }
}

function createForm($id) {
    deleteForm();

    var xhr = null;
    try { xhr = new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) { xhr = new XMLHttpRequest(); }
    xhr.open("GET", "./response.php", true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4) {
            var data = xhr.response; // 外部ファイルの内容
            data = data.replace('##id##', $id);
            var target = document.getElementById($id);
            var divNode = document.createElement('div');
            divNode.innerHTML = data;
            divNode.id = 'responseForm';
            target.parentNode.insertBefore(divNode, target.nextSibling);
        }
    };

    xhr.send(null);
}

function deleteForm() {
    var deleteTarget = document.getElementById('responseForm');
    if (deleteTarget) {
        deleteTarget.parentNode.removeChild(deleteTarget);
    }
}

function deleteResponse($key, $id) {
    if (window.confirm('削除します。よろしいですか？')){
        location.href = "http://10.21.65.8/alphawave/daily/delete_response?id=" + $key + "&urlId=" + $id;
    } else {
        window.alert('キャンセルされました');
        return false;
    }
}

function deleteStack($id) {

    if (window.confirm('削除します。よろしいですか？')){
        location.href = "http://10.21.65.8/alphawave/daily/delete?id=" + $id;
    } else {
        window.alert('キャンセルされました');
        return false;
    }

}

//function deleteResponse() {
//    
//}

//function editResponse() {
//    
//}
//function Response() {
//    
//}