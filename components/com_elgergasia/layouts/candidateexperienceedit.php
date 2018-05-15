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
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE'); ?></h3>
    <form name="employeeform" method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&model=candidateexperienceeditsave&controller=candidateexperienceeditsave', false) ; ?>" >   
    
        <?php 
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser');
             echo $this->form->getInput('language');
            echo JHtml::_('form.token'); ?>
        <div class="candidate" >
            <fieldset>
              
                <div style="clear:left">&nbsp;</div>
                <div class="yjsg-col-1-2">
                    <div  >
                        <?php echo $this->form->getLabel('idIndustry') . $this->form->getInput('idIndustry') ?> 
                    </div>
                </div>
                <div class="yjsg-col-1-2">
                    <div  >
                        <?php echo $this->form->getLabel('idSpecialization') . $this->form->getInput('idSpecialization') ?> 
                    </div>
                </div>
                <div style="clear:left">&nbsp;</div>
                <fieldset>
                    <legend><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_OCCUPATION_DURATION')?></legend>
                    <h4><?php echo JText::_('COM_ELGERGASIA_FROM')?></h4>
                    <div class="yjsg-col-1-2">    
                        <div >
                            <?php echo $this->form->getLabel('monthFrom') . $this->form->getInput('monthFrom') ?>
                        </div>
                    </div>
                    <div class="yjsg-col-1-2">    
                        <div  >
                            <?php echo $this->form->getLabel('yearFrom') . $this->form->getInput('yearFrom') ?> 
                        </div>
                    </div>
                    <div class="clear-fix">&nbsp;</div>
                    <h4><?php echo JText::_('COM_ELGERGASIA_TO')?></h4>
                    <div class="yjsg-col-1-2">    
                        <div  >
                            <?php echo $this->form->getLabel('monthTo') . $this->form->getInput('monthTo') ?> 
                        </div>
                    </div>
                    <div class="yjsg-col-1-2">
                        <div  >    
                            <?php echo $this->form->getLabel('yearTo') . $this->form->getInput('yearTo') ?> 
                        </div>
                    </div>
                </fieldset>
                <div class="clearfix">&nbsp;</div>
                <?php require JPATH_COMPONENT_SITE . '/layouts/parteditlangbar.php'; ?>
                <?php require JPATH_COMPONENT_SITE . "/layouts/candidateexperienceedit_translation.php"; ?>

                <div style="clear:left">&nbsp;</div>

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