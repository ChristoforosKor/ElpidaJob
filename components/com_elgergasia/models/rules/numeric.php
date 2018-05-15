<?php


defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.form.formrule');

class JFormRuleNumeric extends JFormRule {
        
    public function test(& $element, $value, $group = null, & $input = null, & $form = null) {
        if(is_numeric($value)) {
            return true;
        }
        else {
            return false;
        }
    }

}
