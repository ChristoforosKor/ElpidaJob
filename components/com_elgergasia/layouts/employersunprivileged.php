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
    <h2><?php echo JText::_('COM_ELGERGASIA_EMPLOYERS'); ?></h2>
    <form method="post" action="<?php echo $this->formAction ?>" id="adminForm" name="adminForm">
        <input type="hidden" name="filter_order" value="<?php echo $this->filter_order ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->filter_order_Dir ?>" />
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
        <div class="well">
            <fieldset>
                    <legend class="hidden-print" ><?php echo JText::_('COM_ELGERGASIA_FILTERS_SEARCH'); ?></legend>
                    <div class="col-md-6 col-xs-6">
                        <?php echo $this->form->getLabel('idSearch')  . $this->form->getInput('idSearch'); ?>
                        <?php echo $this->form->getLabel('idIndustry') . $this->form->getInput('idIndustry'); ?>
                    </div>
                     <div class="col-md-6 col-xs-6">
                        <?php echo  $this->form->getLabel('nameSearch') . $this->form->getInput('nameSearch'); ?>
                        <?php echo $this->form->getLabel('idCountry') . $this->form->getInput('idCountry'); ?>
                    </div>
                    <div class="clear-fix">&nbsp;</div>
                    <p class="text-info hidden-print"><?php echo Jtext::_('COM_ELGERGASIA_INTRO_EMPLOYERS'); ?></p>
                    <div class="clear-fix">&nbsp;</div>
                    <div class="hidden-print">
                        
                                <button class="btn btn-primary">
                                        <?php echo JText::_('COM_ELGERGASIA_SEARCH') ?>
                                </button>
                    </div>
                    <div class="hidden-print">
                            <a href="index.php?option=com_elgergasia&view=employers&controller=employers&layout=employerssearch&lang=<?php echo $this->state->get('lang'); ?>&Itemid=<?php echo $this->state->get('Itemid'); ?>" ><?php echo JText::_('COM_ELGERGASIA_COMPOSITE_SEARCH');?></a>
                    </div>
                    </div>
            </fieldset>
	</div>
       <?php include 'employerslist.php' ?>
    </form>
</div>