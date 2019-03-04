$(function() {
	$("#datepicker1").datepicker({
		minDate: 0,
		maxDate: '+1Y+6M',
		 todayHighlight: true,
		 dateFormat: "dd-mm-yy",
		onSelect: function (dateStr) {
			var pick_time = $("#timepicker2").val();
			validate_pickup_time(dateStr,pick_time);
			var min = $("#datepicker1").datepicker('getDate'); // Get selected date
			$("#datepicker2").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
		},
		beforeShowDay: function(date) {
			var string = $.datepicker.formatDate('dd-mm-yy', date);
		    return [forbidden.indexOf(string) == -1];
		}
	});

	$("#datepicker2").datepicker({ 
		minDate: '0',
		maxDate: '+1Y+6M',
		dateFormat: 'dd-mm-yy',
		onSelect: function (dateStr) {
			var max = $("#datepicker2").datepicker('getDate'); // Get selected date
			$('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M'); // Set other min, default to today
		},
		beforeShowDay: function(date) {
			var string = $.datepicker.formatDate('dd-mm-yy', date);
		    return [forbidden.indexOf(string) == -1];
		}
	});

	$("#timepicker2").on('change',function(){
		var pick_date = $("#datepicker1").val();
		var pick_time = $("#timepicker2").val();
		validate_pickup_time(pick_date,pick_time);
	});
	$("#timepicker2").timepicker({
		minuteStep: 5,
		showMeridian:false
	});

});

function validate_pickup_time(pick_date,pick_time){
	//var pick_date = $("#datepicker1").val();
		
	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var current_date =  (day<10 ? '0' : '') + day + '-' +
	(month<10 ? '0' : '') + month + '-' +d.getFullYear();
	
	var output1 =  (day<10 ? '0' : '') + day + '-' +
	(month<10 ? '0' : '') + month + '-' +d.getFullYear();
	
	if(pick_date==current_date){
		//convert both time into timestamp
		var monthNames = ["January", "February", "March", "April", "May", "June",
		  "July", "August", "September", "October", "November", "December"
		];
		
		//var pick_time = $("#timepicker2").val();
		var curr_time = d.getHours() + ":" + d.getMinutes();
		
		var pick_formated_date = monthNames[d.getMonth()] +' '+ d.getDate() +' , '+d.getFullYear()+' '+ pick_time;
		var stt = new Date(pick_formated_date);
		stt = stt.getTime();
		
		var current_formated_date = monthNames[d.getMonth()] +' '+ d.getDate() +' , '+d.getFullYear()+' '+ curr_time;
		var endt = new Date(current_formated_date);
		endt = endt.getTime();
		
		if(stt < endt) {
			$("#timepicker2").val(curr_time);
		}
	}
}

var num_input_total = 0; // 23
var num_input_adult = 1; // 23
var num_input_child = 0; // 0
var exceso = 0;
$('#input_adult').on('keyup change', function(){ 
  var adult_count = parseInt($(this).val());
  num_input_adult = isNaN(adult_count) ? 0 : adult_count;
  num_input_total = num_input_adult + num_input_child;
  number_type_input();
});
$('#input_child').on('keyup change', function(){
  var child_count = parseInt($(this).val());
  num_input_child = isNaN(child_count) ? 0 : child_count;
  num_input_total = num_input_adult + num_input_child;
  number_type_input();
});
function number_type_input() {
  if(num_input_total >= _booking_max_adults){
    $('#input_adult').attr('max', num_input_adult);
    $('#input_child').attr('max', num_input_child);
    if(num_input_total > _booking_max_adults){
      if (num_input_adult >= 1){
        if(num_input_adult > _booking_max_adults){
          exceso = num_input_total - _booking_max_adults; // 7
          num_input_total = num_input_total - exceso; // 16 = 23 - 7
          num_input_adult = num_input_adult - exceso; // 16 = 23 - 7
        } else {
          exceso = num_input_total - _booking_max_adults; // 3
          num_input_total = num_input_total - exceso; // 16
          num_input_child = num_input_child - exceso; // 6
        }
        $('#input_adult').attr('max', num_input_adult);
        $('#input_child').attr('max', num_input_child);
      }
      if(num_input_adult < 1){
        exceso = num_input_total - _booking_max_adults; // 3
        num_input_total = num_input_total - exceso; // 16
        exceso = exceso + 1; // 4
        num_input_child = num_input_child - exceso; // 15
        num_input_adult = num_input_adult + 1; // 1
        $('#input_adult').attr('max', num_input_adult);
        $('#input_child').attr('max', num_input_child);
      }
    }
  }
  if(num_input_total <= _booking_max_adults){
    if(num_input_adult < 1){
      if(num_input_child == _booking_max_adults){
        num_input_child = num_input_child - 1;
      }
      num_input_adult = num_input_adult + 1; // 1
    }
    $('#input_adult').attr('max', _booking_max_adults);
    $('#input_child').attr('max', _booking_max_adults);
  }
  var add_num_input_adult = isNaN(num_input_adult) ? 0 : num_input_adult;
  var add_num_input_child = isNaN(num_input_child) ? 0 : num_input_child;
  $('#input_adult').val(add_num_input_adult);
  $('#input_child').val(add_num_input_child);
}