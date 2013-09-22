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

				$this->buttons		= & $this->get( 'Botones');
				//$this->buttones		= & $this->get( 'BotonesAdmin');
				$this->Secretaria		= & $this->get( 'BotonesSecretaria');
				$this->Medico		= & $this->get( 'BotonesMedicos');
				$this->Grupos		= & $this->get('TipoUsuario');
                // Check for errors.
                if (count($errors = $this->get('Errors'))) {
                        JError::raiseError(500, implode("\n", $errors));
                        return false;
                }

                parent::display($tpl);
        }


}
