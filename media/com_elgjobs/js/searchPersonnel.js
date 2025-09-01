let points = [];
let elgSearchTotal = 0;
let elgDefaultPersonnelImage = '/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABkAAD/4QMvaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzEzOCA3OS4xNTk4MjQsIDIwMTYvMDkvMTQtMDE6MDk6MDEgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE3IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpDNDAyRDgzOEUzNkMxMUVDODkwQ0VGQ0M1QTlFODZFRiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpDNDAyRDgzOUUzNkMxMUVDODkwQ0VGQ0M1QTlFODZFRiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkM0MDJEODM2RTM2QzExRUM4OTBDRUZDQzVBOUU4NkVGIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkM0MDJEODM3RTM2QzExRUM4OTBDRUZDQzVBOUU4NkVGIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+/+4ADkFkb2JlAGTAAAAAAf/bAIQAAQEBAQEBAQEBAQEBAQEB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';
 let comJobsSearchEndPoint = location.href;
 let mainSearchForm = document.getElementById('mainSearchForm'); //.type = 'button';
//searchButton.type = 'button'; 
//searchButton.addEventListener('click', searchPersonnel);
let endPoint = location.href.replace('.html', '.json');
mainSearchForm.action = endPoint; 
comPersonnelSearchEndPoint = location.href;
 
function searchPersonnel(){
    
    var center;
    var zoom;
    
    let start = (typeof pageStart === 'undefined' ? 0 : pageStart);
    let limit = (typeof pageLimit === 'undefined'  ? 5 : pageLimit);
//    var comJobsSearchEndPoint = '/aggelies.html?view=jobs'; var comPersonnelSearchEndPoint = '/search-personnel.html?view=personnellist

   
    center = {lat: 37.980453, lng: 23.7337859};
    
    zoom = 14;

let endPoint = location.href.replace('.html', '.json');

  axios.
    get(endPoint).
    then(function (response) {
      points = response.data.data;
      
      initMap(points, center, zoom);
      document.querySelector('.pagination').innerHTML = response.data.paging;
       $('#searchResultsNum').text(response.data.total);
       let selectedLocation = $('#locations').val();
       if ( selectedLocation !== '') {
           $('#searchResultsLocation').text(selectedLocation);
           $('#resultLocationLabel').show();
           $('#searchResultsLocation').show();
       }
       else {
           $('#searchResultsLocation').text('');
           $('#resultLocationLabel').hide();
           $('#searchResultsLocation').hide();
       }
    }).
    catch(function (error) {
      console.log(error);
    });
    
    
    
}


var scaler = 3;
var markerColor = "#000";

