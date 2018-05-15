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
    utils::authorsedForAgent($this->retNoAuthorise, JText::_('COM_ELGERGASIA_NOT_AUTHORISED'));

?>
<div class="elg well">
    <h2><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE') ?></h2>
    <p>
        <?php echo str_replace('#',  $this->deleteSpecificText, JText::_('COM_ELGERGASIA_ASK_DELETE_OF_CONFIRM')); ?>
    </p>
    <?php require JPATH_COMPONENT_SITE . '/commons/html/deletebuttons.php' ?>
    <table class="table table-bordered">
        <?php require $this->dataLayout ?>    
    </table>
    <br />
    <p> 
      <?php echo JText::_('COM_ELGERGASIA_DELETE_CONFIRM_QUESTION'); ?>
    </p>  
    <?php require JPATH_COMPONENT_SITE . '/commons/html/deletebuttons.php' ?>
</div>