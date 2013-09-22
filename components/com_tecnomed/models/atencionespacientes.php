<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelAtencionespacientes
 extends JModelList
{
        public function __construct($config = array())
        {
                if (empty($config['filter_fields'])) {
                        $config['filter_fields'] = array(
                                'id', 'a.id',
                                'published', 'a.published',
                                 'ordering', 'a.ordering'
                               
                        );
                }
                parent::__construct($config);
        }
	protected function populateState()
        {
		// Initialise variables.
                $app = JFactory::getApplication('administrator');

                $search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
                $this->setState('filter.search', $search);


		// Load the parameters.
                $params = JComponentHelper::getParams('com_tecnomed');
                $this->setState('params', $params);

                parent::populateState('v.nombre', 'asc');
        }

	protected function getStoreId($id = '')
        {
                // Compile the store id.
                $id.= ':' . $this->getState('filter.search');

                return parent::getStoreId($id);
        }

	protected function getListQuery()
        {
                // Create a new query object.
                $db             = $this->getDbo();
                $query  = $db->getQuery(true);
				$user	 =& JFactory::getUser();
				$date = JFactory::getDate();

				$nowDate = $date->toFormat("%Y-%m-%d");//$db->Quote($date->toSql());
					
                // Select the required fields from the table.
                $query->select(
                        $this->getState(
                                'list.select',
                                'a.*'
                        )
                );
                $query->select('pac.nombre AS paciente');
                $query->select('p.nombre AS medico');
				$query->select("CONCAT(DATE_FORMAT(adet.fecha,'%d-%m-%Y'),' ',adet.hora) AS fecha_atencion");
				$query->select("(select desc_item from #__tm_paramet WHERE cod_grupo = 205 and cod_item = a.estado) estado_atencion");
                $query->select('v.nombre AS paciente');
				
                $query->from('`#__tm_rce_atenciones` AS a');
	            //buscamos al usuario conectado para cargar solo sus atenciones
                $query->from('`#__tm_profesionales` AS p');
                $query->from('`#__tm_pacientes` AS pac');
                $query->from('`#__tm_agenda_det` AS adet');
                $query->from('`#__tm_pacientes` AS v');
                
                $query->where('pac.id = a.pacienteid' ); 
                $query->where('p.id = a.profesional_id' );  
                $query->where('adet.id = a.reservaid' );  
			    $query->where('v.id = a.pacienteid' );  
			    //muestra solo los atendidos
			    //$query->where('a.estado = 2' );  
			     
  
		// Filter by search in title
                $search = $this->getState('filter.search');
                if (!empty($search)) {
                        if (stripos($search, 'id:') === 0) {
                                $query->where('a.id = '.(int) substr($search, 3));
                        } else {
                                $search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                                $query->where('(v.nombre LIKE '.$search.')');
                        }
                }
     
                return $query;
        }
}	
?>