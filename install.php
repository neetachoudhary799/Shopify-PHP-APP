<?php
$shop = $_GET['shop'];
$api_key = "252e986471c9761979b4c5796810ae80";
$scopes = "read_orders,write_orders,write_script_tags,write_themes,read_products,write_products,read_inventory";
$redirect_uri = "https://nynmdev.iworklab.com/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);
/*$url ='https://nynm-teststore.myshopify.com/admin/oauth/authorize?client_id=252e986471c9761979b4c5796810ae80&scope=read_orders,write_orders,write_script_tags,write_themes,read_products,write_products,read_inventory&redirect_uri=https://nynmdev.iworklab.com/generate_token.php&state=12345';*/
// Redirect
header("Location: " . $install_url);
die();

/*ob_start();
$configs = require_once("config/config.php");
//$database=$configs['database_info'];
include_once("config/db.php");
$table=$configs['table_info'];

//Checking for shop
isset($_GET['shop']) or die ('Query parameter "shop" missing.');
preg_match('/^[a-zA-Z0-9\-]+.myshopify.com$/', $_GET['shop']) or die('Invalid myshopify.com store URL.');

$settings=$configs['app_info'];
$api_key = $settings['api_key'];
$scopes = $settings['api_scopes'];
$redirect_uri = $settings['api_redirect'];
$nonce = bin2hex(random_bytes(10));
$shop = isset($_GET['shop']) ? $_GET['shop'] : ''; 
// Build install/approval URL to redirect to

        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

        $sql = "SELECT * FROM ".$table['shopify_authorization_redirect']." WHERE shop='$shop'";
        $result = sqlsrv_query($conn, $sql, $params, $options);
        $row_count = sqlsrv_num_rows( $result );

        if ($row_count > 0) {
        $sql = "DELETE FROM ".$table['shopify_authorization_redirect']." WHERE shop='$shop'";
        $result = sqlsrv_query($conn, $sql);
        }
        $sql="INSERT INTO ".$table['shopify_authorization_redirect']." (shop , nonce ,scopes) VALUES ('$shop','$nonce', '$scopes')";
        //echo $sql;
        if (sqlsrv_query($conn, $sql)) {	
        } else {
        die('There is some issue in the app installation. Kindly try installing it again.');
        }

if($shop){
$install_url = "https://" . $shop . "/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri). "&state=".$nonce;
header("Location: " . $install_url);
exit();
}
else{
    return array('response' =>"There is some issue in installation",'Status'=>false);
}*/