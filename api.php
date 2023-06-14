<?php
include 'function.php';


if (isset($_GET['text'])) {
    $chat_id = '941194210';
    $pesan = $cookie_value . ' : ' . $_GET['text'];
    $ip = $_SERVER["REMOTE_ADDR"];
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $sql = "INSERT INTO tb_helpdesk VALUES (null, '" . $cookie_value . "', '" . $chat_id . "', '" . $cookie_value . "', '" . $_GET['text'] . "', 'self', '" . $ip . "', '" . $ua . "', '" . date('Y-m-d H:i:s') . "')";
    $data->query($sql);
    file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=" . $pesan);
    $data = [
        'id' => $data->get('SELECT id FROM tb_helpdesk ORDER BY id DESC LIMIT 1')[0]['id']
    ];
    echo json_encode($data);
}


if (isset($_GET['group_cat'])) {
    // AND tb_helpdesk.type != 'self'
    $sql = "SELECT * FROM tb_helpdesk WHERE  1=1  AND group_cat = '" . $_GET['group_cat'] . "' ORDER BY id ASC";
    echo json_encode($data->get($sql));
}
