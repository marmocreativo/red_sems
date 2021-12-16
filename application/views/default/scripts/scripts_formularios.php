<script type="text/javascript">

  // Enviar formularios con Enter
  $(function() {
    $('.enviar_enter').each(function() {
        $(this).find('input').keypress(function(e) {
          // Enter pressed?
          if(e.which == 10 || e.which == 13) {
              this.form.submit();
          }
        });
    });
  });

  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Formulario input file Multiples
  function checkFiles(files) {
      if(files.length>10) {
        alert("Solo puedes subir 10 imágenes a la ves");
        files.slice(0,10);
        return false;
        }
  }

  // Datepicker
  if ( $( ".datepicker" ).length ) {
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      language: 'es',
      weekStart: 0
    });
  }
  // Alertas Sweet note
  $('.borrar_entrada').click(function (){
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
        var enlace = $(this).data('enlace');
        window.location=enlace;
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
  });
  // Summer Note
  if ( $( ".TextEditor" ).length ) {
    $('.TextEditor').summernote({
      minHeight: 400,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      focus: true,                  // set focus to editable area after initializing summernote
      followingToolbar: false,
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['style','ul', 'ol', 'paragraph']],
        ['insert', ['link','picture']],
        ['Code', ['fullscreen','codeview']]
      ]
    });
  }

  // Color Picker
  if ( $( ".ColorPicker" ).length ) {
    $('.ColorPicker').colorpicker();
  }
  // Icon Picker
  if ( $( ".IconPicker" ).length ) {
    $('.IconPicker').iconpicker({
      templates: {
          popover: '<div class="iconpicker-popover popover show"><div class="arrow"></div>' +
              '<div class="popover-title"></div><div class="popover-content"></div></div>'
      }
    });
  }

// Formulario Fecha
if ( $( ".direccion-paises" ).length ) {
  cargar_paises();
}

$( ".direccion-paises").change(function(){
  cargar_estados();
});

$( ".direccion-estados").change(function(){
  cargar_municipios();
});

function cargar_paises(){
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/lista_paises'); ?>",
    dataType: "html",
    success : function(respuesta)
     {
      var respuesta = respuesta;
      $('.direccion-paises').html(respuesta);
      var pais = $( ".direccion-paises" ).attr('data-pais-seleccionado');
      $(".direccion-paises").val(pais);
      cargar_estados();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
  });


}

function cargar_estados(){
  var id_pais = $( ".direccion-paises option:selected" ).attr('data-id-pais');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/lista_estados'); ?>",
    data: {
      id_pais : id_pais
    },
    dataType: "html",
    success : function(respuesta)
     {
      var respuesta = respuesta;
      $('.direccion-estados').html(respuesta);
      var estado = $( ".direccion-estados" ).attr('data-estado-seleccionado');
       $(".direccion-estados").val(estado);
       cargar_municipios();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
  });

}

function cargar_municipios(){
  var id_estado = $( ".direccion-estados option:selected" ).attr('data-id-estado');
  jQuery.ajax({
    method: "GET",
    url: "<?php echo base_url('ajax/lista_municipios'); ?>",
    data: {
      id_estado : id_estado
    },
    dataType: "html",
    success : function(respuesta)
     {
      var respuesta = respuesta;
      $('.direccion-municipios').html(respuesta);
      var municipio = $( ".direccion-municipios" ).attr('data-municipio-seleccionado');
      $(".direccion-municipios").val(municipio);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
      alert(thrownError);
    }
  });

}


// Dropzone

  if ( $( "#Dropzone_multimedia" ).length ) {
    Dropzone.autoDiscover = false;
    if (document.getElementById('Dropzone_multimedia')) {
      var id = $('#Dropzone_multimedia').attr('data-id');
      var tipo = $('#Dropzone_multimedia').attr('data-tipo');
      var tipo_objeto = $('#Dropzone_multimedia').attr('data-tipo-objeto');

      var url = '<?php echo base_url('admin/multimedia/cargar_'); ?>'+tipo;

      var DropZoneMultimedia = new Dropzone("#Dropzone_multimedia", {
        dictDefaultMessage: 'Click o arrastra y suelta para subir archivos',
        url: url,
        params: {
          'id':id,
          'tipo_objeto':tipo_objeto
        },
        addRemoveLinks: true,
        init: function() {
          this.on("success", function(file, responseText) {
            if(id!=''){
              cargar_galeria();
            }else{
              cargar_multimedia();
            }
            this.removeFile(file);

          });
        }
      });
    }

  }
  // Bootstrap select
  if ( $( ".lista_autocompletar" ).length ) {
    $('.lista_autocompletar').each(function() {
      var objeto = $(this).attr('data-objeto');
      var tipo = $(this).attr('data-tipo');
      var select = $(this);
      $(select).selectpicker();
    });
  }

