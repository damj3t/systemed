<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controllerform');

class TecnomedControllerPaciente extends JControllerForm
{
public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}
     function save()
	{

		//$post	= JRequest::get('post');
		$model = $this->getModel( 'paciente' );
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		
		//$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		//$post['id'] 	= (int) $cid[0];

		
		if ($model->store($data)) {
			$msg = JText::_( 'Item Saved' );
		} else {
			$msg = JText::_( 'Error Saving Item' );
		}

		$link = 'index.php?option=com_tecnomed&view=pacientes';
		$this->setRedirect( $link, $msg );
	}
	public function submit()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model	= $this->getModel('paciente');

		// Get the data from the form POST
		$data = JRequest::getVar('jform', array(), 'post', 'array');

        // Now update the loaded data to the database via a function in the model
        $upditem	= $model->updItem($data);

    	// check if ok and display appropriate message.  This can also have a redirect if desired.
        if ($upditem) {
            echo "<h2>Updated Greeting has been saved</h2>";
        } else {
            echo "<h2>Updated Greeting failed to be saved</h2>";
        }

		return true;
	}
}
