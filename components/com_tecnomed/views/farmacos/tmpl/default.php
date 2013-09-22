<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined('_JEXEC') or die('Restricted access');
$user   = JFactory::getUser();
//$listOrder      = $this->state->get('list.ordering');
//$listDirn       = $this->state->get('list.direction');
//$canOrder       = $user->authorise('core.edit.state', 'com_tecnomed.farmaco');
//$saveOrder      = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_tecnomed&view=farmacos'); ?>" method="post" name="adminForm">
	<fieldset id="filter-bar">
		<div>
                        <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
                        <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" title="<?php echo JText::_('COM_TECNOMED_SEARCH_IN_NAME'); ?>" />
                        <button type="submit" class="button"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
                        <button type="button" class="button"onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
       </div>
    </fieldset>
        <div class="clr"> </div>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th width="1%">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="10%">
                                <?php echo JText::_('JFIELD_CODIGO_LABEL');?>
			</th>
			<th width="20%">
                        	<?php echo JText::_('JFIELD_NOMBRE_LABEL'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_DOSIS_LABEL'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_CONTENIDO_LABEL'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_PRESENTACION_LABEL'); ?>
            </th>
            <th width="30%">
                        	<?php echo JText::_('JFIELD_LABORATORIO_LABEL'); ?>
            </th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($this->items as $i => $item) :	
		$canCreate      = $user->authorise('core.create','com_tecnomed.farmaco.'.$item->id);
        $link 		= JRoute::_( 'index.php?option=com_tecnomed&task=farmaco.edit&id='. $item->id );
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				<?php echo $item->id; ?>
			</td>
			<td>
                <?php echo $this->escape($item->codigo); ?>
					
           </td>
			<td>
                <a href="<?php echo $link;?>">
                <?php echo $this->escape($item->nombre); ?></a>
           </td>
            <td>
                <?php echo $this->escape($item->dosis); ?>
					
           </td>
           <td>
                <?php echo $this->escape($item->contenido); ?>
					
           </td>
           <td>
                <?php echo $this->escape($item->precentacion); ?>
					
           </td>
           <td>
                <?php echo $this->escape($item->laboratorio); ?>
					
           </td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="clr"></div>
	<table> 
    	<tr class= "pagination" >
    		<td><?php echo $this->pagination->getListFooter(); ?></td>
    	</tr>
    </table>	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
   <?php echo JHtml::_('form.token'); ?>
</form>
<div class="clr"></div>
<p><?php echo JHTML::_('credit.credit');?></p>
