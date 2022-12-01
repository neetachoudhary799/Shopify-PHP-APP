<link rel="stylesheet" href="https://nynmdev.iworklab.com/css/admin.css">
<?php
ob_start();
//session_start();
// Get our helper functions
require_once("inc/functions.php");
$configs = require_once("config/config.php");
$script_tag_url=$configs['script_tags']['shopify_script_tags_api'];
$shopify_script_api_del=$configs['script_tags']['shopify_script_api_del'];
$act_token=$configs['app_info']['token'];

$query = $_GET; 
$err = array();$errmsg = false;
//print_r($query);
$hmac = $_GET['hmac']; // Retrieve HMAC request parameter
$host = $_GET['host']; 
$store = $query['shop'];
$jslink=$configs['js']['custom_js'];
$public_url=$jslink;


            $script_tags = shopify_call($act_token, $store, $script_tag_url, array(), 'GET');
            $check = json_decode($script_tags['response'], TRUE);
           // print_r($check);
            if(in_array(null,$check)) {
                $_SESSION['chatbot_api']='';
            }else{
            $_SESSION['chatbot_api']=$check['script_tags'][0]['id'];
            }

            if(isset($_REQUEST['chatbotsubmit'])){
                $_SESSION['chatbot'] = $chatbot = isset($_REQUEST['chatbot']) ? $_REQUEST['chatbot'] : '';
            
                if(count($err) > 0){$errmsg = true;}
                else{$errmsg = false; 
                

                if($_SESSION['chatbot']){        
                    if($_SESSION['chatbot_api']){
                    echo "script is added";
                    }
                    else{
                    $array_data='{"script_tag":{"event":"onload","src":"'.$public_url.'"}}';
                    $script_tags = shopify_call($act_token, $store, $script_tag_url, $array_data, 'POST');
                    $response = $script_tags['response'];
                    $_SESSION['chatbot_api']='1';
                    }
                    echo "<div class='alert success'><dl><dt>Success</dt><dd>Scipt is enable!</dd></dl></div>";
                    echo("<meta http-equiv='refresh' content='1'>");
                    }
                else{
                    $id=$check['script_tags'][0]['id'];
                    $script_tags = shopify_call($act_token, $store, $shopify_script_api_del."/".$id.".json", array(), 'DELETE');
                    $response = $script_tags['response'];
                    $_SESSION['chatbot_api']='';
                    echo "<div class='alert success'><dl><dt>Delete</dt><dd>Script is Disable!</dd></dl></div>";
                    echo("<meta http-equiv='refresh' content='1'>");
                } 
     
            }
        }
     
     ?>




<form id="chatbot" method="post" name="">
<h2>Product Filter</h2>
<div class="row">
<label for="chatbot"></label><br/>
<input class="switch_1" type="checkbox" name="chatbot[]" value="1" <?php if($_SESSION['chatbot_api']) { echo ' checked="checked" '; } ?> />
</div>
<div class="row">
<input type="submit" value="Submit" name="chatbotsubmit" id="chatbotsubmit" >
</div> 
</form>  