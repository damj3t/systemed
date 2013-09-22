<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');

class TecnomedModelAsignada extends JModelAdmin
{
	function __construct()
	{
		parent::__construct();
	}
	
	protected $text_prefix = 'COM_TECNOMED';

	public function getTable($type = 'Calendario', $prefix = 'TecnomedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
        {
		$form = $this->loadForm('com_tecnomed.asignada', 'asignada', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) {
                        return false;
                }

		return $form;
        }



	protected function loadFormData()
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_tecnomed.edit.asignada.data', array());

                if (empty($data)) {
                        $data = $this->getItem();
                }

                return $data;
        }

	public function save($data)
	{

		if (parent::save($data)) {
			$db = &JFactory::getDBO();
			$newid = $data['id'];
			$paciente_id = $data['paciente_id'];
			$profesional_id = $data['profesional_id'];
			$estado = $data['estado'];	
			
			$query = $db->getQuery(true);
			$query->select('COUNT(*)');
			$query->from($db->quoteName('#__tm_rce_atenciones'));
			$query->where ('reservaid = '.$newid);
			$db->setQuery($query);
			$count = $db->loadResult();
	
			
			if ($error = $db->getErrorMsg())
			{
				$this->setError($error);
				return false;
			}
// 			si la busqueda retorna 3 es porque esta asignada por lo que no debe crear una nueva atencion 
			if ($count<=0 ){
				$db = $this->getDbo();
				$db->setQuery(
					'insert into  #__tm_rce_atenciones (reservaid,pacienteid,profesional_id)'
				   .'values ('.$newid.','.$paciente_id.','.$profesional_id.')'
				  );
				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}
				
				$lastnewid = $db->insertid();	
					
				$db = $this->getDbo();
					$db->setQuery(
						'insert into  #__tm_caja (atencion_id,paciente_id,profesional_id)'
					   .'values ('.$lastnewid.','.$paciente_id.','.$profesional_id.')'
					  );
					if (!$db->query()) {
						throw new Exception($db->getErrorMsg());
					}
			}

			return true;
		}

		return false;
	}
	
	
		

}
