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
if ($this->SinAcceso==1)
{
?>

<div class="alert alert-block">
  <h4>Precaucion!</h4>
  Ud. <?php echo JText::_('TECNMED_ALERT_DESC');?>
</div>
<?php 	
	
}else {
?>
<form action="<?php echo JRoute::_('index.php?option=com_tecnomed&view=atencionespacientes'); ?>" method="post" name="adminForm">
	<fieldset id="filter-bar">
		<div >
                        <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
                        <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" title="<?php echo JText::_('COM_TECNOMED_SEARCH_IN_NAME'); ?>" />
                        <button type="submit" class="button"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
                        <button type="button" class="button"  onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
       </div>
    </fieldset>
        <div class="clr"> </div>
	<div>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th width="1%">
				<?php echo JText::_( 'ID' ); ?>
			</th>
	
			<th width="25%">
                                <?php echo JText::_('JFIELD_PACIENTE_LABEL');?>
			</th>
            <th width="20%">
                        	<?php echo JText::_('JFIELD_FECHA_LABEL'); ?>
            </th>
            <th width="25%">
                        	<?php echo JText::_('JFIELD_MEDICO_LABEL'); ?>
            </th>
            <th width="5%">
                        	<?php //echo JText::_('JFIELD_IMPRIMIR_LABEL'); ?>
            </th>
            <th width="5%">
                        	<?php //echo JText::_('JFIELD_IMPRIMIR_LABEL'); ?>
            </th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($this->items as $i => $item) :	
		$canCreate      = $user->authorise('core.create','com_tecnomed.atencion.'.$item->id);
        $link 		= JRoute::_( 'index.php?option=com_tecnomed&task=atencion.edit&id='. $item->id );
		$linkPac 	= JRoute::_( 'index.php?option=com_tecnomed&task=calendario.edit&id='. $item->reservaid );
		$linkrec 	= JRoute::_( 'index.php?option=com_tecnomed&view=recetas&id='. $item->id );
		$linkPrint 	= JRoute::_( 'index.php?option=com_tecnomed&view=pdf&id='. $item->id );
		
        $imgFarm = 'tecnomed-farmacia-22.png';
        $imgAten = 'tecnomed-atender-32.png';
        $imgprint = 'tecnomed-imprimir-32.png';
        $imgReceta = 'tecnomed-recetas-32.png';
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				 <?php echo $item->id; ?>
			</td>
			<td>              
                <?php echo $this->escape($item->paciente); ?>
            </td>
            <td>
           			<?php echo $this->escape($item->fecha_atencion); ?>	
            </td>
            <td>
                <?php echo $this->escape($item->medico); ?>	
            </td>
             <td>
           		<?php if (($this->escape($item->estado))== 1) {?>
           		<span class="label label">
                <?php }elseif (($this->escape($item->estado))== 2) {?>
                <span class="label label-Success">
                <?php }elseif (($this->escape($item->estado))== 3) {?>
                <span class="label label-warning">
                <?php }?>
            	<?php echo $this->escape($item->estado_atencion); ?></span>
            
            </td>
             <td>
                <?php if (($this->escape($item->estado))== 2) {?>
                <a href="<?php echo $linkPrint;?>">
           			<?php echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$imgprint, ""); ?>
           		</a>
           		 <?php  }?>	
            </td>
         </tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
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
<?php }?>
<p><?php echo JHTML::_('credit.credit');?></p>
