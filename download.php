<?php
echo "<link rel='stylesheet' href='form.css'>";
if($_COOKIE['auth'] == false){
    echo'<div class ="error">Please login
    <a href="/" class="back-btn">Exit to main menu</a></div>';
} else {
    echo "
<title>Documents</title>
<link rel='stylesheet' href='download.css'>";
    echo '<form class="add_file" action="form.php" method="POST" enctype="multipart/form-data">
<input class="choose " type="file" name="filename" /><br />
<input class="choose" type="submit" value="Send" />
<a href="main_page.php" class="back-btn">Back</a>
</form>';
}
?>
