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
        <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITY'); ?></th>
        <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_EXPERIENCE_MONTH'); ?></th>
        <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITY_RANK'); ?></th>
    </tr>
	<tr>
	<td><?php echo $this->data->speciality; ?></td>
	<td><?php echo $this->data->experience; ?></td>
	<td><?php echo $this->data->rank; ?></td>
	</tr>
</tbody>
