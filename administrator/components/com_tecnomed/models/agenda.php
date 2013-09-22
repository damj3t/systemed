<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');

class TecnomedModelAgenda extends JModelAdmin
{
	function __construct()
	{
		parent::__construct();
	}
	
	protected $text_prefix = 'COM_TECNOMED';

	public function getTable($type = 'Agenda', $prefix = 'TecnomedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
        {
		$form = $this->loadForm('com_tecnomed.agenda', 'agenda', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) {
                        return false;
                }

		return $form;
        }



	protected function loadFormData()
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_tecnomed.edit.agenda.data', array());

                if (empty($data)) {
                        $data = $this->getItem();
                }

                return $data;
        }

	public function save($data)
	{

		if (parent::save($data)) {
			
		
		$db = &JFactory::getDBO();
		$newid = $db->insertid() ;
		$can_dias=1;
		$profesional_id =	$data['profesional_id'];
		$fecha_desde = $data['fecha_desde'];
		$fecha_hasta = $data['fecha_hasta'];
		$hora_ini = $data['hora_ini'];
		$hora_fin = $data['hora_fin'];
		$periodo = $data['periodo'];
		$lunes = $data['lu'];
		$martes = $data['ma'];
		$miercoles = $data['mi'];
		$jueves = $data['ju'];
		$viernes = $data['vi'];
		$sabado = $data['sa'];
		$domingo = $data['do'];
		
		$dias[] = $data['do'];	
		$dias[] = $data['lu'];
		$dias[] = $data['ma'];
		$dias[] = $data['mi'];
		$dias[] = $data['ju'];
		$dias[] = $data['vi'];
		$dias[] = $data['sa'];
			
		for($i=0;$i<=6;$i++)
		{
			if($dias[$i]==0){
			$dias[$i]= "no";
			}else{
				$dias[$i]= "si";
			}
		}	

	if (isset($fecha_desde)) {
			//printf($fecha_desde);		
			while ($fecha_desde <= $fecha_hasta)
				{	//obtengo el numero de dia
					$num_dia=strftime("%w",strtotime($fecha_desde)); 
					 //si esta seleccionado ese numero de dia lo tengo que agregar en la base de Datos
					
					  if($dias[$num_dia] == "si")
					{
						$hora = $hora_ini;
						while($hora != $hora_fin)
						{

								$db = $this->getDbo();
								$db->setQuery(
									'insert into  #__tm_agenda_det (agenda_id,fecha,hora,profesional_id)'
								   .'values ('.$newid.',"'.$fecha_desde.'","'.$hora.'","'.$profesional_id.'")'
								  );
								if (!$db->query()) {
									throw new Exception($db->getErrorMsg());
								}
								
								$hora = $this->sumaMinutos($hora,$periodo);

						}
					}
					$fecha_desde = $this->sumaDias($fecha_desde, 1);
				
				}
				
				
			}


			return true;
		}

		return false;
	}

	function getAgendaDet($fecha,$hora,$agenda_id) {
		$db = &JFactory::getDBO();
		
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from('#__tm_agenda_det');
		$query->where('fecha = '.$fecha);
		$query->where('hora = '.$hora);
		$query->where('agenda_id = '.$agenda_id);
		//echo $query;
		$db->setQuery($query);
		$row = $db->loadResult();
			
		return $row;
		 
		}
		function sumaDias($fecha,$dia)//suma dias a la fecha que se pasa por parametro
		{	list($year,$mon,$day) = explode('-',$fecha);
			return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));		
		}
		 function sumaMinutos($hora,$mn){
			$hora_r = getdate(strtotime($hora));
			$hora_result = date("H:i", mktime(($hora_r["hours"]),($hora_r["minutes"]+$mn)));
			return $hora_result;
		}
		function cambiaf_a_normal($fecha){ 
			ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
			$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
			return $lafecha; 
		} 
		function cambiaf_a_mysql($fecha){ 
			ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
			$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
			return $lafecha; 
		}
		

}
