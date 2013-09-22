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
                                        'text' => JText::_('COM_TECNOMED_AGENDA'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=agendas'),
                                        'image' => 'tecnomed-agenda-48.png',
                                        'text' => JText::_('COM_TECNOMED_AGENDA'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ),
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&view=profesionals'),
                                        'image' => 'tecnomed-medico-48.png',
                                        'text' => JText::_('COM_TECNOMED_MEDICO'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     )
					 ,
					 array(
                                        'link' => JRoute::_('index.php?option=com_tecnomed&task=profesional.add'),
                                        'image' => 'tecnomed-medicoadd-48.png',
                                        'text' => JText::_('COM_TECNOMED_MEDICO_NUEVO'),
                                        'access' => array('core.admin', 'com_tecnomed')
                     ) 
                  );
                }

                return $this->_buttons;
        }



}	
