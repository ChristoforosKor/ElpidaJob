<?php
/**
 * @package     ELG.Jobs.site
 * @subpackage  com_elgjob
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;

/**
 * @todo Τα λεκτικά από μετάφραση.
 */
?>

<?php if ($this->isAuthorised == 1): ?>
    <div class="jobDetailsContent">
        <br><h4 class="chip"><?php echo $this->item->jobState; ?> (<?php echo Text::_('COM_ELGERGASIA_ID_SMALL') . ' ' . $this->item->id; ?>)</h4>  
    </div>
<?php endif ?>

<div class="seperator-l"></div>
<div class="row">
    <div class="col-md-8 mb-4 mb-sm-0">
        <div class="jobDescription">
            <h5 class="personnelDetailsGeneralTitle">ΠΕΡΙΓΡΑΦΗ</h5>
            <p><?php echo $this->item->jobDescription; ?></p>
        </div>

        <div class="seperator-l"></div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3141.631872192029!2d23.737782315598587!3d38.055663203721444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7e4aa9120d7ff12e!2zMzjCsDAzJzIwLjQiTiAyM8KwNDQnMjMuOSJF!5e0!3m2!1sen!2sgr!4v1641669594405!5m2!1sen!2sgr" width="600" height="250" style="border:0; width:100%" allowfullscreen="" loading="lazy"></iframe>

    </div>

    <div class="col-md-4">
        <div class="jobDetails">
            <h5 class="personnelDetailsGeneralTitle">ΧΑΡΑΚΤΗΡΙΣΤΗΚΑ ΑΓΓΕΛΙΑΣ</h5>
            <div class="jobDetailsBlocks">
<?php foreach ($this->item->specs as $spec): ?>
                    <div class="jobDetailsBlock">
                        <h5 class="jobDetailsTitle"><?php echo $spec[0]; ?></h5>
                        <div class="jobDetailsContent">
                            <div class="chip"><?php echo $spec[1]; ?></div>
                        </div>
                    </div>
<?php endforeach;
unset($spec); ?>

            </div>
        </div>
    </div>
</div>


<div class="seperator-l"></div>

<?php if ($this->isAuthorised == 1 && $this->item->documents != null) :
    foreach (explode(",", $this->item->documents) as $document):
        ?>
        <span class="d-inline bg-info isFile"><a href="/<?php echo $document; ?>" class="text-white" target="_blank" ><?php echo basename($document); ?></a></span>
    <?php endforeach;
endif;
?>
<div class="jobContactContainer">
    <div class="time_to_reply_container"><?php echo $this->item->jobTitle; ?></div>
    <div class="job-candidates">
        <?php
        if (isset($this->item->candidates)):
            forEach ($this->item->candidates as $candidate):
                if ($candidate->image == ''):
                    $image = "images/elgjobs/users/default_user.jpg";
                else:
                    $image = $candidate->image;
                endif;
                ?>
                <span class="userListTile">
                    <span class="userListTileImg">
                        <img src="/<?php echo $image; ?>">
                    </span>
                    <span class="userListTileTxt">
                        <a href="epexergasia-prosopikou.html?id=<?php echo $candidate->id; ?>"> <?php echo $candidate->name; ?> 
                            <address class="text-secondary"> <?php echo $candidate->address, ' ', $candidate->suburb, ' ', $candidate->postcode; ?>
                                <br><?php echo $candidate->mobile, ' ', $candidate->telephone; ?>
                            </address>
                        </a>
                    </span>
                </span>
    <?php endforeach;
endif; ?>
    </div>
<?php if ($this->item->idJobState == 2 ): ?> 
        <div class="mt-2 mb-2 mt-sm-3 mb-sm-3 d-flex">
            <button id ="interest"  role="button" class="button button_filled bg_blue">Δήλωση Ενδιαφέροντος</button>
        </div>
<?php endif; ?>
</div>

<?php if ($this->isAuthorised == 1) : ?>
    <div class="jobContactContainer">

        <div class="mt-2 mb-2 mt-sm-3 mb-sm-3 d-flex">
            <a href="/epexergasia-aggelias/?task=job.edit&id=<?php echo $this->item->id; ?>" class="button button_filled bg_blue"><?php echo Text::_('COM_ELG_EDIT'); ?></a>
        </div>
    </div>
