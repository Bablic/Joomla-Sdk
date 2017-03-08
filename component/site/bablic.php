<?php
defined( '_JEXEC' ) or die( 'Restricted access' );


jimport('bablic.sdk');
jimport('bablic.store');

jimport( 'joomla.Platform');

JPluginHelper::importPlugin('bablic');

$plugin = JPluginHelper::getPlugin('system', 'bablic');
$params = new JRegistry($plugin->params);
$url = JURI::root();
$path = parse_url($url, PHP_URL_PATH);
$subdir_base = preg_replace("/\/$/", "", $path);
$options = array("channel" => "joomla","store" => new BablicJoomlaPluginStore($params),'subdir_base' => $subdir_base);
$sdk = new BablicSDK($options);
$sdk->refresh_site();

?>
OK