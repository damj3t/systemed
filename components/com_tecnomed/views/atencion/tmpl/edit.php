<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

$pane1 =& JPane::getInstance('tabs');
?>
<script language="javascript" type="text/javascript">
	function submitbutton(task)
        {
                if (task == 'atencion.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
                        submitform(task);
                } else {
                        alert( "<?php echo JText::_( 'JGLOBAL_VALIDATION_FORM_FAILED' ); ?>" );
                }
        }
</script>

<form action="<?php JRoute::_('index.php?option=com_tecnomed'); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
		
    <?php 
        echo $this->tabs->startPane('tabone');
 		echo $this->tabs->startPanel(JText::_('Atenciones'), 'main');
	?>		      <div class="width-100">
					<fieldset class="adminform">
						<legend><?php echo JText::_( 'COM_TECNOMED_FIELDSET_ATENCION' ); ?></legend>
						<ul class="adminformlist">
						<?php foreach($this->form->getFieldset('atencion') as $field): ?>
										<li><?php echo $field->label;echo $field->input;?></li>
						<?php endforeach; ?>
						</ul> 
					 </fieldset>
					</div>
	
		<?php echo $this->tabs->endPanel(); ?>
		<?php echo $this->tabs->startPanel( JTEXT::_('Licencias'), 'nom_cp_licencias' ); ?>
					<div class="width-100">
						<?php echo $this->loadTemplate('licencia'); ?>
					</div>
		<?php  echo $this->tabs->endPanel(); ?>
		<?php  echo $this->tabs->startPanel( JTEXT::_('Signos'), 'nom_cp_signos' ); ?>
		<table class="adminlist">
			<tr>
				<td>	
					<?php echo JHTML::_('image', 'components/com_tecnomed/assets/images/body-blank.png', ""); ?>
					
				</td>
				<td>
					<?php echo $this->loadTemplate('signos'); ?>
				</td>
			</tr>		
		</table>
     	<?php echo $this->tabs->endPanel(); ?>
		<?php echo $this->tabs->startPanel( JTEXT::_('Recetas'), 'nom_cp_recetas' ); ?>
    		
					<div class="width-100"> 
						<?php echo $this->loadTemplate('receta'); ?>
					</div>
	<?php echo $this->tabs->endPanel(); ?>
	<?php echo $this->tabs->endPane(); ?>					


		  <input type="hidden" name="option" value="com_tecnomed" />
	      <input type="hidden" name="task" value="atencion.save" />
	      <button type="submit" class="button"><?php echo JText::_('Guardar'); ?></button>         
	       <?php echo JHtml::_('form.token'); ?>
      
</form>
<div class="clr"></div>
<p><?php echo JHTML::_('credit.credit');?></p>

