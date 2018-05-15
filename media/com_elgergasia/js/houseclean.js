function submitClean() {
       if(document.getElementById('fullname').value === '' || document.getElementById('address').value === '' || document.getElementById('telephone').value === '' || document.getElementById('area_description').value === '') {
           alert('Τα πεδίο με αστερίσκο (*) είναι υποχρεωτικά');
           return;
       }
       showAsBusy(document.querySelector('.elg'), document.querySelector('.loading-indicator'));
       var fD = jQuery('#cleanForm').serialize();
       var xhr = new XMLHttpRequest();
        xhr.open('POST',  saveURL);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
       xhr.responseType = 'json';
       xhr.send(fD);    
       xhr.onreadystatechange = function(){
           if(xhr.readyState === 4){
               if(xhr.status === 200){
                    renderAppMessages(xhr.response, document.getElementById('houseCleamMessages'));
                    showAsReady(document.querySelector('.elg'), document.querySelector('.loading-indicator'));
               }
           }
       };
}