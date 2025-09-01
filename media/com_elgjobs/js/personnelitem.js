document.addEventListener('DOMContentLoaded', function(e){
    

    
    document.querySelector('.likeButton').addEventListener('click', function(e){
       let button = document.querySelector('.likeButton');
       jQuery.get('/notify.json?task=notify.likep&id=' + button.dataset.id, function(response){
            button.setAttribute("disabled", "disabled");
       }) ;
    });
    
    let submitComment = document.getElementById('submitComment');
    submitComment.addEventListener('click', function(e){
        let data = {};
        data.commentor = document.getElementById('commentor').value;
        data.comment = document.getElementById('comment').value;
        data.idContact = document.getElementById('idContact').value;
        jQuery.post('/notify.json?task=notify.comment', data, function(e){
            document.getElementById('commentResponse').style.display ='block';  
            setTimeout(elgClearComments, 3000);
        });
    });
    
});

function elgClearComments() {
    document.getElementById('commentResponse').style.display ='none';
    jQuery('#postCommentModal').modal('hide');
}
