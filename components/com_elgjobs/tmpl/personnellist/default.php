<?php

/**
 * @package     ELG.Jobs.site
 * @subpackage  com_elgjob
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence
 */

 // No direct access to this file

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die('Restricted Access'); ?>

   <div class="search_results_header">
                            <div class="filters_mob_button"><i class="fa fa-filter" aria-hidden="true"></i> Φίλτρα</div>
                            <div class="search_results_ordering">
                                <span><?php echo Text::_('COM_ELGJOBS_ORDER_BY'); ?>:</span>
                                <div class="select_container">
                                    <select id="orderingSelection" name="list[fullordering]">
                                        <option <?php echo ( $this->fullOrdering == 'created des' ?  ' selected="selected" ': ''); ?> value="created desc"><?php echo Text::_('COM_ELGJOBS_ORDER_BY_NEW_TO_LAST'); ?></option>
                                        <option <?php echo ( $this->fullOrdering == 'modified desc' ?  ' selected="selected" ': ''); ?>  value="modified desc"><?php echo Text::_('COM_ELGJOBS_ORDER_BY_MODIFIED_LAST_TO_FIRST'); ?></option>
                                        <?php if( $this -> user ->authorise('core.edit', 'com_elgjobs') ): ?>
                                            <option <?php echo ( $this->fullOrdering == 'lastOfficeVisit desc' ?  ' selected="selected" ': ''); ?>  value="lastOfficeVisit desc"><?php echo Text::_('COM_ELGJOBS_CANDIDATE_LAST_VISIT'); ?></option>
                                        <?php endif; ?>
                                    </select> 
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
  <div class="search_results" id="searchJobResults"></div>
  
   
  <div class="pagination" arial-label="<?php echo Text::_('JLIB_HTML_PAGINATION'); ?>" ></div>
  <?php
        if( $this -> user ->authorise('core.edit', 'com_elgjobs') ): ?>
                <div class="personnelContactContainer">

                    <div class="mt-2 mb-2 mt-sm-3 mb-sm-3 d-flex">
                        <a href="/epexergasia-prosopikou.html/?task=personnel.edit" class="button button_filled bg_blue"><?php  echo Text::_('COM_ELGJOBS_NEW_RECORD');?></a>
                    </div>
                </div>
    <?php endif; ?>

  
  <div id="aggeliaModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

 <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Προσωπικά στοιχεία</h4>
            <button id ="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="messageArea"></div>
        </div>
        <!-- <form method="post" action="/groupcallkomy.json" id="eodyDataForm"> -->
        <form name="interestForm"  method="post" enctype="multipart/form-data" > 
            <div class="modal-body">
               <input type="hidden" name="notifyUrl" id="notifyUrl"/>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p>Συμπληρώστε τα στοιχεία σας και θα επικοινωνήσουμε το συντομότερο</p>
                        <div class="input_container">
                            <label id="notifyfullname-lbl" for="notify_fullname">Ονοματεπώνυμο</label>
                            <div class="input" >
                                <input type="text" id="notify_fullname" name="notify[fullname]" class="form-control" >                           
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input_container">
                            <label id="notifytelephone-lbl" for="notify_telephone">Τηλέφωνο</label>
                            <div class="input" >
                                <input type="text" id="notify_telephone" name="notify[telephone]" type="tel" class="form-control" >                           
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="input_container">
                            <label id="notifyemail-lbl" for="notify_email">E-mail</label>
                            <div class="input" >
                                <input type="text" id="notify_email" name="notify[email]" type="email" class="form-control" >                           
                            </div>
                        </div>
                    </div>
                   
                    <div class="response"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id ="cancel1" type="button" class="button button_outlined dark" data-bs-dismiss="modal">Ακύρωση</button>
                <button type="button" id="notifyJob" class="button button_filled bg_blue">Καταχώρηση</button>
            </div>
        </form>
    </div>

  </div>