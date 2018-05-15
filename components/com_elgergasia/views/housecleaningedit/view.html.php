<?php
/**
 * e-logism's com_ElgBetStatsAnalytics.
 * @copyright (C) 2014-2015, e-logism.
 * 
 */
 
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT . '/libraries/php/joomla/e-logism/views/viewhtml.php';
 /**
  
  * @package e-logism.joomla.com_elgcomponents.site
  * @subpackage views
  * @author Christoforos J. Korifidis.
  * 
  */
            
   class ElgErgasiaViewHouseCleaningEdit extends ViewHTML
   {
        public function render() {
            $this->hcForm = $this->state->get('forms')['houseCleaning'];
            $this->saveUrl = JRoute::_('index.php?option=' . $this->option . '&Itemid=298') . '?format=json';
             $this->canUserEdit = ComponentUtils::canUserEditData(JFactory::getUser());
            return parent::render();
        }
   }
