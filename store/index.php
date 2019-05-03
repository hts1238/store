<?php
    include_once("functions.php");

    $title = "Sign in/up";
    $menu = Array(
        "Home" => "home.php"
    );

    /*if (checkUser()) {
        $menu["Personal area"] = "personal_area.php";
    } else {
        $menu["Sign in/up"] = "sign_in_up.php";
    }*/

    view("templates/start_page.html", compact("title"));
    view('templates/new/header.html', compact("menu"));
    view('templates/new/sign_page.html');
    view('templates/end_page.html');
?>