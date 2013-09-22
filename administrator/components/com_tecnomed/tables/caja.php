<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

class TecnomedTableCaja extends JTable
{
	public function __construct(&$db)
        {
                parent::__construct('#__tm_caja', 'id', $db);
        }

	function check()
        {
	/** check for valid name */
                if (trim($this->monto) == '') {
                        $this->setError(JText::_('Debe Ingresar Un Monto a Pagar'));
                        return false;
                }

                return true;
        }

}
