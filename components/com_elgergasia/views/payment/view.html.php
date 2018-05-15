<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );

 class  ElgergasiaViewPayment extends JViewHTML{
      
  
    public function render() {
        $state = $this->model->getState();
        $this->itemData = $state->get('itemData');
        $id = $this->state->get('id');
        $idUser = $this->state->get('idUser');
        
        $commonUrl =  'index.php?option=' . $this->state->get('option') . '&idUser=' . $idUser . '&Itemid='  . $this->state->get('Itemid') . '&lang=' .$this->state->get('lang');
       
        switch($this->getLayout()) {
          case 'paymentdelete' :
              $idPaymentType = $this->state->get('type',1);
              if($idPaymentType == 1)
              {
                $viewTo = "employer";
                
              }
              else
              {
                  $viewTo = "candidate";
              }
              $this->retNoAuthorise = JRoute::_($commonUrl . '&id=' . $idUser . '&view=' . $viewTo . '&layout=candidate', false);
              $this->deleteFormAction =  JRoute::_($commonUrl . '&id=' . $id . '&controller=paymentdelete&type=' . $idPaymentType, false);
              $this->cancelFormAction = JRoute::_($commonUrl . '&id=' . $idUser . '&view=' . $viewTo . '&layout=' . $viewTo, false);
              $this->deleteSpecificText = JText::_('COM_ELGERGASIA_OF_PAYMENT');
              break;
          default:
            $this->retToCandidate = JRoute::_($commonUrl . '&id=' . $idUser . '&view=' . $viewTo . '&layout=' . $viewTo, false);
            $this->editAction = JRoute::_($commonUrl . '&id=' . $id . ' &view=paymentedit&layout=paymentedit', false);
      }
        $this->state = $state;
        return parent::render();
    }    
 }
?>
