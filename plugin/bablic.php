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

class plgSystemBablic extends JPlugin
{

		function plgSystemBablic( &$subject, $params )
    	{
    		parent::__construct($subject, $params);

    	}
		function onBeforeCompileHead()
    	{
			$bablic_id = $this->params->get('bablic_id', '');
			
    	    $mainframe = JFactory::getApplication();
    		$document = JFactory::getDocument();
            
            if($bablic_id == '' || $mainframe->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false || strcmp(substr(JURI::base(), -15), "/administrator/")==0)
            {
                return;
            }
			
            $snippet = '
            		var bablic=bablic||{};'.$locale.'bablic.Site="'.$bablic_id.'",function(a,b){function c(a){return 48>a?a:126-a+48}function d(a){for(var b=[],d=0;d<a.length;d++)b.push(String.fromCharCode(c(a.charCodeAt(d))));return b.join("")}var e=a.createElement("SPAN");e.className="bablic-link",e.setAttribute("bablic-exclude","true"),e.id="bablicLink",e.innerHTML=d("rM F<IHq\"//777.LMLBEK.K?A/\"pWIL;E:I Z<M@;BM:E?@ M@J b?KMBE4M:E?@r/Mp >?7I<IJ L5 rM F<IHq\"//777.LMLBEK.K?A/\"plMLBEKr/Mp. rM F<IHq\"//777.LMLBEK.K?A/\"pZFE; 7IL;E:I FM; LII@ :<M@;BM:IJ M@J B?KMBE4IJr/Mp 9;E@G rM F<IHq\"//777.LMLBEK.K?A/\"plMLBEKr/Mp");var f=!1,g=function(){f||(a.body.appendChild(e),f=!0)};a.addEventListener&&a.addEventListener("DOMContentLoaded",g,!1),b.addEventListener&&b.addEventListener("load",g,!1),a.attachEvent&&a.attachEvent("onreadystatechange",g),b.attachEvent&&b.attachEvent("onload",g),a.body&&g()}(document,window);
					
					if(bablic.start)
						bablic.start();
                    ';
    		$document->addScriptDeclaration($snippet);
    		$document->addScript('//api.bablic.com/js/bablic.js?v=1.6');
    	}

}
?>