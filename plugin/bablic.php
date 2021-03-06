<?php
######################################################################
# Copyright (C) 2012 by Bablic  	   	   	   	   	   	   	   	   	 #
# Homepage   : www.bablic.com		   	   	   	   	   	   		     #
# Author     : Ishai Jaffe	    		   	   	   	   	   	   	   	 #
# Email      : ishai@bablic.com      	   	   	   	   	   	   	     #
# Version    : 1.0.0                     	   	    	   	   		 #
# License    : http://www.gnu.org/copyleft/gpl.html GNU/GPL          #
######################################################################

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');
jimport( 'joomla.html.parameter');


jimport('bablic.sdk');
jimport('bablic.store');

jimport('joomla.application.component.helper');



class plgSystemBablic extends JPlugin
{
		private $sdk = null;
		function __construct( &$subject, $params )
    	{
    		parent::__construct($subject, $params);
            $mainframe = JFactory::getApplication();
            if($mainframe->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false || strcmp(substr(JURI::base(), -15), "/administrator/")==0)
                return;

            $url = JURI::root();
            $path = parse_url($url, PHP_URL_PATH);
            $subdir_base = preg_replace("/\/$/", "", $path);
            $params = JComponentHelper::getParams('com_bablic');
			$this->sdk = new BablicSDK(array("channel_id" => "joomla", "store" => new BablicJoomlaPluginStore($params), "subdir_base" => $subdir_base));
			$this->sdk->handle_request();
    	}
		
		
		function onBeforeCompileHead()
    	{
    	    $mainframe = JFactory::getApplication();
            if($mainframe->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false || strcmp(substr(JURI::base(), -15), "/administrator/")==0)
                return;
            $document = JFactory::getDocument();
			$document->addCustomTag($this->sdk->get_bablic_top());
			$footer = $this->sdk->get_bablic_bottom();
            $document->addCustomTag(preg_replace('/<script /i', '<script async ', $footer));
    	}

}
?>