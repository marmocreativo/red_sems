<!-- start footer Area -->
			<footer class="bg-secondary py-4">
				<div class="container">

					<div class="row text-white d-flex justify-content-between">
						todos los derechos reservador
					</div>
				</div>
			</footer>
			<!-- End footer Area -->

			<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  		<script src="<?php echo base_url('assets/redsems'); ?>/js/easing.min.js"></script>
			<script src="<?php echo base_url('assets/redsems'); ?>/js/jquery.nice-select.min.js"></script>
			<script src="<?php echo base_url('assets/redsems'); ?>/js/main.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/starrr/starrr.js" ></script>
			<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
			<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

			<?php $this->load->view('default'.$dispositivo.'/scripts/scripts_formularios'); ?>
<?php $this->load->view('default'.$dispositivo.'/scripts/scripts_front'); ?>
		</body>
		<script>
		if ( $( ".splide" ).length ) {
			new Splide( '.splide', {
				type     : 'loop',
				autoWidth: true,
				focus    : 'center',
			} ).mount();
		};
		</script>
	</html>
