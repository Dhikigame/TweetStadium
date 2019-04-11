<?php
function is_mobile()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    // echo $user_agent;
    return preg_match('/iphone|ipod|ipad|android/ui', $user_agent) != 0;
}
?>