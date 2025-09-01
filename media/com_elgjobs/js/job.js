let employerSelect, candidateSelect;
let parser = new DOMParser();
let jobSync = 0;



function addDefaultCandidateOption(itemData) {
    let data = getJobCandidateData(itemData);
    var option = new Option(data.lastname, data.id, true, true);
    option.dataset.id = (data.id ? data.id : 0);
    option.dataset.lastname = (data.lastname ? data.lastname : '');
    option.dataset.name = (data.name ? data.name : '');
    option.dataset.image = (data.image ? data.image : '');
    option.dataset.address = (data.address ? data.address : '');
    option.dataset.telephone = (data.telephone ? data.telephone : '');
    option.dataset.postcode = (data.postcode ? data.postcode : '');
    candidateSelect.append(option).trigger('change');
    candidateSelect.trigger({
        type: 'select2:select',
        params: {
            data: data
        }
    });
}

function getJobCandidateData(data) {
    
    return {
        id: (data.id ? data.id : 0),
        lastname: (data.lastname ? data.lastname : ''),
        name: (data.name ? data.name : ''),
        image: (data.image ? data.image : ''),
        address: (data.address ? data.address : ''),
        telephone: (data.telephone ? data.telephone : ''),
        postcode: (data.postcode ? data.postcode : '')
    }
}


document.addEventListener('DOMContentLoaded', function (e) {
    jQuery('.select2').select2();
    employerSelect = $('#jobForm_idEmployer');
    employerSelect.select2({
        ajax: {
            url: '/employerlist.json?task=Employer.select2',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    filter: {DiscreteTitle: params.term},
                    limitstart: params.page * 10 || 0,
                    list: {limit: 10}
                };
                return query;
            },

            processResults: function (response, params) {
                params.page = params.page || 1;
                let ret = {
                    results: response.data,
                    pagination: {
                        more: (params.page * 10) < response.data.totalCount
                    }
                };
                return ret;
            }
        },
        templateResult: function (item) {
            if (item.loading) {
                return item.text;
            }
            $item = $('<div class="text-primary" >' + item.DiscreteTitle + '</div><address class="text-secondary">Τηλ: ' + item.Telephone + ' ' + item.Mobile + '<br>Δ/νση: ' + item.EmpAddress + ' ' + item.Zip + ' ' + item.EmpArea + '</address>');
            return $item;
        },
        templateSelection: function (item) {
            return item.DiscreteTitle || item.text;
        }     
        
    });

    candidateSelect = $('#jobForm_idCandidate');
