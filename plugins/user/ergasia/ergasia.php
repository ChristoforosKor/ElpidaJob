<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  User.profile
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
jimport('joomla.application.component.helper');
require JPATH_SITE . '/components/com_elgergasia/models/datautils.php';
/**
 * An example custom profile plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  User.profile
 * @since       1.6
 */
class plgUserErgasia extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
            
		parent::__construct($subject, $config);
		$this->loadLanguage();
//		JFormHelper::addFieldPath(__DIR__ . '/fields');
                
	}

	

	/**
	 * @param   JForm	$form	The form to be altered.
	 * @param   array  $data	The associated data for the form.
	 *
	 * @return  boolean
	 * @since   1.6
	 */
        public function onContentPrepareForm($form, $data) {
			
            $inp = JFactory::getApplication()->input;
            $location = $inp->getString('location');
            JForm::addFormPath(__DIR__ . '/ergasia');
            $form->loadFile('ergasia', false);
			
            $form->setValue('formlocation', null, $location);
        }
	
        
	public function onUserAfterSave($data, $isNew, $result, $error) {
            $params = JComponentHelper::getParams('com_elgergasia')->get('params');
           
            if($isNew) {
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $db->setQuery($query);
                $app = JFactory::getApplication();
                $Itemid = $app->getMenu()->getActive()->id;
                $newGroup = 0;
                $regType = 0;
                
                if( $Itemid === '217' || $Itemid === '230' || $Itemid === '220'/**$menu == $this->params->get('menu_register_candidate', 0)**/ ) {
                    $newGroup = $this->params->get('group_candidate', 0);
                    $regType =1;
                }
                elseif($Itemid === '218' || $Itemid === '234' || $Itemid === '225' /** $menu == $this->params->get('menu_register_employer', 0) **/ ) {
                    $newGroup = $this->params->get('group_employer', 0);
                    $regType = 2;
                }
                
                if($newGroup != 0) {
                    $user = JFactory::getUser($data['id']);
                    if(!in_array($newGroup, $user->groups))
                    {
                        $o = new stdClass();
                        $o->group_id = $newGroup;
                        $o->user_id = $user->id;
                      
                        $db->insertObject('#__user_usergroup_map', $o);
                        
                    }
                    
                    $param = '';
                    $u = JUri::getInstance();
                    
                    
                    $qs = $u->getQuery(true);
                    unset($qs['task']);
                    unset($qs['controller']);
                    switch($regType)
                    {
                        case 1 : $param = 'candidatesMenu';
                            $qs['option'] = 'com_elgergasia';
                            $qs['view']= 'candidate';
                            $qs['layout'] = 'candidate';
                           // $qs['idUser'] = $user->id;
                            $qs['id'] = $user->id;
                            $Itemid = DataUtils::getLanguageItemid($db, $this->params->get('canidate_menu', 196), JFactory::getLanguage()->getTag());
                            $qs['Itemid'] = $Itemid;
                            //$u->setQuery($u->buildQuery($qs));
                            // $url = JRoute::_($u->toString(), false);
                            break;
                        case 2 : $param = 'employersMenu';
                            $qs['option'] = 'com_elgergasia';
                            $qs['view']= 'employeredit';
                            unset($qs['layout']);
                            $qs['id'] = $user->id;
                            $Itemid = DataUtils::getLanguageItemid($db, $this->params->get('employer_menu', 203), JFactory::getLanguage()->getTag());
                            $qs['Itemid'] = $Itemid;
                            //$u->setQuery($u->buildQuery($qs));
                            break;
                    }
                    
                    $currentUser = JFactory::getUser();
                    $currentGrps = $currentUser->getAuthorisedGroups();
                    $cBas = new stdClass();
                    $cBas->idState = 1;
                    if(in_array($params->officeTeam,$currentUser->getAuthorisedGroups()))
                    {
                        
                        $cBas->idUser = $user->id;
                        $db = JFactory::getDbo();
                        $db->updateObject('#__elg_ergasia_candidate_basic', $cBas, 'idUser');
                        //JFactory::getApplication()->redirect($url);
                        //$app->redirect(JRoute::_(implode('&', $qs)));
                        $url = http_build_query($qs, '&');
                    }
                    else
                    {
                        $credential = array('username'=>$user->username,  'password'=>$data['password_clear']);
                        $res = $app->login($credential);
                        if(!$res)
                        {
                            $url = 'index.php';
                        }
                        else
                        {
                            $url = http_build_query($qs, '', '&');//implode('&', $qs);
                        }
                    }    
                    
                    if( $url != '')
                    {
                        //$app->redirect($url);
                       // $app->redirect(JRoute::_('?' . $url));
                        // $app->redirect(JRoute::_('index.php?option=' . $qs['option'] . '&Itemid=' . $qs['Itemid'] . '&view=' . $qs['view'] . '&id=' . $qs['id']), false);
                        $app->redirect('index.php?' . $url /**'index.php?option=' . $qs['option'] . '&Itemid=' . $qs['Itemid'] . '&view=' . $qs['view'] . '&id=' . $qs['id']**/);
                    }
                    else
                    {
                        $app->redirect(JRoute('index.php', false));
                    }
                    
                    
                    
                }
            }            
	}
        

	/**
	 * Remove all user profile information for the given user ID
	 *
	 * Method is called after user data is deleted from the database
	 *
	 * @param   array  $user		Holds the user data
	 * @param   boolean		$success	True if user was succesfully stored in the database
	 * @param   string  $msg		Message
	 */
	public function onUserAfterDelete($user, $success, $menu) {}
        
        
        
}
