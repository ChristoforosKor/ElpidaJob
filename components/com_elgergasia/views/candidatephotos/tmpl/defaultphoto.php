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


    <table class="elg-head-left" >
        
    <?php 
        include 'editbutton.php';
        echo '<tbody>';
    if(count($this->photosData) > 0) { 
        
      include 'photos.php';
    }
    else { ?>
    <?php
     echo '<tr><td>' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_EDIT_FOR_NEW') . '</td></tr>';
    
     
    }
    echo '</tbody>'
    ?>
 </table>