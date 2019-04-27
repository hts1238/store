<?php
    function connect () {
        $db = mysqli_connect('localhost', 'root', '', 'store');
        mysqli_set_charset($db, 'utf8');
        return $db;
    }

    function checkUser () {
        $user_id = $_COOKIE['user_id'] ?? "";
        $token = $_COOKIE['token'] ?? "";
        $session = $_COOKIE['PHPSESSID'] ?? "";
        $authorized = false;
        if ($user_id && $token  && $session) {
            $connect = connect();
            $sql = "
                SELECT UNIX_TIMESTAMP(`connect_token_time`) AS `connect_token_time`, `connect_id`
                FROM `connect` 
                WHERE `connect_token` = '$token'
                AND `connect_session` = '$session';
            ";
            $query = mysqli_query($connect, $sql); 
            $array = mysqli_fetch_assoc($query);
            if (mysqli_num_rows($query)) {
                $token_time = $array['connect_token_time'];
                $connect_id = $array['connect_id'];
                $current_time = time();
                if ($token_time < $current_time) {   // генерация нового токена
                    $new_token_time = $current_time + 900;
                    $new_token = generate_token();
                    $sql = "
                        UPDATE `connect` 
                        SET `connect_token` = '$new_token',
                            `connect_token_time` = FROM_UNIXTIME($new_token_time)
                        WHERE `connect_id` = $connect_id;
                    ";
                    setcookie("token", $new_token);
                    $_COOKIE['token'] = $new_token;
                    mysqli_query($connect, $sql); 
                }
                $authorized = true;
            }
        }
        return  $authorized;
    }

    function view ($html, $data = []) {
        extract($data);
        include_once($html);
    }

    function generate_token ($size = 12) {
        $symbols = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $lenght = count($symbols);
        $token = '';
        for ($i = 0; $i < $size; $i++) {
            $token .= $symbols[rand(0, $lenght - 1)];

        }
        return $token;
    }

?>