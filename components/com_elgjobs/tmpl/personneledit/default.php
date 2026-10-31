<?php
/* ------------------------------------------------------------------------
  # com_elgalocrm - e-logism job agency
  # ------------------------------------------------------------------------
  # author    e-logism
  # copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
  # @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
  # Websites: http://www.e-logism.gr

  ----------------------------------* */
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="elg">

    <div class="title">
        <h2 class="bodyTitleLarge"><?php echo Text::_('COM_ELGERGASIA_PERSONNEL_SUBMIT'); ?></h2>
        <h3 style="margin-top:30px;">Βασικά στοιχεία</h3>
    </div>
    <p class="bodyTextLarge" style="margin-bottom:30px">Καταχωρίστε τα προσωπικά σας στοιχεία</p>
    <div>
        <form name="personnelForm" method="post" enctype="multipart/form-data" >   
            <fieldset>
                <input type="hidden" name="task"  value="personnel.save" />
<?php
echo $this->form->getInput('id');
echo $this->form->getInput('language');
echo HTMLHelper::_('form.token');
?>
                <div class="row mb-5">
                    <div class="com-mb-12 userphoto_edit_container">
                        <div class="userphoto_edit_container_in">
                <?php if ($this->image !== ''): ?>
                                <img class="userphoto_edit" src="<?php echo str_replace('_small', '_medium', $this->image); ?>" />
