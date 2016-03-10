<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			include(Load::getView("Layout/head"));
		?>
	</head>
	<body>
		<?php 
			include(Load::getView("Layout/header"));
	    ?>
	    <div class="wrapper-content">
	    	
	    	<?php
	    		include(Load::getView($view));
	    	?>
	    	
	    </div>
		<?php
			include(Load::getView("Layout/footer"));
		?>
	</body>
</html>
