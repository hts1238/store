<?php
    include_once('functions.php');

    $title = 'Home';
    if(!checkUser()) {
        view('templates/common/header.html', compact('title'));
        view('templates/common/home_alert.html');
        view('templates/common/footer.html');
    } else {
        view('templates/common/header.html', compact('title'));
        //view('.php'); - основное
        view('templates/common/footer.html');
    }
?>