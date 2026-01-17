<?php
/**
 * @package     ELG.Jobs.site
 * @subpackage  com_elgjob
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
/**
 * @todo "Διαθεσιμότητα συγκεκριμένες ώρες/ημέρες" να κονονικοποιηθεί στη βάση., "Ειδικότητες" κλπ μεταφράσιμα
 */

// $name = $this -> item['name'] ." ". substr($this -> item['lastname'],1,1);
// var_dump($this ->item);exit;

?>

<div class="personnelContainer <?php if (isset($this->item['idState']) && $this ->item['idState'] == 1 ) {?> active full"> 
                                <?php } else if ($this ->item['idState'] == 2) { ?> active semi"> 
                                <?php } else { ?> inactive">
                                <?php } ?>
                                
                                 

                <div class="personnelDetailsContainer">

                    <div class="personnelDetailsContainerLeft">

                        <div class="personnelDetailsHeader">
                            <div class="personnelDetailsPerson userListTile">
                                <div class="userListTileImg">
                                    <?php if (isset($this->item["sortname2"]) && $this->item["sortname2"] ==1 && $this -> item['image'] !== "" && $this -> item['image'] !== null ) { ?>
                                    <img src="/<?php 
                                     echo str_replace("_small", "_medium", $this -> item['image']) ; ?>" >
                                     <?php } else {?>
                                    <img src=/images/default_user.jpg>
                                    <?php } ?>
                                    <div class="overlayUserImg"></div>
                                </div>
                                <div class="userListTileTxt">
                                    <h4><?php echo $this -> item['name']," ", mb_substr($this -> item['lastname'],0,1),"."; ?></h4>
                                    <?php if ( $this -> isAuthorised == 1)  :  ?>
                                    <p class="location">
                                        <?php echo $this -> item['address'] ; ?></p><p>
                                        <?php echo $this -> item['telephone'] . ' ' .  $this -> item['mobile']  . ' ' .  $this -> item['fax'] ; ?>
                                    </p>
                                    <?php  
                                    
                                        if ($this->item['lastOfficeVisit'] != '' ): 
                                            echo '<p>', Text::_('COM_ELGJOBS_CANDIDATE_LAST_VISIT'), ': <strong>', (new DateTime($this->item['lastOfficeVisit'])) -> format('d/m/Y'), '</strong></p>';
                                        endif; ?>
                                    <?php
                                        if ($this->item['idInsurance'] != '' ):
                                            echo '<p>', Text::_('COM_ELGJOBS_INSURANCE'), ': <strong>', $this->item['insurance'], '</strong></p>';
                                        endif; ?>
                                    <?php
                                        if ( $this->item['idRecommentation'] == 1  ):
                                            echo '<p><strong>', Text::_('COM_ELGJOBS_CANDIDATE_RECOMENDATION_AVAILABLE_DESC'), '</strong></p>';
                                    endif; ?>
                                                 
                                <?php endif; ?>
                                    <p class="availability">
                                        <?php if (isset($this ->item['idState']) && $this ->item['idState'] == 1 ) {?> Άμεση διαθεσιμότητα 
                                        <?php } else if (isset($this ->item['idState']) && $this ->item['idState'] == 2) { ?> Διαθεσιμότητα συγκεκριμένες ώρες/ημέρες 
                                        <?php } else { ?> Μη διαθέσιμος
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                            <div class="presonnelDetailsStats">
                                <div class="presonnelDetailsStat stat-recommendations">
                                    <h3><?php echo $this -> item['likes']; ?></h3>
                                    <p>προτείνουν</p>
                                </div>
                                <div class="presonnelDetailsStat stat-comments">
                                    <h3><?php echo count($this -> comments); ?></h3>
                                    <p>σχόλια</p>
                                </div>
                                <div class="presonnelDetailsStat stat-hired">
                                    <h3>37</h3>
                                    <p>προσλήψεις</p>
                                </div>
                            </div>
                        </div>


                        <div class="personnelDetails">
                            <div class="personnelDetailsBlocks">
                                <?php if ( count( $this -> item['specialities']) > 0 ): ?>
                                <div class="personnelDetailsBlock">
                                    <h5 class="personnelDetailsTitle">Ειδικότητες</h5>
                                    <div class="personnelDetailsContent">
                                        <?php foreach($this -> item['specialities'] as  $speciality):?>
                                            <div class="chip"><?php echo $speciality; ?></div>
                                        <?php endforeach; unset($speciality); ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ( count( $this -> item['candidateHours']) > 0 ): ?>
                                <div class="personnelDetailsBlock">
                                    <h5 class="personnelDetailsTitle">Είδος απασχόλησης</h5>
                                    <div class="personnelDetailsContent">
                                        <?php foreach($this -> item['candidateHours'] as $hour ): ?>
                                            <div class="chip"><?php echo $hour; ?></div>
                                        <?php endforeach; unset( $hour); ?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if ( count( $this -> item['specialNeeds']) > 0 ): ?>
                                <div class="personnelDetailsBlock">
                                    <h5 class="personnelDetailsTitle">Έξτρα χαρακτηριστικά</h5>
                                    <div class="personnelDetailsContent">
                                        <?php foreach($this -> item['specialNeeds']  as $specialNeed): ?>
                                        <div class="chip"><?php echo $specialNeed; ?> </div>
                                        <?php endforeach; unset($specialNeed); ?>
                                        
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>



<div class="seperator-l"></div>

 <?php if ( $this -> isAuthorised == 1  and isset($this -> item['documents']) ) : 
     
	$documents = explode(",", $this -> item['documents']);
        $idDocuments = explode(",", $this -> item['idDocuments']); ?>
<div class="personnel-files">
        <?php for ( $i = count($documents) -1; $i > -1; $i-- ): 
            
            ?>
<span class="bg-info d-inline"><a href="<?php echo str_replace(JPATH_SITE, '', $documents[$i]); ?>" class="isFile" target="_blank" data-id="<?php echo $idDocuments[$i]; ?>" data-file="<?php echo $documents[$i];?>" ><?php echo basename($documents[$i]); ?></a> <a class="badge bg-warning a-delete">X</a></span>
        <?php endfor; ?>
</div>
<?php endif; ?>
                        <div class="seperator-l"></div>

                    

                        <div class="personAvailabilityContainer">
                            <h5 class="personnelDetailsGeneralTitle">ΔΙΑΘΕΣΙΜΟΤΗΤΑ</h5>
                            <div class="personAvailabilityContainerIn">

                                <div class="personAvailabilityBlock allHours">
                                    <h6>ΚΥΡΙΑΚΗ</h6>
                                    <div class="personAvailabilityHours">
                                        <div class="personAvailabilityHour">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="personAvailabilityBlock allHours">
                                    <h6>ΔΕΥΤΕΡΑ</h6>
                                    <div class="personAvailabilityHours">
                                        <div class="personAvailabilityHour">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="personAvailabilityBlock allHours">
                                    <h6>ΤΡΙΤΗ</h6>
                                    <div class="personAvailabilityHours">
                                        <div class="personAvailabilityHour">
                                             <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="personAvailabilityBlock allHours">
                                    <h6>ΤΕΤΑΡΤΗ</h6>
                                    <div class="personAvailabilityHours">
                                        <div class="personAvailabilityHour">
                                             <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="personAvailabilityBlock allHours">
                                    <h6>ΠΕΜΠΤΗ</h6>
                                    <div class="personAvailabilityHours">
                                        <div class="personAvailabilityHour">
                                             <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="personAvailabilityBlock allHours">
                                    <h6>ΠΑΡΑΣΚΕΥΗ</h6>
                                    <div class="personAvailabilityHours">
                                        <div class="personAvailabilityHour">
                                             <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="personAvailabilityBlock allHours">
                                    <h6>ΣΑΒΒΑΤΟ</h6>
                                    <div class="personAvailabilityHours">
                                        <div class="personAvailabilityHour">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>



                        <div class="seperator-l"></div>



                        <div class="bioAndMapMobile"></div>


                   
                    <div class="personnelComments">
                            <h5 class="personnelDetailsGeneralTitle commentsHeader">
                                <div>ΣΧΟΛΙΑ <span class="comment-badge"><?php echo count($this -> comments); ?></span></div>
                                <div class="postComment noselect" data-bs-toggle="modal" data-bs-target="#postCommentModal"><i class="fa fa-pencil" aria-hidden="true"></i> Γράψτε σχόλιο</div>
                            </h5>
                         <?php 
                    if ( count($this -> comments ) > 0 ): ?>
                        
                            <div class="commentsContainer">
                       <?php forEach($this -> comments as $comment): ?>
                        
                    

                        

                                <div class="personnelComment">
                                    <div class="personnelCommentHeader">
                                        <div class="personnelCommentUser">
                                            <div class="personnelCommentImg">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </div>
                                            <div class="personnelCommentUserNameAndTimePosted">
                                                <h6><?php echo $comment -> commentor; ?></h6>
                                                <div class="personnelCommentTimePosted">
                                                    πριν από <?php echo $this -> getTimeText( $comment -> DateSubmitted ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="personnelCommentBody">
                                        <?php echo $comment -> comment; ?>
                                    </div>
                                </div>
                                <?php  endforeach; unset($comment); ?>
                                

                                

                            </div>
<!--                            <div class="text-center">
                                <a href="#" class="button button_outlined blue">Εμφάνιση περισσότερων σχολίων</a>
                            </div>-->
                        
<?php endif; ?>

</div>
                        <div class="seperator-l"></div>



                    </div>



                    <div class="personnelDetailsContainerRight">

                        

                    <div class="personnelDetailsContainerRightIn">

                            <div class="personnelDetailsBio">
                                <h5 class="personnelDetailsGeneralTitle">ΣΧΕΤΙΚΑ</h5>
                                <?php echo $this -> item['misc']; ?>
                            </div>
    
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3141.631872192029!2d23.737782315598587!3d38.055663203721444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7e4aa9120d7ff12e!2zMzjCsDAzJzIwLjQiTiAyM8KwNDQnMjMuOSJF!5e0!3m2!1sen!2sgr!4v1641669594405!5m2!1sen!2sgr" width="600" height="250" style="border:0; width:100%" allowfullscreen="" loading="lazy"></iframe>
    
                            <div class="seperator-l"></div>

                        </div></div>


                </div>

                <div class="personnelContactContainer">
                    <div class="time_to_reply_container">Εκτιμώμενος χρόνος απάντησης:<div class="time_to_reply">1'</div></div>
                    <div class="mt-2 mb-2 mt-sm-3 mb-sm-3 d-flex">
                        <button class="button button_outlined blue likeButton me-2" data-id="<?php echo $this -> id; ?>"  <?php echo ($this -> canLike ?  '' : ' disabled="disabled" ' ) ;?> ><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                        <button id="interest" class="button button_filled bg_blue">Δήλωση Ενδιαφέροντος</button>
                    </div>
                </div>
                <?php 
            
                if( Factory::getUser()->authorise('core.edit', 'com_elgjobs') ): ?>
                <div class="personnelContactContainer">

                    <div class="mt-2 mb-2 mt-sm-3 mb-sm-3 d-flex">
                        <a href="/epexergasia-prosopikou.html/?task=personnel.edit&id=<?php echo $this -> item['id']; ?>" class="button button_filled bg_blue"><?php  echo Text::_('COM_ELG_EDIT');?></a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
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
               
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p>Συμπληρώστε τα στοιχεία σας και θα επικοινωνήσουμε το συντομότερο</p>
                        <div class="input_container">
                            <label id="notifyfullname-lbl" for="notify_fullname">Ονοματεπώνυμα</label>
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
</div>


<div  id="modal0" class="modal fade" role="dialog">
  <div class="modal-dialog">

 <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button id ="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="messageArea"></div>
        </div>
      
        <form name="interestForm"  method="post" enctype="multipart/form-data" > 
            <div class="modal-body">
                          
            </div>
            <div class="response text-center"></div>
            <div class="visually-hidden loader text-center" role="status">
                <span class="spinner-border text-primary"></span>
            </div>

            <div class="modal-footer">
                <button id ="cancel1" type="button" class="button button_outlined dark" data-bs-dismiss="modal">Ακύρωση</button>
                <button type="button" class="button button_filled bg_blue submit-button">Υποβολή</button>
            </div>
        </form>
    </div>

  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function (e) {
        const elpidaModal = jQuery('#modal0');
        const elpidaModalSubmitButton = elpidaModal.find('.submit-button');
        const elpidaModalTitle = elpidaModal.find('.modal-title');
        const elpidaModalBody = elpidaModal.find('.modal-body');
        const elpidaModalResponse = elpidaModal.find('.response');
        const elpidaModalLoader = elpidaModal.find('.loader');
        let elpidaModalSubmitFunctionality = () => {};
        elpidaModalSubmitButton.on('click', (e) => { 
            elpidaModalSubmitFunctionality();
        });
        const elpidaModalShowBusy = () => {
            elpidaModalBody.addClass('visually-hidden');
            elpidaModalResponse.addClass('visually-hidden');
            elpidaModalLoader.removeClass('visually-hidden');
        };        
                
        const elpidaModalShowReady = () => {
            elpidaModalBody.removeClass('visually-hidden');
            elpidaModalResponse.removeClass('visually-hidden');
            elpidaModalLoader.addClass('visually-hidden');
        };   
        
        const elpidaModalClear = () => {
            elpidaModalBody.html('');
            elpidaModalResponse.html('');
            elpidaModalBody.removeClass('visually-hidden');
            elpidaModalResponse.removeClass('visually-hidden');
            elpidaModalLoader.addClass('visually-hidden');
        };
                
        document.getElementById('notifyJob').addEventListener('click', function(e){
            let postData = {};
            postData.fullname = document.getElementById('notify_fullname').value.trim(/ /g, '');
            if ( postData.fullname === '' ) {
                alert("Παρακαλώ συμπληρώστε το ονοματεπώνυμό σας.");
                return;
            }
            postData.email = document.getElementById('notify_email').value.trim(/ /g, '');
            postData.telephone = document.getElementById('notify_telephone').value.trim(/ /g, '');
            if (postData.telephone === '' && postData.email === '') {
                alert ("Παρακαλώ συμπληρώστε το τηλέφωνο ή το e-mail σας");
                return;
            }
            postData.recordUrl =  encodeURI(location.href);
            postData.type="2";
            postData.task="notify.notify";
            jQuery.post("/notify.json", postData, function(response){
                let message = '';
                Object.keys(response.messages).forEach(function(messageType){
                    let typeMessage = '';
                    response.messages[messageType].forEach(function(message){
                        typeMessage += message +'<br>';
                    });
                    message += '<p class="alert alert-' + messageType +  ' ">' + typeMessage + '<p>';
                });
                document.querySelector('.modal .response').innerHTML = message;
                setTimeout(elgClearNotificationModal, 3000);
            });
                   
        });
        
        const delFileButtons = document.querySelectorAll('.personnel-files .a-delete');
        for(let i = delFileButtons.length-1; i >= 0; i --) {
            delFileButtons[i].addEventListener('click', (e) => {
               elpidaModalClear();
                elpidaData = {
                    id: e.target.previousElementSibling.dataset.id,
                    file: e.target.previousElementSibling.dataset.file
                };
                      
                elpidaModalTitle.text('Επιβεβαίωση διαγραφής');
                elpidaModalBody.html('<p>Θα διαγράψετε το:<br><strong>' + elpidaData.file.replace(/^.*[\\/]/, '') +'</strong>');
                
                elpidaModalSubmitFunctionality = () => {
                    elpidaModalShowBusy();
                    jQuery.post('/personnel.json?task=personnel.deleteFile', elpidaData, function(response){
                        elpidaModalResponse.html('<p class="text-success">' + response.message + '</p>') ;
                        const fileElement = document.querySelector(('a.isFile[data-id="' + elpidaData.id + '"]') );
                        fileElement.parentNode.remove();
                        elpidaModalShowReady();
                        setTimeout(() =>{
                            elpidaModal.modal('hide');
                        }, 1500);
                    })
                            .fail(function(xhr, status, error){
                                elpidaModalResponse.html('<p class="text-warning">' + xhr.responseJSON.message + '</p>');
                                elpidaModalShowReady();
                            });
                                   
                };
                elpidaModal.modal('show');
                
            });
        }
        
        
    });
    
    function elgClearNotificationModal() {
        jQuery('#aggeliaModal').modal('hide');
        document.getElementById('notify_fullname').value = '';
        document.getElementById('notify_telephone').value = '';
        document.getElementById('notify_email').value = '';
        document.querySelector('.modal .response').innerHTML = '';
    }
</script>
<script type="text/javascript" src="/media/com_elgjobs/js/personnelitem.js"></script>