		<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_TECNOMED_FIELDSET_RECETAS' ); ?></legend>
			<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('recetas') as $field): ?>
							<li><?php echo $field->label;echo $field->input;?></li>
			<?php endforeach; ?>
			</ul> 
		 </fieldset>