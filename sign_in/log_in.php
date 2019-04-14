<?php
    if (isset($_POST['email'])) {
        $email = htmlentities($_POST['email']);
        $password= md5(htmlentities($_POST['password']));
        $flag = 1;
    
        //$connect = mysqli_connect('localhost', 'root', '', 'project');
        $connect = mysqli_connect("localhost", "u216556_store", "011470", "u216556_store");
        mysqli_set_charset($connect, 'utf8');
        
        session_start();
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
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        mysqli_close($connect);    
    } 
?>
