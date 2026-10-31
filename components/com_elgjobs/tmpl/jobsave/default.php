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
	
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="elg">
	
    <div class="title">
        <h2 class="bodyTitleLarge"><?php echo JText::_('COM_ELGERGASIA_JOB_SUBMIT'); ?></h2>
        <h3 style="margin-top:30px;">Βασικά στοιχεία</h3>
    </div>
    <p class="bodyTextLarge" style="margin-bottom:30px">Καταχωρίστε τα στοιχεία της αγγελίας σας</p>
    <div>
        <form name="jobForm" method="post" enctype="multipart/form-data" >   
            <fieldset>
                <?php echo $this->form->getInput('id');
                    echo $this->form->getInput('language');
                ?>
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
                                <?php echo $this->form->getLabel('idCounty'); ?>
                                <div class="input"><?php echo $this->form->getInput('idCounty'); ?></div>
                            </div>
                            <?php /*
                            <div class="input_container">
                                <?php echo $this->form->getLabel('idDegreeLevel'); ?>
                                <div class="input"><?php echo $this->form->getInput('idDegreeLevel'); ?></div>
                            </div>
                             * 
                             */ ?>
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
                            <div>
                                <?php  echo $this->form->getLabel('idUser')  . $this->form->getInput('idUser');  ?>
                                <button type="button" class="btn btn-primary" id="addExtraEmployer" data-target="#employerForm"  data-toggle="modal">Προσθήκη</button>
                            </div>
                            */ ?>
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
                            <div id="medicalCare" class="input_container" style="display:none">
                                <?php echo $this->form->getLabel('idMedicalCare'); ?>
                                <div class="input"><?php echo $this->form->getInput('idMedicalCare'); ?></div>
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

                <div class="d-md-flex mb-3 map_address_input_container">
                    <input id="autocomplete" placeholder="Εισάγετε διεύθυνση" type="text" class="map_address_input mb-2 mb-md-0"></input>
                    <!-- <div id="editJobMapLocationBrowser" class="button button_outlined button_sm blue">Επιλογή τοποθεσίας μου</div> -->
                </div>

                <div id="map" class="editJobMap"></div>
                
                <div>
                    <?php /*
                    <div class="input_container">
                        <?php echo $this->form->getLabel('extUrl'); ?>
                        <div class="input"><?php echo $this->form->getInput('extUrl'); ?></div>
                    </div>
                    <br /> */
                    ?>
                    <button class="button button_filled bg_blue">
                        <?php echo JText::_('COM_ELGERGASIA_JOB_SUBMIT') ?>
                    </button>
                </div>
                <input type="hidden" name="controller" value="jobsave" />
                <?php echo JHtml::_('form.token'); ?>
            </fieldset>            
        </form>
    </div>
</div>    
<?php /*
<div class="modal" id="employerForm" tabindex="-1" role="dialog" aria-labelledby="Προσθήκη Εργοδότη" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo JText::_('Προσθήκη εργοδότη'); ?></h4>
            </div>
            <div class="modal-body">
                <form id="newEmployerForm" >
                    <p><?php echo $this -> form2 ->getLabel('name'), $this -> form2 ->getInput('name'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('discreteTitle'), $this -> form2 ->getInput('discreteTitle'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('phone'), $this -> form2 ->getInput('phone'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('mobile'), $this -> form2 ->getInput('phone'); ?></p> 
                    <p><?php echo $this -> form2 ->getLabel('city'), $this -> form2 ->getInput('city'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('address'), $this -> form2 ->getInput('address'); ?></p>
                    <p><?php echo $this -> form2 ->getLabel('idIndustry'), $this -> form2 ->getInput('idIndustry'); ?></p>
                </form>
            </div>
            <div class="loading-indicator"></div>
            <div id="modalMessage" class="text-danger"></div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="btnSaveEmployer" ><?php echo "Αποθήκευση"; ?></button>
            </div>
        </div>
    </div>
</div>
 
 */ ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- script type="text/javascript" src="/media/com_elgjobs/js/select2.min.js"></script -->
<script type="text/javascript" src="/media/com_elgjobs/js/job.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQQbqWgJ_103uyBJWra_vo4MmQSp8uE1k&libraries=places&callback=editJobMap" async defer></script>

<script>

let map;
let newMarkersArray = []; 
var autocomplete;
var latLongObj={};

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

    newMarkersArray.push(marker);

    google.maps.event.addListener(newMarkersArray[0], 'dragend', function(evt){
        console.log(evt.latLng.lat(),evt.latLng.lng()); 
        map.setZoom(18);
        map.setCenter(evt.latLng);
    });
}


function initializePlaces() {
    
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), {
            types: ['geocode'],
            componentRestrictions: {
                country: 'gr'
                }
        });

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();

        if(newMarkersArray.length != 0){
            newMarkersArray[0].setMap(null);
            newMarkersArray = [];
            addMarker(place.geometry.location);
        }else{
            addMarker(place.geometry.location);
        }
        
    });
}

</script>