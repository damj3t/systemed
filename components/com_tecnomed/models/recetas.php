<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modellist' );

class TecnomedModelRecetas
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

                parent::populateState('a.nombre', 'asc');
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
                $id = JRequest::getVar('id');
                //$atencion_id	= JRequest::getVar('atencion_id',	null, 'post', 'int');
                // Select the required fields from the table.
                $query->select(
                        $this->getState(
                                'list.select',
                                'a.*'
                        )
                );
                $query->select('CONCAT(f.nombre," ",f.dosis) as farmaco ');
                $query->from('`#__tm_rce_farmacos` AS a');
                $query->from('`#__tm_farmacos` AS f');
                $query->where('f.id = a.farmaco_id ');
			 
	            $query->where('a.atencion_id = '.$id );
			
	

		// Filter by search in title
                $search = $this->getState('filter.search');
                if (!empty($search)) {
                        if (stripos($search, 'id:') === 0) {
                                $query->where('a.id = '.(int) substr($search, 3));
                        } else {
                                $search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                                $query->where('(a.posologia LIKE '.$search.')');
                        }
                }
     
                return $query;
        }
}	
?>