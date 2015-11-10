/*
  Jquery Validation using jqBootstrapValidation
   example is taken from jqBootstrapValidation docs 
  */
$(function() {

  function updateRecaptchaError() {
	var $error = $("#recaptcha-error");
	if ($("#g-recaptcha-response").val().length === 0) {
	  $error.html('<ul role="alert"><li>Please check the box above.</li></ul>').removeClass('hidden');
	  return;
	}
	$error.empty().addClass('hidden');
  }

 $("input,textarea").jqBootstrapValidation(
    {
     preventSubmit: true,
     submitError: function($form, event, errors) {
      // something to have when submit produces an error ?
      // Not decided if I need it yet
     },
     submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
       // get values from FORM
       var name = $("input#name").val();
       var question1 = $("textarea#question1").val();
       var question2 = $("textarea#question2").val();
	   var question3 = $("textarea#question3").val();
	   var question4 = $("textarea#question4").val();
        var firstName = name; // For Success/Failure Message
           // Check for white space in name for Success/Fail message
        if (firstName.indexOf(' ') >= 0) {
	   firstName = name.split(' ').slice(0, -1).join(' ');
         }
	   var recaptchaToken = $("#g-recaptcha-response").val();
	   updateRecaptchaError();
		// prevent submission unless recaptcha has been checked
		if (recaptchaToken.length === 0) {
		  return;
		}
	 $.ajax({
                url: "./storyteller.php",
            	type: "POST",
            	data: {name: name, question1: question1, question2: question2, question3: question3, question4: question4, "g-recaptcha-response": recaptchaToken},
            	cache: false,
            	success: function() {  
            	// Success message
            	   $('#success').html("<div class='alert alert-success'>");
            	   $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            		.append( "</button>");
            	  $('#success > .alert-success')
            		.append("<strong>Your message has been sent. </strong>");
 		  $('#success > .alert-success')
 			.append('</div>');
 						    
 		  //clear all fields
 		  $('#storytellerForm').trigger("reset");
 	      },
 	   error: function() {		
 		// Fail message
 		 $('#success').html("<div class='alert alert-danger'>");
            	$('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#success > .alert-danger').append("<strong>Sorry "+firstName+" it seems that our mail server is not responding...</strong> Could you please email us directly at <a href='mailto:info@timecap.sl?Subject=Message from timecap.sl contact form'>info@timecap.sl</a>? Sorry for the inconvenience!");
 	        $('#success > .alert-danger').append('</div>');
 		//clear all fields
 		$('#storytellerForm').trigger("reset");
 	    },
           })
         },
         filter: function() {
                   return $(this).is(":visible");
         },
       });

      $("a[data-toggle=\"tab\"]").click(function(e) {
                    e.preventDefault();
                    $(this).tab("show");
        });
  });
 

/*When clicking on Full hide fail/success boxes */ 
$('#name').focus(function() {
     $('#success').html('');
  });