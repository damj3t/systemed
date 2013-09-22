<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controlleradmin');

class TecnomedControllerParametros extends JControllerAdmin
{
        public function &getModel($name = 'Parametro', $prefix = 'TecnomedModel')
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }
}
function save()
	{


		$model = $this->getModel( 'parametro' );
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		
			
		if ($model->store($data)) {
			$msg = JText::_( 'Parametro Grabado' );
		} else {
			$msg = JText::_( 'Error Al Grabar el Parametro' );
		}

		$link = 'index.php?option=com_tecnomed&view=parametros';
		$this->setRedirect( $link, $msg );
	}