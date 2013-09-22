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
//$canOrder       = $user->authorise('core.edit.state', 'com_tecnomed.atencion');
//$saveOrder      = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_tecnomed&view=atenciones'); ?>" method="post" name="adminForm">
	<fieldset id="filter-bar">
		<div >
                        <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
                        <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" title="<?php echo JText::_('COM_TECNOMED_SEARCH_IN_NAME'); ?>" />
                        <button type="submit" class="button"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
                        <button type="button" class="button"  onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
       </div>
    </fieldset>
        <div class="clr"> </div>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th width="1%">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="2%">
				<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />	
			</th>			
			<th width="15%">
                                <?php echo JText::_('JFIELD_PACIENTE_LABEL');?>
			</th>
			<th width="10%">
                        	<?php echo JText::_('JFIELD_DIAGNOSTICO_LABEL'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_FARMACO_LABEL'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_ATENDER_LABEL'); ?>
            </th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($this->items as $i => $item) :	
		$canCreate      = $user->authorise('core.create','com_tecnomed.atencion.'.$item->id);
        $link 		= JRoute::_( 'index.php?option=com_tecnomed&task=atencion.edit&id='. $item->id );
		$linkPac 	= JRoute::_( 'index.php?option=com_tecnomed&task=calendario.edit&id='. $item->reservaid );
		
        $imgFarm = 'tecnomed-farmacia-22.png';
        $imgAten = 'tecnomed-atender-32.png';
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				 <?php echo $item->id; ?>
			</td>
			<td>
				<?php echo JHtml::_('grid.id', $i, $item->id); ?>
			</td>
			<td>
                
                <a href="<?php echo $linkPac;?>"><?php echo $this->escape($item->paciente); ?></a>
            </td>
            <td>
           		<a href="<?php echo $link;?>">
           			<?php echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$imgFarm, ""); ?>
           		</a>	Agregar Diagnosticos		
            </td>
            <td>
           		<a href="<?php echo $link;?>">
           			<?php echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$imgFarm, ""); ?>
           		</a>	Agregar farmcos			
            </td>
            <td>
                <a href="<?php echo $link;?>">
           			<?php echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$imgAten, ""); ?>
           		</a> Atender	
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
