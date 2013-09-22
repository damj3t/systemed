<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controllerform');

class TecnomedControllerDiagnostico extends JControllerForm
{
	protected function allowAdd($data = array())
        {
                // Initialise variables.
                $user           = JFactory::getUser();
                $allow          = null;

                if ($allow === null) {
                        // In the absense of better information, revert to the component permissions.
                        return parent::allowAdd($data);
                } else {
                        return $allow;
                }
        }

	protected function allowEdit($data = array(), $key = 'id')
        {
                // Initialise variables.
              /*  $recordId       = (int) isset($data[$key]) ? $data[$key] : 0;
                $categoryId = 0;

                if ($recordId) {
                        $categoryId = (int) $this->getModel()->getItem($recordId)->catid;
                }

                if ($categoryId) {
                        // The category has been set. Check the category permissions.
                        return JFactory::getUser()->authorise('core.edit', $this->option.'.category.'.$categoryId);
                } else {
                */
				// Since there is no asset tracking, revert to the component permissions.
                        return parent::allowEdit($data, $key);
                //}
        }
}
