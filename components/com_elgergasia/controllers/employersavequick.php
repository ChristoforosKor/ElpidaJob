<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );

class ElgergasiaControllerEmployerSaveQuick extends JControllerBase{
   
    public function execute() {
        
        $resp = new stdClass();
        try {
            
            $userTable =  new JTableUser(JFactory::getDbo());
            $userTable -> email = 'employerjob+emp' . time() . '@gmail.com';
            $userTable -> name = ComponentUtils::normData( $this-> input -> getString('name', ''), ['nogreekaccent', 'siglewhitespace', 'similar2Greek', 'escapeQuotes', 'upper']) ;
            $userTable -> username = ComponentUtils::normData($userTable -> name, ['nowhitespace']) . '_'. time();
            $userTable->password = '1234';
            $userTable->store();
            $table = JTable::getInstance('employer');
            $table2 = JTable::getInstance('employertranslation');
            $table->idUser =  $userTable -> id;
            $table->idIndustry =  $this-> input -> getInt('idIndustry', null);
            $table->phone =  $this-> input -> getString('phone', '');
            $table->mobile =  $this-> input -> getString('mobile', '');
            $table->store();
            $table2->idEmployer = $table->id;
            $discreteTitle =( ComponentUtils::normData( $this-> input -> getString('discreteTitle', ''), ['nowhitespace']) === '' ? $userTable -> name : ComponentUtils::normData($this-> input -> getString('discreteTitle', ''), ['upper', 'siglewhitespace', 'trim', 'nogreekaccent', 'similar2Greek', 'escapeQuotes']) );
            $table2->discreteTitle = $discreteTitle;           
            $table2->city =  ComponentUtils::normData($this-> input -> getString('city', ''), ['upper', 'siglewhitespace', 'trim', 'nogreekaccent', 'similar2Greek', 'escapeQuotes']);
            $table2->address =  ComponentUtils::normData( $this-> input -> getString('address', '') , ['upper', 'siglewhitespace', 'trim', 'nogreekaccent', 'similar2Greek', 'escapeQuotes']);
            $table2->language =  $this -> input->get->post->getString('language', 'el-GR');
            $table2->isDefault = 1;
            $table2->store();
            
            $resp -> error = '';
            $resp -> id = $userTable -> id;
            $resp -> text = $table2 -> discreteTitle . ' - ' . $table -> phone;
        } catch (Exception $ex) {
            $resp -> error = $ex->getMessage();
            $resp -> id = '';
            $resp -> text = $this-> input -> getString('discreteTitle', '') . ' - ' . $this-> input -> getString('phone', '');
        }
        echo json_encode($resp);
        exit();
    } 
}