<?php endif; ?>
                            <div class="input_container mb-0">
                            <?php echo $this->form->getLabel('candidatePhotoUpload1'); ?>
                                <div class="inputForPhoto"><?php echo $this->form->getInput('candidatePhotoUpload1'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="com-mb-12 userfile_edit_container">
                        <div class="userfile_edit_container_in">

                            <div class="input_container mb-0">
<?php echo $this->form->getLabel('candidateFileUpload'); ?>
                                <div class="inputForPhoto"><?php echo $this->form->getInput('candidateFileUpload'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div id="uploadedDocuments">
<?php
if ($this->isAuthorised == 1 and isset($this->item['documents'])) :

    $documents = explode(",", $this->item['documents']);
    $idDocuments = explode(",", $this->item['idDocuments']);

    for ($i = count($documents) - 1; $i > -1; $i--):
        if ($documents[$i] == '') :
            continue;
        endif;
        ?>
                                <div class="d-inline bg-info" id="jobFile<?php echo $idDocuments[$i]; ?>" ><a href="/<?php echo $documents[$i]; ?>" class="text-white" target="_blank" >
                                <?php echo basename($documents[$i]); ?></a> <span style="display:none"" onclick="deleteFile(<?php echo $idDocuments[$i]; ?>)" >x</span></div>
                            <?php endfor;
                        endif;
                        ?>
                    </div>
                    <div id="jobFileMessages" ></div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <div class="yjsg-col-1-2">
                            <div class="input_container">
<?php echo $this->form->getLabel('name'); ?>
                                <div class="input"><?php echo $this->form->getInput('name'); ?></div>
                            </div>
                            <div class="input_container" >
                                <?php echo $this->form->getLabel('dateOfBirth'); ?>
                                <div class="input"><?php echo $this->form->getInput('dateOfBirth'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('idGender'); ?>
                                <div class="input"><?php echo $this->form->getInput('idGender'); ?></div>
                            </div>


                            <!--                            <div class="input_container">
                                                            < ?php  echo $this->form->getLabel('region'); ?>
                                                            <div class="input">< ?php  echo $this->form->getInput('region'); ?></div>
                                                        </div>-->

                            <div class="input_container">
<?php echo $this->form->getLabel('idNationality'); ?>
                                <div class="input"><?php echo $this->form->getInput('idNationality'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('email_to'); ?>
                                <div class="input"><?php echo $this->form->getInput('email_to'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('fax'); ?>
                                <div class="input"><?php echo $this->form->getInput('fax'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('mobile'); ?>
                                <div class="input"><?php echo $this->form->getInput('mobile'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('telephone'); ?>
                                <div class="input"><?php echo $this->form->getInput('telephone'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('lastOfficeVisit'); ?>
                                <div class="input"><?php echo $this->form->getInput('lastOfficeVisit'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="yjsg-col-1-2">
                            <!-- div class="input_container">
                                < ?php  echo $this->form->getLabel('address'); ?>
                                <div class="input">< ?php echo $this->form->getInput('address'); ?></div>
                            </div -->
                            <div class="input_container">
                                <?php echo $this->form->getLabel('lastname'); ?>
                                <div class="input"><?php echo $this->form->getInput('lastname'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('published'); ?>
                                <div class="input"><?php echo $this->form->getInput('published'); ?></div>
                            </div>


                            <div class="input_container select2_cotainer">
<?php echo $this->form->getLabel('idSpeciality'); ?>
                                <div class="input"><?php echo $this->form->getInput('idSpeciality'); ?></div>
                            </div>
                            <div class="input_container select2_cotainer">
                                <?php echo $this->form->getLabel('idHour'); ?>
                                <div class="input"><?php echo $this->form->getInput('idHour'); ?></div>
                            </div>
                            <div class="input_container select2_cotainer">
                                <?php echo $this->form->getLabel('idSpecialNeed'); ?>
                                <div class="input"><?php echo $this->form->getInput('idSpecialNeed'); ?></div>
                            </div>

                            <div class="input_container">
<?php echo $this->form->getLabel('idUserTeam'); ?>
                                <div class="input select2_team"><?php echo $this->form->getInput('idUserTeam'); ?></div>
                            </div>
                            <div class="input_container" >
                                <?php echo $this->form->getLabel('idInsurance'); ?>
                                <div class="input"><?php echo $this->form->getInput('idInsurance'); ?></div>
                            </div>
                            <div class="input_container">
                                <?php echo $this->form->getLabel('idRecommentation'); ?>
                                <div class="input"><?php echo $this->form->getInput('idRecommentation'); ?></div>
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

                <div class="mb-4">
<?php require JPATH_COMPONENT_SITE . '/tmpl/parteditlangbar.php'; ?>
<?php require JPATH_COMPONENT_SITE . "/tmpl/personneledit/default_translation.php"; ?>
                    <div class="clearfix">&nbsp;</div>
                </div>

                <div class="title">
                    <h3>Τοποθεσία αγγελίας</h3>
                </div>
                <p class="bodyTextLarge" style="margin-bottom:30px">Επιλέξτε το σημείο του χάρτη ή εισάγετε τη διεύθυνση που θέλετε να εμφανίζεται η αγγελία</p>

                <div class="d-md-flex mb-3 map_address_input_container">
                    <div class="row">


                        <div class="col-md-12">
<?php echo $this->form->getInput('address'); ?>
                        </div>
                        <div class="col-md-12">
<?php echo $this->form->getInput('address2'); ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->form->getLabel('lat'); ?>
<?php echo $this->form->getInput('lat'); ?>
                        </div>
                        <div class="col-md-2">
<?php echo $this->form->getLabel('lng'); ?>
                            <?php echo $this->form->getInput('lng'); ?>
                        </div>
                        <div class="col-md-2">
<?php echo $this->form->getLabel('suburb'); ?>
                            <?php echo $this->form->getInput('suburb'); ?>
                        </div>
                        <div class="col-md-2">
<?php echo $this->form->getLabel('state'); ?>
                            <?php echo $this->form->getInput('state'); ?>
                        </div>
                        <div class="col-md-2">
<?php echo $this->form->getLabel('country'); ?>
                            <?php echo $this->form->getInput('country'); ?>
                        </div>
                        <div class="col-md-2" >
<?php echo $this->form->getLabel('postcode'); ?>
                            <div class="input"><?php echo $this->form->getInput('postcode'); ?></div>
                        </div>
                    </div>
                </div>

                <div id="map" class="editJobMap"></div>   
                <div class="input mb-3" style="display: flex;align-items: center;"> <?php echo $this->form->getInput('termsofuse'); ?><?php echo $this->form->getLabel('termsofuse'); ?></div>
                <div class="input" style="display: flex;align-items: center;"> <?php echo $this->form->getInput('accept_photo'); ?><?php echo $this->form->getLabel('accept_photo'); ?></div>
                <div class="mt-5">
<?php
/*
  <div class="input_container">
  <?php echo $this->form->getLabel('extUrl'); ?>
  <div class="input"><?php echo $this->form->getInput('extUrl'); ?></div>
  </div>
  <br /> */
?>
                    <button class="button button_filled bg_blue">
                    <?php echo JText::_('COM_ELGERGASIA_PERSONNEL_SUBMIT') ?>
                    </button>
                </div>


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
<script type="text/javascript" src="/media/com_elgjobs/js/personnel.js?ver=2"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQQbqWgJ_103uyBJWra_vo4MmQSp8uE1k&libraries=places&callback=editJobMap" async defer></script>

<script>

                                                            let map;
                                                            let newMarkersArray = [];
                                                            var autocomplete;
                                                            var latLongObj = {};

                                                            $("#editJobMapLocationBrowser").click(function () {
                                                                if (navigator.geolocation) {
                                                                    navigator.geolocation.getCurrentPosition(handlePositionEditJobMap);
                                                                }
                                                            });

                                                            function handlePositionEditJobMap(position) {
                                                                latLongObj.lat = position.coords.latitude;
                                                                latLongObj.lng = position.coords.longitude;
                                                                if (newMarkersArray.length == 0) {
                                                                    addMarker(latLongObj);
                                                                } else {
                                                                    newMarkersArray[0].setMap(null);
                                                                    newMarkersArray = [];
                                                                    addMarker(latLongObj);
                                                                }
                                                            }

                                                            function editJobMap() {

                                                                latLongObj.lat = parseFloat($('#lat').val());
                                                                latLongObj.lng = parseFloat($('#lng').val());

                                                                if (isNaN(latLongObj.lat) || isNaN(latLongObj.lng)) {
                                                                    latLongObj.lat = 37.985605;
                                                                    latLongObj.lng = 23.728925;
                                                                }
                                                                map = new google.maps.Map(document.getElementById('map'), {
                                                                    center: {lat: latLongObj.lat, lng: latLongObj.lng},
                                                                    zoom: 12
                                                                });

                                                                initializePlaces();

                                                                map.addListener('click', function (e) {
                                                                    if (newMarkersArray.length == 0) {
                                                                        addMarker(e.latLng);
                                                                    }
                                                                });

                                                                addMarker(latLongObj);
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

                                                                google.maps.event.addListener(newMarkersArray[0], 'dragend', function (evt) {
                                                                    map.setZoom(12);
                                                                    map.setCenter(evt.latLng);
                                                                    $('#lat').val(evt.latLng.lat());
                                                                    $('#lng').val(evt.latLng.lng());
                                                                });
                                                            }

// $scope.initAutoComplete = function(){
//
//                    //get textbox used for address or place search
//                    var input = document.getElementById('autocomplete');
//
//                    //create google places variable and bind input to it.
//                    var searchBox = new google.maps.places.SearchBox(input);
//
//
//                    // When the user selects an address from the dropdown, 
//                      trigger function
//                    searchBox.addListener('places_changed', function () {
//                        //calling "getPlaces" instead of get place()
//
//                        var place = searchBox.getPlaces();
//
//                        //passing place to my dropPin service
//                        rcisMapService.dropPin(place);
//                    });
//                };
                                                            function initializePlaces() {

                                                                var input = document.getElementById('personnelForm_autocomplete');
                                                                var searchBox = new google.maps.places.SearchBox(input);
//    autocomplete = new google.maps.places.Autocomplete(
//        document.getElementById('autocomplete'), {
//            types: ['geocode'],
//            componentRestrictions: {
//                country: 'gr'
//                }
//        });


                                                                searchBox.addListener('places_changed', function () {
                                                                    var place = searchBox.getPlaces()[0];

                                                                    if (newMarkersArray.length !== 0) {
                                                                        newMarkersArray[0].setMap(null);
                                                                        newMarkersArray = [];
                                                                        addMarker(place.geometry.location);
                                                                    } else {
                                                                        addMarker(place.geometry.location);
                                                                    }

                                                                    let addressComponents = place.address_components.reduce(function (prev, cur) {
                                                                        prev[cur.types[0]] = cur.long_name;
                                                                        return prev;
                                                                    }, {});
                                                                    $('#personnelForm_lat').val(place.geometry.location.lat());
                                                                    $('#personnelForm_lng').val(place.geometry.location.lng());
                                                                    $('#personnelForm_suburb').val(addressComponents.locality);
                                                                    $('#personnelForm_state').val(addressComponents.administrative_area_level_3);
                                                                    $('#personnelForm_country').val(addressComponents.country);
                                                                    $('#personnelForm_postcode').val(addressComponents.postal_code);


//        input.value = 'Μαραθώνος 34,γαλάτσι ,Ελλάδα';
                                                                    // reinitialize with new input value
                                                                    searchBox = new google.maps.places.SearchBox(input);
                                                                    var place = searchBox.getPlaces()[0];

                                                                });

//    google.maps.event.addListener(autocomplete, 'place_changed', function () {
//        var place = autocomplete.getPlaces();
//
//        if(newMarkersArray.length != 0){
//            newMarkersArray[0].setMap(null);
//            newMarkersArray = [];
//            addMarker(place.geometry.location);
//        }else{
//            addMarker(place.geometry.location);
//        }
//        
//        let addressComponents = place.address_components.reduce(function(prev, cur){ prev[cur.types[0]] = cur.long_name; return prev;}, {});
//        $('#lat').val(place.geometry.location.lat());
//        $('#lng').val(place.geometry.location.lng());
//        $('#city').val(addressComponents.locality);
//        $('#state').val(addressComponents.administrative_area_level_3);
//        $('#country').val(addressComponents.country);
//        $('#postcode').val(addressComponents.postal_code);
//        
//    });
                                                            }

</script>