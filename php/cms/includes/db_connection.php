<?php

define("DB_SERVER", "localhost:8889");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "interview_prep_cms");

$connection = mysqli_connect(
    DB_SERVER,
    DB_USER,
    DB_PASS,
    DB_NAME
);

if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
