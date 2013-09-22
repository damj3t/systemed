<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
*/
defined('_JEXEC') or die;
?>
<div id="cpanel">
<?php //foreach ($this->buttons as $button){ 
for ($x=0, $m=count( $this->Grupos ); $x < $m; $x++)
{
	$Cargo = &$this->Grupos[$x];
	
	if($Cargo->grupo=='Medico' ){
			for ($i=0, $n=count( $this->Medico ); $i < $n; $i++)
			{
			
				$button = &$this->Medico[$i];
				?>
			<div class="icon-wrapper">
			        <div class="icon">
			                <a href="<?php echo $button->link; ?>">
			                        <?php echo JHTML::_('image', 'components/com_tecnomed/assets/images/'.$button->imagen, ""); ?>
			                        <span><?php echo JText::_( $button->texto); ?></span></a>
			        </div>
			</div>
			<?php }
	}
	elseif ($Cargo->grupo=='Secretaria' ){
			for ($i=0, $n=count( $this->Secretaria ); $i < $n; $i++)
			{
			
				$button = &$this->Secretaria[$i];
				?>
			<div class="icon-wrapper">
			        <div class="icon">
			                <a href="<?php echo $button->link; ?>">
			                        <?php echo JHTML::_('image', 'components/com_tecnomed/assets/images/'.$button->imagen, ""); ?>
			                        <span><?php echo JText::_( $button->texto); ?></span></a>
			        </div>
			</div>
			<?php }
	}	
	else{
			for ($i=0, $n=count( $this->buttons ); $i < $n; $i++)
			{
			
				$button = &$this->buttons[$i];
				?>
			<div class="icon-wrapper">
			        <div class="icon">
			                <a href="<?php echo $button->link; ?>">
			                        <?php echo JHTML::_('image', 'components/com_tecnomed/assets/images/'.$button->imagen, ""); ?>
			                        <span><?php echo JText::_( $button->texto); ?></span></a>
			        </div>
			</div>
			<?php }
	}		
}
?>
</div>