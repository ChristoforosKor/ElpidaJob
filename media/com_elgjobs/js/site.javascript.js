
function showAsBusy(contData, contIndicator) {
    contData.style.display = 'none';
    contIndicator.style.display = 'block';
}

function showAsReady(contData, contIndicator) {
    contData.style.display = 'block';
    contIndicator.style.display = 'none';
}




function clearChildren(parent) {
    while(parent.firstChild) parent.removeChild(parent.firstChild);
}



/**
 * Contructs an html messahe string from a joomla json response.
 * @param {JSON} response The xhr response.
 * @param {node} messageArea The dom node where the message will be rendered.
 * @returns {String} The constacted html string.
 */
function renderAppMessages(response, messageArea){
    var msg='';
    clearChildren(messageArea);
    if(response.messages)
        Object.keys(response.messages).forEach(function(val){
            msg += '<div class="alert alert-' + val + '" ><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.messages[val].join('<br />') + '</div>';
        });
    messageArea.innerHTML = msg;
}
