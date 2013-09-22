<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');

class TecnomedModelFarmaco extends JModelAdmin
{
	protected $text_prefix = 'COM_TECNOMED';



	public function getTable($type = 'Farmaco', $prefix = 'TecnomedTable', $config = array())
        {
                return JTable::getInstance($type, $prefix, $config);
        }


	public function getScript() 
	{
		return 'administrator/components/com_tecnomed/models/forms/farmaco.js';
	}
	public function getForm($data = array(), $loadData = true)
        {
		$form = $this->loadForm('com_tecnomed.farmaco', 'farmaco', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) {
                        return false;
                }

		return $form;
        }



	protected function loadFormData()
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_tecnomed.edit.farmaco.data', array());

                if (empty($data)) {
                        $data = $this->getItem();
                }

                return $data;
        }

function store($data)
	{
		$row =& $this->getTable();

		if (!$row->bind($data)) {
			return false;
		}

		if (!$row->check()) {
			return false;
		}

		if (!$row->store()) {
			return false;
		}

		return true;
	}


}