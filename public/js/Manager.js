$(function(){

    var options = {
        target:        '#output',   // target element(s) to be updated with server response
        beforeSubmit:  showRequest,  // pre-submit callback
        success:       showResponse,  // post-submit callback
        // other available options:
        //url:       url         // override for form's 'action' attribute
         type:      'post',        // 'get' or 'post', override for form's 'method' attribute
         dataType:  'json'
        //clearForm: true        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit
        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };

// bind to the form's submit event
    $('.Manager').submit(function() {
        $(this).ajaxSubmit(options);
        // !!! Important !!!
        // always return false to prevent standard browser submit and page navigation
        return false;
    });



    $(".delete").click(function(){
        var url= $(this).attr('href');
        var _this=$(this);
        new PNotify({
            title: 'Confirmation Needed',
            text: 'Are you sure?',
            hide: false,
            confirm: {
                confirm: true
            },
            buttons: {
                closer: false,
                sticker: false
            },
            history: {
                history: false
            }
        }).get().on('pnotify.confirm', function() {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        dyn_notice();
                    },
                    success: function (data)
                    {
                        options.title = "Done!";
                        options.type = data.class;
                        options.hide = true;
                        options.text = data.error;
                        options.buttons = {closer: true,sticker: true};
                        options.icon = 'fa fa-check';
                        options.opacity = 1;
                        options.shadow = true;
                        options.width = PNotify.prototype.options.width;
                        notice.update(options);
                        if(data.result==true){
                            _this.parent().parent().parent().parent('.col-box-list').remove();
                        }

                    }
                });
            })
        return false;
    });

    $('.treeview').click(function(){
        return false;
    });

    $('#wizard').smartWizard({
        // Properties
       // selected: 0,  // Selected Step, 0 = first step
       // keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
       // enableAllSteps: false,  // Enable/Disable all steps on first load
       // transitionEffect: 'fade', // Effect on navigation, none/fade/slide/slideleft
       // contentURL:null, // specifying content url enables ajax content loading
       // contentURLData:null, // override ajax query parameters
       // contentCache:true, // cache step contents, if false content is fetched always from ajax url
       // cycleSteps: false, // cycle step navigation
       // enableFinishButton: false, // makes finish button enabled always
       // hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
       // errorSteps:[],    // array of step numbers to highlighting as error steps
        labelNext:"<i class='fa fa-share'></i> PROXIMO", // label for Next button
        labelPrevious:"<i class='fa fa-reply'></i> VOLTAR", // label for Previous button
        labelFinish:"<i class='fa fa-save'></i> FINALIZAR",  // label for Finish button
        //noForwardJumping:false,
        //ajaxType: 'POST',
        // Events
        //onLeaveStep: null, // triggers when leaving a step
       // onShowStep: null,  // triggers when showing a step
       // onFinish: null,  // triggers when Finish button is clicked
       // includeFinishButton : true,   // Add the finish button
       // reverseButtonsOrder: false //shows buttons ordered as: prev, next and finish
    });
});


// pre-submit callback
function showRequest(formData, jqForm, options) {
    dyn_notice();
    //$('.btn').attr('disabled',true);
    return true;
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form)  {
    options.title = "Done!";
    options.type = responseText.class;
    options.hide = true;
    options.text = responseText.error;
    options.buttons = {closer: true,sticker: true};
    options.icon = 'fa fa-check';
    options.opacity = 1;
    options.shadow = true;
    options.width = PNotify.prototype.options.width;
    notice.update(options);
    $('.btn').attr('disabled',false);
}

function print(URL) {
    var mn = 'menubar=no';
    var width = 700;
    var height = 500;
    var left = 99;
    var top = 99;
    window
        .open(
        URL,
        'janela',
        'width='
        + width
        + ',height='
        + height
        + ','
        + mn
        + ',top='
        + top
        + ', left='
        + left
        + ',scrollbars=yes,status=no, toolbar=no,location=no,directories=no,menubar=yes,resizable=no,fullscreen=no');

}