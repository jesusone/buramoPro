
jQuery(document).ready(function($) {
	jQuery('.bur-check-time').on('click' , function(event) {
		var day        = jQuery(this).data('day');
		var id_time    = jQuery(this).data('time');
		var fortune_id = jQuery(this).data('id');
		jQuery.ajax({
	            url : 'setScheduleAjax',
	            type : 'POST',
	            dataType : 'text',
	            data: {
	            	id: fortune_id,
	            	day: day,
	            	id_time: id_time
	            },
	            success : function (result){
	            }
          });
	});

	jQuery('.bur-infor-user').on('click' , function(event) {
		var day        = jQuery(this).data('day');
		var id_time    = jQuery(this).data('time');
		var fortune_id = jQuery(this).data('id');

		jQuery.ajax({
	            url : 'inforUserScheduleAjax',
	            type : 'POST',
	            dataType : 'json',
	            data: {
	            	id: fortune_id,
	            	day: day,
	            	id_time: id_time
	            },
	            success : function (result){
	            	console.log(result);
	            	var html = '';
	            	html += '<p>Username:' + result.user.full_name + '</p>';
	            	html += '<p>Email:' + result.user.mail_address + '</p>';
	            	html += '<p>Telephone:' + result.user.telephone + '</p>';
	            	jQuery('.modal-body').html(html);
	            }
          });
	});


});

