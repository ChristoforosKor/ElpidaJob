<?php

/*------------------------------------------------------------------------
# com_elgalocrm - e-logism aluminum salesmen joomla component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/


JFormHelper::loadFieldClass('sql');

class JFormFieldSQLLang extends JFormFieldSQL {
   
    public $type = 'SQLLang';
        
        

    protected function getOptions() {
        $query = $this->element['query'];
        $lang = JFactory::getLanguage()->getTag();
        $query = str_replace('{language}', " language = '" . $lang . "'", $query);
        $this->query =  $query ;
        return  parent::getOptions();        
    }
}

?>
