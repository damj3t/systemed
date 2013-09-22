<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

class TecnomedTableFarmaco extends JTable
{
	public function __construct(&$db)
        {
                parent::__construct('#__tm_farmacos', 'id', $db);
        }

	/*function check()
        {

                if (trim($this->nombre) == '') {
                        $this->setError(JText::_('COM_TECNOMED_WARNING_VALIDAR_NOMBRE'));
                        return false;
                }

                return true;
        }*/

}
?>