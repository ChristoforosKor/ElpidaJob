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
    <h3><?php echo JText::_('COM_ELGERGASIA_SPOKEN_LANGUAGES'); ?></h3>
    <form name="employeeform" method="post" action="index.php?option=com_elgergasia&model=candidatespokenlanguageeditsave&controller=candidatespokenlanguageeditsave&Itemid=<?php echo $this->state->get('Itemid'); ?>" >   
    
        <?php 
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser');
              echo $this->form->getInput('language');
            echo JHtml::_('form.token'); ?>
        <div class="candidate" >
            <fieldset>
               
                   
                <div class="yjsg-col-1-2">
                    <div >
                        <?php echo $this->form->getLabel('idRank') . $this->form->getInput('idRank') ?> 
                    </div>
                </div>
                    
                <div class="clearfix">&nbsp;</div>
                <?php require JPATH_COMPONENT_SITE . '/layouts/parteditlangbar.php'; ?>
                 
                <?php require JPATH_COMPONENT_SITE . "/layouts/candidatespokenlanguageedit_translation.php"; ?>
                <div class="clearfix">&nbsp;</div>

                <div  >
                        <button class="btn btn-primary">
                         <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                        </button>
                        <a class="btn btn-default" href="<?php echo $this->retTo ?>" ><?php echo $this->returnToText; ?></a>
                </div>
            </fieldset>
        </div>
    </form>
    <div class="pull-right" >
        <?php require JPATH_COMPONENT_SITE . '/commons/html/deleteitembutton.php'?>
    </div>
</div>