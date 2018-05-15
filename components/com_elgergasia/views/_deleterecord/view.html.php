<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

 
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

 class  ElgergasiaViewDeleteRecord extends JViewHTML{
    public function render() {
      
        $state = $this->model->getState();
        $this->idUser = $state->get('idUser');
        $this->delType= $state->get('delType');
        $this->retTo = $state->get('retTo');
        $this->delId = $state->get('delId');
        return parent::render();
    }    
 }
?>
