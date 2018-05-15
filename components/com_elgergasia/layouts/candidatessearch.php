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
<div class="elg well">
    <h2><?php echo JText::_('COM_ELGERGASIA_CANDIDATES_SEARCH') ?> </h2>
    <form name="adminForm" method="post" id="adminForm" action="?option=com_elgergasia" >   
        <input type="hidden" name="filter_order" value="<?php echo $this->filter_order ?>"  />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->filter_order_Dir ?>" />
        <input type="hidden" name="controller" value="candidatessearch" />
		<input type="hidden" name="layout" value="candidatessearch" />
		<input type="hidden" name="Itemid" value="<?php echo $this->state->get('Itemid'); ?>" />
		<input type="hidden" name="lang" value="<?php echo $this->state->get('lang'); ?> />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name="isFullSearch" value="1" />
        <?php echo JHtml::_('form.token'); ?>
        <div class="form" >
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_LOGIN_DATA'); ?> </legend>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('idUser') . $this->form->getInput('idUser'); ?>
                    </div>
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('fullname') . $this->form->getInput('fullname'); ?>
                    </div>
                </div>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('username') . $this->form->getInput('username'); ?>
                    </div>
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('email') . $this->form->getInput('email'); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CONTACT_DATA'); ?> </legend>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('idCountry') . $this->form->getInput('idCountry'); ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('city') . $this->form->getInput('city'); ?>
                    </div>
                </div>
                <div class="elg-column w50">
                   <div class="formelm" >
                        <?php echo $this->form->getLabel('address') . $this->form->getInput('address'); ?>
                   </div>
                   <div class="formelm" >
                        <?php echo $this->form->getLabel('postalCode') . $this->form->getInput('postalCode'); ?>
                    </div>
                </div>
                <div class="elg-column w50">
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('telephone') . $this->form->getInput('telephone'); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CHARACTERISTICS_DATA'); ?> </legend>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('idGender') . $this->form->getInput('idGender'); ?>
                    </div>
                    <div class="formelm" >
                         <?php echo $this->form->getLabel('dateOfBirth') . $this->form->getInput('dateOfBirth'); ?>
                    </div>
                </div>
                <div class="elg-column w50">
                    <div class="formelm" >
                           <?php echo $this->form->getLabel('idNationality') . $this->form->getInput('idNationality'); ?>
                    </div>
                    <div class="formelm" >
                          <?php echo $this->form->getLabel('idMilitaryStatus') . $this->form->getInput('idMilitaryStatus'); ?>
                    </div>
                </div>
                <div class="elg-column w50">
                    <div class="formelm" >
                          <?php echo $this->form->getLabel('idMaritalStatus') . $this->form->getInput('idMaritalStatus'); ?>
                    </div>
                     <div class="formelm" >
                         <?php echo $this->form->getLabel('idDriverLicence') . $this->form->getInput('idDriverLicence'); ?>
                    </div>
                 </div>
                <div class="elg-column w50">
                  
                     <div class="formelm" >
                          <?php echo $this->form->getLabel('smoking') . $this->form->getInput('smoking'); ?>
                     </div>
                </div>
              
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_DATA'); ?> </legend>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('employerTitle') . $this->form->getInput('employerTitle'); ?>
                    </div>
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('idIndustry') . $this->form->getInput('idIndustry'); ?>
                    </div>
                </div>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('idSpecialization') . $this->form->getInput('idSpecialization'); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SPECIALITIES_DATA'); ?> </legend>
                <div class="elg-column w50">
					<div class="formelm" > 
						<?php echo $this->form->getLabel('idSpecialitySpecilities')  . $this->form->getInput('idSpecialitySpecilities') ?> 
					</div>
					<div class="formelm" >
						<?php echo $this->form->getLabel('experienceSpecialities')  . $this->form->getInput('experienceSpecialities') ?> 
					</div>
				</div>     
                <div class="elg-column w50">
					<div class="formelm" >  
						<?php echo $this->form->getLabel('idRankSpecialities')  . $this->form->getInput('idRankSpecialities') ?> 
					</div>
				</div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EDUCATION_DATA'); ?> </legend>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('educationTitle')  . $this->form->getInput('educationTitle') ?> 
                    </div>
                    <div class="formelm">
                         <?php echo $this->form->getLabel('educationInstitute')  . $this->form->getInput('educationInstitute') ?> 
                    </div>
                </div>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('idDegreeLevel')  . $this->form->getInput('idDegreeLevel') ?> 
                    </div>
                    <div class="formelm">
                         <?php echo $this->form->getLabel('idSpecializationEducation')  . $this->form->getInput('idSpecializationEducation') ?> 
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SPOKEN_LANGUAGE_DATA'); ?> </legend>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('spokenLanguage')  . $this->form->getInput('spokenLanguage') ?> 
                    </div>
				</div>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('idRankLanguage')  . $this->form->getInput('idRankLanguage') ?> 
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_PREFERENCES') ?></legend>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('idHour')  . $this->form->getInput('idHour') ?> 
                    </div>
                </div>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('idSectionPreference')  . $this->form->getInput('idSectionPreference') ?> 
                    </div>
                </div>
                <div class="clear-fix">&nbsp;</div>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('idRelationPreference')  . $this->form->getInput('idRelationPreference') ?> 
                    </div>
                </div>
                <div class="elg-column w50">
                    <div class="formelm">
                        <?php echo $this->form->getLabel('idSpecialityPreference')  . $this->form->getInput('idSpecialityPreference') ?> 
                    </div>
                </div>
            </fieldset>
            <div class="clear-fix">&nbsp;</div>
            <div class="elg-column no-print">
                 <button class="btn btn-primary">
                     <?php echo JText::_('COM_ELGERGASIA_SEARCH') ; ?>
                 </button>
            </div>
        </div>
        <div class="elg-newsection" >&nbsp;</div>
        <?php require 'candidateslist.php' ?>
    </form>  
</div>