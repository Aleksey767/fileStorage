<?php
echo "<link rel='stylesheet' href='style.css'>"; 
if($_COOKIE['auth']==true){
    header('Location: auth.php');
}
?>
    <title>Documents</title>
    <form action="auth.php" method="POST" id="frmLogin">

    <div class="field-group">
    <label for="username">Username: </label>
        <input class="input-field"  id="username" type="text" name="username" /> 
    </div>
    <div class="field-group">
        <label for="password">Password: </label>
        <input class="input-field"  id="password" type="password" name="password" />  
        </div>      
        <div class="field-group">
        <input  type="submit" name="submit" value="Submit" class="form-submit-button"/>
        </div>
</form>

