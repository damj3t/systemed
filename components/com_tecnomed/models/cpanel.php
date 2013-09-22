<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelCpanel extends JModelList
{

	public function getBotones() {

	
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('bot.*');
			$query->from( '#__tm_botones AS bot');
			$query->where('bot.menu = 3');
			$query->where('bot.published = 1');
			$query->order('bot.id');

			$this->_db->setQuery($query);
			$this->boton = $this->_db->loadObjectList();
		

		return $this->boton;
	}
	
public function getBotonesMedicos() {

	
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('bot.*');
			$query->from( '#__tm_botones AS bot');
			$query->where('bot.menu = 2');
			$query->where('bot.published = 1');
			$query->order('bot.id');

			$this->_db->setQuery($query);
			$this->boton = $this->_db->loadObjectList();
		

		return $this->boton;
	}
	public function getBotonesSecretaria() {

	
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('bot.*');
			$query->from( '#__tm_botones AS bot');
			$query->where('bot.menu = 1');
			$query->where('bot.published = 1');
			$query->order('bot.id');

			$this->_db->setQuery($query);
			$this->boton = $this->_db->loadObjectList();
		

		return $this->boton;
	}
	
public function getBotonesAdmin() {

	
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('bot.*');
			$query->from( '#__tm_botones AS bot');
			$query->where('bot.menu = 3');
			$query->where('bot.published = 1');
			$query->order('bot.id');

			$this->_db->setQuery($query);
			$this->boton = $this->_db->loadObjectList();
		

		return $this->boton;
	}
public function getTipoUsuario() {

	
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$user	 =& JFactory::getUser();
			$query->select('b.title as grupo');
			 $query->from('`#__user_usergroup_map` AS a');
			 $query->from('`#__usergroups` AS b');
			 $query->where('a.user_id = '.$user->id );
			 $query->where('a.group_id = b.id' );
			 $query->order('a.group_id  ASC' ); 		 

			$this->_db->setQuery($query);
			$this->tipo = $this->_db->loadObjectList();
			//$db->setQuery($query);
			//$row = $db->loadResult();

		return $this->tipo;
	}


}	
