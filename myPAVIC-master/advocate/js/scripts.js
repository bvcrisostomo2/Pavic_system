$(document).ready(function() {
  // DataTables init
  $('#children_table').DataTable({
    responsive: true,
    paging: false,
    searching: false,
    bInfo: false,
    ordering: false,
    columns: [
      {
        width: '10%'
      },
      {
        width: '70%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      }
    ]
  });

  $('#tickets_table').DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: false,
    bInfo: false,
    pageLength: 4
  });

  $('#events_table').DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: false,
    bInfo: false,
    pageLength: 4
  });

  $('#anouncements_table').DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: false,
    searching: false,
    bInfo: false,
    pageLength: 4,
    paging: false
  });

  // fileinput init
  $('.fileinput').fileinput();

  //add_child functions
  $("#addSiblingButton").click(function () {
    var id = ($('.appendedSiblings').length + 1).toString();
    if (id == 1) {
      $('#appendSiblingHere').append('' +
      '<div class="form-group appendedSiblings">' +
      ' <label for="sibling_name">' + id + '. Full Name:</label>' +
      ' <input type="text" name="sibling_name_' + id + '" id="sibling_name_' + id + '" value="" class="form-control" required>' +
      '</div>');
    }else{
      $('.appendedSiblings:last').append('' +
      '<br><div class="form-group appendedSiblings">' +
      ' <label for="sibling_name">' + id + '. Full Name:</label>' +
      ' <input type="text" name="sibling_name_' + id + '" id="sibling_name_' + id + '" value="" class="form-control" required>' +
      '</div>');
    }

    $("#removeSiblingButton").prop('disabled', false);

    $('#number_of_siblings').val(($('.appendedSiblings').length));
  });

  $("#removeSiblingButton").click(function () {
    if ($('.appendedSiblings').length === 0) {
      return false;
    }

    $(".appendedSiblings:last").remove();

    if ($('.appendedSiblings').length === 0) {
      $("#removeSiblingButton").prop('disabled', true);
    }

    $('#number_of_siblings').val(($('.appendedSiblings').length));
  });

  //comparing passwords in register
  $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('Password Match!').css('color', 'green');
        $('#register').removeAttr('disabled');
    } else {
        $('#message').html('Password Not Matching').css('color', 'red');
        $('#register').attr('disabled', 'disabled');
      }
  });



});

var setChildModalValues = function(child_id, first_name, middle_name, last_name, siblings, birthday, sex, school, school_address, grade_level, cause_of_blindness, vision_left, vision_right, additional_disabilities, special_needs_owned, learning_tools_owned, physical_therapy, occupational_therapy, speech_therapy, other_needs, id_picture, family_picture, timestamp){
  $("#child_modal_first_name").html(first_name);
  $("#child_modal_middle_name").html(middle_name);
  $("#child_modal_last_name").html(last_name);
  $("#child_modal_siblings").html(siblings.replace(/;/g, "<br>"));
  $("#child_modal_birthday").html(birthday);
  $("#child_modal_sex").html(sex);
  $("#child_modal_school").html(school);
  $("#child_modal_school_address").html(school_address);
  $("#child_modal_grade_level").html(grade_level);
  $("#child_modal_cause_of_blindness").html(cause_of_blindness);
  $("#child_modal_vision_left").html(vision_left);
  $("#child_modal_vision_right").html(vision_right);
  $("#child_modal_additional_disabilities").html(additional_disabilities);
  $("#child_modal_special_needs_owned").html(special_needs_owned.replace(/;/g, "<br>"));
  $("#child_modal_learning_tools_owned").html(learning_tools_owned.replace(/;/g, "<br>"));
  $("#child_modal_physical_therapy").html(physical_therapy);
  $("#child_modal_occupational_therapy").html(occupational_therapy);
  $("#child_modal_speech_therapy").html(speech_therapy);
  $("#child_modal_other_needs").html(other_needs);
  $("#child_modal_family_picture").attr("src",family_picture);
  $("#child_modal_id_picture").attr("src",id_picture);
  $("#child_modal_medical_history").attr("href","medical-history.php?child_id=" + child_id);
  $("#child_modal_edit_button").attr("href","edit-child.php?child_id=" + child_id);
  $("#child_modal_timestamp").html(timestamp);
};

var setAnouncementsModalValues = function(title, text, timestamp){
  $("#anouncements_modal_title").html(title);
  $("#anouncements_modal_text").html(text);
  $("#anouncements_modal_timestamp").html(timestamp);
};

var ticket_max = 0;
var setEventsModalValues = function(event_id, name, date, start_time, end_time, venue, city, region, tickets_left, description){
  $("#events_modal_name").html(name);
  $("#events_modal_description").html(description);
  $("#events_modal_date").html(date);
  $("#events_modal_time").html(start_time + ' - ' + end_time);
  $("#events_modal_venue").html(venue + ', ' + city + ', ' + region);
  $("#events_modal_tickets_left").html(tickets_left);
  $("#events_modal_edit_button").attr("href","edit-event.php?event_id=" + event_id);
  ticket_max = tickets_left;
  $("#events_modal_ticket_count").attr("max",ticket_max);
  $("#events_modal_event_id").val(event_id);


};
var setTicketsModalValues = function(event_id, name, date, start_time, end_time, venue, city, region, tickets,tickets_left, description){
  $("#tickets_modal_name").html(name);
  $("#tickets_modal_description").html(description);
  $("#tickets_modal_date").html(date);
  $("#tickets_modal_time").html(start_time + ' - ' + end_time);
  $("#tickets_modal_venue").html(venue + ', ' + city + ', ' + region);
  $("#tickets_modal_tickets").html(tickets);
  ticket_max = tickets_left;
  $("#tickets_modal_ticket_count").attr("max",ticket_max + tickets);
  $("#tickets_modal_ticket_count").val(tickets);
  $("#tickets_modal_event_id").val(event_id);
};


$('.qtyplus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment only if value is < 20
                if (currentVal < ticket_max)
                {
                  $('input[name='+fieldName+']').val(currentVal + 1);
                  $('.qtyminus').val("-").removeAttr('style');
								}
                else
                {
                	$('.qtyplus').val("+").css('color','#aaa');
            			$('.qtyplus').val("+").css('cursor','not-allowed');
                }
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(1);

            }
        });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one only if value is > 1
            $('input[name='+fieldName+']').val(currentVal - 1);
             $('.qtyplus').val("+").removeAttr('style');
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
            $('.qtyminus').val("-").css('color','#aaa');
            $('.qtyminus').val("-").css('cursor','not-allowed');
        }
    });
