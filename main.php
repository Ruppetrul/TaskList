<?php
require "connect.php";
session_start();

$connect = new connect("localhost","tasklist",
    "root", "");

render($connect);

function render($connect) {

    require 'Views/create.form.html';
    require 'Views/tools.form.html';

    $tasks = $connect -> getTasks($_SESSION['id']);

    require 'Views/main.show.php';

}

if(isset($_POST['delete'])){
    $connect -> removeTask($_POST['delete']);
    header("Refresh:0");
} else if(isset($_POST['change_status'])) {
    $connect -> alterTaskStatus($_POST['change_status']);
    header("Refresh:0");
}