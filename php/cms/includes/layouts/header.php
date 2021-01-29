<?php if (!isset($layout_context)) { $layout_context = "public"; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CMS <?php if ($layout_context === "admin") { echo " | Admin Dashboard"; } ?></title>
</head>
<body>
    <h2>CMS</h2>