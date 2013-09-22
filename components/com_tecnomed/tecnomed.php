<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
		
// Require the base controller
jimport('joomla.application.component.controller');

   		$document    = & JFactory::getDocument();
		$document->addStyleSheet('administrator/templates/system/css/system.css');
		$document->addCustomTag(
			'<link href="administrator/components/com_tecnomed/assets/css/com_tecnomed.css" rel="stylesheet" type="text/css" />'."\n\n".
			'<!--[if IE 7]>'."\n".
			'<link href="administrator/templates/bluestork/css/ie7.css" rel="stylesheet" type="text/css" />'."\n".
			'<![endif]-->'."\n".
			'<!--[if gte IE 8]>'."\n\n".
			'<link href="administrator/templates/bluestork/css/ie8.css" rel="stylesheet" type="text/css" />'."\n".
			'<![endif]-->'."\n".
			'<link rel="stylesheet" href="administrator/templates/bluestork/css/rounded.css" type="text/css" />'."\n"
			);         
		
//require_once JPATH_COMPONENT.DS.'helpers'.DS.'route.php';
$controller = JController::getInstance('Tecnomed');
error_log(JRequest::getVar( 'task' ));

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );
// Redirect if set by the controller
$controller->redirect();
?>