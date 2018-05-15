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
       
        <tbody>
        <?php 
            if(isset($this->photo)) : 
                include 'photosimages.php';
             endif;
        ?>
        </tbody>
 </table>