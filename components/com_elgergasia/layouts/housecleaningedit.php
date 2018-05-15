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
<script type="application/javascript" >
    var saveURL = '<?php echo $this->saveUrl; ?>';
</script>
<script type="application/javascript" src="media/com_elgergasia/js/houseclean.js" async></script>
<div class="elg cleaning">
    <h3><?php echo JText::_('COM_ELGERGASIA_HOUSE_CLEANING'); ?></h3>
    <p><?php echo JText::_('COM_ELGERGASIA_HOUSE_CLEANING_INTRO'); ?></p>
    <div id="houseCleamMessages"></div>
    <form method="post"  name="cleanForm" id="cleanForm">   
    
        <?php  echo $this->hcForm->getInput('id')  ; ?>
        <?php if($this->canUserEdit) : ?>
        <div class="yjsg-col-1-4" >
            <?php echo $this->hcForm->getLabel('isActive') . $this->hcForm->getInput('isActive') ?> 
        </div>
        <div class="clearfix">&nbsp;</div>
        <?php endif; ?>
        
        <div class="yjsg-col-1" >
            <?php echo $this->hcForm->getLabel('address') . $this->hcForm->getInput('address') ?> 
        </div> 
        <div class="yjsg-col-1-2" >
            <?php echo $this->hcForm->getLabel('fullname') . $this->hcForm->getInput('fullname') ?> 
        </div>
        <div class="yjsg-col-1-4" >
            <?php echo $this->hcForm->getLabel('telephone') . $this->hcForm->getInput('telephone') ?> 
        </div> 
        <div class="yjsg-col-1-4" >
            <?php echo $this->hcForm->getLabel('email') . $this->hcForm->getInput('email') ?> 
        </div>
          <div class="clearfix">&nbsp;</div>
        <br />
        <div class="yjsg-col-1-2" >
            <?php echo $this->hcForm->getLabel('area_description')  ?><br />
            <small><em>Πόσα τετραγωνικά είναι ο χώρος; είναι διαμέρισμα, μεζονέτα κλπ;, πάτωμα με πλακάκι, μωσαϊκό κλπ; ή οτιδήποτε άλλο πρέπει να γνωρίζει η καθαρίστρια</em></small>
            <?php echo $this->hcForm->getInput('area_description') ?> 
        </div>
        <div class="yjsg-col-1-2" >
            <?php echo $this->hcForm->getLabel('idExtraInfo') ?>
            <br />
            <small><em>Αν κάτι δεν αναφέρεται παρακάτω, παρακαλώ συμπληρώστε το δίπλα, ώστε να προετοιμαστεί κατάλλληλα η καθαρίστρια.</em></small>
            <?php echo $this->hcForm->getInput('idExtraInfo') ?>
          
        </div>
        <div class="clearfix">&nbsp;</div>
         <br />
         <div class="yjsg-col-1-2" >
            <?php echo $this->hcForm->getLabel('idCleaningFrequency') . $this->hcForm->getInput('idCleaningFrequency') ?> 
        </div>
        <div class="yjsg-col-1-2" >
            <?php echo $this->hcForm->getLabel('idCleaningStart') . $this->hcForm->getInput('idCleaningStart') ?> 
        </div>
        <div class="yjsg-col-1-2" >
            <?php echo $this->hcForm->getLabel('idΒuying') . $this->hcForm->getInput('idΒuying') ?> 
        </div>
        <div class="yjsg-col-1-2" >
            <?php echo $this->hcForm->getLabel('idCommunicationTime') . $this->hcForm->getInput('idCommunicationTime') ?> 
        </div>
        <div class="yjsg-col-1" >
            <button class="yjsg-button-color" type="button" onclick="submitClean()"><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT'); ?></button> 
        </div>
    </form>
    <div class="loading-indicator" style="display:none"><img src="media/com_elgergasia/images/loader_128_128.gif" /></div>
</div>

 