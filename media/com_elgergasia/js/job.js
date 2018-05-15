var employerFrom = null;
var employerSelect = null;
var employerModal = null;
document.addEventListener('DOMContentLoaded', function(e){
    if(document.getElementById('idSpeciality').value === '57') {
        showOldCares();
    }
    document.getElementById('idSpeciality').addEventListener('change', changedSpeciality);
   
    employerSelect = jQuery('#idUser').select2(); 
    document.getElementById('btnSaveEmployer').addEventListener('click', saveEmployer);
    employerForm = document.getElementById('newEmployerForm');
    jQuery('#employerForm').on('hidden.bs.modal', function () {
        document.querySelector('.loading-indicator').style.display='none';
        document.querySelector('.modal-body').style.display='block';
        document.getElementById('name').value = '';
        document.getElementById('discreteTitle').value = '';
        document.getElementById('phone').value='';
        document.getElementById('mobile').value='';
        document.getElementById('idIndustry').value='';
        document.getElementById('city').value='';
        document.getElementById('address').value='';
    });
});

function changedSpeciality(e) {
    if(e.originalTarget.value === '57') {
        showOldCares();
    }
    else {
        hideOldCares();
        clearOldCares();
    }
    
}

function showOldCares() {
    document.getElementById('medicalCare').style.display = 'block';
    document.getElementById('oldPeople').style.display = 'block';
}

function hideOldCares() {
    document.getElementById('medicalCare').style.display = 'none';
    document.getElementById('oldPeople').style.display = 'none';
}

function clearOldCares() {
    document.getElementById('medicalCare').value = '';
    document.getElementById('oldPeople').value = '';
}

function saveEmployer(e) {
    document.querySelector('.modal-body').style.display='none';
    document.querySelector('.loading-indicator').style.display='block';
    fd = new FormData (employerForm);
    var   xhr = new XMLHttpRequest();
    xhr.open('POST', newEmployerUrl);
    xhr.responseType = 'json';
    xhr.send(fd);    
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                if(xhr.response.error !== '')
                    document.getElementById('modalMessage').textContent = xhr.response.error;
                else {
                    addNewEmployer(xhr.response);
                    jQuery('#employerForm').modal('hide');
                }
            }
        }
    };
    
}

function addNewEmployer(data) {
    var option = '<option value="' + data.id + '" >' + data.text + '</option>';
    employerSelect.append(option);
    employerSelect.val(data.id).trigger('change');    
}