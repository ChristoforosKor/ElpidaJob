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
 class ElgergasiaModelPaymentEditSave extends JModelDatabase{ 
     
    
    public function setState(JRegistry $data) {
        $formData = $data->get('formData');
        $fdata = (array)$formData;
                
        $table = JTable::getInstance('payment');
        $table->bind($fdata);
        $table->store();
        parent::setState($data);        
        
        
    }
}
?>