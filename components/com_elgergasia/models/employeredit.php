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
 require JPATH_COMPONENT_SITE . '/libraries/joomla/models/translations.php';
 
 class ElgergasiaModelEmployerEdit extends JModelDatabase { 
    
   private $table = null;
   private $form = null;
   
   public function __construct() {
       $this->table = JTable::getInstance('employer');
       $this->form = JForm::getInstance('employer', JPATH_COMPONENT . '/models/forms/employer.xml');
       parent::__construct();       
   }  
   
    function getState() {
      
      $state = parent::getState();
      $language =  $state->get('language', JFactory::getLanguage()->getTag());
      $idUser = $state->get('id');
      //$id = $state->get($idUser);
      $this->table->load(array('idUser'=>$idUser));
      $tableTranslation = JTable::getInstance('employertranslation');
      $tableTranslation->load(array('idEmployer'=>$this->table->id, 'language'=>$language));
      $user = JFactory::getUser($idUser);
      $this->form->bind($this->table);
      $this->form->bind($tableTranslation);
      $this->form->setValue('email', null, $user->email);
      $this->form->setValue('name', null, $user->name);
      $this->form->setValue('idUser', null, $idUser);
      if($this->form->getValue('language') == null)
      {
          $this->form->setValue('language', null, $language);
      }
      $state->set('form',$this->form);
      $translations = Translations::getTranslatedLanguages("#__elg_ergasia_employer_translation", ($this->table->id == null ? 0 : $this->table->id), 'idEmployer');
      $state->set('translatedLanguages', $translations);
      $state->set('employerTranslation', $tableTranslation);
      return $state;
    }
     
   
    
}
?>