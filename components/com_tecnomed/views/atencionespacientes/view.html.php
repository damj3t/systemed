<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers');
class TecnomedViewAtencionespacientes extends JView
{
	protected $items;
        protected $pagination;
        protected $state;

        /**
         * Display the view
         */
        public function display($tpl = null)
        {
                $this->state            = $this->get('State');
                $this->items            = $this->get('Items');
                $this->pagination       = $this->get('Pagination');

                // Check for errors.
                if (count($errors = $this->get('Errors'))) {
                        JError::raiseError(500, implode("\n", $errors));
                        return false;
                }
        		//20/02/2013
                //si no pertenece al grupo de medicos no puede acceder a esta opcion 
                $groupsUserIsIn = JAccess::getGroupsByUser(JFactory::getUser()->id);
				 if(!in_array(10,$groupsUserIsIn))
				{
                //  print_r($groupsUserIsIn);
                 $this->msg ='No tiene permisos para acceder';
       			 $this->SinAcceso = 1;	
				}else
				{
				 $this->SinAcceso = 0;	
				}
				
                $this->addToolbar();
                parent::display($tpl);
        }

        protected function addToolbar()
        {
                $document       = & JFactory::getDocument();
                $document->addStyleSheet('components/com_tecnomed/assets/css/com_tecnomed.css');
                $document->addScript(DS.'includes'.DS.'js'.DS.'overlib_mini.js');

                require_once JPATH_COMPONENT.DS.'helpers'.DS.'tecnomed.php';
                $state  = $this->get('State');
                //$canDo  = TecnomedHelper::getActions();


        }
}
