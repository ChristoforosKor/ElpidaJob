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
    utils::canUserEditData($this->retTo, $this->form->getValue('idUser'));
?>
<div class="elg">
    <?php require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php'; ?>
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CHARACTERISTICS_DATA'); ?></h3>
    <form name="employeeform" method="post" >   
          <input type="hidden" name="controller" value="candidatecharacteristicssave" action="<?php echo JRoute::_('index.php&controller=candidatecharacteristicsave'); ?>" />
           
        <?php 
            echo JHtml::_('form.token');
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser'); 
            echo $this->form->getInput('language');
        ?> 
        <div class="candidate">
            <fieldset>
                <div class="yjsg-col-1-2" >
                    <div>    
                        <?php echo $this->form->getLabel('idGender') . $this->form->getInput('idGender') ?> 
                    </div>
                    <div>    
                        <?php echo $this->form->getLabel('dateOfBirth') . $this->form->getInput('dateOfBirth') ?> 
                    </div>
                    <div>    
                        <?php echo $this->form->getLabel('idNationality') . $this->form->getInput('idNationality') ?> 
                    </div>                 
                </div>
                <div class="yjsg-col-1-2" >
                    <div>    
                        <?php echo $this->form->getLabel('smoking') . $this->form->getInput('smoking') ?> 
                    </div>
                    <div>    
                        <?php echo $this->form->getLabel('idDriverLicence') . $this->form->getInput('idDriverLicence') ?> 
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php include JPATH_COMPONENT_SITE . '/layouts/parteditlangbar.php'; ?>
                <?php include 'candidatecharacteristicsedit_translation.php' ?>
                <div class="clearfix"></div>
                <br />
                    <button class="btn btn-primary">
                        <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT'); ?>
                    </button>
                    <a class="btn btn-default" href="<?php echo $this->retTo ?>" ><?php echo JText::_('COM_ELGERGASIA_RETURN_TO_INFO_TAB') ?></a>
               
            </fieldset>
        </div>
    </form>
</div>