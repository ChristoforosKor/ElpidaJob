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
<div class="elg" >
    <h2><?php echo JText::_('COM_ELGERGASIA_PAYMENT'); ?></h2>
    <div class="form">
        <form name="paymentform" method="post" >   
            <fieldset class="c2" >
                <?php echo JHtml::_('form.token') . $this->form->getInput('id') . $this->form->getInput('idUser'); ?>
                
                    <div class="formelm">
                        <?php echo $this->form->getLabel('payDate') .'<br />' . $this->form->getInput('payDate');  ?>
                    </div>
                    <div class="formelm">
                        <?php echo $this->form->getLabel('payment') .'<br />' . $this->form->getInput('payment');  ?>
                    </div>
                
                <diV class="clearfix">&nbsp;</div>
                             
                <div class="formelm">
                    <button class="btn btn-primary">
                        <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ?>
                    </button>
                </div>
                <input type="hidden" name="controller" value="paymenteditsave" />
            </fieldset>            
        </form>
    </div>
</div>    
