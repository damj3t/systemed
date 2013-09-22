<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelAtenciones
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
			//	$id.= ':' . $this->getState('filter.language');

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
                $query->from('`#__tm_rce_atenciones` AS a');
	
			
		// Join over the users for the checked out user.
                $query->select('u.nombre AS diagnostico');
                $query->join('LEFT', '#__tm_diagnosticos AS u ON u.id=a.diagnosticoid');

				$query->select('v.nombre AS paciente');
                $query->join('LEFT', '#__tm_pacientes AS v ON v.id=a.pacienteid');
				
				

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