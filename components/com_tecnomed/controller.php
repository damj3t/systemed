<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TecnomedController extends JController{

	function display($cachable = false, $urlparams = false)
	{
		parent::display($cachable = false, $urlparams = false);
		return $this;
	}

}