/* AJAX REPOSITORIO */
  if ( $( ".contenedor_repositorio" ).length ) {
    cargar_repositorio();
  }
  if ( $( ".contenedor_repositorio_publico" ).length ) {
    cargar_repositorio_publico();
  }
  function cargar_repositorio(){
    var categoria = $('.contenedor_repositorio').attr('data-categoria');
    var orden_cat = $('.contenedor_repositorio').attr('data-orden_cat');
    var busqueda = $('.contenedor_repositorio').attr('data-busqueda');
    jQuery.ajax({
      method: "GET",
      url: "<?php echo base_url('ajax/vista_repositorio'); ?>",
      data: {
        categoria : categoria,
        orden_cat : orden_cat,
        busqueda : busqueda
      },
      dataType: "html",
      success : function(respuesta)
       {
        var respuesta = respuesta;
        $('.contenedor_repositorio').html(respuesta);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }
  function cargar_repositorio_publico(){
    var categoria = $('.contenedor_repositorio_publico').attr('data-categoria');
    var orden_cat = $('.contenedor_repositorio_publico').attr('data-orden_cat');
    var busqueda = $('.contenedor_repositorio_publico').attr('data-busqueda');
    var busqueda_curso = $('.contenedor_repositorio_publico').attr('data-busqueda_curso');
    var busqueda_recurso = $('.contenedor_repositorio_publico').attr('data-busqueda_recurso');
console.log(' busqueda_recurso: ' + busqueda_recurso)    ;
console.log(' busqueda_curso: ' + busqueda_curso)    ;
    jQuery.ajax({
      method: "GET",
      url: "<?php echo base_url('ajax/vista_repositorio_publico'); ?>",
      data: {
        categoria : categoria,
        orden_cat : orden_cat,
        busqueda : busqueda,
        busqueda_curso : busqueda_curso,
        busqueda_recurso : busqueda_recurso
      },
      dataType: "html",
      success : function(respuesta)
       {
        var respuesta = respuesta;
        $('.contenedor_repositorio_publico').html(respuesta);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }

  if ( $( "#Dropzone_repositorio" ).length ) {
    Dropzone.autoDiscover = false;
    if (document.getElementById('Dropzone_repositorio')) {
      var categoria = $('#Dropzone_repositorio').attr('data-categoria');
      var url = '<?php echo base_url('admin/repositorio/crear_archivo'); ?>';

      var DropZoneRepositorio = new Dropzone("#Dropzone_repositorio", {
        dictDefaultMessage: 'Click o arrastra y suelta para subir archivos',
        url: url,
        params: {
          'categoria':categoria
        },
        addRemoveLinks: true,
        success: function (file, response, data) {
             var imgName = response;
             file.previewElement.classList.add("dz-success");
             cargar_repositorio();
             this.removeFile(file);
         },
         error: function (file, response) {
             file.previewElement.classList.add("dz-error");
         },
         //Called just before each file is sent
         sending: function(file, xhr, formData) {
             //Execute on case of timeout only
             xhr.ontimeout = function(e) {
                 //Output timeout error message here
                 console.log('Server Timeout');

             };
         }
      });
    }

  }

  if ( $( "#boton_subir_archivo_pesado" ).length ) {
    $( "#boton_subir_archivo_pesado" ).click(function(e){
      //e.preventDefault();
      $( "#mensaje_subir_archivo_pesado" ).html('<div class="progress"><div class="progress-bar" id="progreso" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Subiendo</div></div>');
      var faltante = parseFloat(100);
      var porcentaje_total = 0;
      setInterval(function () {
        var porcentaje = faltante*10/100;
        porcentaje_total += porcentaje
        $( "#mensaje_subir_archivo_pesado").find("#progreso").css('width',porcentaje_total+'%');
        faltante -= porcentaje;
      }, 500);
    });
  }

  if ( $( "#boton_enviar_correo" ).length ) {
    $( "#boton_enviar_correo" ).click(function(e){
      //e.preventDefault();
      $( this ).html('<i class="fas fa-spinner fa-pulse"></i> Procesando, esto puede tomar unos minutos...');
    });
  }


    $( ".contenedor_repositorio_publico" ).on('click','.registrar_descarga',function(e){
      console.log('le di click');
      var publicacion = $(this).attr('data-id-publicacion');
      var id_usuario = $(this).attr('data-id-usuario');
      var nombre = $(this).attr('data-nombre');
      var apellidos = $(this).attr('data-apellidos');
      jQuery.ajax({
        method: "GET",
        url: "<?php echo base_url('ajax/registrar_descarga'); ?>",
        data: {
          publicacion : publicacion,
          id_usuario : id_usuario,
          nombre : nombre,
          apellidos : apellidos
        },
        dataType: "html",
        success : function(respuesta)
         {
          var respuesta = respuesta;
          console.log(respuesta)
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
      });
    });

    $('#Tema').tagsInput({
      'width':'100%',
    });
    $('#AreasConocimiento').tagsInput({
      'width':'100%',
    });
    //$('#Area').jsonTagEditor();

</script>
