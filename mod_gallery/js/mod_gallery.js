jQuery(document).ready(function($) {

    $(document).ready(function() {
		for (var i =1; i<=$('.gallery_div').length; i++) {
        	$("a.fancyimage"+i).fancybox();
		}
    });

});