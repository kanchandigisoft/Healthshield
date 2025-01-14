<?php
/*
Template Name: Test Page
*/
get_header();
?>
<?php 
 $server_ip = $_SERVER['REMOTE_ADDR'];
 echo "Server IP:$server_ip<br>";
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    return $ip;
}
$user_ip = getUserIP();
//$user_ip = '2600:1700:2f92:b000:306b:c4ed:bca1:ccc9';
echo "MY IP:$user_ip<br>"; 
$ip =$user_ip;
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success')
    {
        echo 'Your City is ' . $query['city'];
        echo '<br />';
        echo 'Your State is ' . $query['region'];
        echo '<br />';
        echo 'Your Zipcode is ' . $query['zip'];
    }
?>
<?php
get_footer();
?>