<?php

require "../connect.php";
session_start();
$connect = new connect("localhost","tasklist",
    "root", "");

if (isset($_POST)) {
    if (isset($_POST['login']) && isset($_POST["password"])) {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $isUser = $connect -> userCheck($login);

        if ($isUser) {
            $isLogin = $connect -> loginUser($login, $password);

            if ($isLogin) {
                echo "Вы вошли в систему";
            } else {
                echo 'Неверный пароль';
            }

        } else {
            echo "таких нет";
            $connect -> registerUser($login, $password);
        }

        } else {

            // TODO ошибка передачи данных

        }

    }
