<?php
/**
 * @package    Bablic
 * @author     Bablic.com
 * @copyright  Copyright (C) 2012 Bablic
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();

class Com_BablicInstallerScript
{
	public function install ($parent)
	{
		$this->run("update #__extensions set enabled=1 where type = 'plugin' and element = 'bablic'");
	}
	public function update ($parent)
	{
	}
	public function uninstall ($parent)
	{
	}
	public function preflight ($type, $parent)
	{
	}
	public function postflight ($type, $parent)
	{
	}
	private function run ($query)
	{
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$db->query();
	}
}