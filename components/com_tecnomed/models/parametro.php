<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');

class TecnomedModelParametro extends JModelAdmin
{
	protected $text_prefix = 'COM_TECNOMED';



	public function getTable($type = 'Parametro', $prefix = 'TecnomedTable', $config = array())
        {
                return JTable::getInstance($type, $prefix, $config);
        }


//	public function getScript() 
//	{
//		return 'administrator/components/com_tecnomed/models/forms/diagnostico.js';
//	}
	
	public function getForm($data = array(), $loadData = true)
        {
		$form = $this->loadForm('com_tecnomed.parametro', 'parametro', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) {
                        return false;
                }

		return $form;
        }



	protected function loadFormData()
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_tecnomed.edit.parametro.data', array());

                if (empty($data)) {
                        $data = $this->getItem();
                }

                return $data;
        }

/*
	protected function prepareTable(&$table)
        {
        $table->nombre = htmlspecialchars_decode($table->nombre, ENT_QUOTES);
		$table->direccion = JApplication::stringURLSafe($table->direccion);
		
        }
*/	
	

}
?>