<?php endif; ?>
<div id="aggeliaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Προσωπικά στοιχεία</h4>
                <button id ="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="messageArea"></div>
            </div>
            <!-- <form method="post" action="/groupcallkomy.json" id="eodyDataForm"> -->
            <!--<form name="interestForm"  method="post" enctype="multipart/form-data" id="jobInterestForm">--> 
            <div class="modal-body">
                <input type="hidden" name="task"  value="job.save" />
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p>Συμπληρώστε τα στοιχεία σας και θα επικοινωνήσουμε το συντομότερο</p>
                        <div class="input_container">
                            <label id="notifyfullname-lbl" for="notify_fullname">Ονοματεπώνυμα</label>
                            <div class="input" >
                                <input type="text" id="notify_fullname" name="notify[fullname]" class="form-control" >                           
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input_container">
                            <label id="notifytelephone-lbl" for="notify_telephone">Τηλέφωνο *</label>
                            <div class="input" >
                                <input type="text" id="notify_telephone" name="notify[telephone]" type="tel" class="form-control" required>                           
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="input_container">
                            <label id="notifyemail-lbl" for="notify_email">E-mail</label>
                            <div class="input" >
                                <input type="text" id="notify_email" name="notify[email]" type="email" class="form-control" >                           
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input_container">

                            <input type="checkbox" id="consent_job" > <label id="consent-job-lbl" for="consent_job">Συναινείτε στην αποστολή των στοιχείων σας στον αρμόδιο συνεργάτης μας τα οποία θα χρησιμοποιηθούν για να επικοινωνήσει μαζί σας. Δεν θα γίνει καταγραφή τους στον ιστότοπό μας.</label>                           

                        </div>
                    </div>
                    <div class="response"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id ="cancel1" type="button" class="button button_outlined dark" data-bs-dismiss="modal">Ακύρωση</button>
                <button type="button" id="notifyJob" class="button button_filled bg_blue">Καταχώρηση</button>
            </div>
            <!--</form>-->
        </div>

    </div>
</div>
<script type="text/javascript" language="javascript">
//    document.addEventListener('DOMContentLoaded', function (le) {

    document.getElementById('aggeliaModal').addEventListener('shown.bs.modal', function () {
        document.getElementById('consent_job').checked = false;
    });


//        document.getElementById('jobInterestForm').addEventListener('submit', function(e) {
//            console.log('in');
    document.getElementById('notifyJob').addEventListener('click', function (e) {
        let postData = {};
        postData.fullname = document.getElementById('notify_fullname').value.trim(/ /g, '');
        if (document.getElementById('consent_job').checked === false) {
            alert('Η συναίνεση σας για τη χρήση των στοιχείων επικοινωνίας σας είναι απαραίτητη');
            return;
        }

        if (postData.fullname === '') {
            alert("Παρακαλώ συμπληρώστε το ονοματεπώνυμό σας.")
            return;
        }


        if (postData.notify_telephone === '') {
            alert("Παρακαλώ συμπληρώστε το τηλέφωνό σας.")
            return;
        }


        postData.email = document.getElementById('notify_email').value.trim(/ /g, '');
        postData.telephone = document.getElementById('notify_telephone').value.trim(/ /g, '');
        if (postData.telephone === '') {
            alert("Παρακαλώ συμπληρώστε το τηλέφωνο σας");
            return;
        }
        postData.recordUrl = encodeURI(location.href);
        postData.type = "1";
        postData.task = "notify.notify";
        jQuery.post("/notify.json", postData, function (response) {
            let message = '';
            Object.keys(response.messages).forEach(function (messageType) {
                let typeMessage = '';
                response.messages[messageType].forEach(function (message) {
                    typeMessage += message + '<br>';
                });
                message += '<p class="alert alert-' + messageType + ' ">' + typeMessage + '<p>';
            });
            document.querySelector('.modal .response').innerHTML = message;
            setTimeout(elgClearNotificationModal, 3000);
        });

    });
//    });

    function elgClearNotificationModal() {
        jQuery('#aggeliaModal').modal('hide');
        document.getElementById('notify_fullname').value = '';
        document.getElementById('notify_telephone').value = '';
        document.getElementById('notify_email').value = '';
        document.querySelector('.modal .response').innerHTML = '';
    }
</script>
