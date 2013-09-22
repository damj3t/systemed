<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
*/
defined('_JEXEC') or die('Restricted access');
$user   = JFactory::getUser();
JHTML::_('behavior.calendar');
jimport( 'joomla.html.html' );

//$pane1 =& JPane::getInstance('tabs');

//$listOrder      = $this->state->get('list.ordering');
//$listDirn       = $this->state->get('list.direction');
//$canOrder       = $user->authorise('core.edit.state', 'com_tecnomed.calendario');
//$saveOrder      = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_tecnomed&view=calendarios'); ?>" method="post" name="adminForm">
	<fieldset id="filter-bar">
	<div> 	
        <label class="filter-search-lbl" for="filter_profesional_id"><?php echo JText::_('JSEARCH_FILTER_PROFESIONAL'); ?></label>
		<select name="filter_profesional_id" class="inputbox" onchange="this.form.submit()">
			<option value=""><?php echo JText::_('JOPTION_SELECT_PROFESIONAL');?></option>
			<?php echo JHtml::_('select.options', $this->Profesionals, 'value', 'text', $this->state->get('filter.profesional_id'));?>
		</select>
	<?php /*
         <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
         <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" title="<?php echo JText::_('COM_TECNOMED_SEARCH_IN_NAME_MEDICO'); ?>" />
    */?>    
        <label for="filter_from" id="filter_from_label"><?php echo JText::_('JSEARCH_FILTER_FECHA'); ?>: </label>
        <?php echo  JHtml::_('calendar',  $this->state->get('filter.fecha'), 'filter_fecha', 'filter_fecha', "%Y-%m-%d", array('size'=>'12','maxlength'=>'10')); ?>
		
		<button type="submit"class="button" ><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
        <button type="button" class="button" class="button" onclick="document.id('filter_fecha').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
	</div>		       

    </fieldset>
     <div class="clr"> </div>
    <div class="width-40 fltlft">    
	<?php 
	foreach ($this->items as $i => $Agenda) :	
	$fecha_agenda = $Agenda->fecha_reserva;
	endforeach;  ?>
			
   	<table class="table table-bordered">
		<thead>
			<tr>
	            <th width="10%">
	                   	<?php echo JText::_('Fecha Reserva:'); ?>
	            </th>
	            <th width="5%">
	                   	<?php echo $fecha_agenda; ?>
	            </th>
			</tr>
		</thead>
	</table>
	
	
	<table class="table table-bordered">
	<thead>
		<tr>
            <th width="10%">
                        	<?php echo JText::_('JFIELD_HORA_LABEL'); ?>
            </th>
			<th width="5%">
                        	<?php  echo JText::_('Reservar'); ?>
            </th>
		</tr>
	</thead>
	<?php
		
	foreach ($this->items as $i => $item) :	
		$canCreate      = $user->authorise('core.create', 'com_tecnomed.calendario.'.$item->id);
        $link 		= JRoute::_( 'index.php?option=com_tecnomed&task=calendario.edit&id='. $item->id );
		$imgTicket = 'tecnomed-ticket-22.png';
        $imgReserva = 'tecnomed-cancel-22.png';
		
        //if ((int)$item->profesional_id == (int)$profesional->value){
        ?>

		<tbody>   
		<tr class="row<?php echo $i % 2; ?>">
			<td>
                <?php echo $this->escape($item->hora); ?>				
           </td>
		   <td>
		   <?php if ($item->estado==1) { 
		    ?> <a href="<?php echo $link;?>">
		    <?php echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$imgTicket, "");             
		   ?></a> <?php }
		   else{
             echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$imgReserva, ""); 
            }    // echo $this->escape($item->paciente); ?>
           </td>
		  
		</tr>
		</tbody>
		<?php
          // }
		 endforeach; 
		
		?>
		
	</table>
	
	<?php /*
	 echo $this->tabs->endPanel(); 
	 endforeach; 
	 echo $this->tabs->endPane(); 
	*/
	?>	
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
<p><?php echo JHTML::_('credit.credit');?></p>