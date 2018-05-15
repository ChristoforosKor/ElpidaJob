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
     <tfoot>
        <tr>
            <td colspan="4">
                <a href="<?php echo JRoute::_('index.php?option=' . $this->option . '&Itemid=' . $this->Itemid . '&view=candidatephotos&layout=edit&idUser=' . $this->idUser . '&id=' . (isset($this->photosData[0])? $this->photosData[0]->id : 0 ) . '&lang=' . $this->lang , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>" ><?php echo JText::_('COM_ELGERGASIA_EDIT'); ?></a>
            </td>
        </tr>
    </tfoot>

    