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
        <input type="hidden" name="idJobState" value="2" /> 
        <div class="col-md-4 col-xs-4">
            <?php echo $this->form->getLabel('id') .  $this->form->getInput('id');  ?><br />
            <?php echo $this->form->getLabel('idSpeciality') . $this->form->getInput('idSpeciality');  ?><br />
             <?php echo $this->form->getLabel('idIndustry') . $this->form->getInput('idIndustry');  ?><br />
            <?php echo $this->form->getLabel('idHour') . $this->form->getInput('idHour');  ?>        
        </div>
        <div class="col-md-4 col-xs-4">
            <?php echo $this->form->getLabel('submitDate') .  $this->form->getInput('submitDate');  ?><br />
            <?php echo $this->form->getLabel('jobSalary') . $this->form->getInput('jobSalary');  ?><br />
            <?php echo $this->form->getLabel('daysOff') . $this->form->getInput('daysOff');  ?><br />
             <?php echo $this->form->getLabel('idOldPeople') . $this->form->getInput('idOldPeople');  ?>
        </div>
        <div class="col-md-4 col-xs-4">
            <?php echo $this->form->getLabel('submitDateTo') .  $this->form->getInput('submitDateTo');  ?><br />
            <?php echo $this->form->getLabel('jobSalaryTo') . $this->form->getInput('jobSalary');  ?><br />
            <?php echo $this->form->getLabel('daysOffTo') . $this->form->getInput('daysOffTo');  ?><br />
             <?php echo $this->form->getLabel('idMedicalCare') . $this->form->getInput('idMedicalCare');  ?>           
        </div>
        <div class="clearfix"></div>
        <p class="text-info hidden-print"><?php echo $this->introText; ?></p>