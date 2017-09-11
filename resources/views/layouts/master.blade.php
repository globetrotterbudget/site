
<!DOCTYPE html>
<html lang="en">
<head>
    @yield('title')


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="/css/main.css">

</head>
<body>
	@include('layouts.partials._navbar')
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
            $('#ratings').text("Economy");
        } else if(clickedIndex == 1) {
            $('#ratings').text("Budget");
        } else if(clickedIndex == 2) {
            $('#ratings').text("Decent");
        } else if(clickedIndex == 3) {
            $('#ratings').text("pretty nice");
        } else if(clickedIndex == 4) {
            $('#ratings').text("Super nice");
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
</body>
</html>