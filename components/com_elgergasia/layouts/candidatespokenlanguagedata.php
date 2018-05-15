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
            <th><?php echo JText::_('COM_ELGERGASIA_SPOKEN_LANGUAGE'); ?></th><td><?php echo $this->data->spokenlanguage ?></td>
            <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITY_RANK'); ?></th><td><?php echo($this->data->rankNeut) ?></td>
        </tr>
</tbody>