function initMap(points, center, zoom) {
  let container =  $('#searchJobResults');
  var mapOpts = {
      center: center,
      zoom: zoom,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      clickableIcons: false,
      disableDefaultUI: true,
      zoomControl: true,
  };

  var map = new google.maps.Map(document.getElementById('map'), mapOpts);

  var bicyclayer = new google.maps.BicyclingLayer();
  bicyclayer.setMap(map);
  var bounds = new google.maps.LatLngBounds();

  // var infowincontent = '<div style="width:300px">CONTENT</div>';

  var infowindow = new google.maps.InfoWindow();
  var marker, i;
  

  
  
 
  
   container.empty();
  for (i = 0; i < points.length; i++) {
//    console.log(points[i].lat)
//    console.log(points[i].lng)
    bounds.extend(points[i]);

        var template = '<?xml version="1.0"?>'+
                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="60px" width="60px" viewBox="0 0 60 60" style="border-radius:50px;'+(!points[i].idState == 1 ? '-webkit-filter:grayscale(100%);filter:grayscale(100%);' : '')+'">'+
                '<image x="5" y="5" width="50" height="50" preserveAspectRatio="xMinYMin slice" xlink:href="data:image/jpeg;base64,'+(points[i].sortname2 != 1 ||  points[i].image == '' || points[i].image == null   ?  elgDefaultPersonnelImage : points[i].base64Encode ) +'"/>'+
                // '<image x="5" y="5" width="50" height="50" preserveAspectRatio="xMinYMin slice" xlink:href="/images/elgjobs/users/'+points[i].id+'.jpg"/>'+
                '<circle cx="30" cy="30" r="30" stroke-width="10" fill="none" stroke="#fff" />'+
                (points[i].idState == 1 ? '<circle cx="30" cy="30" r="30" stroke-width="5" fill="none" stroke="#34E621" />' : (points[i].idState == 2 ? '<circle cx="30" cy="30" r="30" stroke-width="5" fill="none" stroke="#ef961a" />':'<circle cx="30" cy="30" r="30" stroke-width="5" fill="none" stroke="#ffffff" />'))+
                '</svg>';

    
     
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(points[i].lat, points[i].lng),
          map: map,
          title: points[i].title,
          icon:{ url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(template), scaledSize: new google.maps.Size(60, 60) },
          // icon: '/images/elgjobs/users/'+points[i].id+'.jpg',
          optimized: false,
        })

        specialities = typeof (points[i].specialities) === 'object' ? Object.values(points[i].specialities) : points[i].specialities;

        var specsOuter = '';
        specialities.forEach(function(item) {
          specsOuter += '<div class="chip">'+item+'</div>';
        });
        
        var searchResult = '<div class="search_result '+(points[i].idState == 1 ? 'active full': (points[i].idState == 2 ? 'active semi' : 'inactive'))+'">'+
                        '<div  class="search_result_user">'+
                            '<a href="/personnel?id='+points[i].id+ '" class="userListTile">'+
                                '<div class="userListTileImg">'+
                                    '<img src=/'+(points[i].sortname2 !=1 ||  points[i].image == ''  || points[i].image == null  ? 'images/elgjobs/users/default_user.jpg'   : points[i].image ) + '>' +
                                    '<div class="overlayUserImg"></div>'+
                                '</div>'+
                                '<div class="userListTileTxt">'+
                                    '<h4>'+points[i].name+ " "+points[i].lastname.charAt(0) +"." +'</h4>'+
                                    (points[i].lastOfficeVisit ? `<p>${ points[i].lastOfficeVisit}</p>`: '') +
                                  //  '<p class="location">'+points[i].address+'</p>'+
                                    '<p class="availability">'+(points[i].idState == 1 ? 'Άμεση διαθεσιμότητα': (points[i].idState == 2 ? 'Διαθεσιμότητα συγκεκριμένες ώρες/ημέρες' : 'Χωρίς διαθεσιμότητα'))+'</p>'+
                                '</div>'+
                            '</a>'+
                            '<div class="search_result_user_specs">'+specsOuter+
                            '</div>'+
                        '</div>'+
                        '<div class="search_result_action">'+
                            '<div class="time_to_reply_container">'+(points[i].isActive ? 'Εκτιμώμενος χρόνος απάντησης:<div class="time_to_reply">'+points[i].timeToReply+'</div>' : '')+
                            '</div>'+
                            '<div class="search_result_action_button">'+
                                (points[i].isActive ? '<button class="button button_filled bg_blue " type="button" onclick="showNotifyDialog(this)">Δήλωση Ενδιαφέροντος</button>' : '<button class="button button_filled bg_blue">Ειδοποίηση Διαθεσιμότητας</button>')+
                            '</div>'+
                            '<div class="search_result_action_reactions">'+
                                // '<div class="recomendations">'+points[i].likes+' προτείνουν</div>'+
                                // '<div class="comments">'+points[i].comments+' σχόλια</div>'+
                            '</div>'+
                        '</div>'+
                      '</div>';

                     
                      container.append(searchResult);
    

    
    var mapUserModal = new bootstrap.Modal(document.getElementById('mapUserModal'))
    

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
          var specs = '';

        specialities.forEach(function(item) {
            specs += '<div class="chip">'+item+'</div>';
        });
        
        var content = '<div class="search_result '+(points[i].idState == 1 ? 'active full': (points[i].idState == 2 ? 'active semi' : 'inactive'))+'">'+
                        '<div  class="search_result_user">'+
                        '<a href="/personnel?id='+points[i].id+'" class="userListTile">'+
                                '<div class="userListTileImg">'+
                                '<img src=/'  +(points[i].sortname2 !=1 ||  points[i].image == '' || points[i].image == null  ?  "images/elgjobs/users/default_user.jpg" : points[i].image) +'>'+
                                    '<div class="overlayUserImg"></div>'+
                                '</div>'+
                                '<div class="userListTileTxt">'+
                                    '<h4>'+points[i].name+ " "+points[i].lastname.charAt(0)+"." +'</h4>'+
                                    // '<p class="location">'+points[i].address+'</p>'+
                                    '<p class="availability">'+(points[i].idState == 1 ? 'Άμεση διαθεσιμότητα': (points[i].idState == 2 ? 'Διαθεσιμότητα συγκεκριμένες ώρες/ημέρες' : 'Χωρίς διαθεσιμότητα'))+'</p>'+
                                '</div>'+
                            '</a>'+
                            '<div class="search_result_user_specs">'+specs+
                            '</div>'+
                        '</div>'+
                        '<div class="search_result_action">'+
                            '<div class="time_to_reply_container">'+(points[i].isActive ? 'Εκτιμώμενος χρόνος απάντησης:<div class="time_to_reply">'+points[i].timeToReply+'</div>' : '')+
                            '</div>'+
                            '<div class="search_result_action_button">'+
                                (points[i].isActive ? '<button class="button button_filled bg_blue">Δήλωση Ενδιαφέροντος</button>' : '<button class="button button_filled bg_blue">Ειδοποίηση Διαθεσιμότητας</button>')+
                            '</div>'+
                            '<div class="search_result_action_reactions">'+
                                // '<div class="recomendations">'+points[i].likes+' προτείνουν</div>'+
                                // '<div class="comments">'+points[i].comments+' σχόλια</div>'+
                            '</div>'+
                        '</div>'+
                      '</div>';

        $('#mapUserModal .modal_content').html(content);

        mapUserModal.show();

      }
    })(marker, i));

    // google.maps.event.addListener(map, 'click', function(){
    //   infowindow.close(map, marker);
    // });



  }
  map.fitBounds(bounds);

}

function showNotifyDialog(trg) {
    let url = trg.parentNode.parentNode.parentNode.querySelector('a.userListTile').href;
    document.getElementById('notifyUrl').value = url;
    jQuery('#aggeliaModal').modal('show');
}
    

    
    function elgClearNotificationModal() {
        jQuery('#aggeliaModal').modal('hide');
        document.getElementById('notify_fullname').value = '';
        document.getElementById('notify_telephone').value = '';
        document.getElementById('notify_email').value = '';
        document.querySelector('.modal .response').innerHTML = '';
        document.getElementById('notifyUrl').value= '';
    }


    document.getElementById('notifyJob').addEventListener('click', function(e){
        
      
           
            let postData = {};
            postData.fullname = document.getElementById('notify_fullname').value.trim(/ /g, '')
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
            postData.recordUrl =  encodeURI(document.getElementById('notifyUrl').value);
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