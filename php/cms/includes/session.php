<?php

session_start();

function message()
{
    if (isset($_SESSION["message"])) {
        $output = "<div>";
        $output .= "<ul>";
        $output .= "<li>";
        $output .= htmlentities($_SESSION["message"]);
        $output .= "</li>";
        $output .= "</ul>";
        $output .= "</div>";
        $_SESSION["message"] = null;
        return $output;
    }
    return null;


}
