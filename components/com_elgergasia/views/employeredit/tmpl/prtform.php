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
<div class="elg">
    <form  method="post" action="index.php?option=com_elgergasia&controller=employersave&model=employersave&Itemid=<?php echo $this->state->get('Itemid'); ?>" id="adminForm">
        <?php 
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser'); 
            echo $this->form->getInput('language'); 
            echo JHtml::_('form.token');
         ?>
        <input type="hidden" name="controller" value="employersave" />
        <div class="form">
            <fieldset class="c3">
                <legend><?php echo JText::_('COM_ELGERGASIA_EMPLOYER_EDIT_LEGEND'); ?></legend>
                <div class="row">
                     <div class="form-group">
                        <?php echo $this->form->getLabel('name') . $this->form->getInput('name') ; ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->form->getLabel('idIndustry') . $this->form->getInput('idIndustry') ; ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->form->getLabel('phone') . $this->form->getInput('phone') ; ?>
                    </div>
                     <div class="form-group">
                        <?php echo $this->form->getLabel('fax') . $this->form->getInput('fax') ; ?>
                    </div>
                     <div class="form-group">
                        <?php echo $this->form->getLabel('email') . $this->form->getInput('email') ; ?>
                    </div>
                    
                   
                  
                     <div class="form-group">
                         <?php echo $this->form->getLabel('taxNumber') . $this->form->getInput('taxNumber') ; ?>
                    </div>
                </div>
                <div class="row" >
                   
                      <div class="form-group">
                         <?php echo $this->form->getLabel('idCountry') . $this->form->getInput('idCountry') ; ?>
                    </div>
                     <div class="form-group">
                        <?php echo $this->form->getLabel('website') . $this->form->getInput('website') ; ?>
                    </div>
                     <div class="form-group">
                         <?php echo $this->form->getLabel('mobile') . $this->form->getInput('mobile') ; ?>
                    </div>
                     
                     <div class="form-group">
                        <?php echo $this->form->getLabel('postalcode') . $this->form->getInput('postalcode') ; ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->form->getLabel('taxOffice') . $this->form->getInput('taxOffice') ; ?>
                    </div>
                   
                  
                   
                </div>
               
                
              
                
                 <div class="clearfix">&nbsp;</div>
                <?php require_once JPATH_COMPONENT_SITE . '/layouts/parteditlangbar.php'; ?>
                <?php include JPATH_COMPONENT_SITE . '/layouts/employeredit_translation.php' ?>
                <div class="clear-fix">&nbsp;</div>
                <div class="elg-column">
                    <div class="formelm">
                        <button class="btn btn-primary">
                            <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                        </button>
                    </div>
                </div>
                <div class="elg-column c2">
                    <div class="formelm returnTo" >
                            <a class="btn" href ="<?php echo $this->retTo ?>" ><?php echo JText::_('COM_ELGERGASIA_RETURN_TO_INFO_TAB') ?></a>
                    </div>
                </div>
            </fieldset>
        </div>
    </form>
</div>