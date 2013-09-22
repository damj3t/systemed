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
class TecnomedViewProfesional extends JView
{

		protected $form;
        protected $item;
        protected $state;
		protected $config;

        /**
         * Display the view
         */
        public function display($tpl = null)
        {
                // Initialise variables.
                $this->form     = $this->get('Form');
                $this->item     = $this->get('Item');
                $this->state    = $this->get('State');
		
		$this->config =& JComponentHelper::getParams( 'com_tecnomed' );
                $this->imageconfig=& JComponentHelper::getParams('com_media');
                $this->session=& JFactory::getSession();

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
                JRequest::setVar('hidemainmenu', true);

                $user           = JFactory::getUser();
                $isNew          = ($this->item->id == 0);
                $canDo          = TecnomedHelper::getActions();

		$document       = & JFactory::getDocument();
        $document->addStyleSheet('components/com_tecnomed/assets/css/com_tecnomed.css');
		$icon = $isNew ? 'profesionalesadd' : 'profesionales';
		JToolBarHelper::title(JText::_(($isNew ? 'COM_TECNOMED_PAGE_ADD_PROFESIONAL' : 'COM_TECNOMED_PAGE_VIEW_PROFESIONAL')), $icon);

                // If not checked out, can save the item.
                if (!$checkedOut && $canDo->get('core.edit')) {
                        JToolBarHelper::apply('profesional.apply', 'JTOOLBAR_APPLY');
                        JToolBarHelper::save('profesional.save', 'JTOOLBAR_SAVE');
                }

                if (empty($this->item->id))  {
                        JToolBarHelper::cancel('profesional.cancel');
                } else {
                        JToolBarHelper::cancel('profesional.cancel', 'JTOOLBAR_CLOSE');
                }
        }
}
