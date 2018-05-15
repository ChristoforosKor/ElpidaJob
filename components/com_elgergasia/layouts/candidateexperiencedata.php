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


<tbody>
        <tr>    
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EMPLOYER'); ?></th><td colspan="3"><?php echo $this->data->employerTitle ?></td>
        </tr><tr>    
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_INDUSTRY'); ?></th><td><?php echo $this->data->industry ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_SECTOR'); ?></th><td><?php echo($this->data->speciality) ?></td>
        </tr><tr>
            <th><?php echo JText::_('COM_ELGERGASIA_FROM'); ?></th><td><?php echo JHtml::_('date', $this->data->dateFrom, 'M Y'); ?></td>
            <th><?php echo JText::_('COM_ELGERGASIA_TO'); ?></th><td><?php echo JHtml::_('date',  $this->data->dateTo, 'M Y'); ?></td>
        </tr><tr>    
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_JOB_DESCRIPTION_LABEL'); ?></th>
            <td colspan="3" style="width:75%"><?php echo $this->data->jobDescription ?></td>
        </tr>
</tbody>
