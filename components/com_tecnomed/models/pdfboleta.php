
<?php
defined('_JEXEC') or die("Invalid access");
//jimport('joomla.application.component.model');
jimport('joomla.application.component.modelitem');

//class SophiaModelInfo extends JModel
class TecnomedModelPdfboleta extends JModel
{


	public function getTable($type = 'atencion', $prefix = 'TecnomedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}


	function __construct()
	{
		parent::__construct();
	}



	function getData()
	{
		$id = JRequest::getVar('id');


			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('caj.*');
			$query->select('pac.nombre AS nombre');
			$query->select('pac.rut AS rut');
			$query->select('pac.direccion AS direccion');
			$query->select('pac.telefono AS telefono');
			$query->select('pac.telefono AS telefono');
			$query->select('prof.nombre AS medico');
			$query->select('prof.rut AS rutmedico');
			$query->from( '#__tm_caja AS caj ');
			$query->from( '#__tm_pacientes AS pac ');
			$query->from( '#__tm_profesionales AS prof ');
			$query->where('pac.id = caj.paciente_id ');
			$query->where('prof.id = caj.profesional_id ');
			$query->where('caj.id = '. $id);


			$this->_db->setQuery($query);
			$this->atencion = $this->_db->loadObjectList();
	

		return $this->atencion;
	}

	

	 

}
?>