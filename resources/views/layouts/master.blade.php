
<!DOCTYPE html>
<html lang="en">
<head>
    @yield('title')


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<style>
	@import url('https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600');
	</style>
</head>
<body>
	@include('layouts.partials._navbar')
    @if (session()->has('no_match_error'))
        <div class="alert alert-danger">{{ session('no_match_error') }}</div>
    @endif
  	@yield('content')
    
 <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>

$(document).ready(function() {
    const stars = $('.star');
    
    $('#ratings').text("Select your accommodations");
    $('#accommodationsButton').css("display", "none");
    

    function resetStars() {
        $('.star').html(' &#9734 ');
    }

   
   // setup an event listener on every star
   $('.star').click(function(e) {
        resetStars();

        $('#accommodationsButton').css("display", "inline");

        var clickedIndex = $(e.target).data('star');

        
    	


        if(clickedIndex == 0) {
            $('#ratings').text("1 Star—Properties that offer budget facilities without compromising cleanliness or guest security.");
        } else if(clickedIndex == 1) {
            $('#ratings').text("2 Star—Properties that focus on the needs of price conscious travellers. Services and guest facilities are typically limited to keep room rates affordable and competitive but may be available upon request or fee-based.");
        } else if(clickedIndex == 2) {
            $('#ratings').text("3 Star—Properties that deliver a broad range of amenities that exceed above-average accommodation needs. Good quality service, design and physical attributes are typically fit for purpose to match guest expectations.");
        } else if(clickedIndex == 3) {
            $('#ratings').text("4 Star— Properties which achieve a deluxe guest experience. A wide range of facilities and superior design qualities are typically complemented by service standards that reflect the varied and discerning needs of the guest.");
        } else if(clickedIndex == 4) {
            $('#ratings').text("5 Star–Properties that typify luxury across all areas of operation. Guests will enjoy an extensive range of facilities and comprehensive or highly personalised services. Properties at this level will display excellent design quality and attention to detail.");
        }

        $(e.target).html(' &#9733 ');
        
        for(var i = 0; i < clickedIndex; i++) {

            console.log(stars[i]);
            
            $(stars[i]).html(' &#9733 ');
        }

        $('#accommodations').val(clickedIndex);

        
   });
});

</script>

<script>

	$('document').ready(function() {
		"use strict";
		$('#public').click(function() {

			$('#hiddenTrans').val($('#public').data('transportation'));

			// console.log($('#public').data('transportation'));
		});
		$('#rental').click(function() {

			$('#hiddenTrans').val($('#rental').data('transportation'));

			// console.log($('#rental').data('transportation'));
		});
	});

</script>



<script>

$(document).ready(function() {
    const dollarsigns = $('.dollarsign');

    $('#foodButton').css("display", "none");
    
    function resetDollars() {
        $('.dollarsign').css('color','#eee');
    }

   
   // setup an event listener on every dollarsign
   $('.dollarsign').click(function(e) {
        resetDollars();

        $('#foodButton').css("display", "inline");

        var foodIndex = $(e.target).data('dollar');


        
    	


        if(foodIndex == 'lowest') {
            $('#foodDesc').text("1 Star—Properties that offer budget facilities without compromising cleanliness or guest security.");
        } else if(foodIndex == 'modest') {
            $('#foodDesc').text("2 Star—Properties that focus on the needs of price conscious travellers. Services and guest facilities are typically limited to keep room rates affordable and competitive but may be available upon request or fee-based.");
        } else if(foodIndex == 'luxury') {
            $('#foodDesc').text("3 Star—Properties that deliver a broad range of amenities that exceed above-average accommodation needs. Good quality service, design and physical attributes are typically fit for purpose to match guest expectations.");
        } 
   

        $(e.target).css("color", "#ffe319");
        

        $("#foodValue").val(foodIndex);
        console.log($("#foodValue").val());
        console.log(foodIndex);
        
   });
});

</script>

<script>
    
    var arrayOfSelections = [];

    $('.entOptions').click(function(e) {

        var selectedObject = {};
        selectedObject.description = $(e.target).data('ent');
        selectedObject.price = $(e.target).data('price');

        if ($(e.target).hasClass('isSelected')) {
            $(e.target).removeClass('isSelected') 

            // remove selectedObject from arrayOfSelections
            var indexOfObject = arrayOfSelections.indexOf(selectedObject);
            arrayOfSelections.splice(indexOfObject, 1);
            console.log(arrayOfSelections);

        } else {
            $(e.target).addClass('isSelected');
            arrayOfSelections.push(selectedObject);
            console.log(arrayOfSelections);
        }

        var selectionString = arrayOfSelections.join(", ");
        selectionString = JSON.stringify(arrayOfSelections);

        $("#getEntertainment").val(selectionString);

    });
     
</script>



<!-- <script>
	$('document').ready(function () {

		const entertainmentOpts = $('.entOptions');

		

	   		$('.entOptions').click(function(e) {
	   			console.log($(e.target).data('ent'));
	   			$('#getEntertainment').val($(e.target).data('ent'));
	   		});
   		


		
	});




</script> -->

</body>
</html>