<?php
    include_once('functions.php');

    $title = 'Home';
    view('templates/common/header.html', compact('title'));

    if(checkUser()) {
        //view('.php'); - основное
    } else { // checkUser() не прошел
        view('templates/common/home_alert.html');
    }

    view('templates/common/footer.html');
?>