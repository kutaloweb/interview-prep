<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
if (!$current_page) {
    redirect_to("manage_content.php");
}
?>

<?php
if (isset($_POST['submit'])) {
    $id = $current_page["id"];
    $title = mysql_prep($_POST["title"]);
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"];
    $content = mysql_prep($_POST["content"]);
    $required_fields = ["title", "position", "visible", "content"];
    validate_presences($required_fields);
    $fields_with_max_lengths = ["title" => 30];
    validate_max_lengths($fields_with_max_lengths);
    if (empty($errors)) {
        $query = "UPDATE pages SET ";
        $query .= "title = '{$title}', ";
        $query .= "position = {$position}, ";
        $query .= "visible = {$visible}, ";
        $query .= "content = '{$content}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ($result && mysqli_affected_rows($connection) == 1) {
            $_SESSION["message"] = "Page updated.";
            redirect_to("manage_content.php?page={$id}");
        } else {
            $_SESSION["message"] = "Page update failed.";
        }
    }
}
?>

<?php $layout_context = "admin"; ?>

<?php include("../includes/layouts/header.php"); ?>

<?php echo navigation(); ?>
<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<h2>Edit Page: <?php echo htmlentities($current_page["title"]); ?></h2>
<form action="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
    <p>
        Title:
        <input type="text" name="title" value="<?php echo htmlentities($current_page["title"]); ?>"/>
    </p>
    <p>
        Position:
        <select name="position">
            <?php
            $page_set = find_pages(false);
            $page_count = mysqli_num_rows($page_set);
            for ($count = 1; $count <= $page_count; $count++) {
                echo "<option value=\"{$count}\"";
                if ($current_page["position"] == $count) {
                    echo " selected";
                }
                echo ">{$count}</option>";
            }
            ?>
        </select>
    </p>
    <p>
        Visible:
        <input type="radio" name="visible" value="0" <?php if ($current_page["visible"] == 0) {
            echo "checked";
        } ?> /> No
        <input type="radio" name="visible" value="1" <?php if ($current_page["visible"] == 1) {
            echo "checked";
        } ?>/> Yes
    </p>
    <p>
        <textarea name="content" rows="20" cols="80"><?php echo htmlentities($current_page["content"]); ?></textarea>
    </p>
    <input type="submit" name="submit" value="Save"/>
</form>
<br/>
<a href="manage_content.php?page=<?php echo urlencode($current_page["id"]); ?>">Cancel</a>
<a href="delete_page.php?page=<?php echo urlencode($current_page["id"]); ?>">Delete page</a>

<?php include("../includes/layouts/footer.php"); ?>
