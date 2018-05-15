<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

 defined( '_JEXEC' ) or die( 'Restricted access' );
 require_once JPATH_COMPONENT_SITE . '/models/datautils.php';
 
 class ElgergasiaModelPayments extends JModelDatabase{ 
     
    function getState() {
        $state = parent::getState();
        $filters =  DataUtils::getFiltersData();//$state->get('filters');
       
        $db = $this->getDb();
        $query = $db->getQuery(true);
        $query->select("p.id, idUser, " . $db->quoteName("name") . ", p.payment, p.payDate")
                ->from ("#__elg_ergasia_payment p")
                ->join('inner', '#__users u on p.idUser = u.id' . ($filters->idUser > 0? ' and p.idUser = ' . $filters->idUser : ''))
                ->order($filters->filter_order . ' ' . $filters->filter_order_Dir);
        if(trim($filters->dateFrom) != '') {
            $query->where(" p.payDate >= '" . $filters->dateFrom . "%'");
        }
        if(trim($filters->dateTo) != '') {
            $query->where(" p.payDate <= '" . $filters->dateTo . "%'");
        }
        $db->setQuery($query, $filters->limitstart, $filters->limit);
       
        $state->set('data', $db->loadObjectList());
        $query->clear('order');
        $query->clear('select');
        $query->select('count(distinct p.id)');
        $db->setQuery($query);
        $totalRecords =  $db->loadResult();
        $pagination = CommonUtils::getPagination($totalRecords, $filters->limitstart, $filters->limit);
        $state->set('pagination', $pagination);
        $form = JForm::getInstance('jobsquicksearch', JPATH_COMPONENT_SITE . '/models/forms/payment.xml');       
        $form->setValue('idUser', null, $filters->idUser);
        $form->setValue('dateFrom', null, $filters->dateFrom);
        $form->setValue('dateTo', null, $filters->dateTo);
        $state->set('form', $form);
        return $state;
    }
    
}
?>