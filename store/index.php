<?php
    include_once("functions.php");

    $title = "New home";
    $menu = Array(
        "Home" => "home.php",
        "Personal area" => "personal_area.php"
    );
    view("templates/start_page.html", compact("title"));
    view('templates/new/header.html', compact("menu"));
    view('templates/end_page.html');
?>