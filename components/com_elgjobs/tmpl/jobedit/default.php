<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
    defined('_JEXEC') or die('Restricted access');
    use Joomla\CMS\HTML\HTMLHelper;
    use Joomla\CMS\Language\Text;
	
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="elg">
	
    <div class="title">
        <h2 class="bodyTitleLarge"><?php echo JText::_('COM_ELGERGASIA_JOB_SUBMIT'); ?></h2>
        <h3 style="margin-top:30px;">Βασικά στοιχεία</h3>
    </div>
    <p class="bodyTextLarge" style="margin-bottom:30px">Καταχωρίστε τα στοιχεία της αγγελίας σας</p>
    <div>
        <form name="jobForm"  method="post" enctype="multipart/form-data" >   
            <fieldset>
                <input type="hidden" name="task"  value="job.save" />
                
                <?php 
                    
                    echo $this->form->getInput('id');
                    echo $this->form->getInput('language');
                    
                    echo HTMLHelper::_('form.token');
                ?>
		<div class="row mb-2">
			<div class="col-md-6">
                <div class="input_container">
                    <?php echo $this->form->getLabel('idEmployer');?>
                    <div class="input"><?php echo $this->form->getInput('idEmployer');?></div>
                </div>
                <div class="tool_controls">
                    <button type="button" class="buttonNot buttonNotPrimary" id="addExtraEmployer" data-bs-target="#employerForm"  data-bs-toggle="modal"><i class="fa fa-plus"></i> Προσθήκη</button>
                    <button type="button" class="buttonNot" id="eidtExtraEmployer" onclick="popEditEmployer()"><i class="fa fa-pencil"></i> Επεξεργασία</button>
                </div>
			</div>
			<div class="col-md-6">
                <div class="input_container">
                    <?php echo $this->form->getLabel('documentFile');?>
                    <div><?php echo $this->form->getInput('documentFile');?></div>
                </div>
				
				<div id="uploadedDocuments">
				<?php if ( $this -> isAuthorised == 1  and isset($this -> item -> documents) ) : 
				$documents = explode(",", $this -> item -> documents);
				
				$idDocuments = explode(",", $this -> item -> idDocuments);
					
					for ( $i = count($documents) - 1; $i > -1; $i-- ): 
						if ( $documents[$i] == '' ) :
							continue;
						endif;
					?>
						<div class="d-inline bg-info" id="jobFile<?php echo $idDocuments[$i]; ?>" ><a href="/<?php echo $documents[$i]; ?>" class="text-white" target="_blank" >
							<?php echo basename($documents[$i]); ?></a> <span onclick="deleteFile(<?php echo $idDocuments[$i]; ?>)" >x</span></div>
				<?php endfor;
					endif; ?>
						</div>
				<div id="jobFileMessages" ></div>
            </div>       
		</div>
                <div class="row mb-5">
	
                    <div class="col-md-6">
                        <div class="yjsg-col-1-2">
                            <div class="input_container">
                                <?php echo $this->form->getLabel('idJobState');?>
                                <div class="input"><?php echo $this->form->getInput('idJobState');?></div>
                            </div>
                            <?php /**
                            <div class="formelm">
                                <?php echo $this->form->getLabel('jobCost')  . $this->form->getInput('jobCost');  ?>
                            </div>
                            * **
                            */
                            ?>
                        
                            <div class="input_container">
                                <?php echo $this->form->getLabel('areasize'); ?>
                                <div class="input"><?php echo $this->form->getInput('areasize'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('idHour'); ?>
                                <div class="input"><?php echo $this->form->getInput('idHour'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('jobSalary'); ?>
                                <div class="input"><?php echo $this->form->getInput('jobSalary'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="yjsg-col-1-2">
                         
                            
                            <?php /*
                            <div class="input_container">
                                <?php echo $this->form->getLabel('minExperience'); ?>
                                <div class="input"><?php echo $this->form->getInput('minExperience'); ?></div>
                            </div>
                             * 
                             */ ?>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('idSpeciality'); ?>
                                <div class="input"><?php echo $this->form->getInput('idSpeciality'); ?></div>
                            </div>
                            <div  class="input_container" >
                                <?php echo $this->form->getLabel('idSpecialNeed'); ?>
                                <div class="input"><?php echo $this->form->getInput('idSpecialNeed'); ?></div>
                            </div>
                            <?php /*
                            <div id="oldPeople" style="display:none">
                                <?php  echo $this->form->getLabel('idOldPeople')  . $this->form->getInput('idOldPeople'); ?>
                            </div>
                            */ ?>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('daysOff'); ?>
                                <div class="input"><?php echo $this->form->getInput('daysOff'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('idCandidate'); ?>
                                <div class="input select2_team"><?php echo $this->form->getInput('idCandidate'); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- <div class="clearfix">&nbsp;</div> -->
                <?php /*
                <div class="yjsg-col-1">
                    <div class="yjsg-col-1-3">
                        <?php echo $this->form->getLabel('jobImage1')  . $this->form->getInput('jobImage1');  ?>
                    </div>
                    <div class="yjsg-col-1-3" >
                        <?php echo $this->form->getLabel('jobImage2')  . $this->form->getInput('jobImage2');  ?>
                    </div>
                    <div class="yjsg-col-1-3" >
                        <?php echo $this->form->getLabel('jobImage3')  . $this->form->getInput('jobImage3');  ?>
                    </div>
                </div>
                 * 
                 */ ?>
                <!-- <div class="clearfix">&nbsp;</div> -->
                
                <div class="title">
                    <h3>Τίτλος και περιγραφή</h3>
                </div>
                <p class="bodyTextLarge" style="margin-bottom:30px">Εισάγετε τον τίτλο και την περιγραφή της αγγελίας σας στις διαθέσιμες γλώσσες</p>
                
                <div class="mb-4">
                    <?php require JPATH_COMPONENT_SITE . '/tmpl/parteditlangbar.php'; ?>
                    <?php  require JPATH_COMPONENT_SITE . "/tmpl/jobedit/default_translation.php"; ?>
                    <div class="clearfix">&nbsp;</div>
                </div>
                
                <div class="title">
                    <h3>Τοποθεσία αγγελίας</h3>
                </div>
                <p class="bodyTextLarge" style="margin-bottom:30px">Επιλέξτε το σημείο του χάρτη ή εισάγετε τη διεύθυνση που θέλετε να εμφανίζεται η αγγελία</p>

<!--                <div class="d-md-flex mb-3 map_address_input_container">
                    <input id="autocomplete"  placeholder="Εισάγετε διεύθυνση" type="text" class="map_address_input mb-2 mb-md-0"></input>
                     <div id="editJobMapLocationBrowser" class="button button_outlined button_sm blue">Επιλογή τοποθεσίας μου</div> 
                </div>
                -->
                
                <div class="d-md-flex mb-3 map_address_input_container">
                    <div class="row">
                        
                    
                    <div class="col-md-12">
                    <?php  echo $this->form->getInput('address'); ?>
                    </div>
                     <div class="col-md-2">
                          <?php  echo $this->form->getLabel('lat'); ?>
                        <?php echo $this->form->getInput('lat'); ?>
                     </div>
                     <div class="col-md-2">
                          <?php  echo $this->form->getLabel('lng'); ?>
                        <?php echo $this->form->getInput('lng'); ?>
                     </div>
                    <div class="col-md-2">
                         <?php  echo $this->form->getLabel('city'); ?>
                        <?php echo $this->form->getInput('city'); ?>
                     </div>
                     <div class="col-md-2">
                         <?php  echo $this->form->getLabel('county'); ?>
                        <?php echo $this->form->getInput('county'); ?>
                     </div>
                     <div class="col-md-2">
                         <?php  echo $this->form->getLabel('country'); ?>
                        <?php echo $this->form->getInput('country'); ?>
                     </div>
                    <div class="col-md-2" >
                        <?php  echo $this->form->getLabel('postcode'); ?>
                        <div class="input"><?php echo $this->form->getInput('postcode'); ?></div>
                    </div>
                    </div>
                </div>
                
                <div id="map" class="editJobMap"></div>
                
                <div>
                    
                   
                    <button class="button button_filled bg_blue">
                        <?php echo JText::_('COM_ELGERGASIA_JOB_SUBMIT') ?>
                    </button>
                </div>
                
                <?php echo JHtml::_('form.token'); ?>
            </fieldset>            
        </form>
    </div>
</div>    
 
<div class="modal hide fade" id="employerForm" tabindex="-1" role="dialog" aria-labelledby="Προσθήκη Εργοδότη" aria-hidden="true">
    
       <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo JText::_('Προσθήκη εργοδότη'); ?></h4>
                <button id ="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         <form id="newEmployerForm" >
            <div class="modal-body">
               
                    <?php echo $this -> form2 ->getInput('id'); ?>
                    <div class="row">                    
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('DiscreteTitle'); ?> <div class="input"><?php echo $this -> form2 ->getInput('DiscreteTitle'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('idEmployerType'); ?> <div class="input"><?php echo $this -> form2 ->getInput('idEmployerType'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('idIndustry'); ?> <div class="input"><?php echo $this -> form2 ->getInput('idIndustry'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('Profession'); ?> <div class="input"><?php echo $this -> form2 ->getInput('Profession'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('Email'); ?> <div class="input"><?php echo $this -> form2 ->getInput('Email'); ?></div> </div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('WebPage'); ?> <div class="input"><?php echo $this -> form2 ->getInput('WebPage'); ?></div> </div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('Telephone'); ?> <div class="input"><?php echo $this -> form2 ->getInput('Telephone'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('Mobile'); ?> <div class="input"><?php echo $this -> form2 ->getInput('Mobile'); ?></div> </div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('Fax'); ?> <div class="input"><?php echo $this -> form2 ->getInput('Fax'); ?></div> </div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('idCountry'); ?> <div class="input"><?php echo $this -> form2 ->getInput('idCountry'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('EmpArea'); ?> <div class="input"><?php echo $this -> form2 ->getInput('EmpArea'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('EmpAddress'); ?> <div class="input"><?php echo $this -> form2 ->getInput('EmpAddress'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('Zip'); ?> <div class="input"><?php echo $this -> form2 ->getInput('Zip'); ?></div></div>                   
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('TaxNo'); ?> <div class="input"><?php echo $this -> form2 ->getInput('TaxNo'); ?></div></div>
                        <div class="col-md-6 input_container mb-1" ><?php echo $this -> form2 ->getLabel('TaxOffice'); ?> <div class="input"><?php echo $this -> form2 ->getInput('TaxOffice'); ?></div></div>
                        <div class="col-md-12 input_container" ><?php echo $this -> form2 ->getLabel('Comments'); ?> <div class="textarea"><?php echo $this -> form2 ->getInput('Comments'); ?></div></div>
                    </div>
               
            </div>
            <div class="loading-indicator"></div>
            <div id="modalMessage" class="text-danger"></div>
            <div class="modal-footer">
                <button id="btnSaveEmployer" class="button button_filled bg_blue"><?php echo "Αποθήκευση"; ?></button>
            </div>
             </form>
        </div>
        </div>
    
</div>
 
  

<div id="findLocation" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><?php echo Text::_('COM_EODY_LOCATION_FIND') ?></h3>
        <div class="messageArea"></div>
    </div>

    <form method="post" action="<?php echo $this->action; ?>" id="eodyDataForm">
        <div class="modal-body" id="close">

            <!-- Open Map Begin-->
            <div id="location_map" class="location_map"></div>
            <!-- Open Map End-->
            <div class="addresses_before">

            </div>
        </div>



        <div class="modal-footer">
            <div class="latlong-actions">
                <div class="latlong">
                    <span name="txtLong">Γεωγραφικό μήκος: <strong><span id="lon"
                                                                         style="padding-right: 10px">0</span></strong></span>
                    <span name="txtLat">Γεωγραφικό Πλάτος: <strong><span id="lat">0</span></strong></span>
                </div>
                <div class="btns">
                    <button class="btn" data-dismiss="modal"
                            aria-hidden="true"><?php echo Text::_('COM_EODY_CLOSE'); ?></button>
                    <button class="btn btn-primary" disabled="true" id="saveLocation"
                            type="button"><?php echo Text::_('COM_EODY_SUBMIT'); ?></button>
                </div>
            </div>

        </div>
    </form>--
    <div class="loader text-center" style="display:none">
        <img src="/images/loader_128_128.gif"/>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- script type="text/javascript" src="/media/com_elgjobs/js/select2.min.js"></script -->
<script type="text/javascript" src="/media/com_elgjobs/js/job.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQQbqWgJ_103uyBJWra_vo4MmQSp8uE1k&libraries=places&callback=editJobMap" async defer></script>

<script>

let map;
let newMarkersArray = []; 
var autocomplete;
var latLongObj={};

function deleteFile(id) {
	let agreeDelete = confirm("Είστε σίγουροι για τη διαγραφή;");
	if ( agreeDelete ) { 
		$.post("/aggelia/file-delete.json", {id: id}, function(e) {
			document.getElementById("jobFileMessages").textContent = e.message;
			if ( e.data.result == true ) {
				document.getElementById("jobFile" + id ).remove();
			}
			setTimeout(function(){
				document.getElementById("jobFileMessages").textContent = "";
			}, 3000);
		}); 
	}
}

$("#editJobMapLocationBrowser").click(function(){
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(handlePositionEditJobMap);
  }
});

function handlePositionEditJobMap(position) {
    latLongObj.lat = position.coords.latitude;
    latLongObj.lng = position.coords.longitude;
    if(newMarkersArray.length == 0){
        addMarker(latLongObj);
    }else{
        newMarkersArray[0].setMap(null);
        newMarkersArray = [];
        addMarker(latLongObj);
    }
}

function editJobMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 37.985605, lng: 23.728925}, 
    zoom: 12
    });

    initializePlaces();

    map.addListener('click', function(e) {
        if(newMarkersArray.length == 0){
            addMarker(e.latLng);
        }
    });
}

function addMarker(latLng) {    
    let marker = new google.maps.Marker({
        map: map,
        position: latLng,
        draggable: true
    });
    map.setZoom(18);
    map.setCenter(latLng);

    newMarkersArray[0] = marker;

    google.maps.event.addListener(newMarkersArray[0], 'dragend', function(evt){
        console.log(evt.latLng.lat(),evt.latLng.lng()); 
        map.setZoom(18);
        map.setCenter(evt.latLng);
    });
}


function initializePlaces() {
    
    var input = document.getElementById('jobForm_autocomplete');
    var searchBox = new google.maps.places.SearchBox(input);

//    google.maps.event.addListener(autocomplete, 'place_changed', function () {
//        elgJobPlaceChanged (searchBox, newMarkerrsArray);
//        
//    });
    searchBox.addListener('places_changed', function() {
       elgJobPlaceChanged (searchBox, newMarkersArray);
    });
}

</script>
