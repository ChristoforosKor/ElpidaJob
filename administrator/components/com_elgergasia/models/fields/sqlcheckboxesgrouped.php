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
class JFormFieldSQLCheckboxesGrouped extends JFormFieldCheckboxes {
    public $type = 'SQLCCheckboxesGrouped';
    protected function getOptions() {
        $lang = JFactory::getLanguage()->getTag();
        $key = $this->element['key_field'] ? (string) $this->element['key_field'] : 'value';
	$value = $this->element['value_field'] ? (string) $this->element['value_field'] : (string) $this->element['name'];
        $groupKey =  $this->element['group_field'] ? (string) $this->element['group_field'] : '';
        $query = (string) $this->element['query'];
        $query = str_replace('{language}', "language ='" . $lang . "'", $query);
        
        $db = JFactory::getDbo();
        $db->setQuery($query);
        $items = $db->loadObjectlist();
        if(!empty($items)) {
            $options = array();
            
            foreach($items as  $item) {
                //$options[$item->$groupKey][] = JHtml::_('select.option', $item->$key, $item->$value);
                $tmp = new stdClass(); // JHtml::_('select.option', $item->$key, $item->$value );
                $tmp->checked = '';
                $tmp->class = '';
                $tmp->disabled = '';
                $tmp->onchange = '';
                $tmp->onlick = '';
                $tmp->text = $item->$value;
                $tmp->value = $item->$key;
                $options[$item->$groupKey][] = $tmp;
            }
            unset($item);
        }
        $options = array_merge(parent::getOptions(), $options);
       
        return $options;
    }
    
    
    protected function getInput()
	{
		$html = array();

		// Initialize some field attributes.
		$class = $this->element['class'] ? ' class="checkboxes ' . (string) $this->element['class'] . '"' : ' class="checkboxes"';
		$checkedOptions = explode(',', (string) $this->element['checked']);
                
                
		// Start the checkbox field output.
		$html[] = '<fieldset id="' . $this->id . '"' . $class . '>';

		// Get the field options.
		$options = $this->getOptions(); 
                // Get the groups.
                $groups = array_keys($options);
                if(count($options) > 0) {
                    $gN = -1;
                    // Build the checkbox field output.
                   
                    foreach($groups as $group) {    
                        
                        $html[] = '<div class="checkboxes-group g' . ++ $gN . '" ><div class="elg-label">' . $group . '</div>';
                        $html[] = '<ul>';
                        foreach ($options[$group] as $i => $option)
                        {
                                
                                // Initialize some option attributes.
                                if (!isset($this->value) || empty($this->value))
                                {
                                        $checked = (in_array((string) $option->value, (array) $checkedOptions) ? ' checked="checked"' : '');
                                }
                                else
                                {
                                        $value = !is_array($this->value) ? explode(',', $this->value) : $this->value;
                                        $checked = (in_array((string) $option->value, $value) ? ' checked="checked"' : '');
                                }
                                $class = !empty($option->class) ? ' class="' . $option->class . '"' : '';
                                $required = !empty($option->required) ? ' required="required" aria-required="true"' : '';
                                $disabled = !empty($option->disable) ? ' disabled="disabled"' : '';

                                // Initialize some JavaScript option attributes.
                                $onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';

                                $html[] = '<li>';
                                $html[] = '<input type="checkbox" id="' . $this->id . $i . '" name="' . $this->name . '" value="'
                                        . htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $checked . $class . $onclick . $disabled . $required . '/>';

                                $html[] = '<label for="' . $this->id . $i . '"' . $class . '>' . JText::_($option->text) . '</label>';
                                $html[] = '</li>';

                        }
                        unset($i);
                        unset($option);
                        $html[] = '</ul></div>';
                    }
                    unset($group);
                }
		// End the checkbox field output.
		$html[] = '</fieldset>';

		return implode($html);
	}

}
?>
