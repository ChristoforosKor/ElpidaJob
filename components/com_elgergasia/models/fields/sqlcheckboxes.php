<?php

/*------------------------------------------------------------------------
# com_elgalocrm - e-logism aluminum salesmen joomla component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
JFormHelper::loadFieldClass('checkboxes');
class JFormFieldSQLCheckboxes extends JFormFieldCheckboxes {
    public $type = 'SQLCCheckboxes';
    protected function getOptions() {
        $key = $this->element['key_field'] ? (string) $this->element['key_field'] : 'value';
	$value = $this->element['value_field'] ? (string) $this->element['value_field'] : (string) $this->element['name'];
        $class = $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
        $query = (string) $this->element['query'];
        $db = JFactory::getDbo();
        $db->setQuery($query);
        $items = $db->loadObjectlist();
        if(!empty($items)) {
            $options = array();
            foreach($items as  $item) {
                $options[] = JHtml::_('select.option', $item->$key, $item->$value);
              
            }
            unset($item);
        }
        $options = array_merge(parent::getOptions(), $options);
        return $options;
    }
}
?>
