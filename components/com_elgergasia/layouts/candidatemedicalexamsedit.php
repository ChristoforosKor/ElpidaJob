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

<div class="elg" >
    <?php require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php'; ?>
    <h3><?php echo JText::_('COM_ELGERGASIA_MEDICAL_EXAMS'); ?></h3>
    <form name="employeeform" method="post" action="index.php?option=com_elgergasia&idUser=<?php echo $this->state->get('idUser'); ?>&controller=candidatemedicalexamseditsave&Itemid=<?php echo $this->state->get('Itemid'); ?>" enctype="multipart/form-data" >   
    
        <?php 
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser');
            echo $this->form->getInput('language');
            echo JHtml::_('form.token'); ?>
        <div class="form" >
            <fieldset >
                <?php  if($this->state->get('id', 0) == 0) : ?>
                <div class="formelm" >
                    <?php echo $this->form->getLabel('examFile') . $this->form->getInput('examFile') ?> 
                </div>
                <?php endif; ?>
                <div>
                    <?php echo $this->form->getLabel('examDate') . $this->form->getInput('examDate') ?> 
                </div>
                <div style="clearfix">&nbsp;</div>
                <?php require JPATH_COMPONENT_SITE . '/layouts/parteditlangbar.php'; ?>
                <?php include JPATH_COMPONENT_SITE . '/layouts/candidatemedicalexamsedit_translation.php'; ?>
                <div style="clearfix">&nbsp;</div>
                <div class="no-print">
                    <div>
                        
                            <button class="btn btn-primary">
                             <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                            </button>
                             <a class="btn btn-primary" href ="<?php echo $this->retTo ?>" ><?php echo $this->returnToText; ?></a>
                    </div>
                 
              </div>
            </fieldset>
        </div>
    </form>
</div>