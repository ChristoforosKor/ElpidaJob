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
    
 class ElgergasiaViewElgergasia extends JViewHTML{

    
    public function render() {
         JFactory::getApplication() -> redirect('http://elpidajob.gr');
    }
    
 }

