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
<table class="info">
    <tr>
        <th><?php echo JText::_('COM_ELGERGASIA_USER');?></th><td><?php echo $this->itemData->name;  ?>
    </tr>
    <tr>
        <th><?php echo JText::_('COM_ELGERGASIA_PAYMENT_DATE');?></th><td><?php echo $this->itemData->paymentDate;  ?></td>
    </tr>
    <tr>
        <th><?php echo Jtext::_('COM_ELGERGASIA_PAYMENT_AMOUNT') ?></th><td><?php echo $this->itemData->$payment;  ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right"><a class="btn" href="?option=com_elgergasia&view=paymentedit&layout=paymentedit&id=<?php echo $this->state->get('id'); ?>&lang=<?php echo $this->state->get("lang"); ?>&Itemid=201" > <?php echo JText::_('COM_ELGERGASIA_EDIT');  ?></a></td>
    </tr>
</table>
