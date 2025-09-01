<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 -2033 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
    defined('_JEXEC') or die('Restricted access');
    
 
?>
<div class="translateableContent">
    <div class="content">
        <div class="formelm">
            <?php echo $this->form->getLabel('jobTitle') . '<br />' . $this->form->getInput('jobTitle'); ?>
        </div>
        <div class="formelm">
            <?php echo $this->form->getLabel('jobDescription') . '<br />' . $this->form->getInput('jobDescription'); ?>
        </div>
        <?php /**
        <div class="formelm">
            <?php echo $this->form->getLabel('jobComment') . '<br />' . $this->form->getInput('jobComment'); ?>
        </div>
         * 
         */ ?>
    </div>
</div>