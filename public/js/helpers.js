$(document).ready(function(){
  toastr.options ={
      "closeButton": true,
      "positionClass": "toast-bottom-right"
  }

});

$("#user-icon").click(function(e){
  $("#user-settings").fadeIn();
  e.stopPropagation();
});
$("#user-settings").click(function(e){
  e.stopPropagation();
});

$(document).click(function(){
  $("#user-settings").css({'display':'none'});
});

const spinner = $("#spinner"); // Declaracion de constante global spinner

function validateForm(form) { // parametro : formulario completo
  
  let arrInputs = form.getElementsByTagName('input'); // Obtiene un array de Inputs del formulario
  let arrTextareas = form.getElementsByTagName('textarea');// Obtiene un array de Textareas del formualario

  if(arrInputs.length > 0){ // Valida longitud del array
    for (var i = 0; i < arrInputs.length; i++) { // Itera el array
      let oInput = arrInputs[i]; // Variable objeto Input
      if (oInput.getAttribute("data-validate")) { // Valida si el Input permite validacion
        if (!oInput.value) { // Valida input vacio
          alert('Llena el campo '+oInput.name); // Muestra mensaje al usuario
          oInput.focus(); // Envia foco al input
          return false; // Detiene la ejecucion
        }
      }
    }
  }

  if (arrTextareas.length > 0) { // Valida longitud del array
    for (var j = 0; j < arrTextareas.length; j++) { // Itera el array
      let oTextarea = arrTextareas[j]; // Variable objeto textarea
      if(oTextarea.getAttribute("data-validate")){ // Valida si el Input permite validacion
        if(oTextarea.classList.contains("ckeditor")){ // Verifica si el textearea contiene la clase ckeditor
          
          let oCkeditor = CKEDITOR.instances[oTextarea.name]; // Variable objecto oCkeditor
            if (!oCkeditor.getData()) { // Valida oCkeditor vacio
              alert('Llena el campo '+oCkeditor.name); // Muestra mensaje al usuario
              oCkeditor.focus(); // Envia foco al oCkeditor
              return false; // Detitine la ejecucion
            }

          console.log('This textarea is CKEDITOR'); // Envia mensaje a la consola (test).
        }else{
          if(!oTextarea.value){ // Valida textarea vacio
            alert('Llena el campo '+oTextarea.name); // Muestra mensaje al usuario
            oTextarea.focus(); // Envia foco al textearea
            return false; // Detiene la ejecucion
          }
        }
      }
    }
  }

  return true; // Todo OK | continua la ejecucion
}

function showImageModal(src,name) {
  $('#modal-image').css({'display':'block'});
  $("#img-show").attr("src", src);
  $('#caption').text(name);

  var span = $(".cerrar")[0];
  span.onclick = function() { 
    $('#modal-image').css({'display':'none'});
  }
}

function readImage(input,innerImage) {
  if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $(`#${innerImage}`)
                .attr('src', e.target.result);

            /*if($('#text-info')){
              $('#text-info').hide();
            }*/
        };
        reader.readAsDataURL(input.files[0]);
  }
}

function dateFormat(date) { // formatea fecha de mysql dia/mes/año
  let meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciemnbre'];
  let fecha = new Date(Date.parse(date.replace(/[-]/g,'/')));
  return `${fecha.getDate()}-${meses[fecha.getMonth()]}-${fecha.getFullYear()}`;
}

// Helper function: para paginacion
function renderPagination(response,functionName) { // Funcion para renderizar la paginacion

    $(".custom-pagination").empty();
    let html = '';

    if(response.last_page > 1){ // Si hay paginas 
        if(response.current_page > 1){ // Mostrar boton atras
            html +=`<span class="input-group-prepend">
                        <button onclick="${functionName}(${response.current_page - 1})" class="btn btn-outline-secondary" type="button">&laquo;</button>
                    </span>`;
        }else{
            html+=`<span class="input-group-prepend">
                        <button class="btn btn-outline-secondary" disabled type="button">&laquo;</button>
                    </span>`;
        }

        html+=`<div class="input-group-prepend"><span class="input-group-text">Página</span></div>
                <input type="number" onkeyup="changePageInput(this,${response.last_page},${functionName})" class="form-control" value="${response.current_page}">
                <div class="input-group-append"><span class="input-group-text">de ${response.last_page}</span></div>`;

        if (response.current_page < response.last_page) { // Mostrar boton siguiente
            html +=`<span class="input-group-append">
                       <button onclick="${functionName}(${response.current_page + 1})" class="btn btn-outline-secondary" type="button">&raquo;</button>
                     </span>`;
        }else{
            html +=`<span class="input-group-append">
                       <button disabled class="btn btn-outline-secondary" type="button">&raquo;</button>
                     </span>`;
        }
    }
    $(".custom-pagination").append(html);
}

function changePageInput(input,last_page, functionName) { // Funcion para cambiar pagina con input y enter
    event.preventDefault();
    let page = input.value;
    if (page) {
        
        if (event.keyCode == 13) {
            if(page >= 1){
                if(page <= last_page){
                    functionName(page);
                }else{
                    toastr.warning(`¡Solo hay ${last_page} páginas para mostrar!`,'Advertencia');
                }
            }else{
                toastr.warning('Rango incorrecto','Advertencia');
            }
            
        }
    }
}




