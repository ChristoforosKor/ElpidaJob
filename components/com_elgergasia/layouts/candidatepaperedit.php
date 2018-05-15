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
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_DEGREES_CV'); ?></h3>
    <form name="candidatePaperform" method="post" action="index.php?option=com_elgergasia&controller=candidatepapereditsave&model=candidatepapereditsave&Itemid=<?php echo $this->state->get('Itemid'); ?>" enctype="multipart/form-data" >   
    
        <?php 
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser');
            echo $this->form->getInput('language');
            echo JHtml::_('form.token'); ?>
        <div class="candidate" >
            <fieldset class="yjsg-col-1-2" >
                <?php  if($this->state->get('id', 0) == 0) : ?>
                 <div  >
                    <?php echo $this->form->getLabel('paperFile') . $this->form->getInput('paperFile') ?> 
                </div>
                <?php endif; ?>
                <div style="clearfix">&nbsp;</div>
                <?php require JPATH_COMPONENT_SITE . '/layouts/parteditlangbar.php'; ?>
                <?php require JPATH_COMPONENT_SITE . "/layouts/candidatepaperedit_translation.php"; ?>
                <div style="clearfix">&nbsp;</div>
                <div class="no-print">
                   
                        <div  >
                            <button class="btn btn-primary">
                             <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                            </button>
                              <a class="btn btn-default" href ="<?php echo $this->retTo ?>" ><?php echo $this->returnToText; ?></a>
                        </div>
                   
                   
                   
              </div>
            </fieldset>
        </div>
    </form>
    
</div>