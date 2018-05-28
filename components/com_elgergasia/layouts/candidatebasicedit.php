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
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_BASIC_DATA'); ?></h3>
   
    <form name="employeeform" method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&model=candidatebasicsave&controller=candidatebasicsave', false) ; ?>" >   
        
        <?php 
            echo JHtml::_('form.token');
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser'); 
            echo $this->form->getInput('language');
        ?> 
        <div class="form">
            
            <fieldset>
                <div class="yjsg-col-1-2" >
                    <div>    
                        <?php echo $this->form->getLabel('idState') . $this->form->getInput('idState') ?> 
                    </div>
                    <div>    
                        <?php 
                            echo $this->form->getLabel('idCountry') . $this->form->getInput('idCountry') ?> 
                    </div>
                    <div>    
                        <?php echo $this->form->getLabel('mobile') . $this->form->getInput('mobile') ?> 
                    </div>
                </div>
                <div class="yjsg-col-1-3" >
                    <div>    
                        <?php echo $this->form->getLabel('postalCode') . $this->form->getInput('postalCode') ?> 
                    </div>
                    <div>    
                        <?php echo $this->form->getLabel('phone') . $this->form->getInput('phone') ?> 
                    </div>
                   
                    <div>    
                        <?php echo $this->form->getLabel('fax') . $this->form->getInput('fax') ?> 
                    </div>
                   
                </div>
                 <div class="clearfix">&nbsp;</div>
                <div class="yjsg-row">
                    
                    <div class="yjsg-col-1-12">
                        <?php echo $this->form->getInput('showPhoto') . $this->form->getLabel('showPhoto') ?> 
                        <br />
                        <?php echo $this->form->getInput('useMyData') . $this->form->getLabel('useMyData') ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <?php require_once 'parteditlangbar.php'; ?>
                <?php include 'candidatebasicedit_translation.php' ?>
                <div class="clearfix">&nbsp;</div>
                <div>
                    <button class="btn btn-primary">
                            <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                    </button>
                    <a class="btn btn-default" href="<?php echo $this->retTo ?>" ><?php echo JText::_('COM_ELGERGASIA_RETURN_TO_INFO_TAB') ?></a>
                </div>
            </fieldset>
        </div>
    </form>
</div>