<?php

function redirect_to($new_location)
{
    header("Location: " . $new_location);
    exit;
}

function mysql_prep($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function confirm_query($result_set)
{
    if (!$result_set) {
        die("Database query failed.");
    }
}

function form_errors($errors = [])
{
    $output = "";
    if (!empty($errors)) {
        $output .= "<div>";
        $output .= "<ul style=\"color: red;\">";
        foreach ($errors as $key => $error) {
            $output .= "<li>";
            $output .= htmlentities($error);
            $output .= "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

function find_pages($public = true)
{
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM pages ";
    if ($public) {
        $query .= "WHERE visible = 1 ";
    }
    $query .= "ORDER BY position ASC";
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    return $page_set;
}

function find_page_by_id($page_id, $public = true)
{
    global $connection;
    $safe_page_id = mysqli_real_escape_string($connection, $page_id);
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$safe_page_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "LIMIT 1";
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    if ($page = mysqli_fetch_assoc($page_set)) {
        return $page;
    } else {
        return null;
    }
}

function find_admin_by_username($username)
{
    global $connection;
    $safe_username = mysqli_real_escape_string($connection, $username);
    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE username = '{$safe_username}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_selected_page($public = false)
{
    global $current_page;
    if (isset($_GET["page"])) {
        $current_page = find_page_by_id($_GET["page"], $public);
    } else {
        $current_page = null;
    }
}

function navigation($path = "manage_content.php")
{
    if ($path === "index.php") {
        $page_set = find_pages();
    } else {
        $page_set = find_pages(false);
    }
    $output = "<ul>";
    while ($page = mysqli_fetch_assoc($page_set)) {
        $output .= "<li>";
        $output .= "<a href=\"$path?page=";
        $output .= urlencode($page["id"]);
        $output .= "\">";
        $output .= htmlentities($page["title"]);
        $output .= "</a>";
        $output .= "</li>";
    }
    $output .= "</ul>";
    mysqli_free_result($page_set);
    return $output;
}

function password_check($password, $existing_hash)
{
    $hash = crypt($password, $existing_hash);
    if ($hash === $existing_hash) {
        return true;
    } else {
        return false;
    }
}

function attempt_login($username, $password)
{
    $admin = find_admin_by_username($username);
    if ($admin) {
        if (password_check($password, $admin["password"])) {
            return $admin;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function logged_in()
{
    return isset($_SESSION['admin_id']);
}

function confirm_logged_in()
{
    if (!logged_in()) {
        redirect_to("login.php");
    }
}
