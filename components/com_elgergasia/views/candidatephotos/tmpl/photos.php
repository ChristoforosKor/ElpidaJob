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
  
    if (isset($this->photosData)) {
        ?>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_IMAGE_1') ?></th>
        </tr>
        <tr>
            <td>
                <?php echo '<img src="'. JUri::base() . $this->photosData->photo . '" />' ?>
            </td>
        </tr>
        <?php 
        }
        ?>