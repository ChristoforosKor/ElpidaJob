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
   // utils::authorsedForAgent($this->retTo, JText::_('COM_ELGERGASIA_NOT_AUTHORISED'));
    
    //utils::canUserEditData($this->retTo, $this->form->getValue('idUser'));
?>


<div class="translateableContent">
    <div class="content" >
        <div class="row" >
            <div class="form-group" >    
                <?php echo $this->form->getLabel('city') . $this->form->getInput('city') ?> 
            </div>

            <div class="form-group">
                <?php echo $this->form->getLabel('profession') . $this->form->getInput('profession'); ?>
            </div>
        </div>
        <div class="row" >
            <div class="form-group" >    
                <?php echo $this->form->getLabel('address') . $this->form->getInput('address') ?> 
            </div>
            <div class="form-group">
                    <?php echo $this->form->getLabel('discreteTitle') . $this->form->getInput('discreteTitle') ; ?>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="form-group">
                <?php echo $this->form->getLabel('information') . $this->form->getInput('information') ?>
            </div>
        </div>
    </div>
</div>

                