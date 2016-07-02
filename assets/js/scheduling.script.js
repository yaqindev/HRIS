function searchnya(make){
	if(make=="byname")
	{
		
		document.getElementById('searche').innerHTML='<input id="search_key" class="form-control" name="search_key" maxlength="100" >';
	}
	else
	{
		document.getElementById('searche').innerHTML='<select class="form-control" name="cari_department_id" id="category"></select>';
		if(make=='bydepartment')
				var cat = 'department';
		else
			var cat= 'segment';
		var url = "http://localhost/hris2/index.php/timemanagement/get_list";
$.ajax({
      type: "POST",
      data: cat,
	  url: url+"/"+cat,
	  dataType:'json',
	  success: function(data)
{
                            $('#category').empty();
                            $.each(data,function(id, category)
                            {
								var opt = $('<option />'); // here we're creating a new select option for each group
                                opt.val(id);
                                opt.text(category);
                                $('#category').append(opt);
                            });
                        } //end success
	
	  
});
//		 $.getJSON(url, {category:cat}, function(result){
			
//			  $.each(result, function(i, field){
//			 $('<option/>').val(result[i]).html(result[i]).appendTo('#category');
//			  })
//		});
	
	}
 }
(function($) {
	// fungsi dijalankan setelah seluruh dokumen di-load
// untuk events
	$(document).ready(function(e) {
		
		var data_scheduling = "http://localhost/hris2/index.php/timemanagement/workschedule";
		$("#data-schedule").load(data_scheduling);
				jQuery.noConflict(true);
                $('#date1').datepicker({
                    format: "dd M yyyy",
					 todayBtn: "linked",
					 autoclose: true
                })
				$('#date1').on('changeDate', function(selected){
					startDate = new Date(selected.date.valueOf());
					startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
					$('#date2').datepicker('setStartDate', startDate);
					$('#date2').focus();
				}); 
				$('#date2').datepicker({
                    format: "dd M yyyy",
					  todayBtn: "linked",
					autoclose: true
                });	

				    $('#date2').on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#date1').datepicker('setEndDate', FromEndDate);
    });		

	$(document).on("click", ".add_new_list", function() {
		var url = "http://localhost/hris2/index.php/timemanagement/addlist";
		var id = $(this).attr('data-id');
		var tgl = $("#date3").val();
		var tgl2 =$("#date4").val();
		var ids = $("#id").val();
		$("#myModalLabel2").html("<span class='glyphicon glyphicon-pencil'></span> Add List");
		$.post(url, { cari_department_id: id, tgl:tgl,tgl2:tgl2,ids:ids } ,function(data) {
		
			$(".modal-body2").html(data);
			$(".modal-body2").show();
			
		});
		});
		
		
		
	$(document).on("click", ".tambah_workschedule", function(ev) {

		var url = "http://localhost/hris2/index.php/timemanagement/tambah_workschedule";
		var id = $(this).attr('data-id');
		var tgl = $(this).attr('data-tanggal');
		$("#myModalLabel").html("<span class='glyphicon glyphicon-pencil'></span> Edit Schedule");
		$.post(url, { id: id, tgl:tgl } ,function(data) {
		
			$(".modal-body").html(data);
			$(".modal-body").show();
			
		});
		});
	
	$("#simpan-data").bind("click", function(event) {
			
			var url = "http://localhost/hris2/index.php/timemanagement/save_event";
			
			// mengambil nilai dari inputbox, textbox dan select
			var v_employee = $('input[name=id]').val();
			var v_date1 = $('input[name=date3]').val();
			var v_date2 = $('input[name=date4]').val();
			var v_schedule= $('#schedule').val();
			var v_des = $('input[name=des').val();
			if(document.getElementById("holiday").checked)
				v_holiday="yes";
			else v_holiday="no";
			var v_id = $('input[name=id]').val();
			var save_from = "schedule";
			// mengirimkan data ke var URL  untuk di proses
			$.post(url, {v_employee: v_employee, v_date1: v_date1, v_date2: v_date2, v_schedule: v_schedule,v_des: v_des,v_holiday:v_holiday,v_id:v_id,save_from:save_from} ,function(data) {
				// tampilkan data tamu yang sudah di diupdate
				// ke dalam <div id="data-tamu"></div>
				//$("#data-tamu").load(data_tamu);
				

				// sembunyikan modal dialog
				$('#dialog').hide();
				
				// kembalikan judul modal dialog
			});
		});	   	
		$("#searchbydate").on('click',function(event) {
			var url = "http://localhost/hris2/index.php/timemanagement/workschedule"
			var v_date1 = $('input[name=date1]').val();
			var v_date2 = $('input[name=date2]').val();
			$.post(url, {date1: v_date1, date2: v_date2} ,function(data) {
				$("#data-schedule").html(data);
			
			});
		});	
		$("#searchbyname").on('click',function(event) {
			var url = "http://localhost/hris2/index.php/timemanagement/workschedule"
			var v_date1 = $('input[name=date1]').val();
			var v_date2 = $('input[name=date2]').val();
			if ($("#search_by").val()=="byname")
			{
				var searchby = "byname";
				var name = $("#search_key").val();
			}
			else if ($("#search_by").val()=="bydepartment")
			{
				var searchby = "bydepartment"
				var name = $("#category").val();
				
			}
			else
			{
				var searchby = "bysegment";
				var name = $("#category").val();
			}
			
			
			$("#data-schedule").load(data_scheduling, {"name": name,"search": searchby}, function(data) {
			$("#data-schedule").html(data);
			});
			
		});		
		$("#prev_button").on('click',function(event) {
			var url = "http://localhost/hris2/index.php/timemanagement/workschedule"
			var v_date1 = new Date($('input[name=date1]').val());
			var v_date2 = new Date($('input[name=date2]').val());
			v_date1.setMonth(v_date1.getMonth() - 1);
			v_date1 = v_date1.getFullYear()+"-"+v_date1.getMonth()+"-"+v_date1.getDate();
			v_date2.setMonth(v_date2.getMonth() - 1);
			alert(v_date1);
			v_date2 = v_date2.getFullYear()+"-"+v_date2.getMonth()+"-"+v_date2.getDate();			
			$.post(url, {date1: v_date1, date2: v_date2} ,function(data) {
				$("#data-schedule").html(data);
			
			});
		});
		$("#next_button").on('click',function(event) {
			var url = "http://localhost/hris2/index.php/timemanagement/workschedule"
			var v_date1 = new Date($('input[name=date1]').val());
			var v_date2 = new Date($('input[name=date2]').val());
			v_date1.setMonth(v_date1.getMonth() + 2);
			v_date1 = v_date1.getFullYear()+"-"+v_date1.getMonth()+"-"+v_date1.getDate();
			v_date2.setMonth(v_date2.getMonth() + 2);
			v_date2 = v_date2.getFullYear()+"-"+v_date2.getMonth()+"-"+v_date2.getDate();
			alert(v_date1);
			$.post(url, {date1: v_date1, date2: v_date2} ,function(data) {
				$("#data-schedule").html(data);
			
			});
		});		
		
		
	});
		
	


	var SELECTED = 'selected';
