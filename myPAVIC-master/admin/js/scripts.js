$(document).ready(function() {
  $('#admin_table').DataTable({
    responsive: true,
    columns: [
      {
        width: '10%'
      },
      {
        width: '60%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      }
    ]
  });

  $('#admin_logs_table').DataTable({
    responsive: true,
    ordering: false,
    columns: [
      {
        width: '20%'
      },
      {
        width: '30%'
      },
      {
        width: '50%'
      }
    ]
  });

  $('#children_table').DataTable({
    scrollX: true,
    dom: 'Bfrtip',
    buttons: [
      'csv',
      {
        extend: 'pdfHtml5',
        orientation: 'landscape',
        pageSize: 'LEGAL'
      },
      'print'
    ],
    initComplete: function () {
      this.api().columns().every( function () {
          var column = this;
          var select = $('<select class="form-control"><option value="">All</option></select>')
          .appendTo( $(column.footer()).empty() )
          .on( 'change', function () {
          var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
          );
          column
          .search( val ? '^'+val+'$' : '', true, false )
          .draw();
        });

        column.data().unique().sort().each( function ( d, j ) {
          select.append( '<option value="'+d+'">'+d+'</option>' );
        });

        // Disable TBODY scoll bars
        $('.dataTables_scrollBody').css({
          'overflow': 'hidden',
          'border': '0'
        });

        // Enable TFOOT scoll bars
        $('.dataTables_scrollFoot').css('overflow', 'auto');

        // Sync TFOOT scrolling with TBODY
        $('.dataTables_scrollFoot').on('scroll', function () {
          $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
        });
      });
    }
  });

  $('#advocate_table').DataTable({
    scrollX: true,
    dom: 'Bfrtip',
    buttons: [
      'csv',
      {
        extend: 'pdfHtml5',
        orientation: 'landscape',
        pageSize: 'LEGAL'
      },
      'print'
    ],
    initComplete: function () {
      this.api().columns().every( function () {
          var column = this;
          var select = $('<select class="form-control"><option value="">All</option></select>')
          .appendTo( $(column.footer()).empty() )
          .on( 'change', function () {
          var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
          );
          column
          .search( val ? '^'+val+'$' : '', true, false )
          .draw();
        });

        column.data().unique().sort().each( function ( d, j ) {
          select.append( '<option value="'+d+'">'+d+'</option>' );
        });

        // Disable TBODY scoll bars
        $('.dataTables_scrollBody').css({
          'overflow': 'hidden',
          'border': '0'
        });

        // Enable TFOOT scoll bars
        $('.dataTables_scrollFoot').css('overflow', 'auto');

        // Sync TFOOT scrolling with TBODY
        $('.dataTables_scrollFoot').on('scroll', function () {
          $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
        });
      });
    }
  });

  $('#unconfirmed_table').DataTable({
    responsive: true,
    columns: [
      {
        width: '50%'
      },
      {
        width: '20%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      }
    ]
  });

  $('#unpayed_table').DataTable({
    responsive: true,
    columns: [
      // {
      //   width: '10%'
      // },
      {
        width: '70%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      }
    ]
  });

  $('#advocate_children_table').DataTable({
    responsive: true,
    columns: [
      {
        width: '10%'
      },
      {
        width: '60%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      }
    ]
  });
  $('#unconfirmed_children_table').DataTable({
    responsive: true,
    columns: [
      {
        width: '10%'
      },
      {
        width: '60%'
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
    columns: [
      {
        width: '40%'
      },
      {
        width: '10%'
      },
      {
        width: '15%'
      },
      {
        width: '15%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      }
    ]
  });

  $('#reports_table').DataTable({
    responsive: true,
    columns: [
      {
        width: '20%'
      },
      {
        width: '50%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      },
      {
        width: '10%'
      }
    ]
  });

  $('#events_table').DataTable({
    scrollX: true
  });

  // $('#anouncements_table').DataTable({
  //   responsive: true,
  //   ordering: false,
  //   bLengthChange: false,
  //   searching: false,
  //   bInfo: false,
  //   pageLength: 4,
  //   columns: [
  //     {
  //       width: '100%'
  //     }
  //   ]
  // });

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
    } else
        $('#message').html('Password Not Matching').css('color', 'red');
        $('#register').attr('disabled', 'disabled');
  });

});

var setAdminModalValues = function(admin_id, first_name, middle_name, last_name, phone, email, address_line1, address_line2, city, region, head, id_picture, timestamp){
  $("#admin_modal_first_name").html(first_name);
  $("#admin_modal_middle_name").html(middle_name);
  $("#admin_modal_last_name").html(last_name);
  $("#admin_modal_phone").html(phone);
  $("#admin_modal_email").html(email);
  $("#admin_modal_address_line1").html(address_line1);
  $("#admin_modal_address_line2").html(address_line2);
  $("#admin_modal_city").html(city);
  $("#admin_modal_region").html(region);
  $("#admin_modal_head").html(head);
  $("#admin_modal_timestamp").html(timestamp);

  $("#admin_modal_change_password").attr("href","admin-change-password.php?admin_id=" + admin_id);

  $("#admin_modal_id_picture").attr("src",id_picture);
  $("#admin_modal_edit_button").attr("href","edit-admin.php?admin_id=" + admin_id);
};

var setChildModalValues = function(child_id, first_name, middle_name, last_name, siblings, birthday, sex, school, school_address, grade_level, cause_of_blindness, vision_left, vision_right, additional_disabilities, special_needs_owned, learning_tools_owned, physical_therapy, occupational_therapy, speech_therapy, other_needs, id_picture, family_picture, timestamp, advocate_id, advocate_name, advocate_relationship){
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
  $("#child_modal_edit_button").attr("href","edit-child.php?child_id=" + child_id + "&advocate_id=" + advocate_id);
  $("#child_modal_advocate_profile").attr("href","advocate-profile.php?advocate_id=" + advocate_id);

  $("#child_modal_timestamp").html(timestamp);

  $("#child_modal_advocate_name").html(advocate_name);
  $("#child_modal_advocate_relationship").html(advocate_relationship);
};

var setAnouncementsModalValues = function(title, text, timestamp){
  $("#anouncements_modal_title").html(title);
  $("#anouncements_modal_text").html(text);
  $("#anouncements_modal_timestamp").html(timestamp);
};

$("#download_button").click(function() {
  var doc = new jsPDF('p', 'mm');
  var width = doc.internal.pageSize.width;
  var height = doc.internal.pageSize.height;
  html2canvas($("#report_part1"), {
    onrendered: function(canvas) {
      var imgData = canvas.toDataURL(
        'image/png');
      doc.addImage(imgData, 'PNG', 10,10,width-20,150);
      doc.addPage();
      html2canvas($("#report_part2"), {
        onrendered: function(canvas) {
          var imgData = canvas.toDataURL(
            'image/png');
            doc.addImage(imgData, 'PNG', 10,10,width-20,130);
            doc.addPage();
            html2canvas($("#report_part3"), {
              onrendered: function(canvas) {
                var imgData = canvas.toDataURL(
                  'image/png');
                  doc.addImage(imgData, 'PNG', 10,10,width-20,140);
                  doc.addPage();
                  html2canvas($("#report_part4"), {
                    onrendered: function(canvas) {
                      var imgData = canvas.toDataURL(
                        'image/png');
                        doc.addImage(imgData, 'PNG', 10,10,width-20,200);
                        doc.addPage();
                        html2canvas($("#report_part5"), {
                          onrendered: function(canvas) {
                            var imgData = canvas.toDataURL(
                              'image/png');
                              doc.addImage(imgData, 'PNG', 10,10);
                              doc.save($("#report-name").html() + '.pdf');
                            }
                          });
                      }
                    });
                }
              });
          }
        });
    }
  });
});

$( "#report_id" ).change(function() {
  $(location).attr('href', 'reports.php?report_id=' + $( "#report_id" ).val());
});
