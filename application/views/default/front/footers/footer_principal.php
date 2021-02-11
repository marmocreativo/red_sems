<!-- start footer Area -->
			<footer class="footer-area section-gap">
				<div class="container">

					<div class="row footer-bottom d-flex justify-content-between">

						<div class="col-lg-4 col-sm-12 footer-social">
							<a href="#"><i class="fab fa-facebook"></i></a>
							<a href="#"><i class="fab fa-twitter"></i></a>
							<a href="#"><i class="fab fa-dribbble"></i></a>
							<a href="#"><i class="fab fa-behance"></i></a>
						</div>
					</div>
				</div>
			</footer>
			<!-- End footer Area -->

			<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  		<script src="<?php echo base_url('assets/redsems'); ?>/js/easing.min.js"></script>
			<script src="<?php echo base_url('assets/redsems'); ?>/js/jquery.nice-select.min.js"></script>
			<script src="<?php echo base_url('assets/redsems'); ?>/js/main.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
			<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
			<script type="module">

			  var slider = tns({
			    container: '.owl-carousel',
			    items: 5,
			    autoplay: true,
					controls: false,
					navPosition: 'bottom',
			  });
			  </script>

			<?php $this->load->view('default'.$dispositivo.'/scripts/scripts_formularios'); ?>
<?php $this->load->view('default'.$dispositivo.'/scripts/scripts_front'); ?>
		</body>
	</html>
