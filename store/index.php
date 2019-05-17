<?php
    include_once("functions.php");
    session_start();

    $title = "Home";
    $menu = Array(
        "Home" => "./",
    );

    if (checkUser()) {
        $menu["Personal area"] = "personal_area.php";
    } else {
        $menu["Sign in/up"] = "sign_in_up.php";
    }

    view("templates/start_page.html", compact("title"));
    view('templates/new/header.html', compact("menu"));
    //view('templates/new/sign_page.html');
    view('templates/end_page.html');
?>