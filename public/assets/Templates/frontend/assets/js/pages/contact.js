/*
  Jquery Validation using jqBootstrapValidation
   example is taken from jqBootstrapValidation docs 
  */
$(function() {
    $("#gmap").gmap3({
      marker:{
        latLng: [40.746190, -73.981742],
        options:{
          draggable:true
        },
        events:{
          dragend: function(marker){
            $(this).gmap3({
              getaddress:{
                latLng:marker.getPosition(),
                callback:function(results){
                  var map = $(this).gmap3("get"),
                    infowindow = $(this).gmap3({get:"infowindow"}),
                    content = results && results[1] ? results && results[1].formatted_address : "no address";
                  if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(content);
                  } else {
                    $(this).gmap3({
                      infowindow:{
                        anchor:marker, 
                        options:{content: content}
                      }
                    });
                  }
                }
              }
            });
          }
        }
      },
      map:{
        options:{
          zoom: 13
        }
      }
    });

    $('#contactForm').bootstrapValidator({
        container: 'tooltip',
        feedbackIcons: {
            valid: 'icon-checkmark2',
            invalid: 'icon-warning3',
            validating: 'icon-spinner3'
        },
        message: 'This value is not valid',
        fields: {
            name: {
                message: 'Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'Name is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 _\.]+$/,
                        message: 'Name can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            message: {
                validators: {
                    notEmpty: {
                        message: 'Message is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        message: 'Message must be more than 6 characters long'
                    }
                }
            }
        }
    }).on('status.field.bv', function (e, data) {

        data.bv.disableSubmitButtons(false);
    }).on('success.form.bv', function(e) {
        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        $.post("contact.php", $form.serialize(), function(data){
            if(data == "1"){
                // Success message
                $('#success').html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Your message has been sent. </strong></div>");
                $('#contactForm').trigger("reset");
            }else if(data == "0"){
                // Fail message
                $('#success').html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Please fill in all required fields!</strong></div>");
            }else{
                // Fail message
                $('#success').html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Sorry, there was an error while sending the mail...</strong></div>");
            }
        });
        return false;
    });

});