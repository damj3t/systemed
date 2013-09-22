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

class TecnomedTableAgenda extends JTable{


	function __construct( &$db )
	{
		parent::__construct( '#__tm_agenda', 'id', $db );

	}// function

public function delete($cid)
        {
		$db = $this->getDbo();
                //cancellazione autori e tags relatii a questo libro
		$query = $db->getQuery(true);
                $query->delete()->from('#__tm_agenda_det')->where('agenda_id = '. $cid);
                $this->_db->setQuery($query);
                $this->_db->query();
		         return parent::delete($cid);
        }
}


