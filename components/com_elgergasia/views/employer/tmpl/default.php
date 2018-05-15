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
<div class="elg" >
    <h2><?php echo '(' . $this->itemCaption->id . ') ' . $this->itemCaption->name ;?> </h2>
    <table class="info" >
      <?php
       require 'prteditbutton.php';
       require 'prtemployer.php';
       ?>
   </table>
    <?php /**if($this->isUserPrivileged ) : ?>
    <h3><?php echo JText::_('COM_ELGERGASIA_PAYMENTS'); ?></h3>
   <?php require JPATH_COMPONENT_SITE . '/layouts/payments.php'; 
   endif; **/
   ?>
</div>