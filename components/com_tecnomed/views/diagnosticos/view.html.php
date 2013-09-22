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
class TecnomedViewDiagnosticos extends JView
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
               // $canDo  = TecnomedHelper::getActions();

//                JToolBarHelper::title(JText::_( 'COM_TECNOMED_PACIENTE_MANAGER' ), 'pacientes' );
              //  if ($canDo->get('core.create')) {
  //                      JToolBarHelper::addNew('paciente.add','JTOOLBAR_NEW');
             //   }
             //   if ($canDo->get('core.edit')) {
    //                    JToolBarHelper::editList('paciente.edit','JTOOLBAR_EDIT');
            //    }

		//if ($canDo->get('core.delete')) {
     //                   JToolBarHelper::deleteList('', 'pacientes.delete','JTOOLBAR_DELETE');
		//}

		//if ($canDo->get('core.admin')) {
   //                     JToolBarHelper::divider();
   //                     JToolBarHelper::preferences('com_tecnomed');
       //         }
        }
}
