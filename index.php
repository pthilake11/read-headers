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

$data = json_decode(file_get_contents('php://input'), true);
file_put_contents('logs.txt','the request body is '. serialize($data). PHP_EOL, FILE_APPEND);
$headers = getRequestHeaders();

foreach ($headers as $header => $value) {
    //echo "$header: $value <br />\n";
    if ($header == "Authorization")
    {
        header('Content-Type: application/json; charset=utf-8');
        file_put_contents('logs.txt', 'the token value is '. $value . PHP_EOL, FILE_APPEND);
        echo json_encode(array('success' => true));
        exit;
    }
}
