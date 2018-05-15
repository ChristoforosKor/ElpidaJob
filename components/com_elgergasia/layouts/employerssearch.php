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
    <h2><?php echo JText::_('COM_ELGERGASIA_SEARCH_EMPLOYER'); ;?> </h2>
    <form method="post" action="<?php echo $this->formAction ?>" id="adminForm" name="adminForm">
        <input type="hidden" name="filter_order" value="<?php echo $this->filter_order ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->filter_order_Dir ?>" />
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
        <div class="form" >
            <fieldset>
                <legend><?php echo JText::_('COM_ELGERGASIA_FILTERS_SEARCH'); ?></legend>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('idSearch') . $this->form->getInput('idSearch') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('nameSearch') . $this->form->getInput('nameSearch') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('discreteTitle') . $this->form->getInput('discreteTitle') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('idIndustry') . $this->form->getInput('idIndustry') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('taxNumber') . $this->form->getInput('taxNumber') ?>
                    </div>
                </div>
                <div class="elg-column w50">
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('profession') . $this->form->getInput('profession') ?>
                    </div>
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('idCountry') . $this->form->getInput('idCountry') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('city') . $this->form->getInput('city') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('address') . $this->form->getInput('address') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('taxOffice') . $this->form->getInput('taxOffice') ?>
                    </div>
                </div>
                <div class="clear-fix">&nbsp;</div>
                <div class="elg-column w50">
                   <div class="formelm" >
                        <?php echo $this->form->getLabel('postalCode') . $this->form->getInput('postalCode') ?>
                    </div>
                     <div class="formelm" >
                        <?php echo $this->form->getLabel('phone') . $this->form->getInput('phone') ?>
                    </div>
				</div>
                <div class="elg-column w50">
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('email') . $this->form->getInput('email') ?>
                    </div>
                    <div class="formelm" >
                        <?php echo $this->form->getLabel('website') . $this->form->getInput('website') ?>
                    </div>
                </div>

                <div class="clear-fix">&nbsp;</div>

				<div class="formelm" >
					<button class="btn btn-primary">
						<?php echo JText::_('COM_ELGERGASIA_SEARCH') ; ?>
					</button>
				</div>
            </fieldset>
        </div>
        <?php include 'employerslist.php' ?>
    </form>
</div>