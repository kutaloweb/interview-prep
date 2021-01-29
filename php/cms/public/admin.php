<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>

<?php include("../includes/layouts/header.php"); ?>

    <h2>Admin Menu</h2>
    <p>Welcome, <?php echo htmlentities($_SESSION["username"]); ?>.</p>
    <p><a href="logout.php">Logout</a></p>
    <p><a href="manage_content.php">Manage Content</a></p>
    <p><a href="index.php">Home</a></p>

<?php include("../includes/layouts/footer.php"); ?>