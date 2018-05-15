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
        <th><?php echo JText::_('COM_ELGERGASIA_TITLE'); ?></th><td><?php echo $this->data->legalTitle ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_FILE'); ?></th><td><?php echo($this->data->legalFile) ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_DATE_EXPIRE'); ?></th><td><?php echo($this->data->legalDateExpire) ?></td>
    </tr>
</tbody>
