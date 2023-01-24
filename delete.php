<?php
if($_COOKIE['auth'] == false){
    echo'<div class ="error">Please login
    <a href="/" class="back-btn">Exit to main menu</a></div>';
} else {
    echo "<title>Documents</title>
<link rel='stylesheet' href='form.css'>";
    echo '<div class="error">File deleted successfully<br>
<a href="main_page.php" class="back-btn">Back</a></div>';
}
?>