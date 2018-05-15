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
    //

?>
<div class="elg" >
   <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE') ?></h3>
   <p>
    <?php
        echo str_replace('#', JText::_('COM_ELGERGASIA_OF_WORKEXPERIENCE'), JText::_('COM_ELGERGASIA_ASK_DELETE_OF_CONFIRM'));
    ?>
  </p>
   <?php require 'deletebuttons.php' ?>
      
  <div>
   <p>
       <?php
        $delA = '<a href="'. JRoute::_('index.php?option=com_elgergasia&controller=employeeexperiencedelete&id=' . $this->id . '&iduser=' . $this->idUser) . '" title="' . JText::_('COM_ELGERGASIA_DELETE') .'" ><strong>'. JText::_("JYES") . '</strong></a>';
        $cancelA = '<a href="' . JRoute::_('index.php?option=com_elgergasia&view=employee&id=' . $this->idUser) . '" title="' . JText::_('JNO') . '" ><strong>' . JText::_('JNO') . '</strong></a>';
        echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE_EXPLAIN') . '<br /><br />';
        echo str_replace("#", $delA, str_replace("##", $cancelA, JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE_QUESTION')));
        ?>
       
   </p>