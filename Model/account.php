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


            if (isset($isLogin['id'])) {
                echo "Вы вошли в систему";
                $connect -> addTask($isLogin['id'], "task");

                $posts = $connect -> getTasks($isLogin['id']);
                var_dump($posts);

                //$connect -> alterTasksStatus($isLogin['id'], false );
                //$connect -> alterTaskStatus($posts['id']);
                //$connect -> removeTask($posts['id']);
                //$connect -> removeAllTasks($isLogin['id']);

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

