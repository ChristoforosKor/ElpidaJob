<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

 
----------------------------------**/

 defined( '_JEXEC' ) or die( 'Restricted access' );
 require_once JPATH_COMPONENT . '/models/employeredit.php';
 
 class ElgergasiaModelEmployerSave extends JModelDatabase{ 
    
   private $table = null;
   private $userTable = null;
   private $form = null;
  
   public function __construct() {
       parent::__construct();       
       $this->table = JTable::getInstance('employer');
       $this->userTable =  new JTableUser($this->getDb());
       $this->form = JForm::getInstance('employer', JPATH_COMPONENT . '/models/forms/employer.xml');
  }  
   
   
    public function setState(JRegistry $state) {
        $toUpper = array (
           
            'city'=>array('upper'), 
            'address'=>array('upper'), 
            'postalCode'=>array('upper', 'nowhitespace'), 
            'website'=>array('lower', 'nowhitespace'), 
            'email'=>array('lower'), 
            'phone'=>array('upper','nowhitespace'),
            'mobile'=>array('upper','nowhitespace'), 
            'fax'=>array('upper','nowhitespace'), 
            'taxNumber'=>array('upper','nowhitespace'), 
            'taxOffice'=>array('upper'), 
            'profession'=>array('upper'), 
            'discreteTitle'=>array('upper'), 
            'name'=>array('upper'), 
            'profession'=>array('upper')
            
            );
        $data =  CommonUtils::normData($state->get('formData'), $toUpper);
        $validData = $this->form->validate($data);
        if ($validData === false) {
            $state->set('errors', $this->form->getErrors());
        }     
        else 
        {
            $user = JFactory::getUser($data->idUser); 
            $user->email =  $data->email;
            $user->name = $data->name;
            if(!$user->save(true)) {
                $state->set('errors',array(new UnexpectedValueException($user->getError(), 602)));
            }
            else {
                $this->table->bind($data);
                $this->table->store();
                $this->state->set('newId', $this->table->id);
                $data2Store = (array) $data;
                $input = JFactory::getApplication()->input;
                $language = $input->get->post->getString('language');
                $data2Store['language'] = $language;
                //$state->set('idUser', $this->table->idUser);
            Translations::saveTranslation('employertranslation', '#__elg_ergasia_employer_translation', $this->table->id, 'idEmployer', $data2Store);
            }          
        }
        parent::setState($state);
    }
 
 }
?>