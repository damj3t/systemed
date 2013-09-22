<?php

// no direct access
defined('_JEXEC') or die;

// Component Helper
jimport('joomla.application.component.helper');
jimport('joomla.application.categories');
JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

abstract class TecnomedHelperRoute
{
	protected static $lookup;
	/**
	 * @param	int	The route of the newsfeed
	 */
	public static function getTecnomedRoute($id, $catid)
	{
		$needles = array(
			'tecnomed'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_tecnomed&view=farmaco&id='. $id;
		
		return $link;
	}

	public static function getCategoryRoute($catid)
	{
		if ($catid instanceof JCategoryNode){
                        $id = $catid->id;
                        $category = $catid;
                }else{
                        $id = (int) $catid;
                        $category = JCategories::getInstance('Tecnomed')->get($id);
                }

                if($id < 1){
			$needles = array(
                                'categories' => array($id)
                        );
			if ($item = self::_findItem($needles)) {
                                $link = 'index.php?Itemid='.$item;
                        } else {
                        	$link = 'index.php?option=com_tecnomed&view=farmacos&id=0';
			}
                }else{
                            $link = 'index.php?option=com_tecnomed&view=farmacos&id=0';
                                
                     }
                }
                return $link;
	}



	protected static function _findItem($needles=null)
	{
//error_log(print_r($needles, true), 3, 'debug.log');
		$app    = JFactory::getApplication();
                $menus  = $app->getMenu('site');
                // Prepare the reverse lookup array.
                if (self::$lookup === null){
                        self::$lookup = array();
                        $component      = JComponentHelper::getComponent('com_tecnomed');
                        $items          = $menus->getItems('component_id', $component->id);
                        foreach ($items as $item){
                                if (isset($item->query) && isset($item->query['view'])){
                                        $view = $item->query['view'];
                                        if (!isset(self::$lookup[$view])) {
                                                self::$lookup[$view] = array();
                                        }
                                        if (isset($item->query['id'])) {
                                                self::$lookup[$view][$item->query['id']] = $item->id;
                                        }
                                }
                        }
                }

                if ($needles){
                        foreach ($needles as $view => $ids){
                                if (isset(self::$lookup[$view])){
                                        foreach($ids as $id){
                                                if (isset(self::$lookup[$view][(int)$id])) {
                                                        return self::$lookup[$view][(int)$id];
                                                }
                                        }
                                }
                        }
                } else {
                        $active = $menus->getActive();
                        if ($active && $active->component == 'com_tecnomed') {
                                return $active->id;
                        }
                }

                return null;
	}
}
