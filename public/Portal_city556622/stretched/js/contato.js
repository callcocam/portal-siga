$(function () {
	/* Contact us process */
	$("#Mail").submit(function() {
		var submitData = $('#Mail').serialize();
        $("#Mail .data-status").hide();
		$("#Mail input[name='title']").attr('disabled','disabled');
		$("#Mail input[name='email']").attr('disabled','disabled');
		$("#Mail input[name='subject']").attr('disabled','disabled');
		$("#Mail textarea[name='description']").attr('disabled','disabled');
		$("#Mail input[name='submit']").attr('disabled','disabled');
		$("#Mail .data-status").addClass('alert alert-info').show().html('<strong>Loading...</strong>');
		$.ajax({ // Send an offer process with AJAX
			type: "POST",
			url: "/cidadeonline/contact",
			data: submitData,
			dataType: "json",
			success: function(dataResult){
                     $("#Mail .data-status").removeClass('alert-info');
                     $("#Mail .data-status").removeClass('alert-danger');
                     $("#Mail .data-status").removeClass('alert-success');
                     $("#Mail .data-status").addClass(dataResult.classe);
					if (dataResult.result) {
						$("#Mail input[name='title']").val('').removeAttr('disabled');
						$("#Mail input[name='email']").val('').removeAttr('disabled');
						$("#Mail input[name='subject']").val('').removeAttr('disabled');
						$("#Mail textarea[name='description']").val('').removeAttr('disabled');
						$("#Mail input[name='submit']").removeAttr('disabled');
						$("#Mail .data-status").html(dataResult.error).fadeIn();
					} else {
						$("#Mail input[name='title']").removeAttr('disabled');
						$("#Mail input[name='email']").removeAttr('disabled');
						$("#Mail input[name='subject']").removeAttr('disabled');
						$("#Mail textarea[name='description']").removeAttr('disabled');
						$("#Mail input[name='submit']").removeAttr('disabled');
						$("#Mail .data-status").html(dataResult.error).fadeIn();
					}
					
				}
		});
		return false;
	});
})