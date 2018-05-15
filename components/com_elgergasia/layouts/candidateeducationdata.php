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
            <th><?php echo JText::_('COM_ELGERGASIA_EDUCATION_TITLE'); ?></th><td><?php echo $this->data->educationTitle ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_INSTITUTION'); ?></th><td><?php echo($this->data->educationInstitute) ?></td>
        </tr><tr>
            <th><?php echo JText::_('COM_ELGERGASIA_LEVEL'); ?></th><td><?php echo $this->data->degreeLevel ; ?></td>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_SPECIALIZATION_SECTOR'); ?></th><td><?php echo $this->data->speciality;  ?></td>
        </tr><tr>    
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_YEAR_FROM_LABEL'); ?></th><td><?php echo $this->data->yearFrom; ?></td>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_YEAR_TO_LABEL'); ?></th><td><?php echo $this->data->yearTo; ?></td>
        </tr>
</tbody>
