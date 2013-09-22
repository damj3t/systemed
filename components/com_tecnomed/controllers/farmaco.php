<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controllerform');

class TecnomedControllerFarmaco extends JControllerForm
{
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


		$model = $this->getModel( 'farmaco' );
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		
			
		if ($model->store($data)) {
			$msg = JText::_( 'Item Saved' );
		} else {
			$msg = JText::_( 'Error Saving Item' );
		}

		$link = 'index.php?option=com_tecnomed&view=farmacos';
		$this->setRedirect( $link, $msg );
	}
}
