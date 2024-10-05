<?php


function getDbConnection() {
    static $conn;
    if ($conn === null) {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "EduSphereTest";

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("La connexion a la base de donnée a échoué :" . $conn->connect_error);
        }

        $conn->set_charset("utf8mb4");
    }
    return $conn;

}

function isLoggedIn(): bool
{
    return isset($_SESSION["user_id"]);
}