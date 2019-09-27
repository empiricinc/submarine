$(document).ready(function() {

var xin_table = $('#xin_table').dataTable({

	"bDestroy": true,

	"ajax": {

		url : base_url+"/job_list/",

		type : 'GET'

	},

	"fnDrawCallback": function(settings){

	$('[data-toggle="tooltip"]').tooltip();          

	}

});



$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));

$('[data-plugin="select_hrm"]').select2({ width:'100%' }); 



$('#long_description').summernote({

  height: 150,

  minHeight: null,

  maxHeight: null,

  focus: false

});

$('.note-children-container').hide();



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



// edit

$('.edit-modal-data').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);

	var job_id = button.data('job_id');

	var modal = $(this);

$.ajax({

	url : base_url+"/read/",

	type: "GET",

	data: 'jd=1&is_ajax=1&mode=modal&data=job&job_id='+job_id,

	success: function (response) {

		if(response) {

			$("#ajax_modal").html(response);

		}

	}

	});

});



/* Add data */ /*Form Submit*/

$("#xin-form").submit(function(e){

e.preventDefault();

	var obj = $(this), action = obj.attr('name');

	$('.save').prop('disabled', true);

	var long_description = $("#long_description").code();

	$('.icon-spinner3').show();

	$.ajax({

		type: "POST",

		url: e.target.action,

		data: obj.serialize()+"&is_ajax=1&add_type=job&form="+action+"&long_description="+long_description,

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

				$('.add-form').fadeOut('slow');

				$('.icon-spinner3').hide();

				$('#xin-form')[0].reset(); // To reset form fields

				$('.save').prop('disabled', false);

			}

		}

	});

});

});

$( document ).on( "click", ".delete", function() {

$('input[name=_token]').val($(this).data('record-id'));

$('#delete_record').attr('action',base_url+'/delete/'+$(this).data('record-id'))+'/';

});




///////////


// get province 
jQuery(document).on('change', 'select#preven-name', function (e) {
    e.preventDefault();
    var provinceID = jQuery(this).val();
    getCityList(provinceID);
});

// get city
jQuery(document).on('change', 'select#city-name', function (e) {
    e.preventDefault();
    var thecityID = jQuery(this).val();
    getAreaList(thecityID);

});

// get area
jQuery(document).on('change', 'select#area-name', function (e) {
    e.preventDefault();
    var theAreaID = jQuery(this).val();
    getAreaPositionList(theAreaID);

});

// function get All city
function getCityList(provinceID) {
    $.ajax({
        url: base_url+"/getcity",
        type: 'post',
        data: {provinceID: provinceID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#city-name').find("option:eq(0)").html("Please wait..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            options +='<option value="">Select City</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].city_id + '">' + json[i].city_name + '</option>';
            }
            jQuery("select#city-name").html(options);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

// function get All Areas
function getAreaList(thecityID) {
    $.ajax({
        //url: baseurl + "location/getareas",
        url: base_url+"/getareas",
        type: 'post',
        data: {thecityID: thecityID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#area-name').find("option:eq(0)").html("Please wait..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            options +='<option value="">Select Area</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].area_id + '">' + json[i].area_name + '</option>';
            }
            jQuery("select#area-name").html(options);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

// function get All Areas
function getAreaPositionList(theAreaID) {
    $.ajax({
        //url: baseurl + "location/getareas",
        url: base_url+"/getareaspositionsdept",
        type: 'post',
        data: {theAreaID: theAreaID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#area-positions').find("option:eq(0)").html("Please wait..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            //options +='<option value="">Select Area Positions</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].total_job_positions + '">' + json[i].total_job_positions + '</option>';
            }
            jQuery("select#area-positions").html(options);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}