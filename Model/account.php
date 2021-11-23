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
            echo "найден юзер";
            $isLogin = $connect -> loginUser($login, $password);
            var_dump($isLogin);

            if (password_verify($password, $isLogin["password"])) {

                echo 'верный пароль';
                // TODO пользователь пошел

            } else {
                echo 'не вернрый пароль';
                // TODO ошибка ввода данных

            }

        } else {
            echo "таких нет";
            $connect -> registerUser($login, $password);
        }

        } else {

            // TODO ошибка передачи данных

        }

    }
