<?php


include 'function.php';




if ($content) {



    // tes api set webhook
    //  https://api.telegram.org/bot6130650892:AAH8uUxplMm4eXgShovxR94NPk1GcCnEE9s/setwebhook?url=https://bc4e-114-122-102-214.ngrok-free.app/data.php


    $update = json_decode($content, true);

    // $myfileopen = fopen("log.json", "r") or die("Unable to open file!");
    // $datajson = json_decode(fgets($myfileopen), true);
    $datajson = json_decode(file_get_contents('log.json'), true);
    $myfilecreate = fopen("log.json", "w");
    $datajson[] = $update;
    fwrite($myfilecreate, json_encode($datajson));
    fclose($myfilecreate);

    $chat_id  = $update['message']['chat']['id'];
    $text = $update['message']['text'];
    $chatName = $update['message']['chat']['first_name'] . ' - ' . $update['message']['chat']['username'];
    if ($text == "/start") {
        $pesan = "Welcome Bot 543";
        // persiapan pesan balesan 
        file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=" . $pesan);
    } else {
        // $chat_id = '941194210';
        $pesan = $text;
        $ip = $_SERVER["REMOTE_ADDR"];
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $sql = "INSERT INTO tb_helpdesk VALUES (null, '" . $cookie_value . "', '" . $chat_id . "', '" . $cookie_value . "', '" . $pesan . "', 'user', '" . $ip . "', '" . $ua . "', '" . date('Y-m-d H:i:s') . "')";
        $data->query($sql);
    }
} else {
    echo "Hanya Telegram yang dapat mengakses URL ini....!!";
}
