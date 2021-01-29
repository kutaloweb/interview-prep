<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>

<?php include("../includes/layouts/header.php"); ?>

<?php find_selected_page(); ?>
<p><a href="admin.php">&laquo; Main menu</a></p>
<?php echo navigation() ?>
<p><a href="new_page.php">+ Add a page</a></p>
<?php echo message(); ?>
<?php if ($current_page) { ?>
    <h2>Manage Page</h2>
    Page name: <?php echo htmlentities($current_page["title"]); ?><br/>
    Position: <?php echo $current_page["position"]; ?><br/>
    Visible: <?php echo $current_page["visible"] == 1 ? 'yes' : 'no'; ?><br/>
    Content:<br/>
    <div class="view-content">
        <?php echo htmlentities($current_page["content"]); ?>
    </div>
    <a href="edit_page.php?page=<?php echo urlencode($current_page['id']); ?>">Edit page</a>
<?php } else { ?>
    <p>Please select a page</p>
<?php } ?>

<?php include("../includes/layouts/footer.php"); ?>