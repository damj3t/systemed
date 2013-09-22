<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');

class TecnomedModelCaja extends JModelAdmin
{
	function __construct()
	{
		parent::__construct();
	}
	
	protected $text_prefix = 'COM_TECNOMED';

	public function getTable($type = 'Caja', $prefix = 'TecnomedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
        {
		$form = $this->loadForm('com_tecnomed.caja', 'caja', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) {
                        return false;
                }

		return $form;
        }



	protected function loadFormData()
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_tecnomed.edit.caja.data', array());

                if (empty($data)) {
                        $data = $this->getItem();
                }

                return $data;
        }

	public function save($data)
	{

		if (parent::save($data)) {
	
		return true;
		}
	return false;
	}
	
	

}
