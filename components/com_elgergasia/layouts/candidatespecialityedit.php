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
    <?php  require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php' ?>
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SPECIALITIES'); ?></h3>

    <form name="employeeform" method="post"  action="index.php?option=com_elgergasia&model=candidatespecialityeditsave&controller=candidatespecialityeditsave&Itemid=<?php echo $this->state->get('Itemid'); ?>"  >   
        <?php 
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser'); 
            echo JHtml::_('form.token');
        ?> 
        <div class="candidate">
            <fieldset>
                    <div class="yjsg-col-1-2">
                            <div >
                                    <?php echo $this->form->getLabel('idSpeciality') . $this->form->getInput('idSpeciality') ?> 
                            </div>
                    </div>
                    <div class="yjsg-col-1-2">
                            <div>
                                    <?php  echo $this->form->getLabel('experience') . $this->form->getInput('experience') ?> 
                            </div>
                    </div>

                    <div style="clearfix">&nbsp;</div>
                    <br />
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