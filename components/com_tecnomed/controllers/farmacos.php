<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controlleradmin');

class TecnomedControllerFarmacos extends JControllerAdmin
{
        public function &getModel($name = 'Farmaco', $prefix = 'TecnomedModel')
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }
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