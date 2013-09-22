<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controlleradmin');

class TecnomedControllerDiagnosticos extends JControllerAdmin
{
        public function &getModel($name = 'Diagnostico', $prefix = 'TecnomedModel')
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }
}
function save()
	{


		$model = $this->getModel( 'diagnostico' );
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		
			
		if ($model->store($data)) {
			$msg = JText::_( 'Diagnostico Grabado' );
		} else {
			$msg = JText::_( 'Error Al Grabar el Diagnostico' );
		}

		$link = 'index.php?option=com_tecnomed&view=diagnosticos';
		$this->setRedirect( $link, $msg );
	}