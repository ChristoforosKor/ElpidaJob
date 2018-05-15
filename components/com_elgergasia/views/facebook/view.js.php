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
 require JPATH_COMPONENT_SITE . '/views/elgview.php';
 class  ElgergasiaViewJob extends ElgergasiaViewElgView{
      
  
    public function render() {
        $state = $this->model->getState();
        $this->itemData = $state->get('itemData');
        $this->state = $state;
        $this->state = $this->model->getState();
      
        
        if(!$this->isUserPrivileged)
        {
                $this->setLayout('jobunprivileged');
           
        }
        return parent::render();
    }    
 }
?>
