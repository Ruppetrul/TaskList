<?php

require "../connect.php";
session_start();
$connect = new connect("localhost","tasklist",
    "root", "");

var_dump($_POST);
if (isset($_POST)) {
    if (isset($_POST['login']) && isset($_POST["password"])) {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $isUser = $connect -> userCheck($login);

        if ($isUser) {
            $isLogin = $connect -> loginUser($login, $password);

            if (isset($isLogin['id'])) {
                $connect -> addTask($isLogin['id'], "task");
                $_SESSION['id'] = $isLogin['id'];
                header("Location: ../main.php");
            } else {
                echo 'Неверный пароль';
            }
        } else {
            $connect -> registerUser($login, $password);
            $isLogin = $connect -> loginUser($login, $password);

            if (isset($isLogin['id'])) {
                $connect->addTask($isLogin['id'], "task");
                echo 'Вы вошли и добавили новый пост';
            } else {
                echo 'Ошибка входа';
            }
        }
    }
}