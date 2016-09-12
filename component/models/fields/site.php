<?php
######################################################################
# Copyright (C) 2012 by Bablic  	   	   	   	   	   	   	   	   	 #
# Homepage   : www.bablic.com		   	   	   	   	   	   		     #
# Author     : Ishai Jaffe	    		   	   	   	   	   	   	   	 #
# Email      : ishai@bablic.com      	   	   	   	   	   	   	     #
# Version    : 1.0.0                     	   	    	   	   		 #
# License    : http://www.gnu.org/copyleft/gpl.html GNU/GPL          #
######################################################################

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldSite extends JFormField {

        protected $type = 'Site';


        public function getInput() {
               $name = $this->name;
                $value = $this->value;

                return '<input id="bablicSite" type="hidden" id="'.$this->id.'" name="'.$name.'" value="'.$value.'" />'.
                       '<button id="edit-account-login">Login</button><script src="https://www.bablic.com/js/bablicSDK.js"></script><script src="https://www.bablic.com/js/joomlaAdmin.js"></script>';
        }
}