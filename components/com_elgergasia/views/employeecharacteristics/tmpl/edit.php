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
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CHARACTERISTICS_DATA'); ?></h3>
    <form name="employeeform" method="post" >   
        <?php echo $this->form->getInput('id')  ;
         echo $this->form->getInput('idUser'); ?> 
        <div class="elg-head-left" >
            <div class="elg-column" >
                <div class="elg-form-row" >    
                    <?php 
                        echo $this->form->getLabel('idGender') ?> 
                    <br />
                    <?php echo $this->form->getInput('idGender') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('dateOfBirth') ?> 
                    <br />
                    <?php echo $this->form->getInput('dateOfBirth') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('idNationality') ?> 
                    <br />
                    <?php echo $this->form->getInput('idNationality') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('idMilitaryStatus') ?> 
                    <br />
                    <?php echo $this->form->getInput('idMilitaryStatus') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('idPetFriend') ?> 
                    <br />
                    <?php echo $this->form->getInput('idPetFriend') ?> 
                </div>
            </div>
            <div class="elg-column" >
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('idMaritalStatus') ?> 
                    <br />
                    <?php echo $this->form->getInput('idMaritalStatus') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('childrenNum') ?> 
                    <br />
                    <?php echo $this->form->getInput('childrenNum') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('idReligion') ?> 
                    <br />
                    <?php echo $this->form->getInput('idReligion') ?> 
                </div>
                <div class="elg-form-row" >    
                    <?php echo $this->form->getLabel('smoking') ?> 
                    <br />
                    <?php echo $this->form->getInput('smoking') ?> 
                </div>
            </div>
             <div style="clear:left">&nbsp;</div>
            <div class="elg-column" >
                <?php echo $this->form->getLabel('aboutMe') ?> 
                <br />
                <?php echo $this->form->getInput('aboutMe') ?> 
            </div>
            <div style="clear:left">&nbsp;</div>
            <div class="elg-column">
                 <button>
                     <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                 </button>
            </div>
            <div style="clear:left">&nbsp;</div>

        </div>
        <input type="hidden" name="controller" value="employeecharacteristicssave" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
