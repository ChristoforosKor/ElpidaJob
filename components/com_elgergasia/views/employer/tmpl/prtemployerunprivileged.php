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
            <th><?php echo JText::_('COM_ELGERGASIA_EMPLOYER_DISCRETE_TITLE'); ?></th><td><?php echo $this->data->discreteTitle; ?></td>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_FULLNAME'); ?></th><td><?php echo $this->data->name; ?></td>
        </tr>
        <tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYER_INDUSTRY'); ?></th><td><?php echo $this->data->industry ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_ACTIVITY'); ?></th><td><?php echo $this->data->profession ?></td>
       </tr>
       <tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_COUNTRY_LABEL'); ?></th><td><?php echo $this->data->country ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYER_CITY_LABEL'); ?></th><td><?php echo($this->data->city) ?></td>
       </tr>
      <tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_COMMENTS'); ?></th>
           <td colspan="3" ><?php echo $this->data->information ?></td>

       </tr>    
   </tbody>
   
 

