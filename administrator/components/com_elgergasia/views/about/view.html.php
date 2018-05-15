<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.com
# Technical Support: http://www.e-logism.gr/index.php?main_page=contact_us&zenid=5q08u7hbg8f4eitc4hb8dfmlq5
 
----------------------------------**/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

require_once (JPATH_COMPONENT_ADMINISTRATOR . '/libraries/e-logism/joomla/XMLJoomlaFunctions.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR . '/libraries/e-logism/joomla/JoomlaUtilities.php');

class elgergasiaViewAbout extends JViewLegacy {
    function display($tpl = null) {
        $descr = JText::_('COM_ELGERGASIA_DESCRIPTION');
        $logoImage = JURI::base() . "components/" . JRequest::getWord("option") . "/libraries/e-logism/images/logo.png";
        $xmlFile = JPATH_COMPONENT_ADMINISTRATOR . '/' . JRequest::getWord("option") .".xml";
          $this->canDo = elgergasiaHelper::getActions();
        if (count($errors = $this->get('Errors'))) 
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        $this->addToolBar();
        $this->setDocument();
        
       
        $xml = new XmlJoomlaFunctions();
        $xml->loadFile($xmlFile);
        $this->assignRef('authorUrl',$xml->authorUrl);
        $this->assignRef('logoImage',$logoImage);
        $this->assignRef('version', $xml->version);
        $this->assignRef('creationDate', $xml->creationDate);
        $this->assignRef('copyright', $xml->copyright);
        
        $this->assignRef('description',$descr );
        $this->assignRef('author', $xml->author);
        $this->assignRef('authorEmail', $xml->authorEmail);
        parent::display($tpl);
    }
    
     /**
    * setting the toolbar.
    */
    protected function addToolBar() 
    {
        JToolBarHelper::title(JText::_('COM_ELGERGASIA_ABOUT') . ': <small><small>[ ' . JText::_('COM_ELGERGASIA_EXTNAME') . ' ]</small></small>', substr(JRequest::getWord("option"), 4) );
        if($this->canDo->get('core.admin'))
        {
            JToolBarHelper::divider();
            JoomlaUtilities::getOptionsToolbar();
        } 
        
    }
    
    
    /**
     * Method to set up the document properties
    *
    * @return void
    */
    protected function setDocument()
    {
        $doc = JFactory::getDocument();
        $doc->setTitle(JText::_('COM_ELGERGASIA_ADMINISTRATION_ABOUT'));
        $doc->addStyleSheet( 'components/elgergasia/libraries/e-logism/joomla/styles/styles.css' );
       
    }

}