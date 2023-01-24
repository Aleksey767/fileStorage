<?php
echo "<link rel='stylesheet' href='form.css'>";
if($_COOKIE['auth'] == false){
    echo'<div class ="error">Please login
    <a href="/" class="back-btn">Exit to main menu</a></div>';
} else {
    echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title>Documents</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">';
    echo "<link rel='stylesheet' href='form.css'>";
    $size = $_FILES['filename']['size'] / 1024 / 1024;
    if (empty($_FILES['filename']['name'])) {
        echo '<div class="error">File not selected
    <a href="main_page.php" class="back-btn" );">Back</a></div>
    ';
    } else {
        if (move_uploaded_file($_FILES['filename']['tmp_name'], 'upload/' . $_FILES['filename']['name'])) {
            if ($size > 0.1) {
                echo '<div class="error">The file was successfully uploaded to the server<br>
    Размер: ' . round($size, 1) . 'Mb<br> 
    ' . $_FILES['filename']['name'] . '
    <a href="main_page.php" class="back-btn">Back</a></div>';
            } else {
                echo '<div class="error">The file was successfully uploaded to the server<br>
    Размер: ' . round($size * 1024, 1) . 'Kb<br> 
    ' . $_FILES['filename']['name'] . '
    <a href="main_page.php" class="back-btn">Back</a></div>';
            }
        } else {
            echo 'The file has not been uploaded to the server. Please contact your administrator';
        }
    }
}
?> 
