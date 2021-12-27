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
										<div class="col-lg-3 form-cols">
											<input type="text" class="form-control" name="busqueda" placeholder="Busca un recurso">
										</div>
										<div class="col-lg-2 form-cols">
											<div class="default-select" id="default-selects">
												<select name="categoria">
													<option value="">Curso</option>
													<?php
														$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'','','');
														foreach($cursos as $curso){
															echo '<option value="'.$curso->TIPO_NOMBRE.'" >'.$curso->TIPO_NOMBRE_PLURAL.'</option>';
														} ?>
												</select>
											</div>
										</div>
										<div class="col-lg-2 form-cols">
											<div class="default-select" id="default-selects2">
												<select name="busqueda_area">
													<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
													<option value="">Área de conocimiento</option>
													<?php foreach($areas_conocimiento as $area){ ?>
														<option value="<?php echo $area->TIPO_NOMBRE;  ?>"><?php echo $area->TIPO_NOMBRE_PLURAL;  ?></option>
													<?php } ?>
													</select>
											</div>
										</div>
										<div class="col-lg-2 form-cols">
											<div class="default-select" id="default-selects2">
												<select name="busqueda_recurso">
													<?php $tipos_recurso = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'tipo_recurso'],'','',''); ?>
													<option value="">Tipo de recurso</option>
													<?php foreach($tipos_recurso as $tipo_recurso){ ?>
														<option value="<?php echo $tipo_recurso->TIPO_NOMBRE;  ?>"><?php echo $tipo_recurso->TIPO_NOMBRE_PLURAL;  ?></option>
													<?php } ?>
													</select>
											</div>
										</div>
										<div class="col-lg-3 form-cols">
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
							<?php
								$iconos = [
									'Página web'=>'fas fa-code',
									'Imagen'=>'fas fa-image',
									'Video'=>'fas fa-play',
									'Presentación'=>'fas fa-chalkboard-teacher',
									'Archivo de texto'=>'fas fa-file-alt',
									'Audio'=>'fas fa-file-audio',
									'Software/Aplicación'=>'fas fa-laptop-code',
									'Pdf'=>'far fa-file-pdf',
									'Epub'=>'fas fa-book',
									'Infografía'=>'fas fa-chart-pie'
								];
							?>
							<div class="splide__track">
								<ul class="splide__list">
									<?php foreach($tipos_recurso as $tipo_recurso){ ?>
									<li class="splide__slide">
										<div class="single-fcat">
											<div class='circle fill-secondary'></div>
											<a href="<?php echo base_url('repositorio?busqueda=&busqueda_curso=0&busqueda_recurso='.$tipo_recurso->TIPO_NOMBRE); ?>">
												<i class="<?php if(isset($iconos[$tipo_recurso->TIPO_NOMBRE])){ echo $iconos[$tipo_recurso->TIPO_NOMBRE]; }else{ echo 'far fa-file'; } ?>"></i>
											</a>
											<p><?php echo $tipo_recurso->TIPO_NOMBRE_PLURAL; ?></p>
										</div>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
				</div>
			</div>
			</section>
			<!-- End feature-cat Area -->
		<!-- Start About Area -->
		<section class="section-gap" id="inter">
			<div class="container">
				<div class="row d-flex sidebar">
					<div class="col-md-12 col-lg-4 single-slidebar">
						<h4 class="text-white">Recursos por Área</h4>
						<ul class="cat-list">
							<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimiento'],'','',''); ?>
							<?php foreach($areas_conocimiento as $area){ ?>
								<li><a class="justify-content-between d-flex" href="<?php echo base_url('repositorio?busqueda=&busqueda_curso=0&busqueda_recurso&busqueda_area='.$area->TIPO_NOMBRE); ?>"><p><?php echo $area->TIPO_NOMBRE; ?></p></a></li>
							<?php } ?>
						</ul>
					</div>

						<div class="col-md-12 col-lg-4 single-slidebar">
							<h4 class="text-white">Recursos por Tipo</h4>
							<ul class="cat-list">
								<?php foreach($tipos_recurso as $tipo_recurso){ ?>
									<li><a class="justify-content-between d-flex" href="<?php echo base_url('repositorio?busqueda=&busqueda_curso=0&busqueda_recurso='.$tipo_recurso->TIPO_NOMBRE.'&busqueda_area'); ?>"><p><?php echo $tipo_recurso->TIPO_NOMBRE_PLURAL; ?></p><!--<span>37</span>--></a></li>
								<?php } ?>
							</ul>
						</div>

						<div class="col-md-12 col-lg-4 single-slidebar">
							<h4 class="text-white">Recursos por Curso</h4>
							<ul class="cat-list">
								<?php $cursos = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'cursos'],'','',''); ?>
								<?php foreach($cursos as $curso){ ?>
								<li><a class="justify-content-between d-flex" href="<?php echo base_url('repositorio?busqueda=&busqueda_curso='.$curso->TIPO_NOMBRE.'&busqueda_recurso&busqueda_area'); ?>"><p><?php echo $curso->TIPO_NOMBRE_PLURAL; ?></p><!--<span>37</span>--></a></li>
								<?php } ?>
							</ul>
						</div>
				</div>
			</div>
		</section>
		<!-- End About Area -->
