		<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_TECNOMED_FIELDSET_LICENCIAS' ); ?></legend>
			<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('licencias') as $field): ?>
							<li><?php echo $field->label;echo $field->input;?></li>
			<?php endforeach; ?>
			</ul> 
		 </fieldset>