<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class TecnomedControllerPdf extends SophiaController
{
	function __construct()
	{
		parent::__construct();
		$this->cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		JArrayHelper::toInteger($this->cid, array(0));
	}

}
