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
class TecnomedViewPaciente extends JView
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
                $this->script 	= $this->get('Script');
		
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
                // Set the document
				$this->setDocument();
        }

	protected function addToolbar()
        {
                JRequest::setVar('hidemainmenu', true);

                $user           = JFactory::getUser();
                $isNew          = ($this->item->id == 0);
               // $canDo          = TecnomedHelper::getActions();

		$document       = & JFactory::getDocument();
        $document->addStyleSheet('components/com_tecnomed/assets/css/com_tecnomed.css');
		$icon = $isNew ? 'pacientesadd' : 'pacientes';
	//	JToolBarHelper::title(JText::_(($isNew ? 'COM_TECNOMED_PAGE_ADD_PACIENTE' : 'COM_TECNOMED_PAGE_VIEW_PACIENTE')), $icon);

                // If not checked out, can save the item.
              //  if (!$checkedOut && $canDo->get('core.edit')) {
    //                    JToolBarHelper::apply('paciente.apply', 'JTOOLBAR_APPLY');
    //                    JToolBarHelper::save('paciente.save', 'JTOOLBAR_SAVE');
              //  }

                if (empty($this->item->id))  {
      //                  JToolBarHelper::cancel('paciente.cancel');
                } else {
        //                JToolBarHelper::cancel('paciente.cancel', 'JTOOLBAR_CLOSE');
                }
        }
		protected function setDocument() 
			{
				$isNew = $this->item->id == 0;
				$document = JFactory::getDocument();
				$document->setTitle($isNew ? JText::_('COM_TECNOMED_PACIENTE_NUEVO') : JText::_('COM_TECNOMED_PACIENTE_EDITAR'));
				$document->addScript(JURI::root() . $this->script);
				$document->addScript(JURI::root() . "/administrator/components/com_tecnomed/views/paciente/submitbutton.js");
				JText::script('COM_TECNOMED_PACIENTE_ERROR_INACEPTABLE');
			}    
}