//    if (idJobCandidate > 0) {
//        $.getJSON('/search-personnel.json?task=Personnel.select2&filter[id]=' + idJobCandidate, function (data, stsus, xhr) {
//            if (data.data.length > 0) {
//                addDefaultCandidateOption(data.data[0]);
//            } else {
//                addDefaultCandidateOption({});
//            }
//        });
//    } else {
//        addDefaultCandidateOption({});
//    }
    
    candidateSelect.select2({
        /*
        ajax: {
            url: '/search-personnel.json?task=Personnel.select2',
            dataType: 'json',
            delay: 250,
            allowClear: true,
            data: function (params) {
                var query = {
                    filter: {name: (params.term ? params.term : '')},
                    limitstart: params.page * 10 || 0,
                    list: {limit: 10}
                };
                return query;
            },

            processResults: function (response, params) {
                params.page = params.page || 1;
                let ret = {
                    results: response.data,
                    pagination: {
                        more: (params.page * 10) < response.data.totalCount
                    }
                };
                return ret;
            }
        },
        templateResult: function (item) {
            if (item.loading) {
                return item.text;
            }


            $htmlItem = $('<div class="row"><div class="col-md-3" >' + getImageForJobEdit( item.image) + '</div><div class="col-md-9"> <div class="text-primary" >(' + item.id + ') ' + item.lastname + ' ' + item.name + '</div><address class="text-secondary">'  + item.address + ' ' + item.postcode + ' <br>' + ( item.telephone || '' ) +'</address></div></div>');
            return $htmlItem;
        },
        templateSelection: function (item) {
            return $('<div class="row"><div class="col-md-3" >' + getImageForJobEdit( item.image || item.element.dataset.image) + '</div><div class="col-md-9"> <span class="text-primary" >(' + item.id + ') ' + ( item.lastname || item.element.dataset.lastname) + ' ' + (item.name || item.element.dataset.name) + '</span><br><span class="text-secondary">' + (item.address || item.element.dataset.address) + ' ' + (item.postcode || item.element.dataset.postcode) + '<br>'  + (item.telephone || item.element.dataset.telephone || '') + '</span></div></div>');
        } */
        
        
        ajax: {
            url: '/api/index.php/v1/params?opt=seateam',
            dataType: 'json',
            delay: 400,
            data: function (params) {
                ret = {
                    term: params.term,
                    pageTo: params.page || 1
                };

                return ret;
            },

            processResults: function (response) {
                const results = response.data.map((item) => {
                    return {
                        id: item.attributes.id, 
                        name: item.attributes.name, 
                        image: getImage(item.attributes.image),
                        address: `${item.attributes.address} ${item.attributes.postcode} ${item.attributes.suburb}`,
                        phone: item.attributes.mobile || item.attributes.telephone
                    };
                });

                return {
                    results: results,
                    pagination: {
                        more: response.links.next ? true : false
                    }
                };
            }
        },
        templateResult: function (item) {
            if (item.loading) {
                return item.text;
            }
            
            return jQuery(candidateInnerHTML(item.id, item.name, item.image, item.address, item.phone));
        },
        templateSelection: function (item) {
            const image = item.element.dataset.image ? item.element.dataset.image: item.image;
            const name = item.element.dataset.name ? item.element.dataset.name : item.name;
            const address = item.element.dataset.address ? item.element.dataset.address : item.address;
            const phone = item.element.dataset.phone ? item.element.dataset.phone : item.phone;
            return jQuery(candidateInnerHTML(item.id, name, image, address, phone, true));
        }
    });
});

 jQuery.ajax({
        type: 'GET',
        url: '/api/index.php/v1/params?opt=stojob&term=' + document.getElementById('jobForm_id').value
    }).then(function (data) {
//        const select2Data = data.data.map(item => {
//                    id: id, 
//                    text: text,
//                    image:  image && image !== '' ? image : "images/elgjobs/users/default_user.jpg",
//            
//            selected: selected
//            }
//        }, item.attributes.name, item.attributes.image, true));
//        const select2Data = data.data.map(item =>{
//           return {
//               id: item.attributes.id,
//               name: item.attributes.name
//           }; 
//        });
        for (const item of data.data) {
//            const text = item.text;
            const option = new Option('', item.attributes.id, true, true);
            option.dataset.name = item.attributes.name;
            option.dataset.image = getImage(item.attributes.image);
            option.dataset.address = `${item.attributes.address} ${item.attributes.postcode} ${item.attributes.suburb}`
            option.dataset.phone =  item.attributes.mobile || item.attributes.telephone;
            candidateSelect.append(option).trigger('change');
        }
    });


 const getImage = (image2Check) => {
        if (image2Check && image2Check !== '')
            return image2Check;
        return "images/elgjobs/users/default_user.jpg";
    };

    const candidateInnerHTML = (id, name, image, address, phone, createLink = false) => {
        
        let html = `${name} <address class="text-secondary">${address}<br>${phone}</address>`;
        if (createLink) {
            html = `<a href="epexergasia-prosopikou.html?id=${id}" >${html}</a>`;
        }
        return `<span class="userListTile" id="${id}" ><span class="userListTileImg"><img src="/${image}" ></span><span class="userListTileTxt">${html}</span></span>`;
    };
    
    
    const dataO = (id, text, image, selected) => {
        return {
            id: id, 
            text: text,
            image:  image && image !== '' ? image : "images/elgjobs/users/default_user.jpg",
            
            selected: selected
        };
    };

function getImageForJobEdit( image ) {
    
    
    if ( image) {
        return '<img src="/' + image + '" >';
    } else {
        return '<img src="/images/elgjobs/users/default_user.jpg" >';
    }
}

function popEditEmployer() {
    let selectedEmployerId = employerSelect.val();
    if (selectedEmployerId === '') {
        return;
    }
    document.querySelector('.loading-indicator').style.display = 'block';
    $.getJSON("/employer.json?id=" + selectedEmployerId, function (response) {
        fillEmployerForm(response.data);
        document.querySelector('.loading-indicator').style.display = 'none';
    });
}

function elgJobPlaceChanged(searchBox, newMarkersArray) {
    var place = searchBox.getPlaces()[0];

    if (newMarkersArray.length !== 0) {
        newMarkersArray[0].setMap(null);
        newMarkersArray = [];
    }

    addMarker(place.geometry.location);

    let addressComponents = place.address_components.reduce(function (prev, cur) {
        prev[cur.types[0]] = cur.long_name;
        return prev;
    }, {});
    $('#jobForm_lat').val(place.geometry.location.lat());
    $('#jobForm_lng').val(place.geometry.location.lng());
    $('#jobForm_city').val(addressComponents.locality);
    $('#jobForm_county').val(addressComponents.administrative_area_level_3);
    $('#jobForm_country').val(addressComponents.country);
    $('#jobForm_postcode').val(addressComponents.postal_code);

//        return newMarkersArray;
}




