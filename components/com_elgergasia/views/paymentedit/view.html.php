<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

 class  ElgergasiaViewPaymentEdit extends JViewHTML{
  
    public function render() {
        $state = $this->model->getState();
        $this->form = $state->get('form');   
        $id = $state->get('id');
        $this->form->setValue('id', null,$id);
        $this->state = $state;
        return parent::render();
    }    
 }
?>
