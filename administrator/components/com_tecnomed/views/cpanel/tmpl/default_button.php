<?php
/**
 * @package Joomla
 * @subpackage Tecnomed
 * @copyright (C) 2012 Alex Olave 
 * @license GNU/GPL, see LICENSE.php
 */
defined('_JEXEC') or die;
?>
<?php foreach ($this->buttons as $button){ ?>
<div class="icon-wrapper">
        <div class="icon">
                <a href="<?php echo $button['link']; ?>">
                        <?php echo JHTML::_('image', 'administrator/components/com_tecnomed/assets/images/'.$button['image'], ""); ?>
                        <span><?php echo $button['text']; ?></span></a>
        </div>
</div>
<?php } ?>
