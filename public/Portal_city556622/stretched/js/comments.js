$(function(){
    var output=$('#output');
    var options= {
        target: output,   // target element(s) to be updated with server response
        beforeSubmit: showComentRequest,  // pre-submit callback
        success: showComentResponse,  // post-submit callback
        type: 'post',        // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json'
    };
    // bind to the form's submit event
    $("#Comentarios").ajaxForm(options);
    $('body').on('click','.btn-reply',function()
    {
       options = {
            target: $($(this).attr('href')).children('.data-status'),   // target element(s) to be updated with server response
            beforeSubmit: showComentRequest,  // pre-submit callback
            success: showComentResponse,  // post-submit callback
            type: 'post',        // 'get' or 'post', override for form's 'method' attribute
            dataType: 'json'
        };
        $('.reply').fadeOut(400);
        $($(this).attr('href')).fadeIn('slow');
        $($(this).attr('href')).children('form').ajaxForm(options);
        return false;
    });

})
// pre-submit callback
function showComentRequest(formData, jqForm, options) {
    $(options.target).html('<div class="alert alert-info"><strong>Enviando...</strong></div>');
    output=options.target;
    return true;
}

// post-submit callback
function showComentResponse(responseText, statusText, xhr, $form)  {
   console.clear();
    console.log(output);
    if(responseText.result==true){
        output.addClass('alert alert-success');
        var conteudo=$('#load-comments');
        conteudo.load('/cidadeonline/loadcomments'+responseText.data.parent+'s/'+responseText.data.parent_id);
        $("#description").val("");
        $("#nota").val("5");
    }
    else{
        output.addClass('alert alert-danger');
    }
    output.html(responseText.error);
}