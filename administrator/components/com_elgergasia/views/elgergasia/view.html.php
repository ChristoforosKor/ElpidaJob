<?php
 defined( '_JEXEC' ) or die( 'Restricted access' );
    jimport( 'joomla.application.component.view');
    
 class elgergasiaView extends JView{

      function display($tpl = null) {
          
          $elgergasiaHTML = "html";
          $this->assignRef( 'ajHTML', $elgergasiaHTML );
          parent::display($tpl);
      }
 }
?>
