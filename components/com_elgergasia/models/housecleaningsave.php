<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class ElgErgasiaModelHouseCleaningSave extends JModelDatabase
{    
    public function setState(JRegistry $state) 
    {
        
        $submData = $state->get('submData');    
        $submData['idExtraInfo'] = implode(',', $submData['idExtraInfo']);
        $table = JTable::getInstance('cleaning');
        $table->bind($submData);
        $table->store();        
        $this->sendNotification($table);
    }
    
    private function sendNotification($table)
    {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->FromName = 'ELPIDA JOB';
        $mail->From = 'info@elpidajob.gr';
        $mail->Body = $table->area_description . '<br /><a href="http://elpidajob.gr/' . JRoute::_('index.php?option=com_elgergasia&Itemid=297&id=' . $table->id ) . '" >Προβολή</a>';
        $mail->Subject = JText::_('COM_ELG_ERGON_NOTIFICATION_HOUSE_CLEANINGSUBJECT') ;
        $mail->IsHTML();  
        $mail->AddAddress('info@elpidajob.gr');
        $mail->Send();
        $mail->ClearAddresses();
        
    }
}