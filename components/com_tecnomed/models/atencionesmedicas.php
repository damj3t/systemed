	<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelAtencionesmedicas
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

              //  $language = $app->getUserStateFromRequest($this->context.'.filter.language', 'filter_language', '');
              //  $this->setState('filter.language', $language);

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

				//$nowDate = JDate::format("%Y-%m-%d");
				//$nowDate = $date->toFormat("%Y-%m-%d");//$db->Quote($date->toSql());
					
                // Select the required fields from the table.
                $query->select(
                        $this->getState(
                                'list.select',
                                'a.*'
                        )
                );
                $query->select('pac.nombre AS paciente');
                $query->select('pac.telefono AS telefono');
                $query->select('pac.email AS email');
                $query->select('adet.hora AS hora');
                $query->select('isa.nombre AS isapre');
                //$query->select("(select estado nombre from #__tm_estados where id = adet.estado) AS estado");
                //$query->select("adet.estado AS estadoid");
                
                $query->select("(select desc_item from #__tm_paramet WHERE cod_grupo = 204 and cod_item = adet.tipo_atencion_id) tipo_atencion");
                $query->select("(select desc_item from #__tm_paramet WHERE cod_grupo = 205 and cod_item = a.estado) estado_atencion");
                
                $query->from('`#__tm_rce_atenciones` AS a');
	            //buscamos al usuario conectado para cargar solo sus atenciones
                $query->from('`#__tm_profesionales` AS p');
                $query->from('`#__tm_pacientes` AS pac');
                $query->from('`#__tm_agenda_det` AS adet');
                $query->from('`#__tm_isapres` AS isa');
                $query->where('pac.id = a.pacienteid' ); 
                $query->where('p.id = a.profesional_id' );  
                $query->where('adet.id = a.reservaid' );  
			    $query->where("adet.fecha =  DATE_FORMAT(sysdate(),'%Y,%m,%d')");//"' .$nowDate.'"'); 
			    //JHtml::date($date,'Y-m-d H:M');
                $query->where('p.user_id = '.$user->id );
			    $query->where('pac.isapreid = isa.id' );  
			    $query->order('adet.hora ASC' ); 
		// Join over the users for the checked out user.
            
			/*  
			 *  $query->select('u.desc_item AS diagnostico');
                $query->join('LEFT', '#__tm_paramet AS u ON u.id=a.diagnosticoid');
 	$query->select('v.nombre AS paciente');
                $query->join('LEFT', '#__tm_pacientes AS v ON v.id=a.pacienteid');
			*/	
                
				

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