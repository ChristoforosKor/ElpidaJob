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
   
   <h2><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE') ?></h2>
   <p>
       <?php
        
        echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE_EXPLAIN') . '<br /><br />';
        echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE_QUESTION');
        //echo str_replace("#", $delA, str_replace("##", $cancelA, JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_CONFIRM_DELETE_QUESTION')));
        ?>
        <div>
            <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&controller=deleterecord&Itemid=' . $this->Itemid )?>" >
                <input type="hidden" name="delId" value="<?php echo $this->delId ?>"  />
                <input type="hidden" name="delType" value="<?php echo $this->delType ?>"  />
                <input type="hidden" name="retTo" value="<?php echo $this->retTo ?>" />
                <button style="float:left" ><?php echo JText::_("JYES") ?></button>
            </form>
            <form method="post"  action="<?php echo JRoute::_('index.php?option=com_elgergasia&controller=deleterecord&Itemid=' . $this->Itemid ) ?>" >
                <input type="hidden" name="delType" value="cancel" />
                <input type="hidden" name="retTo" value="<?php echo $this->retTo ?>" />
                <button><?php echo JText::_('JNO') ?></button>
            </form>
       </div>
       
   </p>