var SELSTART = 'select-start';
var SELEND   = 'select-end';
var MONTHS   = ['january', 'february', 'march', 'april',
                'may', 'june', 'july', 'august',
                'september', 'october', 'november', 'december'];
var DAYNAMES = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		
		


function resetSelectedDays() {
  $('.day.selected').removeClass(SELECTED);
}

function range(low, high) {
  var i, range_array = [];

  for (i = low; i <= high; i++) {
    range_array.push(i);
  }

  return range_array;
}
function buildYearCalendar(year) {

	var inputeddate = document.getElementById('year-calendar').getAttribute('data-id');
    var nomore=0;
	obj = JSON.parse(inputeddate);



		

  var populateWeek = function (start_date, start_day, num_of_days) {
    var i, day_number, week_days = [0, 0, 0, 0, 0, 0, 0]; // Exactly 7 elements

    if (num_of_days > 7) {
      num_of_days = 7;
    }

    // TODO Clean this up; this is hard to read!
    for (i = start_day, day_number = start_date; i < num_of_days; i++, day_number++) {
      week_days[i] = day_number;
    }

    return { weekdays: week_days, daynumber: day_number };
  };

  var populateWeekDayNames = function(month_id) {
    var table_id = '#' + month_id;

    $(table_id).append('<thead />');

    var table_header = $(table_id).find('thead').first();

    $(table_header).append('<tr>');
    var table_header_row = $(table_header).find('tr');
    $(table_header_row).append('<th class="month_name" colspan="7">' + month_id + '</th>');

    $(table_header).append('<tr>');
    var table_header_row = $(table_header).find('tr')[1];

    DAYNAMES.forEach(function (dayname) {
      $(table_header_row).append('<th>' + dayname + '</th>');
    });
  };

  var stringifyDate = function (date) {
    function zeroPad(n) {
      return (n < 10 ? '0' : '') + n;
    }
    function stringize(year, month, date) {
      return         year   + '-' +
             zeroPad(month) + '-' +
             zeroPad(date);
    }
    return stringize(date.getFullYear(),
                     date.getMonth() + 1,
                     date.getDate());
  };

  var populateMonth = function (year, month) { // Month range: 0-11
    var buildWeek = function() {
      return [0, 0, 0, 0, 0, 0, 0];
    };
    var fillWeek = function(start_date) {
      start_date = start_date || 0;
      while(start_date < 7) {
        week[start_date] = month_date;
        month_date++;
        start_date++;

        if (month_date > days_in_month) {
          break;
        }
      }
    };
    var month_array = [];
    var month_date = 1;
    var days_in_week;

    // Get the number of days for the month
    var days_in_month = new Date(year, month + 1, 0).getDate();

    // Find which day the first day of the month falls on
    var date_value = new Date(year, month, 1);
    var first_day = date_value.getDay();

    // Create first row of the week, based on the first day
    var week = buildWeek();
    fillWeek(first_day);
    month_array = week;

    // thereafter, fill the days until the end of the month
    while(month_date <= days_in_month) {
      week = buildWeek();
      fillWeek();
      month_array = month_array.concat(week);
    }

    // Now display the month in HTML
    var month_id = MONTHS[month];
    var table_id = '#' + month_id;

    populateWeekDayNames(month_id);
    $(table_id).append('<tbody />');
    var table_body = $(table_id).find('tbody').first();
    var createTableRow = (function() {
      $(table_body).append('<tr>');
      return $(table_body).find('tr:last');
    });
	
    for (var i = 0; i < month_array.length; i++) {
      if (i % 7 == 0) {
        table_row = createTableRow();
      }
      if (month_array[i] > 0) {
        var string_date = stringifyDate(new Date(year, month, month_array[i]));


//warnai dan cetak tabel
	var Adaga = -1;
	hasil =$.grep(obj,function(e){
		if(e.date.indexOf(string_date)>=0)
		{Adaga=obj[nomore]['type'];nomore++;return 1;}
	});
	
	if(Adaga==1)
		$(table_row).append('<td class="day" bgcolor="#FF0000" data-yc-value="' + string_date + '" data-dismiss="#myModal"><a  class="tambah" href="#dialog" data-id="'+ string_date +'"  data-toggle="modal">' + month_array[i] + '</a></td>');
	else if(Adaga==2)
		$(table_row).append('<td class="day" bgcolor="#FF6600" data-yc-value="' + string_date + '" data-dismiss="#myModal"><a  class="tambah" href="#dialog" data-id="'+ string_date +'"  data-toggle="modal">' + month_array[i] + '</a></td>');
	else if(Adaga==3)
		$(table_row).append('<td class="day" bgcolor="#0000FF" data-yc-value="' + string_date + '" data-dismiss="#myModal"><a  class="tambah" href="#dialog" data-id="'+ string_date +'"  data-toggle="modal">' + month_array[i] + '</a></td>');
	else if(Adaga==4)
		$(table_row).append('<td class="day" bgcolor="#FFFF00" data-yc-value="' + string_date + '" data-dismiss="#myModal"><a  class="tambah" href="#dialog" data-id="'+ string_date +'"  data-toggle="modal">' + month_array[i] + '</a></td>');
	
	else 
	   $(table_row).append('<td class="day" data-yc-value="' + string_date + '" data-dismiss="#myModal"><a  class="tambah" href="#dialog" data-id="'+ string_date +'"  data-toggle="modal">' + month_array[i] + '</a></td>');

	
        
      } else {
        $(table_row).append('<td />');
      }
    }

  };

  var setupTriggers = function() {
    $('#year ul li').click(function () {
      yearClicked(this);
    });

    $('.month_name').click(function () {
      monthClicked(this);
    });

    $('.day').click(function () {
      dayClicked(this);
    });
  };

  // Remove the old year calendar; wipe the slade clean
  $('#year-calendar').hide();
  $('#year-calendar').empty();
  resetSelection();

  // Layout the calendar tables
  // Put up the year menu
  var year_div = document.createElement('div');
  year_div.id = 'year';
  var calendar_year = $('#year-calendar');
  var year_menu = document.createElement('ul');
  $(year_div).append(year_menu);
  $(calendar_year).append(year_div);

  for (i = year - 1; i <= year + 1; i++) {
    var item_list = document.createElement('li');
    var year_text = document.createTextNode(i);
    item_list.appendChild(year_text);

    if (i == year) {
      $(item_list).addClass('selected-year');
    }

    $(item_list).data('yc-year', i);
    $(year_menu).append(item_list);
  }

  MONTHS.forEach(function (month) {
    $(calendar_year).append('<table id="' + month + '" />');
  });

  for (var month = 0; month < 12; month++) {
    populateMonth(year, month);
  }

  updateSelectedDates();
  setupTriggers();
  $('#year-calendar').slideDown(250);
}	
function updateSelectedDates()
{
	
}
function toggleSelected(that) {
  $(that).toggleClass(SELECTED);
}

