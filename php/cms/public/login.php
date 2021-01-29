<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
$username = "";
if (isset($_POST['submit'])) {
    $required_fields = ["username", "password"];
    validate_presences($required_fields);
    if (empty($errors)) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $found_admin = attempt_login($username, $password);
        if ($found_admin) {
            $_SESSION["admin_id"] = $found_admin["id"];
            $_SESSION["username"] = $found_admin["username"];
            redirect_to("admin.php");
        } else {
            $_SESSION["message"] = "Username/password not found.";
        }
    }
}
?>

<?php $layout_context = "admin"; ?>

<?php include("../includes/layouts/header.php"); ?>

<?php echo message(); ?>

<?php echo form_errors($errors); ?>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <p>
            Username:
            <input type="text" name="username" value="<?php echo htmlentities($username); ?>"/>
        </p>
        <p>
            Password:
            <input type="password" name="password" value=""/>
        </p>
        <input type="submit" name="submit" value="Submit"/>
    </form>

<?php include("../includes/layouts/footer.php"); ?>