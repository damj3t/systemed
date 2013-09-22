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
class TecnomedViewCpanel extends JView
{
        protected $buttons;

        /**
         * Display the view
         */
        public function display($tpl = null)
        {
                $this->buttons       = $this->get('Buttons');

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

		JToolBarHelper::title(JText::_( 'COM_TECNOMED' ), 'tecnomed-main' );
                require_once JPATH_COMPONENT.DS.'helpers'.DS.'tecnomed.php';
                $state  = $this->get('State');
                $canDo  = TecnomedHelper::getActions($state->get('filter.category_id'));

		if ($canDo->get('core.admin')) {
                        JToolBarHelper::preferences('com_tecnomed');
                }
        }
}
