<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TecnomedController extends JController
{
	protected $default_view = 'cpanel';

	public function display($cachable = false, $urlparams = false)
        {
                require_once JPATH_COMPONENT.'/helpers/tecnomed.php';

                parent::display();

                // Load the submenu.
                TecnomedHelper::addSubmenu(JRequest::getWord('view', 'cpanel'));

                return $this;
        }
}
