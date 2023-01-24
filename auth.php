<?php
function quickSort(&$array, $compare, $start, $end)
{
    $partition = function (&$array, $start, $end) use (&$partition, $compare) {
        if ($start >= $end) {
            return;
        }
        $pivot = $array[$start];
        $left = $start;
        $right = $end;
        while ($left <= $right) {
            while ($compare($array[$left], $pivot) < 0) {
                $left += 1;
            }
            while ($compare($array[$right], $pivot) > 0) {
                $right -= 1;
            }
            if ($left > $right) {
                break;
            }
            list($array[$left], $array[$right]) = [$array[$right], $array[$left]];
            $left += 1;
            $right -= 1;
        }
        $partition($array, $start, $right);
        $partition($array, $left, $end);
    };

    $partition($array, $start, $end);
}


function ldapSort(array &$entries, $key)
{
    $SORT_KEY = 'SortValue';

    $key = strtolower($key);

    for ($i = 0; $i < $entries['count']; $i++) {
        $entry = &$entries[$i];
        $attributes = array_change_key_case($entry, CASE_LOWER);

        $entry[$SORT_KEY] = isset($attributes[$key][0]) ?
            $attributes[$key][0] : null;
    }
    unset($entry);

    quickSort(
        $entries,
        function ($a, $b) use ($SORT_KEY) {
            $a = $a[$SORT_KEY];
            $b = $b[$SORT_KEY];
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        },
        0, 
        $entries['count'] - 1
    );
}
function generateSalt()
{
    $salt = '';
    $saltLength = 8; 
    for($i=0; $i<$saltLength; $i++) {
        $salt .= chr(mt_rand(33,126)); 
    }
    return $salt;
}

if(isset($_COOKIE['auth'])){
if (strpos($_COOKIE['memberof'], 'Lawyers') !== false or strpos($_COOKIE['memberof'], 'SystemAdmin') !== false){
    header('Location: main_page.php');
}else{
    header('Location: main_page_view.php');
}}

if(isset($_POST['username']) && isset($_POST['password'])){
 
    $adServer = "ldap://adcontroler.example.by";
    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = 'example' . "\\" . $username;
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password); 
    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=EXAMPLE,dc=BY",$filter);
        $entries = ldap_get_entries($ldap, $result);
        ldapSort($entries, 'displayname');
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break; 
                function checkGroup($ad, $userdn, $groupdn) {
                    $attributes = array('members');
                    $result = ldap_read($ad, $userdn, "(memberof={$groupdn})", $attributes);
                    if ($result === FALSE) { return FALSE; };
                    $entries = ldap_get_entries($ad, $result);
                    return ($entries['count'] > 0);
                } 
            session_start();
            $_SESSION['auth'] = true;  
		    $_SESSION['login'] = $username; 

            $_SESSION['name_ldap'] = $info[$i]["givenname"][0];
            $_SESSION['surname_ldap'] = $info[$i]["sn"][0]; 
 
            setcookie('auth',true,time()+60*60*24*30);
            setcookie('name_ldap',$info[$i]["givenname"][0],time()+60*60*24*30);
            setcookie('surname_ldap',$info[$i]["sn"][0],time()+60*60*24*30);
            setcookie('memberof',$info[$i]["sn"][0],time()+60*60*24*30);
            $rows;
            foreach ( $info[$i]["memberof"] as $row) {
                $rows = $rows.$row;
            }  
            setcookie('memberof',$rows,time()+60*60*24*30);
            if (strpos($rows, 'Lawyers') !== false or strpos($rows, 'SystemAdmin') !== false){
                header('Location: main_page.php');
            }else{
                header('Location: main_page_view.php');
            } 
        }
            } else {  
                echo "<link rel='stylesheet' href='form.css'>";
                echo'<div class ="error">Invalid email address / password
                <a href="/" class="back-btn">Exit to main menu</a></div>'; 
            }
}
?>
