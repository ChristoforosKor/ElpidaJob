<?php

/*------------------------------------------------------------------------
# com_elgalocrm - e-logism aluminum salesmen joomla component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/


JFormHelper::loadFieldClass('hidden');

class JFormFieldHiddenLang extends JFormFieldHidden {
   
    public $type = 'HiddenLang';
    
    
    public function getInput() {
        $this->setValue(JFactory::getLanguage()->getTag());
        return parent::getInput();
    }
        
    
}

?>