/** employer form **/




// document.getElementById('btnSaveEmployer').addEventListener('click', saveEmployer);
employerForm = document.getElementById('newEmployerForm');
employerForm.addEventListener('submit', saveEmployer);

function fillEmployerForm(data) {


    document.querySelector('.modal-body').style.display = 'block';
    document.getElementById('employerForm_id').value = data.id;
    document.getElementById('employerForm_DiscreteTitle').value = data.DiscreteTitle;
    document.getElementById('employerForm_Telephone').value = data.Telephone;
    document.getElementById('employerForm_Mobile').value = data.Mobile;
    document.getElementById('employerForm_idIndustry').value = data.idIndustry;
    document.getElementById('employerForm_EmpArea').value = data.EmpArea;
    document.getElementById('employerForm_EmpAddress').value = data.EmpAddress;
    document.getElementById('employerForm_Email').value = data.Email;
    document.getElementById('employerForm_TaxNo').value = data.TaxNo;
    document.getElementById('employerForm_TaxOffice').value = data.TaxOffice;
    document.getElementById('employerForm_Comments').value = data.Comments;
    document.getElementById('employerForm_Profession').value = data.Profession;
    document.getElementById('employerForm_idEmployerType').value = data.idEmployerType;
    document.getElementById('employerForm_Zip').value = data.Zip;
    document.getElementById('employerForm_Fax').value = data.Fax;
    document.getElementById('employerForm_WebPage').value = data.WebPage;
    $('#employerForm_idCountry').val(data.idCountry);
    document.getElementById('modalMessage').innerHTML = '';
    $('#employerForm').modal('show');

}


jQuery('#employerForm').on('hidden.bs.modal', function () {
    document.querySelector('.loading-indicator').style.display = 'none';
    document.getElementById('employerForm_id').value = "";
    document.getElementById('employerForm_DiscreteTitle').value = "";
    document.getElementById('employerForm_Telephone').value = "";
    document.getElementById('employerForm_Mobile').value = "";
    document.getElementById('employerForm_idIndustry').value = "";
    document.getElementById('employerForm_EmpArea').value = "";
    document.getElementById('employerForm_EmpAddress').value = "";
    document.getElementById('employerForm_Email').value = "";
    document.getElementById('employerForm_TaxNo').value = "";
    document.getElementById('employerForm_TaxOffice').value = "";
    document.getElementById('employerForm_Comments').value = "";
    document.getElementById('employerForm_Profession').value = "";
    document.getElementById('employerForm_idEmployerType').value = "";
    document.getElementById('employerForm_Zip').value = "";
    document.getElementById('employerForm_Fax').value = "";
    document.getElementById('employerForm_WebPage').value = "";
    $('#employerForm_idCountry').val("");
    document.getElementById('modalMessage').innerHTML = '';
    jQuery('#employerForm_idCountry').val();

});


function saveEmployer(e) {
    e.preventDefault();
    document.querySelector('.modal-body').style.display = 'none';
    document.querySelector('.loading-indicator').style.display = 'block';
    fd = new FormData(employerForm);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "/employer-save.json");
    xhr.responseType = 'json';
    xhr.send(fd);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let messageString = {};
                let hasErrors = false;
                Object.keys(xhr.response.messages).forEach(function (errorType) {
                    if (errorType === 'warning' || errorType === 'error' || errorType === 'danger') {
                        hasErrors = true;
                    }
                    xhr.response.messages[errorType].forEach(function (errMessage) {
                        if (typeof messageString[errorType] === 'undefined') {
                            messageString[errorType] = '';
                        }
                        messageString[errorType] += errMessage;
                    });
                });
                let htmlMessage = '';
                Object.keys(messageString).forEach(function (errorType) {
                    htmlMessage += '<div class="alert alert-' + errorType + '" >' + messageString[errorType] + '</div>';
                });
                document.getElementById('modalMessage').innerHTML = htmlMessage;
                if (!hasErrors) {
                    addNewEmployer(xhr.response.data);
                    jQuery('#employerForm').modal('hide');
                }

            }
        }
    };
}

function addNewEmployer(data) {
//    var option = '<option value="' + data.id + '" >' + data.name + ' - ' + data.discreteTitle + '</option>';
    var newOption = new Option(data.DiscreteTitle, data.id, false, true);
    employerSelect.append(newOption);
    employerSelect.append(newOption).trigger('change');
}
