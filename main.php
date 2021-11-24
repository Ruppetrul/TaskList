<?php
require "connect.php";
session_start();

render();

function render() {

    require 'Views/create.form.html';
    require 'Views/tools.form.html';

   /* $connect = new connect("localhost","tasklist",
        "root", "");
    var_dump($_SESSION);
    $posts = $connect -> getTasks($_SESSION['id']);
    var_dump($posts);*/

}