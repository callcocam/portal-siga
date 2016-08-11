$(function(){
    var options= {
        beforeSubmit: showComentRequest,  // pre-submit callback
        success: showComentResponse,  // post-submit callback
        type: 'post',        // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json'
    };
    // bind to the form's submit event
    $("#Empresas").ajaxForm(options);
    $("#Profile").ajaxForm(options);
    $("#Classificados").ajaxForm(options);
    $("#cidade-empresa").change(function(){
        $.ajax({
            url:'/cidadeonline/getuf/'+$(this).val(),
            dataType:'json',
            success:function(data){
                console.log(data);
                $("#uf").val(data.uf);
            }

        });
    })

    var btn_remover_anuncio=$(".btn-remover-classificado");
    btn_remover_anuncio.on('click',function(ev)
    {
        var confirm=window.confirm("Deseja Realmente Excluir O Anuncio?");
        if(!confirm){
            ev.preventDefault();
        }

    });

    //CAPA VIEW
    $('#attachment-empresa').on('change',function () {
       // imagePreview($(this),'#imagePreview',$('#images-empresa'));
        var input = $(this);
        var target = $('#images-empresa');
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
            target.fadeOut('fast', function () {
                $('#image-preview').attr('src', fileDefault).fadeIn('slow');
            });
            input.val('');
            return false;
        }
    });
    $('#attachment-user').on('change',function () {
        //imagePreview($(this), '#user-preview',$('#images-user'));
        var input = $(this);
        var target = $('#images-user');
        var fileDefault = target.attr('default');
        if (!input.val()) {
            target.fadeOut('fast', function () {
                $('#user-preview').attr('src', fileDefault).fadeIn('slow');
            });
            return false;
        }
        if (this.files && this.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                target.fadeOut('fast', function () {
                    $('#user-preview').attr('src', e.target.result).fadeIn('fast');
                });
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            target.fadeOut('fast', function () {
                $('#user-preview').attr('src', fileDefault).fadeIn('slow');
            });
            input.val('');
            return false;
        }
    });
    $('#attachment-anuncio').on('change',function () {
        //imagePreview($(this), '#user-preview',$('#images-user'));
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
            target.fadeOut('fast', function () {
                $('#image-preview').attr('src', fileDefault).fadeIn('slow');
            });
            input.val('');
            return false;
        }
    });
})

// pre-submit callback
function showComentRequest(formData, jqForm, options) {
    $('#output').addClass('alert alert-info').html('Enviando...');
    return true;
}

// post-submit callback
function showComentResponse(responseText, statusText, xhr, $form)  {

    $('#output').removeClass('alert alert-info');
    if(responseText.result==true){
        $('#output').addClass('alert alert-success');
        $("#id").val(responseText.data.id);
        $("#codigo").val(responseText.data.codigo);
        $("#asset_id").val(responseText.data.asset_id);

    }
    else{
        $('#output').addClass('alert alert-danger');
    }
    $('#output').html(responseText.error);
}