function selectMonth(month_id) {
  var month_id = '#' + month_id;
  var month_days = month_id + ' td.day';
  var month_selected = $(month_id).hasClass(SELECTED);

  resetSelection();

  if (month_selected) {
    $(month_days).removeClass(SELECTED);
    $(month_id).removeClass(SELECTED);
  } else {
    $(month_days).addClass(SELECTED);
    $(month_id).addClass(SELECTED);

    // Find the first day and last day of this month
    // and insert SELSTART/SELEND classes
    $($(month_id + ' .day').first()).addClass(SELSTART);
    $($(month_id + ' .day').last()).addClass(SELEND);
  }
}

function getDateAtPosition(that) {
  return $(that).data('yc-value');
}



function getDateAtClick(that) {
  return getDateAtPosition(that);
}

function dayClicked(that) {
	var d = new Date(getDateAtClick(that));
	var weekday = new Array(7);
	var monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
    ];
weekday[0]=  "Sunday";
weekday[1] = "Monday";
weekday[2] = "Tuesday";
weekday[3] = "Wednesday";
weekday[4] = "Thursday";
weekday[5] = "Friday";
weekday[6] = "Saturday";
	$('#myModal').modal('show');
	
  
}

function getMonthId(that) {
  return $(that).parents('table')[0].id;
}

