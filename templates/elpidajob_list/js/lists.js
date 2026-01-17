let url = window.location.href;
let title_search = document.getElementsByClassName("search_page_main_title");

if (url.includes('search-personnel')){
    title_search[0].innerHTML= "<h1>Αναζήτηση προσωπικού</h1>";
}else if (url.includes('aggelies')){
    title_search[0].innerHTML= "<h1>Εύρεση εργασίας</h1>";
}


//let elgListOrdering = document.querySelector(".joblist #orderingSelection");
let elgSearchButton = document.getElementById(".joblist #searchButton");
//if ( elgListOrdering !== null) {
//    elgListOrdering.addEventListener("change", comJobsStartSearch);
//}
if ( elgSearchButton !== null ){    
    elgSearchButton.addEventListener("click", comJobsStartSearch);
}
function comJobsStartSearch() {
    let filter = {};
    let list = {};
    list.fullordering = elgListOrdering.value;
    filter.hours = comJobsArrayForUrl("hour", comJobsSelectionToArray("#filterHour :checked") );
    filter.sizes = comJobsArrayForUrl("size", comJobsSelectionToArray("#filterSizes :checked" ) );
    filter.distances = comJobsArrayForUrl("dist", comJobsSelectionToArray("#filterDistance :checked" ) );
    filter.specialities =  comJobsArrayForUrl("spec", comJobsSelectionToArraySpeciality("#types" ) );
    filter.locations =  comJobsArrayForUrl("loc", comJobsSelectionToArray("#locations" ) );
    filter.employers =  comJobsArrayForUrl("emp", comJobsSelectionToArray("#employers" ) );
    let urlParams = new URLSearchParams(window.location.search);
    let type = urlParams.get('type');
    
    if ( type !== undefined) {
        filter.type = type;
    }
    else {
        filter.type = '';
    }
    listParams = "?list[fullordering]=" + list.fullordering + filter.hours 
            + filter.sizes + filter.distances
            + filter.specialities + filter.locations + filter.type;
    
//    searchJob();
    
}

function comJobsSelectionToArray(selector) {
    let ret =[];
    document.querySelectorAll(selector).forEach((a) => ret.push(a.value) );
    return ret;
}

function comJobsSelectionToArraySpeciality(selector) {
    let ret = [];
    document.querySelectorAll(selector).forEach((a) => { 
        let specialityFound = specialities.find(specialityItem => ( specialityItem.speciality == a.value ) );
        if ( specialityFound !== undefined ) {
            ret.push(specialityFound.idSpeciality);
        }
        //ret.push( specialities.filter(specility) => speciality. ) };
    });
    return ret;
}


function comJobsArrayForUrl(urlVar, array) {
    return array.reduce(
            ( previousValue, currentValue ) => { return previousValue + '&' + urlVar + '[]=' + currentValue },
             '');
}


 document.getElementById('orderingSelection').addEventListener('change', (e) => {
    
   document.getElementById('mainSearchForm').submit();
    
});