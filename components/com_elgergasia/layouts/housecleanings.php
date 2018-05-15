<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

    defined('_JEXEC') or die('Restricted access');
    $lEdit = JText::_('COM_ELGERGASIA_EDIT')
?>

<div class="elg cleaning">
    <h3><?php echo JText::_('COM_ELGERGASIA_HOUSE_CLEANINGS'); ?></h3>
    <ul>
        <?php foreach($this->houseCleanings as $houseCleaning): ?>
        <li><?php echo $houseCleaning['area_description']; ?>><br /><a href="<?php echo str_replace('#id', $houseCleaning['id'], $this->editUrl); ?>" ><?php echo $lEdit; ?></a></li>
        <?php 
            endforeach;
            unset($houseCleaning);
        ?>        
    </ul>   
</div>

 