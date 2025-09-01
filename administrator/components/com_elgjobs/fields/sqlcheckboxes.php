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
        $lang = JFactory::getLanguage()->getTag();
        $key = $this->element['key_field'] ? (string) $this->element['key_field'] : 'value';
	$value = $this->element['value_field'] ? (string) $this->element['value_field'] : (string) $this->element['name'];
        //$class = $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
        $query = (string) $this->element['query'];
        $query = str_replace('{language}', "language ='" . $lang . "'", $query);
        $db = JFactory::getDbo();
        $db->setQuery($query);
        $items = $db->loadObjectlist();
        $options = array();
        if(!empty($items)) {
            
            foreach($items as  $item) {
                $tmp = new stdClass(); // JHtml::_('select.option', $item->$key, $item->$value );
                $tmp->checked = '';
                $tmp->class = '';
                $tmp->disabledd = '';
                $tmp->onchange = '';
                $tmp->onlick = '';
                $tmp->text = $item->$value;
                $tmp->value = $item->$key;
                $options[] = $tmp;
              
            }
            unset($item);
        }

        $options = array_merge(parent::getOptions(), $options);
        return $options;
    }
}
?>
