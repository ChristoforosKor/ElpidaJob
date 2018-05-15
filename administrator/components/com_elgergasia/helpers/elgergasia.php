<?php
/**
 * @author e-logism
 * @copyright (c) e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @created 1.0.0 2012-10-24
 * */
defined('_JEXEC') or die;
abstract class elgergasiaHelper
{
        /**
         * Configure the Linkbar.
         */
//        public static function addSubmenu($submenu) 
//        {
//                JSubMenuHelper::addEntry(JText::_('COM_HELLOWORLD_SUBMENU_MESSAGES'),
//                                         'index.php?option=com_helloworld', $submenu == 'messages');
//                JSubMenuHelper::addEntry(JText::_('COM_HELLOWORLD_SUBMENU_CATEGORIES'),
//                                         'index.php?option=com_categories&view=categories&extension=com_helloworld',
//                                         $submenu == 'categories');
//                // set some global property
//                $document = JFactory::getDocument();
//                $document->addStyleDeclaration('.icon-48-helloworld ' .
//                                               '{background-image: url(../media/com_helloworld/images/tux-48x48.png);}');
//                if ($submenu == 'categories') 
//                {
//                        $document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION_CATEGORIES'));
//                }
//        }
 
        /**
         * Get the actions
         * @todo what is messageId and if I need it.
         * @todo what is $assetName and if I need it.
         */
        public static function getActions($messageId = 0)
        {       
                jimport('joomla.access.access');
                $user   = JFactory::getUser();
                $result = new JObject();
                if (empty($messageId)) {
                        $assetName = 'com_elgergasia';
                }
                else {
                        $assetName = 'com_elgergasia.message.'.(int) $messageId;
                }
 
                $actions = JAccess::getActions('com_elgergasia', 'component');
 
                foreach ($actions as $action) {
                        $result->set($action->name, $user->authorise($action->name, $assetName));
                }
                return $result;
        }
}
?>
