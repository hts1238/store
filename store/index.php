<?php
    include_once("functions.php");

    $title = "New home";
    view("templates/start_page.html", compact("title"));
    view('templates/new/header.html');
    view('templates/end_page.html');
?>