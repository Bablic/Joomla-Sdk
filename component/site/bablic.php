<?php
defined( '_JEXEC' ) or die( 'Restricted access' );


jimport('bablic.sdk');
jimport('bablic.store');

jimport( 'joomla.Platform');

JPluginHelper::importPlugin('bablic');

$plugin = JPluginHelper::getPlugin('system', 'bablic');
$params = new JRegistry($plugin->params);
$options = array("channel" => "joomla","store" => new BablicJoomlaPluginStore($params));
$sdk = new BablicSDK($options);
$sdk->refresh_site();

?>
OK