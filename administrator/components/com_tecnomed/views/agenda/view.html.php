<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

jimport( 'joomla.application.component.view' );
JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers');
class TecnomedViewAgenda extends JView
{

		protected $form;
        protected $item;
        protected $state;
		protected $config;

	function display($tpl = null)
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
	
		//Data from model
		//$model = $this->getModel();
		//$agenda		=& $this->get('Data');
		$document       = & JFactory::getDocument();
        $document->addStyleSheet('components/com_tecnomed/assets/css/com_tecnomed.css');
		
		$isNew		= ($this->item->id == 0);
		$text = $isNew ? JText::_( 'NUEVO' ) : JText::_( 'EDITAR' );

		JToolBarHelper::title(   '&nbsp;&nbsp;' .JText::_( 'COM_TECNOMED_AGENDA' ).': <small><small>[ ' . $text.' ]</small></small>', 'agenda');

		JToolBarHelper::apply('agenda.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::save('agenda.save', 'JTOOLBAR_SAVE');
                
		JToolBarHelper::cancel('agenda.cancel');

		parent::display($tpl);
	}
}
