<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php $layout_context = "public"; ?>

<?php include("../includes/layouts/header.php"); ?>

<?php find_selected_page(true); ?>

<?php echo navigation("index.php") ?>

<?php if (!logged_in()) { ?>
    <p><a href="login.php">Login</a> (username: admin, password: secret)</p>
<?php } else { ?>
    <a href="admin.php">Admin</a>
<?php } ?>

<?php if ($current_page) { ?>
    <h2><?php echo htmlentities($current_page["menu_name"]); ?></h2>
    <?php echo nl2br(htmlentities($current_page["content"])); ?>
<?php } else { ?>
    <p>Welcome!</p>
<?php } ?>


<?php include("../includes/layouts/footer.php"); ?>