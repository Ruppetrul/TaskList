<?php

class connect{
    private $db;

    function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->db =
                new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exception) {
            echo $exception -> getMessage();
            die;
        }
    }

    function registerUser($login, $password) {
        $sql = "INSERT INTO users (login, password) 
            VALUES (:login, :password)";

            try {
                $statement = $this -> db -> prepare($sql);
                $statement -> bindParam(":login", $login);
                $statement -> bindParam(":password", $password);

                return $statement -> execute();

            } catch (PDOException $ex) {
                echo $ex -> getMessage();
                die;
            }
    }

    function userCheck($login) {
        $sql = "SELECT id FROM users WHERE login LIKE $login";
        $statement = $this -> db -> prepare($sql);
        $statement -> execute();
        $result = $statement -> fetch(PDO::FETCH_ASSOC);
        return $result;
        /*if (isset($result['id'])) {
            return true;
        } else {
            return false;
        }*/
    }

    function loginUser($login, $password, $password_hash) {
        $sql = "SELECT password FROM users WHERE login = $login";

        $statement = $this -> db -> prepare($sql);
       /* $statement -> bindParam(":login", $login);
        $statement -> bindParam(":password_hash", $password_hash);*/

        $statement -> execute();
        $result = $statement -> fetch(PDO::FETCH_ASSOC);

        if (isset($result['password'])) {
            return password_verify($password, $result['password']);
        } else {
            return false;
        }


        /*if (isset($result)){
            if ($result['password'] == $password_hash) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }*/


    }
}