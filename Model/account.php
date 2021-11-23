<?php

require "../connect.php";
session_start();
$connect = new connect("localhost","tasklist",
    "root", "");

if (isset($_POST)) {
    if (isset($_POST['login']) && isset($_POST["password"])) {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $isLogin = $connect -> loginUser($login, $_POST['password'], $password_hash);

        // отрицание для теста
        if ($isLogin) {
            //TODO переход на основную страницу
        } else {
            // TODO проверка на логин. Если есть, ошибка пароля, если нет - регистрация
            $isUser = $connect -> userCheck($login);
            var_dump($isUser);
        }

        /*
         * $isUser = $connect -> registerUser($login, $password_hash);
        $isCheck = $connect -> userCheck($login);

        */

    }

}

