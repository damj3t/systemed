<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
// import Joomla table library
jimport('joomla.database.table');


/*
 tabla definada para el ingreso de los datos del alumno
 */

class TecnomedTableCalendario extends JTable{


	function __construct( &$db )
	{
		parent::__construct( '#__tm_agenda_det', 'id', $db );

	}// function

}


