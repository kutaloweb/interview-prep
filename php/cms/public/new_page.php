<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
if (isset($_POST['submit'])) {
    $required_fields = ["title", "position", "visible", "content"];
    validate_presences($required_fields);
    $fields_with_max_lengths = ["title" => 30];
    validate_max_lengths($fields_with_max_lengths);
    if (empty($errors)) {
        $title = mysql_prep($_POST["title"]);
        $position = (int)$_POST["position"];
        $visible = (int)$_POST["visible"];
        $content = mysql_prep($_POST["content"]);
        $query = "INSERT INTO pages (";
        $query .= " title, position, visible, content";
        $query .= ") VALUES (";
        $query .= " '{$title}', {$position}, {$visible}, '{$content}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $_SESSION["message"] = "Page created.";
            redirect_to("manage_content.php");
        } else {
            $_SESSION["message"] = "Page creation failed.";
        }
    }
}
?>

<?php $layout_context = "admin"; ?>

<?php include("../includes/layouts/header.php"); ?>

<?php echo navigation(); ?>
<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<h2>Create Page</h2>
<form action="new_page.php" method="post">
    <p>
        Title:
        <input type="text" name="title" value=""/>
    </p>
    <p>
        Position:
        <select name="position">
            <?php
            $page_set = find_pages(false);
            $page_count = mysqli_num_rows($page_set);
            for ($count = 1; $count <= ($page_count + 1); $count++) {
                echo "<option value=\"{$count}\">{$count}</option>";
            }
            ?>
        </select>
    </p>
    <p>
        Visible:
        <input type="radio" name="visible" value="0"/> No
        <input type="radio" name="visible" value="1"/> Yes
    </p>
    <p>
        <textarea name="content" rows="20" cols="80"></textarea>
    </p>
    <input type="submit" name="submit" value="Save"/>
</form>
<br/>
<a href="manage_content.php">Cancel</a>

<?php include("../includes/layouts/footer.php"); ?>