function monthClicked(that) {
  selectMonth(getMonthId(that), resetSelection);
  updateSelectedDates();
}

function yearClicked(that) {
  // See if the current year is selected
  var is_year_current = $(that).hasClass('selected-year');

  if (is_year_current) {
    var year_cal_id = '#year-calendar';
    var calendar_selected = $(year_cal_id).hasClass(SELECTED);

    
    
  } else {
    // Switch current year to the selected year
    // Redo the calendar
    var selected_year = $(that).data('yc-year');
    buildYearCalendar(selected_year);

	
  }
 	updateCalendar(selected_year); 
}

function updateCalendar(year) {
		

		
		$('.tambah_workschedule').on("click", function(){
		
		var url = "http://localhost/hris2/index.php/timemanagement/tambah_workschedule";
		var id = $(this).attr('data-id');
		var d = new Date(id);
		var weekday = new Array(7);
		var monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"];
		weekday[0]=  "Sunday";
		weekday[1] = "Monday";
		weekday[2] = "Tuesday";
		weekday[3] = "Wednesday";
		weekday[4] = "Thursday";
		weekday[5] = "Friday";
		weekday[6] = "Saturday";
		$("#myModalLabel").html("<span class='glyphicon glyphicon-pencil'></span> Edit Workschedule");
		var st = weekday[d.getDay()]+', '+d.getDate()+' '+monthNames[d.getMonth()]+' '+d.getFullYear();
		$("#simpan-data").data("modal1","workshedule");
		$.post(url, { date1: d, id: id } ,function(data) {
		// tampilkan var URL diatas ke dalam <div class="modal-body"></div>
			$(".modal-body").html(data);
			$(".modal-body").show();
		});
		});		
		
		// ketika tombol simpan ditekan

		
}
	}) (jQuery);
	