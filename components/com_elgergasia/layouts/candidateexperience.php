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
    <?php require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php'; ?>
    <table class="table table-bordered">
        <tfoot class="no-print">
            <tr>
                <td colspan="4">
                    <form method="post" action="<?php echo $this->editAction ?>" >
                        <div class="form">
                            <div class="candidate" >
                                    <button class="btn btn-primary">
                                            <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                                    </button>
                                    <a class="btn btn-default" href="<?php echo $this->retToCandidate ?>" ><?php echo JText::_('COM_ELGERGASIA_RETURN_TO_CANDIDATE_INFO_TAB') ?></a>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </tfoot>
        <?php require $this->dataLayout ?>
   </table>
</div>