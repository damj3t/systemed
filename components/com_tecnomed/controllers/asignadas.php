<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controlleradmin');

class TecnomedControllerAsignadas extends JControllerAdmin
{
        public function &getModel($name = 'Calendario', $prefix = 'TecnomedModel')
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }


		function publish()
			{
				$db = &JFactory::getDBO();
				
				$id = JRequest::getVar('id');
				//obtener la info de la reserva

	        	$query  = ' SELECT `paciente_id`, `profesional_id`,`estado`,`id` ';
	        	$query .= ' FROM `#__tm_agenda_det` ';
	        	$query .= ' WHERE `id`= ' . $id;
	        	
	        	$db->setQuery($query);
	        	$itemsDb = $db->loadObjectList();
           	    //la informacion la pasamos a un arreglo para manipular los datos mas adelante
        		foreach ($itemsDb as $itemDb) { //store reserved items to array just like items to reserve
	        			
	        		$item = array();
	        		$item['paciente_id']=$itemDb->paciente_id; 
	        		$item['profesional_id']=$itemDb->profesional_id;
	        		$item['estado']=$itemDb->estado;
	        		$item['id']=$itemDb->id;
        		}
		
       		//$db = $this->getDbo();
			//$query = $db->getQuery(true);
			$query  =' SELECT COUNT(*)';
			$query .=' FROM #__tm_rce_atenciones ';
			$query .=' WHERE reservaid ='.$id;
			$db->setQuery($query);
			$count = $db->loadResult();
	
			if ($error = $db->getErrorMsg())
			{
				$this->setError($error);
				return false;
			}
			
			// si la busqueda retorna 3 es porque esta asignada por lo que no debe crear una nueva atencion 
			if ($count<=0 ){
			
			//	$db = $this->getDbo();
				$db->setQuery(
					'insert into  #__tm_rce_atenciones (reservaid,pacienteid,profesional_id)'
				   .'values ('.$item['id'].','.$item['paciente_id'].','.$item['profesional_id'].')'
				  );
				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}
				
				$lastnewid = $db->insertid();	
					
			//	$db = $this->getDbo();
					$db->setQuery(
						'insert into  #__tm_caja (atencion_id,paciente_id,profesional_id)'
					   .'values ('.$lastnewid.','.$item['paciente_id'].','.$item['profesional_id'].')'
					  );
					if (!$db->query()) {
						throw new Exception($db->getErrorMsg());
					}
					
			}
			
        		
        		
        		
				$query = 'Update #__tm_agenda_det set estado = 3 WHERE id = '.$id;
				$db = &JFactory::getDBO();
				$db->setQuery($query);
				if (!$db->query())
				{
					JError::raiseError(500, $db->getErrorMsg() );
				}
				
			    $query = 'Update #__tm_rce_atenciones set estado = 1 WHERE reservaid = '.$id;
				$db = &JFactory::getDBO();
				$db->setQuery($query);
				if (!$db->query())
				{
					JError::raiseError(500, $db->getErrorMsg() );
				}
				
				$link = 'index.php?option=com_tecnomed&view=asignadas';
				$this->setRedirect($link, $msg);
			}
}
