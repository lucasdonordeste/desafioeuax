		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="<?php echo base_url().'public/js/jquery.min.js'?>"></script>
		<script src="<?php echo base_url().'public/js/jquery.easing.min.js'?>"></script>
		<script src="<?php echo base_url().'public/js/bootstrap.min.js'?>"></script>
	
		<!-- <script src="public/js/cbpAnimatedHeader.js"></script> -->

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="<?php echo base_url().'public/js/ie10-viewport-bug-workaround.js'?>"></script>

				<?php 
			if(isset($scripts)){
				foreach ($scripts as $script_name) {
					$href=base_url().'public/js/'.$script_name; ?>
					<script src="<?php echo $href; ?>"></script>
			<?php }
			} ?>
	</body>
</html>