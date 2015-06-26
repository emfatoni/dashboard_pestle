<!DOCTYPE html>

<head>
</head>

<body>
	<!--<script>
	  (function() {
	    var cx = '010284409504547172167:v_6u_hoi8rq';
	    var gcse = document.createElement('script');
	    gcse.type = 'text/javascript';
	    gcse.async = true;
	    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
	        '//cse.google.com/cse.js?cx=' + cx;
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(gcse, s);
	  })();
	</script>
	<gcse:searchresults-only></gcse:searchresults-only>-->

	<?php
		$res = file_get_contents('https://www.googleapis.com/customsearch/v1?key=AIzaSyCuXlh6HdSLy-hjxlnpOUv7uH58Mon7PTY&cx=010284409504547172167:v_6u_hoi8rq&q=political+issue+china');

		print_r($res);
	?>
</body>

</html>