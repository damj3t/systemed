<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controllerform');
class TecnomedControllerAtencion extends JControllerForm
{
	
		protected $text_prefix = 'COM_TECNOMED_AGENDA';
		
		protected function allowAdd($data = array())
        {
                // Initialise variables.
                $user           = JFactory::getUser();
                $allow          = null;

                if ($allow === null) {
                        // In the absense of better information, revert to the component permissions.
                        return parent::allowAdd($data);
                } else {
                        return $allow;
                }
        }

	protected function allowEdit($data = array(), $key = 'id')
        {
                  return parent::allowEdit($data, $key);
        }
      
 function save()
	{


		$model = $this->getModel( 'atencion' );
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		
			
		if ($model->store($data)) {
			$msg = JText::_( 'Atencion guardada' );
		} else {
			$msg = JText::_( 'Error al guarda la Atencion' );
		}

		$link = 'index.php?option=com_tecnomed&view=atencionesmedicas';
		$this->setRedirect( $link, $msg );
	}
	
}
