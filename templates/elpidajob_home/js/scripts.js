$("#open_menu").click(function(){
  $('nav').addClass('opened')
});
$("#close_menu").click(function(){
  $('nav').removeClass('opened')
});




var main_slider = new Swiper(".main_slider .mainSlider", {
    effect:'fade',
});



if($("#autoTyperElem").length){
  var typer = new TypeIt("#autoTyperElem", {
      speed: 100,
      waitUntilVisible: true,
      loop: true,
  })
  .exec( () => main_slider.slideTo(0,1000))
  .type("γηροκόμο;", { delay: 3600 })
  .delete(21)
  .exec( () => main_slider.slideTo(1,1000))
  .type("οικιακή βοηθό;", { delay: 3600 })
  .delete(16)
  .exec( () => main_slider.slideTo(2,1000))
  .type("babysitter;", { delay: 3600 })
  // .delete(15)
  .go();
}



function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });

  inp.addEventListener("click", function(e) {
  	var a, b, i;
      
      closeAllLists();
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          b.innerHTML = arr[i];
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
      }
  });

  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
	  // console.log(elmnt)
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }

  url_path= window.location.href;

  if (url_path.includes("search-personnel") ) {
          /*execute a function when someone clicks in the document:*/
      document.addEventListener("click", function (e) {
        if (document.getElementById('types').contains(e.target)){
          // Clicked in boxzz
        }else if (document.getElementById('locations').contains(e.target)){
          // Clicked in box
        } 
        else if (document.getElementById('filter_nationality').contains(e.target)){
          // Clicked in box
        } 

        //  else if  ( document.URL.includes("aggelies")) {
      //      if (document.getElementById('employers').contains(e.target)){
      //      }
        //  }
        else{
            closeAllLists(e.target);
        }
            // closeAllLists(e.target);
      });
  }else {    /*execute a function when someone clicks in the document:*/
      document.addEventListener("click", function (e) {
        if (document.getElementById('types').contains(e.target)){
        // Clicked in boxzz
      }else if (document.getElementById('locations').contains(e.target)){
        // Clicked in box
      } 
      else{
          closeAllLists(e.target);
      }
          // closeAllLists(e.target);
    });
}




}

/*An array containing all the country names in the world:*/
//var locations = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
//var types = ["Φροντίδα ηλικιωμένων","Οικιακή βοιήθεια","Φύλαξη παιδιών"]

// if(($("#locations").length) && ($("#types").length) && ($("#filter_nationality").length)){
  if(($("#locations").length) && ($("#types").length) ){
//  autocomplete(document.getElementById("locations"), locations);
//  autocomplete(document.getElementById("types"), specialities.map(item => item.speciality));
    elgMakeSearchAutoComplete();
}

if(($("#locations").length) && ($("#types").length) && ($("#filter_nationality").length)){

    //  autocomplete(document.getElementById("locations"), locations);
    //  autocomplete(document.getElementById("types"), specialities.map(item => item.speciality));
        elgMakeSearchAutoComplete('anazitisi_proswpikou');
    }
    


function elgMakeSearchAutoComplete(cat) {
  let locationsData, specialitiesData, formAction, employersData,nationalityData;
  if ( cat === 'anazitisi_proswpikou') {
     
      locationsData = locations;
      specialitiesData = types;
      nationalityData = nationality;
      formAction = comPersonnelSearchEndPoint;
      if ( document.getElementById('filter_nationality') !== null ) {
        autocomplete(document.getElementById("filter_nationality"), nationalityData);
    }
  }
  else {
      locationsData = locations;
      specialitiesData = types;
      if ( document.URL.includes("aggelies") ) {
        employersData = employers; 
      }
      formAction = comJobsSearchEndPoint;
      // nationalityData = nationality;
    
  }
  
  autocomplete(document.getElementById("locations"), locationsData);
  autocomplete(document.getElementById("types"), specialitiesData);
  // if ( document.getElementById('filter_nationality') !== null ) {
  //     autocomplete(document.getElementById("filter_nationality"), nationalityData);
  // }
  document.forms[0].action = formAction;
}



$(".home_search_categories button").click(function(){
  var cat = $(this).attr('data-cat');
  $('#category').val(cat);
  if (cat == "anazitisi_proswpikou" ) {
    locationsData = locationsPersonnel;
    specialitiesData = typesPersonnel;
    document.getElementById("frontpageform").action = "/search-personnel.html?view=personnellist" ;
  }else {
    document.getElementById("frontpageform").action = "/aggelies.html?view=jobs" ;
    locationsData = locations;
    specialitiesData = types;
  }
  autocomplete(document.getElementById("locations"), locationsData);
  autocomplete(document.getElementById("types"), specialitiesData);
    
  $(this).addClass('active').siblings().removeClass('active');
        // elgMakeSearchAutoComplete(cat);
});



