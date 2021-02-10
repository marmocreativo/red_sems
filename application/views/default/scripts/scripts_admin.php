<script type="text/javascript">
// Evento URL Amigable
$('.UrlAmigableOrigen').on('keyup', function(){ escribir_url($('.UrlAmigableOrigen')) });
$('.UrlAmigableResultado').on('blur', function(){ escribir_url($('.UrlAmigableResultado')) });
function  escribir_url(origen){
  var url = origen.val();
  var tabla = $('.UrlAmigableOrigen').attr('data-tabla');
  var objeto = $('.UrlAmigableOrigen').attr('data-objeto');
  var id = $('.UrlAmigableOrigen').attr('data-id');

  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/url_amigable'); ?>",
    data: {
      tabla : tabla,
      url : url,
      objeto : objeto,
      id : id
    },
    dataType: "text",
    success : function(respuesta)
     {
      var respuesta = respuesta;
      $('.UrlAmigableResultado').val(respuesta);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
  });
};

// REORDENAR
function activar_reordenar(){
  if ( $( ".ui-sortable" ).length ) {

    $('.ui-sortable').sortable({
      scroll: true,
       helper: function(event, ui){
        var $clone =  $(ui).clone();
        $clone .css('position','absolute');
        return $clone.get(0);
        },
      start: function(){
        $(this).data("startingScrollTop",$(this).parent().scrollTop());
       },
        update: function (event, ui) {
        var objetos = $(this).sortable('serialize');
        var columna =  $(this).attr('data-columna');
        var tabla =  $(this).attr('data-tabla');
        if(columna!=null&&tabla!=null){
        // Llamada ajax
        var request = $.ajax({
            data: {
              objetos : objetos,
              tabla : tabla,
              columna : columna
            },
            type: 'GET',
            url: '<?php echo base_url('ajax/reordenar'); ?>',
            dataType: "html",
            success : function(respuesta)
             {
              var respuesta = respuesta;
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
            }
        });
      }

      }
    });
  }
}
activar_reordenar();

// Galeria Ajax
function  cargar_multimedia(){
  var tipo = $('.multimedia_ajax').attr('data-tipo');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/multimedia_ajax'); ?>",
    data: {
      tipo : tipo
    },
    dataType: "html",
    success : function(respuesta)
     {
      var respuesta = respuesta;
      $('.multimedia_ajax').html(respuesta);
      activar_reordenar();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
  });
}
// Galeria Ajax
function  cargar_galeria(){
  var id = $('.galeria_ajax').attr('data-id');
  var tipo = $('.galeria_ajax').attr('data-tipo');
  var tipo_objeto = $('.galeria_ajax').attr('data-tipo-objeto');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/galeria_ajax'); ?>",
    data: {
      id : id,
      tipo : tipo,
      tipo_objeto : tipo_objeto
    },
    dataType: "html",
    success : function(respuesta)
     {
      var respuesta = respuesta;
      $('.galeria_ajax').html(respuesta);
      activar_reordenar();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
  });
}

