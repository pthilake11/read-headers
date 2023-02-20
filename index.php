<?php
function getRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}
//file_put_contents('logs.txt','the request is '. $_POST['body'],FILE_APPEND);
$headers = getRequestHeaders();

foreach ($headers as $header => $value) {
    //echo "$header: $value <br />\n";
    if ($header == "Authorization")
    {
        header('Content-Type: application/json; charset=utf-8');
        file_put_contents('logs.txt', 'the token is '. $value , FILE_APPEND);
        echo json_encode(array('success' => true));
        exit;
    }
}
