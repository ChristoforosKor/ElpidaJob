<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
    defined('_JEXEC') or die('Restricted access');
?>

<div class="elg" id="stats1st">
    <table class="info"  >
         <caption><?php echo JText::_('COM_ELGERGASIA_INDEX_STATS_CAPTION') ?></caption>
       
       
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_REGISTERED_EMPLOYERS')?></th>
            <td><?php echo $this->usersByGroup['11'] ?></td>
        </tr>
        <tr>
            
            <th><?php echo JText::_('COM_ELGERGASIA_REGISTERED_CANDIDATES')?></th>
            <td><?php echo $this->usersByGroup['10'] ?></td>
        </tr>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_REGISTERED_ACTIVE_JOBS')?></th>
            <td><?php echo $this->jobsByState['2'] ?></td>
        </tr>
    </table>
</div>