<?php
    include_once('functions.php');
    $message = "";
    session_start();
    
    if (isset($_POST['flag']) && $_POST['flag'] == "in" && isset($_POST['email'])) {    // Sign In
        $email = htmlentities($_POST['email']);
        $password = md5(htmlentities($_POST['password']));
        $flag = 1;
    
        $connect = connect();
        

        if (!mysqli_errno($connect)) {
            $sql = "
                SELECT `user_id` 
                FROM `users` 
                WHERE `user_email` = '$email'
                AND `user_password` = '$password';
            ";
            $query = mysqli_query($connect, $sql); 
    
            if (mysqli_num_rows($query)) {
                $user_id = mysqli_fetch_assoc($query)['user_id'];
                $_SESSION['user_id'] = $user_id;
                setcookie("user_id", $user_id);
                $token_time = time() + 900;
                $token = generate_token();
                $_SESSION['token'] = $token;
                $session = $_COOKIE['PHPSESSID'];
                $sql = "
                    INSERT INTO `connect` (`connect_session`, `connect_token`, `connect_token_time`, `connect_user_id`) 
                    VALUES ('$session', '$token', FROM_UNIXTIME($token_time), $user_id)
                ;";
                mysqli_query($connect, $sql); 
                setcookie("token", $token);
                header('Location: home.php');
            } else {
                $message = "Данные введены неправильно";
            }
        } else {
            echo mysqli_connect_error($connect);
        }
        mysqli_close($connect);    
    } 



    if (isset($_POST['flag']) && $_POST['flag'] == "up" &&  isset($_POST['name'])) {  // Sign Up
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        $password_f= htmlentities($_POST['first_password']);
        $password_s= htmlentities($_POST['second_password']);
        $flag = 1;
    
        if(!preg_match('/^[a-zа-яё]+$/ui', $name)) { //имя
            $flag = 0;
            $message = 'Имя введено неправильно <br>';
        }
    
        if(!preg_match("/^([a-z0-9_-]{1,20})@([a-z]{2,5})\.([a-z]{2,4})$/i", $email)) { //email
            $flag = 0;
            $message = "Email введен неправильно <br>";
        }
    
        if($password_f != $password_s) { //Пароль
            $flag = 0;
            $message = 'Пароли не совпадают <br>';
        }
        else if (!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password_f)) { 
            $flag = 0;
            $message = 'Пароль введен неправильно <br>';
            /*
                ^: привязано к началу строки
                \S*: любой набор символов
                (?=\S{8,}): не менее длины 8
                (?=\S*[a-z]): содержит хотя бы одну строчную букву
                (?=\S*[a-z]): и по крайней мере одно прописное письмо
                (?=\S*[\d]): и по крайней мере одно число
                $: привязано к концу строки
            */
        }
    
        if ($flag) {
            $connect = connect();
            if (!mysqli_errno($connect)) {
                $sql = "
                    SELECT `user_email` 
                    FROM `users` 
                    WHERE `user_email` = '$email';
                ";
                $query = mysqli_query($connect, $sql); 
                if (!mysqli_num_rows($query)) {    
                    $password_f = md5($password_f);
                    $sql = "
                        INSERT INTO `users` (`user_name`, `user_email`, `user_password`)
                        VALUES ('$name', '$email', '$password_f');
                    ";
                    mysqli_query($connect, $sql);
                    $sql = "
                        SELECT `user_id` 
                        FROM `users` 
                        WHERE `user_email` = '$email'
                        AND `user_password` = '$password_f';
                    ";
                    $query = mysqli_query($connect, $sql); 
                    $user_id = mysqli_fetch_assoc($query)['user_id'];
                    $_SESSION['user_id'] = $user_id;
                    $token_time = time() + 900;
                    $token = generate_token();
                    $_SESSION['token'] = $token;
                    $session = $_COOKIE['PHPSESSID'];
                    setcookie("user_id", $user_id);
                    setcookie("token", $token);
                    $sql = "
                        INSERT INTO `connect` (`connect_session`, `connect_token`, `connect_token_time`, `connect_user_id`) 
                        VALUES ('$session', '$token', FROM_UNIXTIME($token_time), $user_id)
                    ;";
                    mysqli_query($connect, $sql); 
                    header('Location: home.php');
                } else {
                    $message = "Такой пользователь уже есть";
                }
                
            } else {
                echo mysqli_connect_error($connect);
            }
            mysqli_close($connect);       
        }
    }
    
    $title = 'Sign In/Up';
    view('templates/common/header.html', compact('title'));
    view('templates/sign/sign_page.html', compact('message'));
    view('templates/common/footer.html');
?>
