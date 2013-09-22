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
//$canOrder       = $user->authorise('core.edit.state', 'com_tecnomed.caja');
//$saveOrder      = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_tecnomed&view=cajas'); ?>" method="post" name="adminForm">
	<fieldset id="filter-bar">
		<div>
        <label class="filter-search-lbl" for="filter_profesional_id"><?php echo JText::_('JSEARCH_FILTER_PROFESIONAL'); ?></label>
		<select name="filter_profesional_id" class="inputbox" onchange="this.form.submit()">
			<option value=""><?php echo JText::_('JOPTION_SELECT_PROFESIONAL');?></option>
			<?php echo JHtml::_('select.options', $this->Profesionals, 'value', 'text', $this->state->get('filter.profesional_id'));?>
		</select>
        
        <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_PACIENTE'); ?></label>
        <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" title="<?php echo JText::_('COM_TECNOMED_SEARCH_IN_NAME'); ?>" />
        <button type="submit" class="button" ><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
        <button type="button" class="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
       </div>
    </fieldset>
        <div class="clr"> </div>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th width="1%">
				<?php echo JText::_( 'ID' ); ?>
			</th>
		
			<th width="20%">
                                <?php echo JText::_('JFIELD_NOMBRE_PROFESIONAL');?>
			</th>
			<th width="20%">
                        	<?php echo JText::_('JFIELD_PACIENTE'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_FECHA_ATENCION'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_MONTO'); ?>
            </th>
			<th width="10%">
                        	<?php echo JText::_('JFIELD_ESTADO'); ?>
            </th>
            <th width="5%">
                        	<?php echo JText::_('JFIELD_BOLETA'); ?>
            </th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($this->items as $i => $item) :	
		$canCreate      = $user->authorise('core.create', 'com_tecnomed.caja.'.$item->id);
        $link 		= JRoute::_( 'index.php?option=com_tecnomed&task=caja.edit&id='. $item->id );
		$linkPrint 	= JRoute::_( 'index.php?option=com_tecnomed&view=pdfboleta&id='. $item->id );
		
		$imgprint = 'tecnomed-imprimir-32.png';
        ?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				<?php echo $item->id; ?>
			</td>
			<td>
                <?php echo $this->escape($item->profesional); ?>
            </td>
            <td>
                <?php echo $this->escape($item->paciente); ?>				
           </td>
		   <td>
                <?php echo $this->escape($item->atencion); ?>				
           </td>
		
		   <td>
                <?php echo $this->escape($item->monto); ?>
           </td>
		   <td>
                <?php if (($this->escape($item->state))==1){
                ?>
                  <a href="<?php echo $link;?>"><button class="btn btn-warning" type="button">Pendiente</button></a>
                 <?php }else{ ?>
                <button class="btn btn-success" type="button">Pagada</button>
                <?php } ?>
           </td>
           <td>
                <?php if (($this->escape($item->state))> 1) {?>
                <a href="<?php echo $linkPrint;?>">
           			<?php echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$imgprint, ""); ?>
           		</a>
           		 <?php  }?>	
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
