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
    <?php  require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php' ?>
    <h3><?php echo JText::_('COM_ELGERGASIA_RELATIONS_PREFERENCES_EDIT_TITLE'); ?></h3>
     <form name="employeeform" method="post" class="candidate">   
        <?php echo $this->form->getInput('id')  ;
         echo $this->form->getInput('idUser'); 
         echo $this->form->getInput('idRelations');
                                               ?>     
          <div style="clear:left">&nbsp;</div>
            <div class="elg-column">
                 <button class="btn btn-primary">
                     <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                 </button>
            </div>
            <div style="clear:left">&nbsp;</div>
        <input type="hidden" name="controller" value="preferencesrelationssave" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>


    