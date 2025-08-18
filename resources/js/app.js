
import 'livewire-v3';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

//ELEMENTO DEL FORM CON ID dropzone
const dropzoneElement = document.querySelector("#dropzone");
if (dropzoneElement) { //EVITAR ERROR EN CONSOLA EN VISTAS QUE NO TIENEN EL ID DROPZONE
    const dropzone = new Dropzone('#dropzone', { 
        //CONFIGURACIONES
        dictDefaultMessage: "Sube aqui tu imagen",
        /*acceptedFiles: ".png,.jgp,.jpeg,.gif",*/ //NO ME FUNCIONA EL ACCEPTE FILES 
        addRemoveLinks: true,
        dictRemoveFile: "Borrar Archivo",
        maxFiles: 1,
        uploadMultiple: false,    

        //RECUPERAR LA IMAGEN AGREGADA CUANDO DA ERROR EN OTRO CAMPO
        init: function(){
            if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {};
                imagenPublicada.size = 1234; //no hace falta que sea el tamaño real
                imagenPublicada.name = document.querySelector('[name="imagen"]').value;
                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, '/uploads/' + imagenPublicada.name);
                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');

            }
        },
    });

    dropzone.on('success', function(file, response){
        document.querySelector('[name="imagen"]').value = response.imagen; //ASIGNAR AL INPUT OCULTO EL NOMBRE DEL FICHERO
    });
}


//PARA DEBUG LO QUE HACE DROPZONE
/*dropzone.on('sending', function(file, xhr, formData){
    console.log(file);
    console.log(xhr);
    console.log(formData);
});


dropzone.on('error', function(file, message){
    console.log(file);
    console.log(message);
});

dropzone.on('removedfile', function(file, message){
    console.log(file);
    console.log(message);
});
*/