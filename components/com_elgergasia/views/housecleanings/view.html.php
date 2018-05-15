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
            
   class ElgErgasiaViewHouseCleanings extends ViewHTML
   {
        public function render() {
            $this->houseCleanings = $this->state->get('data')['houseCleanings'];
            $this->canUserEdit = ComponentUtils::canUserEditData(JFactory::getUser());
            $this->editUrl = JRoute::_('index.php?option=com_elgergasia&Itemid=297&id=#id');
            return parent::render();
        }
   }
