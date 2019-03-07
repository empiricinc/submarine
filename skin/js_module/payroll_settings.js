$(document).ready(function() {

      var xin_table = $('#xin_table').dataTable({

          "bDestroy": true,

           "ajax": {

                url : base_url+"/list/",

                type : 'GET'

            },

	        "fnDrawCallback": function(settings){

	        $('[data-toggle="tooltip"]').tooltip();          

	        }

        });
      	/* Add data */ /*Form Submit*/

	$("#xin-form").submit(function(e){

	e.preventDefault();

		var obj = $(this), action = obj.attr('name');

		$('.save').prop('disabled', true);

		$('.icon-spinner3').show();

		$.ajax({

			type: "POST",

			url: e.target.action,

			data: obj.serialize()+"&is_ajax=1&add_type=add_payroll_settings&form="+action,

			cache: false,

			success: function (JSON) {

				if (JSON.error != '') {

					toastr.error(JSON.error);

					$('.save').prop('disabled', false);

					$('.icon-spinner3').hide();

				} else {

					xin_table.api().ajax.reload(function(){ 

						toastr.success(JSON.result);

					}, true);

					$('.icon-spinner3').hide();

					$('#xin-form')[0].reset(); // To reset form fields

					$('.save').prop('disabled', false);

				}

			}

		});

	});

		/* Delete data */

	$("#delete_record").submit(function(e){
	/*Form Submit*/

	e.preventDefault();

		var obj = $(this), action = obj.attr('name');

		$.ajax({

			type: "POST",

			url: e.target.action,

			data: obj.serialize()+"&is_ajax=2&form="+action,

			cache: false,

			success: function (JSON) {

				if (JSON.error != '') {

					toastr.error(JSON.error);

				} else {

					$('.delete-modal').modal('toggle');

					xin_table.api().ajax.reload(function(){ 

						toastr.success(JSON.result);

					}, true);							

				}

			}

		});

	});
$( document ).on( "click", ".delete", function() {

	$('input[name=_token]').val($(this).data('record-id'));

	$('#delete_record').attr('action',base_url+'/delete/'+$(this).data('record-id'));

});

});

