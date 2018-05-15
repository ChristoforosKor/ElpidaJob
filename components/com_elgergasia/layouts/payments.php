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
//    $this->colspans[0] = "3";
//    $this->buttonsTexts[0] = JText::_("COM_ELGERGASIA_ADD");
//    $this->linksUrls[0] = 
    require JPATH_COMPONENT_SITE . '/libraries/tbs/tbs_class.php';
?>

<table>
    <?php 
        $htmlIndex = 0;
        require JPATH_COMPONENT_SITE . '/libraries/joomla/html/tfooteractionbuttons.php'; 
    ?>
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_USER'); ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_PAYMENT_AMOUNT'); ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_PAYMENT_DATE'); ?></th>
        </tr>
    <thead>
    <tbody>
        <?php 
           $TBS = new clsTinyButStrong;
           $TBS->LoadTemplate(JPATH_COMPONENT_SITE .'/layouts/payments_tmpl.html');
           $data = $this->state->get('data');
           $TBS->MergeBlock('b', $data->payments);
           $TBS->Show(TBS_OUTPUT);
       ?>
   </tbody>
</table>