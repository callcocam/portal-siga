$(function() {

    var options = {
        target: '#output',   // target element(s) to be updated with server response
        beforeSubmit: showRequest,  // pre-submit callback
        success: showResponse,  // post-submit callback
        // other available options:
        //url:       url         // override for form's 'action' attribute
        type: 'post',        // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json'
        //clearForm: true        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit
        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };

// bind to the form's submit event
    $('.Manager').ajaxForm(options);

    $(".delete").click(function () {
        var url = $(this).attr('href');
        var _this = $(this);
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
        }).get().on('pnotify.confirm', function () {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        dyn_notice();
                    },
                    success: function (data) {
                        options.title = "Done!";
                        options.type = data.class;
                        options.hide = true;
                        options.text = data.error;
                        options.buttons = {closer: true, sticker: true};
                        options.icon = 'fa fa-check';
                        options.opacity = 1;
                        options.shadow = true;
                        options.width = PNotify.prototype.options.width;
                        notice.update(options);
                        if (data.result == true) {
                            _this.parent().parent().parent().parent('.col-box-list').remove();
                        }

                    }
                });
            })
        return false;
    });

    $('.treeview').click(function () {
        return false;
    });

     //CAPA VIEW
    $('#attachment').change(function () {
       var input = $(this);
        var target = $('#images');
        var fileDefault = target.attr('default');
       if (!input.val()) {
            target.fadeOut('fast', function () {
                $('#image-preview').attr('src', fileDefault).fadeIn('slow');
            });
            return false;
        }
        if (this.files && this.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                target.fadeOut('fast', function () {
                    $('#image-preview').attr('src', e.target.result).fadeIn('fast');
                });
            };
            reader.readAsDataURL(this.files[0]);
        } else {
                    PNotify.removeAll();
                    new PNotify({
                        title: 'Oh No!',
                            text: 'O arquivo selecionado não é válido! Selecione uma <b>imagem JPG ou PNG</b> para enviar!',
                        type: 'error'
                    });
                
            target.fadeOut('fast', function () {
                $('#image-preview').attr('src', fileDefault).fadeIn('slow');
            });
            input.val('');
            return false;
        }
    });

   
});
function lerUserOnlie() {
    $.get('/admin/user-online', function (data) {
         $("#rest").html(data);
    });
}

// pre-submit callback
function showRequest(formData, jqForm, options) {
    dyn_notice();
    //$('.btn').attr('disabled',true);
    return true;
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form)  {
    if(responseText.result==true){
        $('#id').val(responseText.data.id);
        $('#save_copy').attr('disabled',false);
     }
   
    
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