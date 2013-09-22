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
class TecnomedViewMedico extends JView
{
        protected $buttons;

        /**
         * Display the view
         */
        public function display($tpl = null)
        {
                //$this->buttons       = $this->get('Buttons');
				$this->buttons		= & $this->get( 'Botones');
                // Check for errors.
                if (count($errors = $this->get('Errors'))) {
                        JError::raiseError(500, implode("\n", $errors));
                        return false;
                }

                parent::display($tpl);

        }


}
