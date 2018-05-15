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
	
    <h2><?php echo JText::_('COM_ELGERGASIA_JOB_SUBMIT'); ?></h2>
    <div>
        <form name="jobForm" method="post" enctype="multipart/form-data" >   
            <fieldset>
                <?php echo $this->form->getInput('id');
                    echo $this->form->getInput('language');
                ?>
                <div class="yjsg-col-1-2">
                    <div>
                        <?php echo $this->form->getLabel('idJobState')  . $this->form->getInput('idJobState');  ?>
                    </div>
                    <?php /**
                    <div class="formelm">
                        <?php echo $this->form->getLabel('jobCost')  . $this->form->getInput('jobCost');  ?>
                    </div>
                     * **
                     */
                    ?>
                    <div>
                        <?php echo $this->form->getLabel('idCounty')  . $this->form->getInput('idCounty');  ?>
                    </div>
                    <div>
                        <?php echo $this->form->getLabel('idDegreeLevel')  . $this->form->getInput('idDegreeLevel');  ?>
                    </div>
                    <div>
                        <?php echo $this->form->getLabel('idHour')  . $this->form->getInput('idHour');  ?>
                    </div>
                    <div>
                        <?php echo $this->form->getLabel('jobSalary')  . $this->form->getInput('jobSalary');  ?>
                    </div>
                </div>
                <div class="yjsg-col-1-2">
                    <div>
                        <?php echo $this->form->getLabel('idUser')  . $this->form->getInput('idUser');  ?>
                        <button type="button" class="btn btn-primary" id="addExtraEmployer" data-target="#employerForm"  data-toggle="modal">Προσθήκη</button>
                    </div>
                    <div>
                        <?php echo $this->form->getLabel('minExperience')  . $this->form->getInput('minExperience');  ?>
                    </div>
                    <div>
                        <?php echo $this->form->getLabel('idSpeciality')  . $this->form->getInput('idSpeciality');  ?>
                    </div>
                    <div id="medicalCare" style="display:none">
                        <?php echo $this->form->getLabel('idMedicalCare')  . $this->form->getInput('idMedicalCare');  ?>
                    </div>
                    <div id="oldPeople" style="display:none">
                        <?php echo $this->form->getLabel('idOldPeople')  . $this->form->getInput('idOldPeople');  ?>
                    </div>
                     <div>
                        <?php echo $this->form->getLabel('daysOff')  . $this->form->getInput('daysOff');  ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="yjsg-col-1">
                    <div class="yjsg-col-1-3">
                        <?php echo $this->form->getLabel('jobImage1')  . $this->form->getInput('jobImage1');  ?>
                    </div>
                    <div class="yjsg-col-1-3" >
                        <?php echo $this->form->getLabel('jobImage2')  . $this->form->getInput('jobImage2');  ?>
                    </div>
                    <div class="yjsg-col-1-3" >
                        <?php echo $this->form->getLabel('jobImage3')  . $this->form->getInput('jobImage3');  ?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <?php require JPATH_COMPONENT_SITE . '/layouts/parteditlangbar.php'; ?>
                <?php require JPATH_COMPONENT_SITE . "/layouts/jobedit_translation.php"; ?>
                <div class="clearfix">&nbsp;</div>
                <div>
                     <div>
                        <?php echo $this->form->getLabel('extUrl')  . $this->form->getInput('extUrl');  ?>
                    </div>
                    <br />
                    <button class="btn btn-primary">
                        <?php echo JText::_('COM_ELGERGASIA_JOB_SUBMIT') ?>
                    </button>
                </div>
                <input type="hidden" name="controller" value="jobsave" />
                <?php echo JHtml::_('form.token'); ?>
            </fieldset>            
        </form>
    </div>
</div>    
<div class="modal" id="employerForm" tabindex="-1" role="dialog" aria-labelledby="Προσθήκη Εργοδότη" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo JText::_('Προσθήκη εργοδότη'); ?></h4>
            </div>
            <div class="modal-body">
                <form id="newEmployerForm" >
                    <p><?php echo $this -> form2 ->getLabel('name'), $this -> form2 ->getInput('name'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('discreteTitle'), $this -> form2 ->getInput('discreteTitle'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('phone'), $this -> form2 ->getInput('phone'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('mobile'), $this -> form2 ->getInput('phone'); ?></p> 
                    <p><?php echo $this -> form2 ->getLabel('city'), $this -> form2 ->getInput('city'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('address'), $this -> form2 ->getInput('address'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('idIndustry'), $this -> form2 ->getInput('idIndustry'); ?></p>
                </form>
            </div>
            <div class="loading-indicator"></div>
            <div id="modalMessage" class="text-danger"></div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="btnSaveEmployer" ><?php echo "Αποθήκευση"; ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="media/com_elgergasia/js/select2.min.js"></script>
<script type="text/javascript" src="media/com_elgergasia/js/job.js"></script>