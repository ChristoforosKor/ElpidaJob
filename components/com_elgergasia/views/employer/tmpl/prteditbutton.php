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


    <tfoot class="no-print">
        <tr>
            <td colspan="4">
                <form method="post" action="<?php echo 'index.php?option=' . $this->state->get('option') . '&view=employeredit&layout=employeredit&model=employeredit&id=' . $this->state->get('id') . '&Itemid=' . $this->state->get('Itemid') . '&lang=' . $this->state->get('lang'); ?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                                </button>
                              
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tfoot>
