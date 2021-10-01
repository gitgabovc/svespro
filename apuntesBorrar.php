

 	<div class="row">
        <div class="col s12 m6 l6">
            <div class="input-field">
                <?php 
                $listaCategoria=array();
                foreach ($categorias->result() as $row1) { 
                    $listaCategoria[$row1->idCategoria]=$row1->nombre;
                         } 
                  echo form_dropdown('cbxCategoria',$listaCategoria,$row->idCategoria,'class="form-control"');
                      ?>
                <label for="email1">Categoria</label>
            </div>
                      </div>
                       <div class="col s12 m6 l6">
                      <div class="input-field">
                          <input id="txtCodigo" name="txtCodigo" type="text" value="<?php echo $row->codigo; ?>">
                         <label for="email1">Codigo</label>
            </div>
        </div>
  </div>


<! ---
  function enviarDatos(datos){
     $.ajax({
         url: "https://tu-server.com",
         type: "POST",
         data: JSON.stringify(datos), //array creado con los valores tomados por el input
         success: window.location = "https://nueva-pagina.com", //redireccionamento 
         error: function(e){
            console.log(JSON.stringify(e));
         }
     });
}


$("#contactform1_contact-form-submit").on("click", function(){
     var datos = [];
     //inputs inventados para hacerte ver el funcionamento
     datos.push($("#nombre").val());
     datos.push($("#apellido").val());
     enviarDatos(datos);
});

-->

<!--- 
  Mi github// https://github.com/jgm5225/proyecto_final/tree/c581dfc01639c01cb5bc2269e84f2806889bf168
  #Clonar un repositorio
git clone https://github.com/arielivandiaz/teaching-git-starter-pack.git

#Entrar en la carpeta del repositorio
cd teaching-git-starter-pack

#Modificamos el repositorio
### /*/*/*/*/

#Checkeamos los archivos modificados
git status 

#Agregamos los cambios
git add -A

#Creamos un commit con titulo "Probando git bash"
git commit -m 'Probando git bash'

# Opcional: Actualizar el repo (pull)
git pull origin master

#Enviamos los cambios al repositorio remoto  // para sincronizar con github
git push origin master
 ---->