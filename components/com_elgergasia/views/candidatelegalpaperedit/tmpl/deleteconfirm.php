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
<div class="elg">
   <h2><?php /** echo '(' . $this->employee->id . ') ' . $this->employee->name /**/ ?></h2>   
   <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE') ?></h3>
   <p>
       <?php
        $delA = '<a href="'. JRoute::_('index.php?option=com_elgergasia&controller=candidateslegalpaperdelete&id=' . $this->id . '&idcandidate=' . $this->idCandidate) . '" title="' . JText::_('COM_ELGERGASIA_DELETE') .'" ><strong>'. JText::_("JYES") . '</strong></a>';
        $cancelA = '<a href="' . JRoute::_('index.php?option=com_elgergasia&view=employee&id=' . $this->idCandidate) . '" title="' . JText::_('JNO') . '" ><strong>' . JText::_('JNO') . '</strong></a>';
        echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE_EXPLAIN') . '<br /><br />';
        echo str_replace("#", $delA, str_replace("##", $cancelA, JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE_QUESTION')));
        ?>
       
   </p>
</div>