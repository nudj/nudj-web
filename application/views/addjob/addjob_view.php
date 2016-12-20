<form id="form-job" method="post">

<div class="dashboard-content padding-bottom130">

	<div class="content">

		<div class="form-container">
			<!-- <?php echo form_open(''); ?> -->
			 
			<div class="form-add-job">
				<?php //if( isset($error) && $error) echo '<p class="error">Incorrect credentials.</p>';?>
				<label>Job Title</label>
				<input  class="input-job" placeholder="Director of Engineering" name="title" type="text" value=<?php //if(isset($email)) echo $email;?> >

				<br/><label>Location</label>
				<input id="autocomplete" onFocus="geolocate()" class="input-job" placeholder="Shoreditch, London, United Kingdom" name="location" type="text" >
				
				<br/><label>Brief Description</label>
				<input  class="input-job" placeholder="One line, tell us what you’re looking for" name="brief" type="text" >
				<br/><label>Job Description</label>
				<textarea class="textarea-job" cols="40" rows="10" 
				name="description" type="text" ></textarea>

				<div class="div-job" id="skills" class="drop-down-list">Necessary Skills &amp; Requirements <span>(optional)</span> <span id="close-skills" class="close">x</span></div>
				<div class="div-job-container" id="skills-container">
					<div class="stick-to-top">
						<input id="input-add-skill" placeholder="Team management skill">
						<button id="button-add-skill" type="button">Add</button>
					</div>
					<ul id="list-skills">
					</ul>
				</div>				

				<div class="div-job" id="preferences" class="drop-down-list">Candidates Preferences <span>(optional)</span> <span id="close-preferences" class="close">x</span></div>
				<div class="div-job-container" id="preferences-container">
					<div class="stick-to-top">
						<input id="input-add-preferences" placeholder="Team player? .. ">
						<button id="button-add-preferences" type="button">Add</button>
					</div>
					<ul id="list-preferences">
					</ul>
				</div>	


				<div class="clear"></div>
				<div class="float-left">
					<label>Salary</label>
					<input class="input-job" placeholder="£150,000" name="salary" type="text">
				</div>
				<div class="float-right">
					<label>Referral Bonus</label>
					<input class="input-job" placeholder="£4,500" name="referral_bonus" type="text">
				</div>
				<div class="clear"></div>
				<p class="info">Lorem ipsum dolor sit amet, sit amet, consectetur adipiscing elit, sed do eiusmod tempor , sed do eiusmod tempor in incididunt ut labore et dolore magna aliqua.  </p>
				<!--<input class="submit-job" value="Lorem Ipsum" name="submit" type="submit" >-->
				<!-- <button id="submit" class="submit-job" type="buttton" >Lorem Ipsum</button> -->
			</div>
			
		</div>
		
	</div>
</div>


<div class="footer-dashboard">
    <div class="full-delimiter">
    </div>

    <div class="footer-content">
      <div class="left-side">
        <p>Create Job</p>
        <a href=<?php echo base_url()."dashboard" ?>>Back to Dashboard</a>
      </div>
      <div class="right-side">
      	<input class="green-button" value="Post Job" name="submit" type="submit" >
	<!--        <button class="green-button" id="form-add-job-submit" onclick="">Post Job</button>-->
        <button class="grey-button" onclick="">Preview Job</button>
      </div>
    </div>
</div>
</form>


</body>
</html>

