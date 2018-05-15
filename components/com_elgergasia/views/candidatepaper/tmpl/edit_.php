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
    <?php  require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php' ?>
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SPECIALITIES'); ?></h3>
    <form name="employeeform" method="post" >   
        <?php echo $this->form->getInput('id')  ;
         echo $this->form->getInput('idCandidate'); ?> 
        <div class="elg-head-left" >
            <div class="elg-column" >
                <div  class="elg-form-row" >
                    <?php echo $this->form->getLabel('idSpeciality') ?> 
                    <br />
                    <?php echo $this->form->getInput('idSpeciality') ?> 
                </div>
                <br />
                <div  class="elg-form-row" >
                    <?php 
                        echo $this->form->getLabel('experience') ?> 
                        <br />
                        <?php echo $this->form->getInput('experience') ?> 
                </div>
                <br />
                <div  class="elg-form-row" >
                    <?php echo $this->form->getLabel('idRank') ?> 
                    <br />
                    <?php echo $this->form->getInput('idRank') ?> 
                </div>
                <br />
                        
            <div style="clear:left">&nbsp;</div>
            <div class="elg-column">
                 <button>
                     <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                 </button>
            </div>
            <div style="clear:left">&nbsp;</div>

        </div>
                                                        
        <input type="hidden" name="controller" value="candidatespecialitiessave" />
        <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>