function borrar_multimedia(){
  Swal.fire({
    title: '¿Estas seguro?',
    text: "Esta acción no se puede deshacer.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, estoy seguro!',
    cancelButtonText: 'Mejor no.',
  }).then((result) => {
    if (result.value) {
      var id_multimedia = $(this).attr('data-id-multimedia');
      var vista = $(this).attr('data-vista');
      jQuery.ajax({
        method: "GET",
        url: "<?php echo base_url('ajax/borrar_multimedia'); ?>",
        data: {
          id_multimedia : id_multimedia
        },
        dataType: "html",
        success : function(respuesta)
         {
           if(vista=='galeria'){
             cargar_galeria();
           }
           if(vista=='multimedia'){
             cargar_multimedia();
           }

          activar_reordenar();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
      });
    } else if (
      // Read more about handling dismissals
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire(
        'Cancelado',
        'Información segura :)',
        'success'
      )
    }
  });
}
// Si existe un lugar para cargar la galería la cargo
if ( $( ".galeria_ajax" ).length ) {
  cargar_galeria();
}
if ( $( ".multimedia_ajax" ).length ) {
  cargar_multimedia();
}

//Editar datos multimedia
function mostrar_formularios_multimedia(){
  var id = $(this).attr('data-id-objeto');
  var titulo = $('.form-titulo-multimedia-'+id).val();
  var resumen = $('.form-resumen-multimedia-'+id).val();
  var archivo = $('.form-archivo-multimedia-'+id).val();

  $(this).toggleClass('btn-outline-warning');
  $(this).toggleClass('btn-outline-success');
  $('.mostrar_editar-'+id).toggleClass('d-none');
  $('.mostrar_guardar-'+id).toggleClass('d-none');

  // Actualización de datos
  jQuery.ajax({
    method: "POST",
    url: "<?php echo base_url('ajax/actualizar_multimedia'); ?>",
    data: {
      id : id,
      titulo : titulo,
      resumen : resumen,
      archivo : archivo
    },
    dataType: "html",
    success : function(respuesta)
     {
       $('.archivo-multimedia-'+id).html(archivo);
       $('.archivo-multimedia-'+id).attr('href',archivo);
       $('.titulo-multimedia-'+id).html(titulo);
       $('.resumen-multimedia-'+id).html(resumen);

       //

       $('.titulo-multimedia-'+id).toggleClass('d-none');
       $('.resumen-multimedia-'+id).toggleClass('d-none');
       $('.archivo-multimedia-'+id).toggleClass('d-none');
       $('.form-titulo-multimedia-'+id).toggleClass('d-none');
       $('.form-resumen-multimedia-'+id).toggleClass('d-none');
       $('.form-archivo-multimedia-'+id).toggleClass('d-none');
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
  });
}


// Borrar Galeria Ajax
$('.galeria_ajax').on('click','.editar_multimedia', mostrar_formularios_multimedia);
$('.multimedia_ajax').on('click','.editar_multimedia', mostrar_formularios_multimedia);
$('.galeria_ajax').on('click','.borrar_multimedia', borrar_multimedia);
$('.multimedia_ajax').on('click','.borrar_multimedia', borrar_multimedia);


/// REORDENAR MENU
if ( $( ".menu-sortable" ).length ) {
  $('.menu-sortable').nestedSortable({
			handle: 'div',
			items: 'li',
			toleranceElement: '> div',
      relocate: function(){
   			serialized = $('.menu-sortable').nestedSortable('serialize');
        var request = $.ajax({
            data: {
              objetos : serialized
            },
            type: 'GET',
            url: '<?php echo base_url('ajax/reordenar_menu'); ?>',
            dataType: "html",
            success : function(respuesta)
             {
              var respuesta = respuesta;
              console.log(respuesta);
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
            }
        });
      }
		});
  }

  //Marcar todos
  if ( $( ".control_estados_disponibilidad" ).length ) {
    $( ".control_estados_disponibilidad" ).change(function(){
      var controla = $(this).attr('data-controla');
      if($(this).prop("checked") == true){
        $("."+controla).attr('checked','checked');
      }else{
        $("."+controla).removeAttr('checked');
      }
    });
  }

  if ( $( ".hijo_estados_disponibilidad" ).length ) {
    $( ".hijo_estados_disponibilidad" ).change(function(){
      var controlador = $(this).attr('data-controlador');
      if($(this).prop("checked") != true){
        console.log('desmarcar '+controlador);
        $("#"+controlador).prop( "checked", false );
      }
    });
  }

  // Gráficas
  $(function() {
    if ( $( "#placeholder" ).length ) {
    $.ajax({
        url: "<?php echo base_url('ajax/vistas_por_dia'); ?>",
        type: "GET",
        dataType: "json",
        success: onDataReceived
      });
      function onDataReceived(series) {
        data = [ series ];
        var plot = $.plot("#placeholder", data,{

          xaxis: {
            mode: "time",
            showTicks: false,
            gridLines: false
          }
        });

      }
    }
  });
</script>
