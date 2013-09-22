<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');

class TecnomedModelAtencion extends JModelAdmin
{
	function __construct()
	{
		parent::__construct();
	}
	
	protected $text_prefix = 'COM_TECNOMED';

	public function getTable($type = 'Atencion', $prefix = 'TecnomedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
        {
		$form = $this->loadForm('com_tecnomed.atencion', 'atencion', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) {
                        return false;
                }

		return $form;
        }



	protected function loadFormData()
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_tecnomed.edit.atencion.data', array());

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
		
		    $pacinte_id = $data['pacienteid'];
			$atencion_id = $data['id'];
			//MEDICAMENTOS
			$farmaco1 = $data['farmaco1'];
			$posologia1 = $data['posologia1'];
			$farmaco2 = $data['farmaco2'];
			$posologia2 = $data['posologia2'];
			$farmaco3 = $data['farmaco3'];
			$posologia3 = $data['posologia3'];
			$farmaco4 = $data['farmaco4'];
			$posologia4 = $data['posologia4'];
			$farmaco5 = $data['farmaco5'];
			$posologia5 = $data['posologia5'];				
			$farmaco6 = $data['farmaco6'];
			$posologia6 = $data['posologia6'];
			
			$db = $this->getDbo();
			
			if ($farmaco1>0){
			$db->setQuery(
				'insert into  #__tm_rce_farmacos (atencion_id,paciente_id,farmaco_id,posologia)'
			   .'values ('.$atencion_id.','.$pacinte_id.','.$farmaco1.',"'.$posologia1.'")'
			  );
	        if (!$db->query()) {
                        $this->setError($db->getErrorMsg());
                        return false;
                }
			}
			if ($farmaco2>0){
			$db->setQuery(
				'insert into  #__tm_rce_farmacos (atencion_id,paciente_id,farmaco_id,posologia)'
			   .'values ('.$atencion_id.','.$pacinte_id.','.$farmaco2.',"'.$posologia2.'")'
			  );
	        if (!$db->query()) {
                        $this->setError($db->getErrorMsg());
                        return false;
                }
			}

			if ($farmaco3>0){     
			$db->setQuery(
				'insert into  #__tm_rce_farmacos (atencion_id,paciente_id,farmaco_id,posologia)'
			   .'values ('.$atencion_id.','.$pacinte_id.','.$farmaco3.',"'.$posologia3.'")'
			  );
	        if (!$db->query()) {
                        $this->setError($db->getErrorMsg());
                        return false;
                } 
			}
			if ($farmaco4>0){
			$db->setQuery(
				'insert into  #__tm_rce_farmacos (atencion_id,paciente_id,farmaco_id,posologia)'
			   .'values ('.$atencion_id.','.$pacinte_id.','.$farmaco4.',"'.$posologia5.'")'
			  );
	        if (!$db->query()) {
                        $this->setError($db->getErrorMsg());
                        return false;
                }
			}
			if ($farmaco5>0){   
			$db->setQuery(
				'insert into  #__tm_rce_farmacos (atencion_id,paciente_id,farmaco_id,posologia)'
			   .'values ('.$atencion_id.','.$pacinte_id.','.$farmaco5.',"'.$posologia5.'")'
			  );
	        if (!$db->query()) {
                        $this->setError($db->getErrorMsg());
                        return false;
                }
			}
			if ($farmaco6>0){
			$db->setQuery(
				'insert into  #__tm_rce_farmacos (atencion_id,paciente_id,farmaco_id,posologia)'
			   .'values ('.$atencion_id.','.$pacinte_id.','.$farmaco6.',"'.$posologia6.'")'
			  );
	        if (!$db->query()) {
                        $this->setError($db->getErrorMsg());
                        return false;
                }
			}
		return true;
	}
	

}
