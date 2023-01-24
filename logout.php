<?php
echo "<link rel='stylesheet' href='form.css'>";
if($_COOKIE['auth'] == false){
    echo'<div class ="error">Please login
    <a href="/" class="back-btn">Exit to main menu</a></div>';
} else {
    echo "
<title>Documents</title>";
    setcookie("auth", "", time() - 3600);
    setcookie("name_ldap", "", time() - 3600);
    setcookie("surname_ldap", "", time() - 3600);
    setcookie("memberof", "", time() - 3600);
    header('Location: index.php');
}
?>