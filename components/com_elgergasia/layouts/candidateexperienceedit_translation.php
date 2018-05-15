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
    
?>
<div class="translateableContent">
    <div class="content">
        <div class="elg-column all-wide">
            <?php echo $this->form->getLabel('employerTitle') . $this->form->getInput('employerTitle') ?> 
        </div>
        <div class="clearfix"></div>

        <div class="formelm" >
            <?php echo $this->form->getLabel('jobDescription') . $this->form->getInput('jobDescription') ?> 
        </div>
    </div>
</div>           
                

                