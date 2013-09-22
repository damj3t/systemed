<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controlleradmin');

class TecnomedControllerAtencionesmedicas extends JControllerAdmin
{
        public function &getModel($name = 'AtencionesMedicas', $prefix = 'TecnomedModel')
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }


		function publish()
			{
				$id = JRequest::getVar('id');
				
				//JArrayHelper::toInteger($id);
		
				$query = 'Update #__tm_agenda_det set estado = 5 WHERE id = '.$id;
				$db = &JFactory::getDBO();
				$db->setQuery($query);
				if (!$db->query())
				{
					JError::raiseError(500, $db->getErrorMsg() );
				}
				
			    $query = 'Update #__tm_rce_atenciones set estado = 3 WHERE reservaid = '.$id;
				$db = &JFactory::getDBO();
				$db->setQuery($query);
				if (!$db->query())
				{
					JError::raiseError(500, $db->getErrorMsg() );
				}
				
				$link = 'index.php?option=com_tecnomed&view=atencionesmedicas';
				$this->setRedirect($link, $msg);
			}
}
