<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined('_JEXEC') or die('Restricted access');
$user   = JFactory::getUser();
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

<form action="<?php echo JRoute::_('index.php?option=com_tecnomed&view=atencionesmedicas'); ?>" method="post" name="adminForm">
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
				<?php echo JText::_( 'hora' ); ?>
			</th>
			<th width="30%">
                                <?php echo JText::_('JFIELD_PACIENTE_LABEL');?>
			</th>
            <th width="20%">
                        	<?php echo JText::_('JFIELD_ISAPRE_LABEL'); ?>
            </th>
            <th width="20%">
                        	<?php  echo JText::_('JFIELD_TIPO_VISITA_LABEL'); ?>
            </th>
              <th width="10%">
                        	<?php echo JText::_('JFIELD_ESTADO_LABEL'); ?>
            </th>
             <th width="5%">
                        	<?php echo JText::_('JFIELD_ANULAR_LABEL'); ?>
            </th>
             <th width="20%">
                        	<?php echo JText::_('JFIELD_LLAMAR_LABEL'); ?>
            </th>
             <th width="20%">
                        	<?php echo JText::_('JFIELD_EMAIL_LABEL'); ?>
            </th>
             <th width="10%">
                        	<?php echo JText::_('JFIELD_ATENDER_LABEL'); ?>
            </th>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_IMPRIMIR_LABEL'); ?>
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
		//$linkPrint 	= JRoute::_( 'index.php?option=com_tecnomed&view=print&id='. $item->id );
		$linkAnulacion 	= JRoute::_( 'index.php?option=com_tecnomed&task=atencionesmedicas.publish&id='. $item->reservaid );
		$linkPrint 	= JRoute::_( 'index.php?option=com_tecnomed&view=pdf&id='. $item->id );
        $imgFarm = 'tecnomed-farmacia-22.png';
        $imgAten = 'tecnomed-atender.png';
        $imgprint = 'tecnomed-imprimir-32.png';
        $imgcancel = 'tecnomed-cancel-22.png';
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				 <?php echo $item->hora; ?>
			</td>
			<td>
                <?php echo $this->escape($item->paciente); ?>
            </td>
            <td>
           		<span class="label label-info"><?php echo $this->escape($item->isapre); ?></span>
            </td>
            <td>
           		<span class="label label-info"><?php echo $this->escape($item->tipo_atencion); ?></span>
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
            <?php if (($this->escape($item->estado))== 1) {?>
                <a href="<?php echo $linkAnulacion;?>">
           			<?php echo JHTML::_('image', 'components/com_tecnomed/assets/images/'.$imgcancel, ""); ?>
           		</a>	
             <?php }?>	
            </td>
            <td>
           		 <?php echo $this->escape($item->telefono); ?>
            </td>
             <td>
	 			 <?php echo $this->escape($item->email); ?>
            </td>
            <td>
           		<?php if (($this->escape($item->estado))== 1) {?>
           		<a href="<?php echo $link;?>">
           			<?php echo JHTML::_('image', 'components/com_tecnomed/assets/images/'.$imgAten, ""); ?>
           		</a>	
           		<?php }?>	
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
