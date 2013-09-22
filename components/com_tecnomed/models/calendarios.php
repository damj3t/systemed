<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelCalendarios extends JModelList
{
        public function __construct($config = array())
        {
                if (empty($config['filter_fields'])) {
                        $config['filter_fields'] = array(
                                'id', 'a.id',
                                'published', 'a.published',
                                 'ordering', 'a.ordering',
								 'nombre','u.nombre',
								 'fecha','a.fecha',
                        'profesional','a.profesional_id'
                               
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
                
               $fecha = $this->getUserStateFromRequest($this->context.'.filter.fecha', 'filter_fecha');
		       $this->setState('filter.fecha', $fecha);
		       
		       $profesional = $this->getUserStateFromRequest($this->context.'.filter.profesional_id', 'filter_profesional_id');
		       $this->setState('filter.profesional_id', $profesional);
                

		// Load the parameters.
                $params = JComponentHelper::getParams('com_tecnomed');
                $this->setState('params', $params);

                parent::populateState('u.nombre', 'asc');
        }

	protected function getStoreId($id = '')
        {
                // Compile the store id.
                $id .= ':'.$this->getState('filter.search');
                $id	.= ':'.$this->getState('filter.fecha');
                $id	.= ':'.$this->getState('filter.profesional_id');
                return parent::getStoreId($id);
        }

	protected function getListQuery()
        {
                // Create a new query object.
                $db             = $this->getDbo();
                $query  = $db->getQuery(true);

                // Select the required fields from the table.
                $query->select(
                        $this->getState(
                                'list.select',
                                'a.*'
                        )
                );
                $query->select("DATE_FORMAT(a.fecha,'%d-%m-%Y')As fecha_reserva");
                
                $query->from('`#__tm_agenda_det` AS a');
				// Join over the users for the checked out user.
                $query->select('u.nombre AS profesional');
                $query->join('LEFT', '#__tm_profesionales AS u ON u.id=a.profesional_id');
				
				$query->select('p.nombre AS paciente');
                $query->join('LEFT', '#__tm_pacientes AS p ON p.id=a.paciente_id');

                $query->select('(Select e.especialidad from #__tm_especialidades e where e.id = u.especialidad_id ) AS especialidad');
                
                
		        // Filter by author
				$profesional = $this->getState('filter.profesional_id');
				if (is_numeric($profesional)) {
					$query->where("a.profesional_id = ".(int) $profesional);
				}else{
					$query->where("a.profesional_id = 0");
				}
				
         	//	if ($profesional = $this->getState('filter.profesional_id')) {
			//		$query->where("a.profesional_id = ". $profesional);
            //	    }
                
                if ($fecha = $this->getState('filter.fecha')) {
					$query->where("a.fecha = '". $fecha."'");
                }else {
					$query->where("a.fecha = DATE_FORMAT(sysdate(),'%Y,%m,%d')");//"' .$nowDate.'"'); 
                }
				 $query->order('u.nombre', 'DESC');
				 $query->order('a.fecha', 'DESC');
                 $query->order('a.hora', 'DESC');
		// Filter by search in title
          /*      $search = $this->getState('filter.search');
                if (!empty($search)) {
                        if (stripos($search, 'id:') === 0) {
                                $query->where('a.id = '.(int) substr($search, 3));
                        } else {
                                $search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                                $query->where('(u.nombre LIKE '.$search.')');
                        }
                }
                */
     
                return $query;
        }
        
public function getProfesionals() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Construct the query
		$query->select('u.id AS value, u.nombre AS text');
		$query->from('#__tm_profesionales AS u');
		$query->group('u.id, u.nombre');
		$query->order('u.nombre');

		// Setup the query
		$db->setQuery($query->__toString());

		// Return the result
		return $db->loadObjectList();
	}
	
public function getProfesional() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Construct the query
		$query->select('u.id , u.nombre ');
		$query->from('#__tm_profesionales AS u');
		$query->order('u.nombre');

		// Setup the query
		$db->setQuery($query->__toString());

		// Return the result
		return $db->loadObjectList();
	}
	
public function getAgendaProf() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$id = JRequest::getVar('id');
		
			// Construct the query
			$query->select('u.fecha');
			$query->from('#__tm_agenda_det AS u');
			if ($id != null){
			 	$query->where('u.profesional_id ='.$id);
			}else 
			{
				$query->where('u.profesional_id = 0');
			}
			
			$query->group('u.fecha');
			$query->order('u.fecha asc');
			// Setup the query
			$db->setQuery($query->__toString());
	
			// Return the result
			return $db->loadObjectList();
		}
	}	
	
