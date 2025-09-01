<?php
/**
 * @package     ELG.Jobs.site
 * @subpackage  com_elgjob
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
?>

<div class="search_results_header">
    <div class="filters_mob_button"><i class="fa fa-filter" aria-hidden="true"></i> Φίλτρα</div>
    <div class="search_results_ordering">
        <span><?php echo Text::_('COM_ELGJOBS_ORDER_BY'); ?>:</span>
        <div class="select_container">
            <select id="orderingSelection" name="list[fullordering]">
                <option <?php echo ( $this->fullOrdering == 'submitDate desc' ? ' selected="selected" ' : ''); ?> value="submitDate desc"><?php echo Text::_('COM_ELGJOBS_ORDER_BY_NEW_TO_LAST'); ?></option>
                <option <?php echo ( $this->fullOrdering == 'stateChangedDate desc' ? ' selected="selected" ' : ''); ?>  value="stateChangedDate desc"><?php echo Text::_('COM_ELGJOBS_CANDIDATE_LAST_STATE_CHANGE'); ?></option>
                <option <?php echo ( $this->fullOrdering == 'jobSalary desc' ? ' selected="selected" ' : ''); ?>  value="jobSalary desc"><?php echo Text::_('COM_ELGJOBS_ODER_BY_SALARY_DESL'); ?></option>
            COM_ELGJOBS_SALARY
            </select> 
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </div>
    </div>
</div>
<div class="search_results" id="searchJobResults"></div>


<div class="pagination" arial-label="<?php echo Text::_('JLIB_HTML_PAGINATION'); ?>" ></div>
<?php if ($this->user->authorise('core.edit', 'com_elgjobs')): ?>
    <div class="personnelContactContainer">

        <div class="mt-2 mb-2 mt-sm-3 mb-sm-3 d-flex">
            <a href="/epexergasia-aggelias.html/?task=job.edit" class="button button_filled bg_blue"><?php echo Text::_('COM_ELGJOBS_NEW_RECORD'); ?></a>
        </div>
    </div>
<?php endif; ?>