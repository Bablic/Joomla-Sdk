<?php

defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.Platform');


class BablicJoomlaPluginStore{
	private $params = null;
	function __construct(&$params) {
		$this->params = $params;
    }
    public function get($key){
		return $this->params->get($key,'');
    }

    public function set($key, $value){
		if($this->get($key) == $value)
			return;
        $this->saveValues($key,$value);
    }

	function getPlgId(){
		$db = JFactory::getDBO();
		$sql = 'SELECT `extension_id` FROM `#__extensions` WHERE `type` = "plugin" AND `element` = "bablic"'; // check the #__extensions table if you don't know your element / folder
		$db->setQuery($sql);
		if( !($plg = $db->loadObject()) ){
			return false;
		} else {
			return (int) $plg->extension_id;
		}
	}

	function saveValues($key,$value){
		$ext_id = $this->getPlgId();
		$extension = new JTableExtension(JFactory::getDBO());
		$extension->load($ext_id);

		$this->params->set($key,$value);
		$extension->bind( array('params' => $this->params->toString()) );

		// check and store
		if (!$extension->check()) {
			echo ($extension->getError());
			exit;
		}
		if (!$extension->store()) {
			echo ($extension->getError());
			exit;
		}
	}
}