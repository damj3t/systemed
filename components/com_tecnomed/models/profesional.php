<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modeladmin');

class TecnomedModelProfesional extends JModelAdmin
{
	protected $text_prefix = 'COM_TECNOMED';



	public function getTable($type = 'Profesional', $prefix = 'TecnomedTable', $config = array())
        {
                return JTable::getInstance($type, $prefix, $config);
        }



	public function getForm($data = array(), $loadData = true)
        {
		$form = $this->loadForm('com_tecnomed.profesional', 'profesional', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) {
                        return false;
                }

		return $form;
        }
/*
public function save($data)
	{

		if (parent::save($data)) {
			
		
			$db = &JFactory::getDBO();
			$pacienteid = $db->insertid() ;
			$can_dias=1;
				
			$name = $data['name'];
			$username = $data['username'];
			$email = $data['email1'];
			$pasword1 = $data['password1'];
			$password2 = $data['password2'];
			$periodo = $data['periodo'];
		if (isset($data['password']) && isset($data['password2']))
		{
			// Check the passwords match.
			if ($data['password'] != $data['password2'])
			{
				$this->setMessage(JText::_('JLIB_USER_ERROR_PASSWORD_NOT_MATCH'), 'warning');
				$this->setRedirect(JRoute::_('index.php?option=com_users&view=user&layout=edit', false));
			}

			unset($data['password2']);
		}
		
		    $db = $this->getDbo();
		    $db->setQuery('INSERT INTO #__users (name,username,email,password)  VALUES ("'.$name.'","'.$username.'","'.$email.'","'.$password1.'")');
			if (!$db->query()) {
				throw new Exception($db->getErrorMsg());
			}
		
			$newid = $db->insertid() ;
		   $db->setQuery('update #__tm_profesionales set user_id= '.$newid.' where id ='. $pacienteid.')');
			if (!$db->query()) {
				throw new Exception($db->getErrorMsg());
			}
	 }
	}*/
function store($data)
	{
		$row =& $this->getTable();

		if (!$row->bind($data)) {
			return false;
		}

		if (!$row->check()) {
			return false;
		}

		if (!$row->store()) {
			return false;
		}

	      
		return true;
	}
	
	protected function loadFormData()
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_tecnomed.edit.profesional.data', array());

                if (empty($data)) {
                        $data = $this->getItem();
                }

                return $data;
        }

/*
	protected function prepareTable(&$table)
        {
        $table->nombre = htmlspecialchars_decode($table->nombre, ENT_QUOTES);
		$table->direccion = JApplication::stringURLSafe($table->direccion);
		
        }
*/	
	

}
