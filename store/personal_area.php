<?php
    include_once("functions.php");
    session_start();

    if (!checkUser()) {
        header("Location: sign_in_up.php");
    }

    $title = "Personal area";
    $menu = Array(
        "Home" => "./"
    );

    view("templates/start_page.html", compact("title"));
    view('templates/new/header.html', compact("menu"));
    view('templates/end_page.html');
?>