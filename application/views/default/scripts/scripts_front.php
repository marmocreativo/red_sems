<script type="text/javascript">
  window.onload = function() {
      $(".load-screen").animate({opacity:0},500,function(){$(".load-screen").css('display','none'); });
      $("body").css('overflow','auto');

  };

// EstrellasCalificacion
if($( ".estrellas" ).length ){
  $('.estrellas').starrr({
    rating: 0,
    emptyClass: 'far fa-star text-warning fa-2x',
    fullClass: 'fa fa-star text-warning fa-2x',
  });

  $('.estrellas').on('starrr:change', function(e, value){
    $('#EstrellasCalificacion').val(value);
  })
}

// lightbox
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

  if ( $( ".grid" ).length ) {
    $('.grid').masonry({
      // options
      itemSelector: '.grid-item',
      columnWidth: 200
    });
  }

  // Owl carousel
  if ( $( ".carrusel_imagenes" ).length ) {
    $('.calcular_ancho').each(function() {
      var ancho = $(this).width();
      var alto = $(this).height();

      var nuevo_alto = 400;
      var nuevo_ancho = (nuevo_alto*ancho)/alto;
      $(this).parent().css('display', 'block')
      $(this).parent().width(nuevo_ancho);
      $(this).parent().height(nuevo_alto);

    });
    $( ".nuevo-carousel" ).addClass('owl-carousel');
    $('.owl-carousel').owlCarousel({
      items:4,
      autoWidth:true,
      loop:true,
      margin:10,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true
    });
  }

  // Parallax
  if ( $( ".parallax-principal" ).length ) {
    var scenes = [];
    var scenesSelector = document.querySelectorAll('.parallax-principal');
    for(i=0; i<scenesSelector.length; i++){
      scenes[i] = new Parallax(scenesSelector[i]);
    }
  }

  // Switch Grid-list
  $('body').on ('click','#switch-list', function(){
    $('.archivo').removeClass('grid');
    $('.archivo').removeClass('col-sm-6');
    $('.archivo').removeClass('col-md-4');
    $('.archivo').removeClass('col-lg-3');
    $('.archivo').removeClass('col-xxl-2');
    $('.archivo').addClass('list');
    $('.archivo').addClass('col-12');
  });

  $('body').on ('click','#switch-grid', function(){
    $('.archivo').removeClass('list');
    $('.archivo').removeClass('col-12');
    $('.archivo').addClass('grid');
    $('.archivo').addClass('col-sm-6');
    $('.archivo').addClass('col-md-4');
    $('.archivo').addClass('col-lg-3');
    $('.archivo').addClass('col-xxl-2');
  });


</script>
