<?php

date_default_timezone_set('Asia/Jakarta');
session_start();

$desired_length = 5; //or whatever length you want
$unique = uniqid();

$random_id = substr($unique, 0, $desired_length);
$cookie_name = "user_code";

if (!isset($_COOKIE[$cookie_name])) {
    // echo "Cookie named '" . $cookie_name . "' is not set!";
    $cookie_value = $random_id;
    setcookie($cookie_name, $cookie_value, time() + (60), "/");
} else {
    $cookie_value = $_COOKIE[$cookie_name];
}


// 86400 = 1 day


$content = file_get_contents("php://input");
// Persiapan Token Bot Telegram
$token = "6130650892:AAH8uUxplMm4eXgShovxR94NPk1GcCnEE9s";
// t.me/helpdesk543_bot. 

// Persiapan API LINK
$apiLink = "https://api.telegram.org/bot$token/";


class Data
{
    function __construct()
    {
        try {
            $this->db = new PDO("sqlite:db.db");
        } catch (PDOException $e) {
            die("Database tidak terhubung!");
        }
    }

    public function get($sql)
    {

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $data = array();
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $rows;
        }

        return $data;
    }

    public function query($sql)
    {
        $res = $this->db->prepare($sql);
        $res->execute();

        /* Return number of rows that were deleted */
        // print("Return number of rows that were deleted:\n");
        $count = $res->rowCount();
        return $res;
    }
}


$data = new Data();
