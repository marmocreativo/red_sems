<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="video-container">
					<div class="container" id="info-banner">
						<div class="row fullscreen d-flex align-items-center justify-content-center">
							<div class="banner-content col-lg-12 pt-4">
								<div class="row justify-content-center">
									<img src="<?php echo base_url('assets/img'); ?>/logo_full.png?v=1" class="col-3" style="max-width:300px">
								  <img src="<?php echo base_url('assets/redsems'); ?>/img/code_logo.svg?v=1" class="col-6">
							  </div>
								<h3 class="h3 text-white">CONTENIDO DIGITAL EDUCATIVO</h3>
								<form action="<?php echo base_url('repositorio'); ?>" method="get" class="search-form-area">
									<div class="row justify-content-center form-wrap">
										<div class="col-lg-4 form-cols">
											<input type="text" class="form-control" name="busqueda" placeholder="Busca un recurso">
										</div>
										<div class="col-lg-3 form-cols">
											<div class="default-select" id="default-selects">
												<select name="busqueda_curso">
													<option value="0">Selecciona curso</option>
													<?php 
							$cursos = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'cursos'],'TIPO_NOMBRE ASC','','');
							foreach($cursos as $curso){
								echo '<option value="'.$curso->ID.'" >'.$curso->TIPO_NOMBRE.'</option>';
							} ?>
												</select>
											</div>
										</div>
										<div class="col-lg-3 form-cols">
											<div class="default-select" id="default-selects2">
												<select name="busqueda_recurso">
													<option value="">Selecciona recurso</option>
													<option value="Pdf">PDF</option>
													<option value="Epub">Epub</option>
													<option value="Imagen">Imágen</option>
													<option value="Infografía">Infografía</option>
													<option value="Video">Video</option>
													<option value="Audio">Audio</option>
												</select>
											</div>
										</div>
										<div class="col-lg-2 form-cols">
										    <button type="submit" class="btn btn-info">
										      <span class="lnr lnr-magnifier"></span> Buscar
										    </button>
										</div>
									</div>
								</form>
								<p class="text-white"> <b class="text-white">Busca con Etiquetas:</b> Investigación, Infografía, Ecología, Educación, Tecnología, Humanidades</p>
							</div>
						</div>
					</div>
          <!-- <div class="poster hidden">
            <img src="http://www.videojs.com/img/poster.jpg" alt="">
          </div> -->
    		</div>
				<!-- <div class="overlay overlay-bg"></div> -->

			</section>
			<!-- End banner Area -->

			<!-- Start features Area -->
			<section class="callto-action-area section-gap" id="bienvenida">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-9">
							<div class="title text-center">
								<h1 class="mb-10 text-white">¡Bienvenido a la RED SEMS!</h1>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-6">
							<div class="single-feature">
								<h4>Investiga</h4>
								<img src="<?php echo base_url('assets/redsems'); ?>/img/Investiga.png" width="80px"/>
								<p>
									Obtén información fidedigna para tus trabajos de investigación y actividades académicas.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-feature">
								<h4>Descarga</h4>
								<img src="<?php echo base_url('assets/redsems'); ?>/img/descarga.png" width="80px"/>
								<p>
									Guarda en tu equipo o dispositivo distintos recursos que te servirán para ampliar tu conocimiento.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-12">
							<div class="single-feature">
								<h4>Interactúa</h4>
								<img src="<?php echo base_url('assets/redsems'); ?>/img/busca.png" width="80px"/>
								<p>
									Aprende de manera lúdica con la diversidad de recursos interactivos que tenemos para ti.
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End features Area -->

						<!--Section: Features v.3-->
						<section class="pt-50" id="ejes-modelo">
							<div class="container">
							<div class="row d-flex justify-content-center">
								<div class="menu-content pb-60 col-lg-10">
									<div class="title text-center">
										<h1 class="mb-10">Nueva Escuela Mexicana</h1>
										<p>En Prepa en Línea-SEP estamos comprometidos con el cumplimiento de la Nueva Escuela Mexicana, por ello desarrollamos recursos educativos digitales (RED) acordes con cada uno de sus principios en los que se fomenta lo siguiente: </p>
									</div>
								</div>
							</div>

						    <!--Grid row-->
						    <div class="row pt-2">

						    <!--Grid column-->
						    <div class="col-lg-5 text-center text-lg-left" id="col-ilust">
				          <video playsinline autoplay muted loop class="ilust-vid">
				            <source src="<?php echo base_url('assets/redsems'); ?>/img/Ilustracion_NME.webm" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
									</video>
						    </div>
						    <!--Grid column-->

						    <!--Grid column-->
						    <div class="col-lg-7">

						        <!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/cont-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Aprecio por nuestra cultura, el conocimiento de nuestra historia y el apego a los valores que se enuncian en nuestra Constitución.</p>
						        </div>
						        </div>
						        <!--Grid row-->

						        <!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/escuela-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Aceptación y respeto de los derechos y deberes propios y comunes, mediante el fomento de valores cívicos.</p>
						        </div>
						        </div>
						        <!--Grid row-->

						        <!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/modelo-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Trabajo con honestidad y apego a la verdad, que son la base de la responsabilidad social y el sustento de toda relación sana entre ciudadanos.</p>
						        </div>
						        </div>
						        <!--Grid row-->

										<!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/equi-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Trasformación social mediante la formación de personas críticas, participativas y activas que procuran la innovación y la creación de iniciativas para el bienestar común.</p>
						        </div>
						        </div>
						        <!--Grid row-->

						        <!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/gob-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Respeto irrestricto a la dignidad y derechos humanos de todas las personas, con base en la convicción de igualdad de todos los individuos.</p>
						        </div>
						        </div>
						        <!--Grid row-->

						        <!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/cont-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Comprensión y aprecio de las diferencias culturales y lingüísticas, así como del diálogo con base en la equidad y el respeto mutuo.</p>
						        </div>
						        </div>
						        <!--Grid row-->

						        <!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/escuela-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Fortalecimiento del diálogo constructivo, la solidaridad y la búsqueda de acuerdos que permitan la convivencia sana y pacífica entre individuos.</p>
						        </div>
						        </div>
						        <!--Grid row-->

						        <!--Grid row-->
						        <div class="row pb-2">
						        <div class="col-2">
						            <img src="<?php echo base_url('assets/redsems'); ?>/img/modelo-icn.png" width="100%"/>
						        </div>
						        <div class="col-10">
						            <p class="grey-text text-left">Conciencia ambiental para favorecer la protección y conservación del entorno en el que vivimos y la prevención del cambio climático, con base en el desarrollo sostenible. </p>
						        </div>
						        </div>
						        <!--Grid row-->

						    </div>
						    <!--Grid column-->

						    </div>
						    <!--Grid row-->
								</div>

						</section>
						<!--Section: Features v.3-->

			<!-- Start feature-cat Area -->
			<section class="feature-cat-area pt-50" id="categorias">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-20 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Recursos por tipo</h1>
								<p>Explora por tipo o por palabras clave</p>
							</div>
						</div>
						<div class="splide" style="width:100%">
							<div class="splide__track">
								<ul class="splide__list">
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-secondary'></div>
											<a href="category.html">
												<i class="fas fa-code"></i>
											</a>
											<p>Página web</p>
										</div>
									</li>
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-blue'></div>
											<a href="category.html">
												<i class="fas fa-image"></i>
											</a>
											<p>Imagen</p>
										</div>
									</li>
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-teal'></div>
											<a href="category.html">
												<i class="fas fa-play"></i>
											</a>
											<p>Video</p>
										</div>
									</li>
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-lime'></div>
											<a href="category.html">
												<i class="fas fa-chalkboard-teacher"></i>
											</a>
											<p>Presentación</p>
										</div>
									</li>
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-pink'></div>
											<a href="category.html">
												<i class="fas fa-file-alt"></i>
											</a>
											<p>Archivo de texto</p>
										</div>
									</li>
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-secondary'></div>
											<a href="category.html">
												<i class="fas fa-file-audio"></i>
											</a>
											<p>Audio</p>
										</div>
									</li>
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-teal'></div>
											<a href="category.html">
												<i class="fas fa-laptop-code"></i>
											</a>
											<p>Software/Aplicación</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
				</div>
			</div>
			</section>
			<!-- End feature-cat Area -->

			<!-- Start feature-cat Area -->
			<section class="feature-cat-area pt-50" id="recursos">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Recursos Recientes</h1>
								<p>Recursos agregados</p>
							</div>
						</div>
					</div>
			<!-- End feature-cat Area -->
			<div class="row">
				  <a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-webtxt">
							<div class="genric-btn default circle"><i class="fas fa-code"></i>Página web</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Silver beet shallot wakame tomatillo salsify mung bean beetroot groundnut.
							</div>
						</div>
					</a>
						<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
							<div class="single-service rec-img">
							<div class="genric-btn default circle"><i class="fas fa-image"></i>Imagen</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Wattle seed bunya nuts spring onion okra garlic bitterleaf zucchini.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-vid">
							<div class="genric-btn default circle"><i class="fas fa-play"></i>Video</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Kohlrabi bok choy broccoli rabe welsh onion spring onion tatsoi ricebean kombu chard.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-img">
							<div class="genric-btn default circle"><i class="fas fa-image"></i>Imagen</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Melon sierra leone bologi carrot peanut salsify celery onion jícama summer purslane.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-sim">
							<div class="genric-btn default circle"><i class="fas fa-chalkboard-teacher"></i>Presentación</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Celery carrot napa cabbage wakame zucchini celery chard beetroot jícama sierra leone.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-txt">
							<div class="genric-btn default circle"><i class="fas fa-file-alt"></i>Archivo de texto</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Catsear cabbage tomato parsnip cucumber pea brussels sprout spring onion shallot swiss .
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-app">
							<div class="genric-btn default circle"><i class="fas fa-laptop-code"></i>Software/Aplicación</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Mung bean taro chicory spinach komatsuna fennel.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-aud">
							<div class="genric-btn default circle"><i class="fas fa-file-audio"></i>Audio</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Epazote soko chickpea radicchio rutabaga desert raisin wattle seed coriander water.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-aud">
							<div class="genric-btn default circle"><i class="fas fa-file-audio"></i>Audio</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Tatsoi caulie broccoli rabe bush tomato fava bean beetroot epazote salad grape.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-txt">
							<div class="genric-btn default circle"><i class="fas fa-file-alt"></i>Archivo de texto</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Endive okra chard desert raisin prairie turnip cucumber maize avocado.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-vid">
							<div class="genric-btn default circle"><i class="fas fa-play"></i>Video</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Bush tomato peanut shallot turnip prairie turnip gram desert raisin.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-img">
							<div class="genric-btn default circle"><i class="fas fa-image"></i>Imagen</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Yarrow leek cabbage amaranth onion salsify caulie kale desert raisin prairie turnip garlic.
							</div>
						</div>
					</a>
			<a class="text-uppercase loadmore-btn mx-auto d-block" href="category.html">Más recursos</a>
		</div><!-- /row -->
		</div><!-- /container -->
		</section>

		<!-- Start About Area -->
		<section class="section-gap" id="inter">
			<div class="container">
				<div class="row d-flex sidebar">
					<div class="col-md-12 col-lg-4 single-slidebar">
						<h4 class="text-white">Recursos por Área</h4>
						<ul class="cat-list">
							<li><a class="justify-content-between d-flex" href="category.html"><p>Comunicación</p><span>37</span></a></li>
							<li><a class="justify-content-between d-flex" href="category.html"><p>Ciencias Sociales</p><span>57</span></a></li>
							<li><a class="justify-content-between d-flex" href="category.html"><p>Humanidades</p><span>33</span></a></li>
							<li><a class="justify-content-between d-flex" href="category.html"><p>Matemáticas</p><span>36</span></a></li>
							<li><a class="justify-content-between d-flex" href="category.html"><p>Ciencias Experimentales</p><span>47</span></a></li>
						</ul>
					</div>

						<div class="col-md-12 col-lg-4 single-slidebar">
							<h4 class="text-white">Recursos por Tipo</h4>
							<ul class="cat-list">
								<li><a class="justify-content-between d-flex" href="category.html"><p>Página webs</p><span>37</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Página web con diversos recursos</p><span>57</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Imagen</p><span>33</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Video</p><span>36</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Archivo de texto</p><span>47</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Audio</p><span>33</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Presentaciónes</p><span>36</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Software/Aplicación</p><span>47</span></a></li>
							</ul>
						</div>

						<div class="col-md-12 col-lg-4 single-slidebar">
							<h4 class="text-white">Palabras clave</h4>
							<ul class="cat-list">
								<li><a class="justify-content-between d-flex" href="category.html"><p>Tecnología</p><span>37</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Matemáticas</p><span>57</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Ciencias</p><span>33</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Artes y Humanidades</p><span>36</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Física</p><span>47</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Química</p><span>27</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Psicología</p><span>17</span></a></li>
								<li><a class="justify-content-between d-flex" href="category.html"><p>Aprendizaje</p><span>17</span></a></li>
							</ul>
						</div>
				</div>
			</div>
		</section>
		<!-- End About Area -->

			<!-- Start post Area -->
			<!-- Start feature-cat Area -->
			<section class="feature-cat-area pt-50" id="mas-vistos">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Más Vistos</h1>
								<p>Los recursos que más veces han sido descargados por los usuarios.</p>
							</div>
						</div>
					</div>
			<!-- End feature-cat Area -->
			<div class="row">
				  <a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-webtxt">
							<div class="genric-btn default circle"><i class="fas fa-code"></i>Página web</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Silver beet shallot wakame tomatillo salsify mung bean beetroot groundnut.
							</div>
						</div>
					</a>
						<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
							<div class="single-service rec-img">
							<div class="genric-btn default circle"><i class="fas fa-image"></i>Imagen</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Wattle seed bunya nuts spring onion okra garlic bitterleaf zucchini.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-vid">
							<div class="genric-btn default circle"><i class="fas fa-play"></i>Video</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Kohlrabi bok choy broccoli rabe welsh onion spring onion tatsoi ricebean kombu chard.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-img">
							<div class="genric-btn default circle"><i class="fas fa-image"></i>Imagen</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Melon sierra leone bologi carrot peanut salsify celery onion jícama summer purslane.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-sim">
							<div class="genric-btn default circle"><i class="fas fa-chalkboard-teacher"></i>Presentación</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Celery carrot napa cabbage wakame zucchini celery chard beetroot jícama sierra leone.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-txt">
							<div class="genric-btn default circle"><i class="fas fa-file-alt"></i>Archivo de texto</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Catsear cabbage tomato parsnip cucumber pea brussels sprout spring onion shallot swiss .
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-app">
							<div class="genric-btn default circle"><i class="fas fa-laptop-code"></i>Software/Aplicación</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Mung bean taro chicory spinach komatsuna fennel.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-aud">
							<div class="genric-btn default circle"><i class="fas fa-file-audio"></i>Audio</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Epazote soko chickpea radicchio rutabaga desert raisin wattle seed coriander water.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-aud">
							<div class="genric-btn default circle"><i class="fas fa-file-audio"></i>Audio</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Tatsoi caulie broccoli rabe bush tomato fava bean beetroot epazote salad grape.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-txt">
							<div class="genric-btn default circle"><i class="fas fa-file-alt"></i>Archivo de texto</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Endive okra chard desert raisin prairie turnip cucumber maize avocado.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-vid">
							<div class="genric-btn default circle"><i class="fas fa-play"></i>Video</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Bush tomato peanut shallot turnip prairie turnip gram desert raisin.
							</div>
						</div>
					</a>
					<a href="recurso.html" class="col-lg-4 col-md-6 px-1">
						<div class="single-service rec-img">
							<div class="genric-btn default circle"><i class="fas fa-image"></i>Imagen</div>
							<div class="cbp-vm-title">
								<h5>Nombre de Recurso</h5>
								<div class="cbp-vm-price">Autor</div>
							</div>
							<div class="cbp-vm-details">
								Yarrow leek cabbage amaranth onion salsify caulie kale desert raisin prairie turnip garlic.
							</div>
						</div>
					</a>
			<a class="text-uppercase loadmore-btn mx-auto d-block" href="category.html">Más recursos</a>
		</div><!-- /container -->
		</section>
			<!-- End post Area -->
