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


    <h2><?php echo '(' . $this->employee->id . ') ' . $this->employee->name ?></h2>
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_BASIC_DATA'); ?></h3>
    <form name="employeeform" method="post" >   
        <?php echo $this->form->getInput('id')  ;
         echo $this->form->getInput('idUser'); ?> 
        <div class="elg-head-left" >
            <div class="elg-column" >
                <div class="elg-form-row" >    
                    <?php 
                        echo $this->form->getLabel('idCountry') ?> 
                    <br />
                    <?php echo $this->form->getInput('idCountry') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('city') ?> 
                    <br />
                    <?php echo $this->form->getInput('city') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('address') ?> 
                    <br />
                    <?php echo $this->form->getInput('address') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('postalCode') ?> 
                    <br />
                    <?php echo $this->form->getInput('postalCode') ?> 
                </div>
            </div>
            <div class="elg-column" >
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('phone') ?> 
                    <br />
                    <?php echo $this->form->getInput('phone') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('mobile') ?> 
                    <br />
                    <?php echo $this->form->getInput('mobile'
                            ) ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('fax') ?> 
                    <br />
                    <?php echo $this->form->getInput('fax') ?> 
                </div>

            </div>
            <div style="clear:left">&nbsp;</div>
            <div class="elg-column">
                 <button>
                     <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                 </button>
            </div>
            <div style="clear:left">&nbsp;</div>

        </div>
        <input type="hidden" name="controller" value="employeebasicsave" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
