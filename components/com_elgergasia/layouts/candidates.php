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
 <h2><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATES'); ?></h2>
 <form method="post" action="<?php echo JRoute::_('index.php?Itemid=' . $this->state->get('Itemid')); ?>" id="adminForm" name="adminForm">
        <input type="hidden" name="filter_order" value="<?php echo $this->filter_order ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->filter_order_Dir ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="isFullSearch" value="0" />
        <?php echo JHtml::_('form.token'); ?>
      
        <div class="form well">
            <fieldset>
                    <legend class="hidden-print">
                            <?php echo JText::_('COM_ELGERGASIA_FILTERS_SEARCH'); ?>
                    </legend>
                    <div class="row">
                        <div class="formelm col-md-4 col-xs-4" >
                                <?php echo $this->form->getLabel('idUser')  . $this->form->getInput('idUser'); ?>
                        </div>
                        <div class="formelm col-md-4 col-xs-4" >
                            <?php echo  $this->form->getLabel('idSpecialization') . $this->form->getInput('idSpecialization'); ?>
                        </div>
                        <div class="formelm col-md-4 col-xs-4" >
                                <?php echo  $this->form->getLabel('fullname') . $this->form->getInput('fullname'); ?>
                        </div>
                       
                    </div>
                    <div class="row">
                       
                       
                        <div class="formelm col-md-4 col-xs-4" >
                            <?php echo $this->form->getLabel('idSectionPreference') . $this->form->getInput('idSectionPreference'); ?>
                        </div>
                        <div class="formelm col-md-4 col-xs-4" >
                            <?php echo $this->form->getLabel('idCandidateState') . $this->form->getInput('idCandidateState'); ?>
                        </div>
                        <div class="formelm col-md-4 col-xs-4" >
                            <?php echo $this->form->getLabel('idUserTeam') . $this->form->getInput('idUserTeam'); ?>
                        </div>
                         <div class="formelm col-md-4 col-xs-4" >
                                <?php echo  $this->form->getLabel('idNationality') . $this->form->getInput('idNationality'); ?>
                        </div>
                    </div>
                    <div class="clear-fix">&nbsp;</div>
                    <div class="hidden-print">
                        <div class="formelm" >
                            <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_SEARCH') ?>
                            </button>
                        </div>
                        <div class="formelm">
                            <a href="<?php echo JRoute::_('index.php?layout=candidatessearch&controller=candidatessearch&lang=' . $this->state->get('lang', CommonUtils::getComponentParams()->get('lang', 'el'))); ?>" ><?php echo JText::_('COM_ELGERGASIA_COMPOSITE_SEARCH');?></a>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <p class="hidden-print">
                        <?php echo $this -> par3; ?>
                    </p>
                    <p class="hidden-print">
                    <?php if($this->par1 != ''):
                            echo $this -> par1, '<br />';
                    endif;
                        echo $this->par2; ?>
                    </p>
					
					
            </fieldset>
	</div>
        <?php require 'candidateslist.php'; ?>
    </form>
</div>