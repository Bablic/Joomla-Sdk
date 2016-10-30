<?php
defined( '_JEXEC' ) or die( 'Restricted access' );


jimport('bablic.sdk');
jimport('bablic.store');

jimport( 'joomla.Platform');

JPluginHelper::importPlugin('bablic');

$plugin = JPluginHelper::getPlugin('system', 'bablic');
$params = new JRegistry($plugin->params);
$options = array("channel_id" => "joomla","store" => new BablicJoomlaPluginStore($params));
$sdk = new BablicSDK($options);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	header('Content-type: application/json');
	$url = JURI::root();
	switch($_POST['action']){
		case 'create':
			$rslt = $sdk->create_site(
				array(
					'site_url' => $url,
					'callback' => "$url?option=com_bablic&format=raw"
				)
			);
			if(!$sdk->site_id){
				echo json_encode(array('error' => 'Failed registering this website. Make sure this Bablic code snippet was not added manually into the website code'));
				exit;
			}
			break;
		case 'set':
			$site = $_POST['site'];
			$sdk->set_site($site,"$url?option=com_bablic&format=raw");
			break;
		case 'refresh':
			$sdk->refresh_site();
			break;
		case 'delete':
			$sdk->clear_data();
			break;
	}
	$sdk->clear_cache();
	echo json_encode(array(
		'site' => $sdk->get_site()
	));
	exit;
}

$sdk->refresh_site();
$site = $sdk->get_site();

?>
<div id="bablicHide" style="position:fixed;z-index:9999999;top:0;left:0;right:0;bottom:0;background:white;"></div>
<script>(function(){ 
	var link = document.createElement("LINK"); link.rel="stylesheet"; link.href="//dev.bablic.com/css/addons/generic.css";
	document.getElementsByTagName("head")[0].appendChild(link); 
	var link = document.createElement("LINK"); link.rel="stylesheet"; link.href="//dev.bablic.com/css/addons/joomla.css";
	document.getElementsByTagName("head")[0].appendChild(link); 
 })();</script>
<script src="http://dev.bablic.com/js/sdk.js"></script>
<script src="http://dev.bablic.com/js/addons/joomla.js"></script>
<div style="display:none;">
    <input type="hidden" value="<?php echo $site['site_id'] ?>" id="bablic_site_id" />
    <input type="hidden" value="<?php echo $site['access_token'] ?>" id="bablic_access_token" />
    <textarea  id="bablic_item_meta"><?php echo $site['meta'] ?></textarea>
    <input type="hidden" value="<?php echo ($site['trial_started'] ? '1' : '') ?>" id="bablic_trial" />
</div>
<div id="bablic_form"></div>
