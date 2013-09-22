<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelCajas extends JModelList
{
        public function __construct($config = array())
        {
                if (empty($config['filter_fields'])) {
                        $config['filter_fields'] = array(
                                'id', 'a.id',
                                'published', 'a.published',
                                 'ordering', 'a.ordering',
								 'nombre','u.nombre',
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
                $id.= ':' . $this->getState('filter.search');
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
                $query->from('`#__tm_caja` AS a');
	
			
		// Join over the users for the checked out user.
                $query->select('b.nombre AS profesional');
                $query->join('LEFT', '#__tm_profesionales AS b ON b.id=a.profesional_id');

                $query->select('c.nombre AS paciente');
                $query->join('LEFT', '#__tm_pacientes AS c ON c.id=a.paciente_id');

				$query->select("(SELECT CONCAT(DATE_FORMAT(e.fecha,'%d-%m-%Y'),' ',e.hora) FROM #__tm_agenda_det  e WHERE e.id = d.reservaid ) AS atencion");
                $query->join('LEFT', '#__tm_rce_atenciones AS d ON d.id=a.atencion_id');

                
                
               // Filter by profesional
				$profesional = $this->getState('filter.profesional_id');
				if (is_numeric($profesional)) {
					$query->where("a.profesional_id = ".(int) $profesional);
				}
				
                
		// Filter by search in title
                $search = $this->getState('filter.search');
                if (!empty($search)) {
                        if (stripos($search, 'id:') === 0) {
                                $query->where('a.id = '.(int) substr($search, 3));
                        } else {
                                $search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                                $query->where('(c.nombre LIKE '.$search.')');
                        }
                }
     
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
}	
