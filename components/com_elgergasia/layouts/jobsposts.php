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
$imageAlt = JText::_('COM_ELGERGASIA_JOB_PHOTO_ALT');
$jobSalary =  JText::_('COM_ELGERGASIA_SALARY');
$jobEmployer = JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EMPLOYER');
JFactory::getDocument() -> addStylesheet('media/com_elgergasia/css/bootstrap_lumen.min.css');
?>

<div class="elg job">
    <h1><?php echo JText::_('COM_ELGERGASIA_JOBS_TITLE'); ?></h1>
    <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid')); ?>" id="adminForm" name="adminForm">
        <input type="hidden" name="filter_order" value="<?php echo $this->filter_order ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->filter_order_Dir ?>" />
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
        <div class="form well hidden-print " >
            <fieldset>
                <legend class="no-print"><?php echo Jtext::_('COM_ELGERGASIA_FILTERS_SEARCH') ?></legend>
                <?php include $this->formFile; ?>
                <div class="clear-fix">&nbsp</div>
                <div>
                    
                        <button class="btn btn-primary">
                             <?php echo JText::_('COM_ELGERGASIA_SEARCH') ; ?>
                        </button>
             
                </div>
            </fieldset> 
            <div class="clearfix">&nbsp;</div>
        </div>
        <div class="clearfix">&nbsp;</div>
           <?php if( count($this->data) > 0 ): ?>
        <table class="table table-border table-striped table-hover table-jobs">
            <thead>
                <tr class="table-info">
                    <th>Ειδίκευση</th>
                    <th>Ημ/νια Αγγελίας</th>
                    <th>Περιοχή</th>
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($this->data as $item): ?>
                        <tr>
                            <td><?php echo $item -> speciality; ?></td>
                            <td><?php echo $item -> submitDate; ?></td>
                            <td><?php echo $item -> county; ?></td>
                            <td>
                                <?php if ( trim( $item -> extUrl ) !== '' ): ?>
                                    <a href="<?php echo  $item -> extUrl; ?>" target="_blank" class="btn btn-info btn-lg pull-right" style="margin-right:0;font-weight:bold;font-size:x-large"> > </a>
                                <?php else: ?>
                                    <a href="index.php?view=jobpost&controller=jobpost&id=<?php echo  $item->id; ?>" class="btn btn-info btn-lg pull-right" style="margin-right:0;font-weight:bold;font-size:x-large"> > </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
         <?php
                else:
                   echo '<p>' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '</p>';
                endif;
		?>  
		<?php echo ($this->state->get('pagination')->getListFooter()); ?> 
    </form>
</div>
