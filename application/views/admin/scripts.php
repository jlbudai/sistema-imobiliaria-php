		<script src="<?php echo base_url(); ?>js/vendor/jquery.js"></script>
		<script src="<?php echo base_url(); ?>js/validate.js"></script>
		<script src="<?php echo base_url(); ?>js/foundation.min.js"></script>
		<script>
			$(document).foundation();
			
			var clearAlert = setTimeout(function() {
				$(".alert-box").fadeOut('slow')
			}, 5000);			
		</script>
	