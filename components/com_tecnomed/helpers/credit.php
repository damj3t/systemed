<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

class JHTMLCredit
{
        function credit()
        {
		$xmldata = JApplicationHelper::parseXMLInstallFile(JPATH_ADMINISTRATOR .DS. 'components'.DS.'com_tecnomed'.DS.'tecnomed.xml');
		$credit='<div style="text-align:center;"><a href="http://www.systemed.cl" target="_blank">Systemed -Sistema Clinico '.$xmldata['version'].'</a></div><br />';
                return $credit;
        }
}
