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
    <?php require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php'; ?>
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE'); ?></h3>
    <form name="employeeform" method="post" >   
        <?php echo $this->form->getInput('id')  ;
         echo $this->form->getInput('idUser'); ?> 
        <div class="elg-head-left" >
            <div class="elg-column" >
                <?php echo $this->form->getLabel('employerTitle') ?> 
                <br />
                <?php echo $this->form->getInput('employerTitle') ?> 
                <div style="clear:left">&nbsp;</div>
                
                    <div class="elg-column" >
                        <?php 
                            echo $this->form->getLabel('idIndustry') ?> 
                        <br />
                        <?php echo $this->form->getInput('idIndustry') ?> 
                    </div>
                    <div class="elg-column" >
                        <?php echo $this->form->getLabel('idSpecialization') ?> 
                        <br />
                        <?php echo $this->form->getInput('idSpecialization') ?> 
                    </div>
                
                        <div style="clear:left">&nbsp;</div>
                
                       
                        <span><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_OCCUPATION_DURATION')?></span>
                        <br /><br />
                        <span><?php echo JText::_('COM_ELGERGASIA_FROM')?></span>
                        <br />
                        <div class="elg-column" >    
                            <?php echo $this->form->getLabel('monthFrom') ?> 
                            <br />
                            <?php echo $this->form->getInput('monthFrom') ?> 
                        </div>
                        <div class="elg-column" >    
                            <?php echo $this->form->getLabel('yearFrom') ?> 
                            <br />
                            <?php echo $this->form->getInput('yearFrom') ?> 
                        </div>
                        <div style="clear:left">&nbsp;</div>
                        <span><?php echo JText::_('COM_ELGERGASIA_TO')?></span>
                        <br />
                        <div class="elg-column" >    
                            <?php echo $this->form->getLabel('monthTo') ?> 
                            <br />
                            <?php echo $this->form->getInput('monthTo') ?> 
                        </div>
                        <div class="elg-column" >    
                            <?php echo $this->form->getLabel('yearTo') ?> 
                            <br />
                            <?php echo $this->form->getInput('yearTo') ?> 
                        </div>
                       
                
                <div style="clear:left">&nbsp;</div>
                <div class="elg-columns" >  
                    <?php echo $this->form->getLabel('jobDescription') ?> 
                    <br />
                    <?php echo $this->form->getInput('jobDescription') ?> 
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
        <input type="hidden" name="controller" value="employeeexperiencessave" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