<script type="text/javascript">
	$( document ).ready(function() {
	    console.log( "ready!" );

	    $.digits = function(){ 
		    return this.each(function(){ 
		        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "£1,") ); 
		    })
		}

		function addCommas(t) {
		      return String(t).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		 }

		 function addCommas2(nStr) {
		    nStr += '';
		    x = nStr.split('.');
		    x1 = x[0];
		    x2 = x.length > 1 ? '.' + x[1] : '';
		    var rgx = /(\d+)(\d{3})/;
		    while (rgx.test(x1)) {
		        x1 = x1.replace(rgx, '$1' + ',' + '$2');
		    }
		    return x1 + x2;
		}

		$('[name="salary"]').keyup(function() {
			var value = $('[name="salary"]').val();

			value = value.replace(/,/g, '');
			value = value.replace(/£/g, '');
			console.log( "before " + value);

			 value = addCommas(value);
			 if(value.length > 0) {
				 value = '£'+value;
			 }
			 $('[name="salary"]').val(value);
		  	console.log( "Handler for .keypress() called. " + value );
		});


		$('[name="referral_bonus"]').keyup(function() {
			var value = $('[name="referral_bonus"]').val();

			value = value.replace(/,/g, '');
			value = value.replace(/£/g, '');
			console.log( "before " + value);

			 value = addCommas(value);
			 if(value.length > 0) {
				 value = '£'+value;
			 }
			 $('[name="referral_bonus"]').val(value);
		  	console.log( "Handler for .keypress() called. " + value );
		});



	    $( "#form-job" ).submit(function( event ) {
		  	//alert( "Handler for .submit() called." );
		  	event.preventDefault();
		  	//console.log('dsffdgssd');

		  	$('input[type="submit"]').attr('disabled','disabled');
		  	
		  	var subfolder = "";
		    var base_url = document.location.origin;
		    if(base_url.includes("carmen")) {
		    	subfolder = "/nudj-php";
		    } else if(base_url.includes("zudent")){
		    	subfolder = "/dev.nudj";
		    }

	          var title = $('[name="title"]').val();
	          var description = $('[name="description"]').val();
	          var salary = $('[name="salary"]').val();
	          var referral_bonus = $('[name="referral_bonus"]').val();
	          var location = $('[name="location"]').val();
	          var brief = $('[name="brief"]').val();

	          var preferencesList = [];
	          var skillsList = [];

	          //list.push(item.text);

	          $('#list-skills').children('li').each(function () {
	          		skillsList.push($(this).text());
				    //console.log($(this).text()); // "this" is the current element in the loop
				});

	          $('#list-preferences').children('li').each(function () {
	          		preferencesList.push($(this).text());
				    //console.log($(this).text()); // "this" is the current element in the loop
				});


	          var preferences =  JSON.stringify(preferencesList);
	          var skills = JSON.stringify(skillsList);


	          var url = window.location + "/create-job";
	          var redirect = window.location + "/add-job";


	          $.ajax({
			    type: 'POST',
			    url: url, //this should be url to your PHP file 
			    dataType: 'html',
			    data: { 'brief':brief, 'preferences': preferences, 'skills':skills, 'title': title, 'description':description, 'location':location, 'salary':salary, 'referral_bonus':referral_bonus },
			    complete: function() { console.log("complete?");},
			    success: function() { window.location.href=window.location.href;}//$(location).attr('href', redirect);}
			});



		});

	    $(document).on("keypress", "form", function(event) { 
		    return event.keyCode != 13;
		    //prevent form submitting on enter
		});

	    $(document).on('click', function (e) {
		    if ($(e.target).closest("#skills-container").length === 0 && $(e.target).closest("#skills").length === 0 && $(e.target).closest(".remove-item").length === 0) {//} && $("#skills-container").css('display') == 'none') {
		        $("#skills-container").slideUp();
		        $('#close-skills').hide();
		    }

		    if ($(e.target).closest("#preferences-container").length === 0 && $(e.target).closest("#preferences").length === 0 && $(e.target).closest(".remove-item").length === 0) {// && $("#preferences-container").css('display') == 'none') {
		        $("#preferences-container").slideUp();
		        $('#close-preferences').hide();
		    }
		});

	    $("#skills").click(function(e) {

	    	if($("#skills-container").css('display') == 'none') {
		    	$('#skills-container').width( $("#skills").width() );
		    	$('#skills-container').slideDown();
		    	$('#close-skills').show();
		    } else {
		    	$("#skills-container").slideUp();
		        $('#close-skills').hide();
		    }
	    });


	    $("#preferences").click(function(e) {

	    	if($("#preferences-container").css('display') == 'none') {
		    	$('#preferences-container').width( $("#preferences").width() );
		    	$('#preferences-container').slideDown();
		    	$('#close-preferences').show();
		    } else {
		    	$("#preferences-container").slideUp();
		        $('#close-preferences').hide();
		    }
	    });

	    $('#button-add-skill').click(function(e) {
	    	
	    	var inputSkill = $('#input-add-skill').val();

	    	if(inputSkill.length > 0) {
	    		$("#list-skills").append('<li><button type="button" class="remove-item" >x</button>'+inputSkill+'</li>');
	    		$("#list-skills").scrollTop($("#list-skills")[0].scrollHeight);
	    		$('#input-add-skill').val("");
	    	} 
	    });

	    //if enter pressed on input-skill

		$('#input-add-skill').bind('keyup', function(e) {
		    if ( e.keyCode === 13 ) { // 13 is enter key

		       $( "#button-add-skill" ).trigger( "click" );

		    }
		});


		$('#button-add-preferences').click(function(e) {
	    	
	    	var inputSkill = $('#input-add-preferences').val();

	    	if(inputSkill.length > 0) {
	    		$("#list-preferences").append('<li><button type="button" class="remove-item" >x</button>'+inputSkill+'</li>');
	    		$("#list-preferences").scrollTop($("#list-preferences")[0].scrollHeight);
	    		$('#input-add-preferences').val("");
	    	} 
	    });

	    //if enter pressed on input-preferences

		$('#input-add-preferences').bind('keyup', function(e) {
		    if ( e.keyCode === 13 ) { // 13 is enter key

		       $( "#button-add-preferences" ).trigger( "click" );

		    }
		});

		$(document).on("click", ".remove-item", function(event) { 
		    var parent = $(this).parent();
		 	parent.remove();
		});


	});


</script>



<script>
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbPNVkSZyWLnxmKRgja9nZuJlku7w-0l0&libraries=places&callback=initAutocomplete"
        async defer></script>