$(".listSliderCategories .tab_button").click(function(){
	var cat = $(this).attr('data-cat');
	// $('#category').val(cat);
	$(this).addClass('active').siblings().removeClass('active');
});




var list_slider = new Swiper(".listSliderContainer .listSlider", {
    // effect:'slide',
    slidesPerView: 1,
	grid: {
	  rows: 3,
	  fill: 'row'
	},
	spaceBetween: 30,
	pagination: {
	  el: ".listSliderContainer .swiper-pagination",
	  clickable: true,
    dynamicBullets: true,
	},
	observer: true,
	observeParents: true,
	autoplay: {
      delay: 3600,
      disableOnInteraction: true,
  },
  breakpoints: {
    567: {
      slidesPerView: 2,
		  spaceBetween: 30,
		  grid: {
		    rows: 3,
		    fill: 'row'
		  },
    },
    640: {
      slidesPerView: 2,
		  spaceBetween: 30,
		  grid: {
		    rows: 3,
		    fill: 'row'
		  },
    },
    840: {
      slidesPerView: 3,
		  spaceBetween: 30,
		  grid: {
		    rows: 3,
		    fill: 'row'
		  },
    },
    1200: {
      slidesPerView: 4,
  		spaceBetween: 30,
  		grid: {
  		  rows: 3,
  		  fill: 'row'
  		},
    },
  },
});





$(".aggeliesSliderCategories .tab_button").click(function(){
	var cat = $(this).attr('data-cat');
	// $('#category').val(cat);
	$(this).addClass('active').siblings().removeClass('active');
});



// var aggelies_slider = new Swiper(".aggelies_slider", {
//     slidesPerView: 1,
//     spaceBetween: 30,
// 	observer: true,
// 	observeParents: true,
//     navigation: {
//       nextEl: ".aggelies_slider_container .button-next",
//       prevEl: ".aggelies_slider_container .button-prev",
//     },
//     breakpoints: {
//       567: {
//         slidesPerView: 1,
//     	spaceBetween: 20,
//       },
//       640: {
//         slidesPerView: 1,
//     	spaceBetween: 20,
//       },
//       840: {
//         slidesPerView: 2,
//     	spaceBetween: 20,
//       },
//       1400: {
//         slidesPerView: 'auto',
//       },
//     },
// });



var pistopoiisiSlider = new Swiper(".pistopoiisiSlider", {
	effect: 'fade',
	loop:true,
	observer: true,
	observeParents: true,
	autoplay: {
      delay: 3600,
      disableOnInteraction: false,
    },
});



var testimonialsSlider = new Swiper(".testimonialsSlider", {
    pagination: {
      el: ".testimonials .swiper-pagination",
    },
	loop:true,
	observer: true,
	observeParents: true,
	autoplay: {
      delay: 3600,
      disableOnInteraction: true,
    },
});



$(".filters_mob_button").click(function(){
  $('.filters_list_container').addClass('opened')
});
$(".close_filters").click(function(){
  $('.filters_list_container').removeClass('opened')
});



function moveBioAndMapInContentWhenMobile(x) {
  if (x.matches) {
    $('.personnelDetailsContainerRightIn').appendTo('.bioAndMapMobile');
  } else {
    $('.personnelDetailsContainerRightIn').appendTo('.personnelDetailsContainerRight');
  }
}

var under991 = window.matchMedia("(max-width: 991px)")
moveBioAndMapInContentWhenMobile(under991)
under991.addListener(moveBioAndMapInContentWhenMobile)

function handlePosition(position) {
  userLatitude =  position.coords.latitude;
  userLongitude =  position.coords.longitude;
}


function handlePositionError(position) {
//  userLatitude =  position.coords.latitude;
//  userLongitude =  position.coords.longitude;
    let dbg = 1;
}


//$("#getLocationBtn").click(function(){
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(handlePosition, handlePositionError);
  }
//});

var userLatitude, userLongitude;



$('#interest').click(function() {
  $('#aggeliaModal').modal('show');
});

$('#cancel').click(function() {
  $('#aggeliaModal').modal('hide');
});

$('#cancel1').click(function() {
  $('#aggeliaModal').modal('hide');
});


var aggelies_slider = new Swiper(".aggelies_slider", {
  slidesPerView: 1,
  spaceBetween: 30,
observer: true,
observeParents: true,
  navigation: {
    nextEl: ".aggelies_slider_container .button-next",
    prevEl: ".aggelies_slider_container .button-prev",
  },
  breakpoints: {
    567: {
      slidesPerView: 1,
    spaceBetween: 20,
    },
    640: {
      slidesPerView: 1,
    spaceBetween: 20,
    },
    840: {
      slidesPerView: 2,
    spaceBetween: 20,
    },
    1400: {
      slidesPerView: 'auto',
    },
  },
});


