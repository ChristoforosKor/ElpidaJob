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
 class  ElgergasiaViewShowConsent extends ElgergasiaViewElgView{
      
  
    public function render() {
        $this -> consentData = $this -> state -> get('itemData');
        return parent::render();
    }    
 }
