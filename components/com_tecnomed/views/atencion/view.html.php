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
jimport('joomla.html.pane');
JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers');
class TecnomedViewAtencion extends JView
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
	

		$document       = & JFactory::getDocument();
        $document->addStyleSheet('components/com_tecnomed/assets/css/com_tecnomed.css');
		
		$isNew		= ($this->item->id == 0);
		$text = $isNew ? JText::_( 'NUEVO' ) : JText::_( 'EDITAR' );
		
		$tabsParams = array();
		$tabsParams['startOffset'] = isset($_COOKIE['startOffset']) ? $_COOKIE['startOffset'] : 0;
        
        $tabs = &JPane::getInstance('tabs', $tabsParams, true);
		$this->assignRef('tabs', $tabs);
		
		parent::display($tpl);
	}
}