$(".tab_button_aggelies").on("click", function(){
  var filter = $(this).attr('data-cat').toLowerCase();
  var slidesxcol;
  // $(".tab_button").removeClass("active");
  // $(this).addClass("active");


  if(filter=="all"){
    $("[data-filter]").removeClass("non-swiper-slide").addClass("swiper-slide").fadeIn();
    aggelies_slider.destroy();
    aggelies_slider = new Swiper(".aggelies_slider", {
      slidesPerView: 1,
      spaceBetween: 30,
    observer: true,
    observeParents: true,
      navigation: {
        nextEl: ".aggelies_slider_container .button-next",
        prevEl: ".aggelies_slider_container .button-prev",
      },
      breakpoints: {
        567: {
          slidesPerView: 1,
        spaceBetween: 20,
        },
        640: {
          slidesPerView: 1,
        spaceBetween: 20,
        },
        840: {
          slidesPerView: 2,
        spaceBetween: 20,
        },
        1400: {
          slidesPerView: 'auto',
        },
      },
    });
    
  }
  else {
    $(".aggelies_slider .swiper-slide").not("[data-filter='"+filter+"']").addClass("non-swiper-slide").removeClass("swiper-slide").fadeOut(20);
    $("[data-filter='"+filter+"']").removeClass("non-swiper-slide").addClass("swiper-slide").attr("style", null).fadeIn();
    $("[data-filter='all']").removeClass("non-swiper-slide").addClass("swiper-slide").attr("style", null).fadeIn();
   
    aggelies_slider.destroy();
    aggelies_slider = new Swiper(".aggelies_slider", {
      slidesPerView: 1,
      spaceBetween: 30,
    observer: true,
    observeParents: true,
      navigation: {
        nextEl: ".aggelies_slider_container .button-next",
        prevEl: ".aggelies_slider_container .button-prev",
      },
      breakpoints: {
        567: {
          slidesPerView: 1,
        spaceBetween: 20,
        },
        640: {
          slidesPerView: 1,
        spaceBetween: 20,
        },
        840: {
          slidesPerView: 2,
        spaceBetween: 20,
        },
        1400: {
          slidesPerView: 'auto',
        },
      },
    });
  }
})


$(".tab_button_list").on("click", function(){
  var filter = $(this).attr('data-cat').toLowerCase();
  var slidesxcol;
  // $(".tab_button").removeClass("active");
  // $(this).addClass("active");


  if(filter=="all"){
    $("[data-filter]").removeClass("non-swiper-slide").addClass("swiper-slide").fadeIn();
    list_slider.destroy();
    list_slider = new Swiper(".listSliderContainer .listSlider", {
      slidesPerView: 1,
      grid: {
        rows: 3,
        fill: 'row'
      },
      spaceBetween: 30,
      pagination: {
        el: ".listSliderContainer .swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      observer: true,
      observeParents: true,
      autoplay: {
          delay: 3600,
          disableOnInteraction: true,
      },
      breakpoints: {
        567: {
          slidesPerView: 2,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
        840: {
          slidesPerView: 3,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
      },
    });
    
  }
  else {
    $(".listSlider .swiper-slide").not("[data-filter='"+filter+"']").addClass("non-swiper-slide").removeClass("swiper-slide").fadeOut(20);
    $("[data-filter='"+filter+"']").removeClass("non-swiper-slide").addClass("swiper-slide").attr("style", null).fadeIn();
    $("[data-filter='all']").removeClass("non-swiper-slide").addClass("swiper-slide").attr("style", null).fadeIn();
   
    list_slider.destroy();
    list_slider = new Swiper(".listSliderContainer .listSlider", {
      slidesPerView: 1,
      grid: {
        rows: 3,
        fill: 'row'
      },
      spaceBetween: 30,
      pagination: {
        el: ".listSliderContainer .swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      observer: true,
      observeParents: true,
      autoplay: {
          delay: 3600,
          disableOnInteraction: true,
      },
      breakpoints: {
        567: {
          slidesPerView: 2,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
        840: {
          slidesPerView: 3,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 30,
          grid: {
            rows: 3,
            fill: 'row'
          },
        },
      },
    });
  }
});



const makeTheCall = async () => {
  let call = await fetch('https://www.elpidajob.gr/el/notify-phone-call.json');
  let resp = await call.text();
  // console.log(resp)
}


$('a[href="tel:+30210 5230341"].footer_contact').click(function(){
  makeTheCall()
});
$('.call_us a').click(function(){
  makeTheCall()
});
$('.floating_phone a').click(function(){
  makeTheCall()
});




$('#notifyJob').click(function(){
  gtag('event', 'click', {
    'event_category': '',
    'event_label':'Φόρμα ενδιαφέροντος',
    'value': 1
  });
});

$('#interest').click(function(){
  gtag('event', 'click', {
    'event_category': '',
    'event_label':'Δήλωση ενδιαφέροντος',
    'value': 1
  });
});

$('#notifyJob2').click(function(){
  gtag('event', 'click', {
    'event_category': '',
    'event_label':'Δημιουργία αγγελίας',
    'value': 1
  });
});