<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelSecretaria extends JModelList
{
	
/*
 * comentado por llamada a tabla botones 15/02/2013
	public function &getButtons()
        {
                if (empty($this->_buttons)) {
                        $this->_buttons = array(
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&task=paciente.add'),
                                        'image' => 'tecnomed-pacientesadd-48.png',
                                        'text' => JText::_('COM_TECNOMED_PACIENTE_NUEVO'),
                                        'access' => array('core.admin', 'com_tecnomed')
                      ),
                     array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=pacientes'),
                                        'image' => 'tecnomed-pacientes-48.png',
                                        'text' => JText::_('COM_TECNOMED_PACIENTES'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
                     array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&task=agenda.add'),
                                        'image' => 'tecnomed-agenda-48.png',
                                        'text' => JText::_('COM_TECNOMED_AGENDA_NUEVA'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=agendas'),
                                        'image' => 'tecnomed-agenda-48.png',
                                        'text' => JText::_('COM_TECNOMED_AGENDA'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=calendarios'),
                                        'image' => 'tecnomed-calendario-48.png',
                                        'text' => JText::_('COM_TECNOMED_RESERVAS'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=asignadas'),
                                        'image' => 'tecnomed-confirmar-48.png',
                                        'text' => JText::_('COM_TECNOMED_ASIGNADAS'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&task=caja.add'),
                                        'image' => 'tecnomed-pagos-48.png',
                                        'text' => JText::_('COM_TECNOMED_PAGOS'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=cajas'),
                                        'image' => 'tecnomed-pagos-48.png',
                                        'text' => JText::_('COM_TECNOMED_PAGOS'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     )
                  );
                }

                return $this->_buttons;
        }
    */    
	public function getBotones() {

	
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('bot.*');
			$query->from( '#__tm_botones AS bot');
			$query->where('bot.menu = 1');
			$query->where('bot.published = 1');
			$query->order('bot.id');

			$this->_db->setQuery($query);
			$this->Secretaria = $this->_db->loadObjectList();
		

		return $this->Secretaria;
	}



}	
