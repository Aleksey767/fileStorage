<?php
echo "<link rel='stylesheet' href='main_page.css'>";
echo "<link rel='stylesheet' href='form.css'>";
if($_COOKIE['auth'] == false){
  echo'<div class ="error">Please login
  <a href="/" class="back-btn">Exit to main menu</a></div>'; 
}else{ 

echo "<div class='wrap'><div class='welcome'>
<a href='logout.php'><div class='logout'><img src='logout.png'><a href='logout.php'>Logout</div></a></a>
<div class='enter'>You are logged in as:  <div class='name'> ". $_COOKIE['name_ldap'].' '. $_COOKIE['surname_ldap'] ."</div><br></div></div>
<div class='access'>Available files:</div>
</div>";   
function get_file_extension($file_path) {
    $basename = basename($file_path); 
    if ( strrpos($basename, '.')!==false ) { 
      
      $file_extension = substr($basename, strrpos($basename, '.') + 1);
    } else {
      
      $file_extension = false;
    }
    return $file_extension;
  }
$dir = '/upload';
$f = scandir($_SERVER['DOCUMENT_ROOT'].$dir);
    foreach ($f as $file) {

        if ($file != '.' and $file != '..') {
            $name = $file;
            $name = str_replace(' ','',$name); 
            $name = mb_strimwidth($name = wordwrap($name,30,'<br>',true),0,60,"...");
            if (get_file_extension($dir.$file) == 'doc' or get_file_extension($dir.$file) == 'docx') {
                echo '<div  class="item"><img src="icon.png" alt="icon">
' . $name . '
<div class="btns"><a href="http://docs.google.com/viewer?url=http://your_domen' . $dir . '/' . $file . '"  class="down_btn">Открыть</a><br></div>
</div>';
            } else {
                echo '<div  class="item"><img src="icon.png" alt="icon">
' . $name . '
<div class="btns"><a href="' . $dir . '/' . $file . '"  class="down_btn">Открыть</a><br></div>
</div>';
            }
        }
        
    }
echo '
<title>Documents</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
<script src="script.js"></script>'; }
?>
