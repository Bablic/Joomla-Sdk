<?php
defined( '_JEXEC' ) or die( 'Restricted access' );


jimport('bablic.sdk');
jimport('bablic.store');
jimport('joomla.application.component.helper');

jimport( 'joomla.Platform');

$params = JComponentHelper::getParams('com_bablic');

$url = JURI::root();
$path = parse_url($url, PHP_URL_PATH);
$subdir_base = preg_replace("/\/$/", "", $path);
$options = array("channel" => "joomla","store" => new BablicJoomlaPluginStore($params),'subdir_base' => $subdir_base);
$sdk = new BablicSDK($options);
$sdk->refresh_site();

?>
OK