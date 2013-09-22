		<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_TECNOMED_FIELDSET_SIGNOS' ); ?></legend>
			<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('signos') as $field): ?>
							<li><?php echo $field->label;echo $field->input;?></li>
			<?php endforeach; ?>
			</ul> 
		 </fieldset>