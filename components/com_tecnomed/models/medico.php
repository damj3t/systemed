<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelMedico extends JModelList
{
/*
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
                     ) ,
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&task=diagnostico.add'),
                                        'image' => 'tecnomed-diagnostico-48.png',
                                        'text' => JText::_('COM_TECNOMED_DIAGNOSTICO_NUEVO'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=diagnosticos'),
                                        'image' => 'tecnomed-diagnostico-48.png',
                                        'text' => JText::_('COM_TECNOMED_DIAGNOSTICO'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=farmacos'),
                                        'image' => 'tecnomed-medicamento-48.png',
                                        'text' => JText::_('COM_TECNOMED_FARMACOS'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ) ,
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&task=farmaco.add'),
                                        'image' => 'tecnomed-medicamento-48.png',
                                        'text' => JText::_('COM_TECNOMED_FARMACO_NUEVO'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=calendarios'),
                                        'image' => 'tecnomed-calendario-48.png',
                                        'text' => JText::_('COM_TECNOMED_RESERVAS'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=atencionespacientes'),
                                        'image' => 'tecnomed-atenciones-48.png',
                                        'text' => JText::_('COM_TECNOMED_ATENCIONES_PACIENTE'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=atencionesmedicas'),
                                        'image' => 'tecnomed-atencion-48.png',
                                        'text' => JText::_('COM_TECNOMED_ATENCION_MEDICA'),
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
			$query->where('bot.menu = 2');
			$query->where('bot.published = 1');
			$query->order('bot.id');

			$this->_db->setQuery($query);
			$this->medico = $this->_db->loadObjectList();
		

		return $this->medico;
	}

}	
