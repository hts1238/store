<?php
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $password_f= htmlentities($_POST['password_f']);
    $password_s= htmlentities($_POST['password_s']);
    $flag = 1;

    if(!preg_match('/^[a-zа-яё]+$/ui', $name)) { //имя
        $flag = 0;
        print $name . ' Name is incorrect <br>';
    }

    if(!preg_match("/^([a-z0-9_-]{1,20})@([a-z]{2,5})\.([a-z]{2,4})$/i", $email)) { //email
        $flag = 0;
        print $email . " Email entered incorrectly <br>";
    }

    if($password_f != $password_s) { //Пароль
        $flag = 0;
        print 'Passwords do not match <br>';
    }
    else if (!preg_match('/(?=^.{8,30}$)(?=.*\d)(?=.*[\W_])(?=.*[A-Z])(?=.*[a-z]).*$/', $password_f)) { 
        $flag = 0;
        print $password_f . 'The password is incorrect <br>';
    }

    if ($flag) {
        //$connect = mysqli_connect('localhost', 'root', '', 'project');
        $connect = mysqli_connect("localhost", "u216556_store", "011470", "u216556_store");
        mysqli_set_charset($connect, 'utf8');
    
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
                echo "You have successfully registered";
            } else {
                echo "This user already exists";
            }
            
        } else {
            echo 0;
        }
       
        mysqli_close($connect);       
    }

?>
