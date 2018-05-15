<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 
 class ElgergasiaModelPaymentEdit extends JModelDatabase { 
    
     
   
    function getState() {
      $state = parent::getState();
      $table = JTable::getInstance('payment');
      $form = JForm::getInstance('payment', JPATH_COMPONENT . '/models/forms/payment.xml');
      $id = $state->get('id', 0);
      $table->load($id);
      $form->bind($table);
      if($id == 0) 
      {
          $form->setValue('idUser', null, $state->get('idUser', 0));
      }
      $state->set('form',$form);
      
      return $state;
    }
     
   
    
}
?>