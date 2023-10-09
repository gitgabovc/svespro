
const listaCarrito = document.querySelector('#listaCarrito tbody');
const carritoB = document.querySelector('#carritoB');
let carrito = [];
let carritoProductos = [];

const txtCantidadRecibido = document.querySelector('.cantidad-dinero-recibido');

txtCantidadRecibido.addEventListener('input', modificarRecibido);


function modificarRecibido(e) {
     const tVentas = Number(document.querySelector("#tVentas").value);
     const tRecibido = Number(e.target.value);

     const tCambio = tRecibido - tVentas;

     document.querySelector(".tCambio-span").textContent = tCambio;
     document.querySelector(".tRecibido-span").textContent = tRecibido;





}


$('#txtCliente').on('select2:select', (e) => {
     document.querySelector('#inputCliente').value = e.params.data.id;

});


carritoB.addEventListener('click',eliminarProducto);
function agregarProducto(){
     const precio = $('#precio').val();
     const producto = $('#producto').val();
     const total = $('#total').val();
     const cantidad = $('#cantidad').val();
     const idProducto = $('#idProducto').val();

     if(cliente.length == 0 || producto.length == 0 || total == 0 || cantidad == 0|| precio == 0 ){
          console.log("Todos los campos son obligatorios");
          return;
      }
      const carritoObj ={
          idCarrito : idProducto,
          producto,
          cantidad,
          precio,
          total,
      }
      carrito = [...carrito, carritoObj];

      const Iprecio = document.querySelector('#precio');
      const Iproducto = document.querySelector('#producto');
      const Itotal = document.querySelector('#total');
      const Icantidad = document.querySelector('#cantidad');
      const prec = document.querySelector('#precioNormal');
      const txtCantidadProducto = document.querySelector('#txtCantidadProducto');
      const IidProducto = document.querySelector('#idProducto');
      const ventasTotal = document.querySelector('#ventasTotal');
      const tt = carrito.reduce((t,producto)=>t+Number(producto.total),0);
      ventasTotal.value= tt;
      txtCantidadProducto.textContent = 'Cantidad';
       Iprecio.value='';
       IidProducto.value='';
       prec.value='';
       Iproducto.value='';
       Itotal.value='';
       Icantidad.value='';
      

      crearHTML();
}

function eliminarProducto(e){
     console.log('funciona');
     if(e.target.classList.contains('borrar-producto')){
          const id = e.target.getAttribute('data-id');
          desagregarSeleccionadoEnModal(id);
          console.log(id);
         const cursos = carritoProductos.filter(c => c.idProducto != id );
         console.log(cursos);
         carritoProductos = [...cursos];
         crearHTML();
     }
 
 }

 function desagregarProductoEnTablaDesdeModal(id){
     console.log('funciona');
          console.log(id);
         const cursos = carritoProductos.filter(c => c.idProducto != id );
         console.log(cursos);
         carritoProductos = [...cursos];
         crearHTML();
     
 
 }



function btn_buscar_cliente()
{
     // console.log();
     const cerrar = document.querySelector('#seleccionarCliente');
     cerrar.style.display='inline';

    var palabra = $("#cliente").val();
    console.log(palabra);
    var obj= {palabra};

        $.ajax({
                    //el protocolo
                    type: "POST",
                    //a donde quiero mandar el objeto
                    url: 'venta/buscar_en_bd_cliente',    
                    data: obj,
    
                    //que quieres mostrar como recargable al iniciar
                    beforeSend: function(objeto){
                        
                    },
    
                    //al finalizar
                    success: function(data)
                    {
                        $("#seleccionarCliente").html(data);

                       
                    }
                });
}
function btn_buscar_producto()
{
     // console.log();
     const cerrar = document.querySelector('#seleccionarProducto');
     cerrar.style.display='inline';

    var palabraProducto = $("#producto").val();
    console.log(palabraProducto);
    var obje= {palabraProducto};

        $.ajax({
                    //el protocolo
                    type: "POST",
                    //a donde quiero mandar el objeto
                    url: 'venta/buscar_en_bd_producto',    
                    data: obje,
    
                    //que quieres mostrar como recargable al iniciar
                    beforeSend: function(objeto){
                        
                    },
    
                    //al finalizar
                    success: function(data)
                    {
                        $("#seleccionarProducto").html(data);

                       
                    }
                });
}

function btn_cerrar(){
     const cerrar = document.querySelector('#seleccionarCliente');
     cerrar.style.display='none';
}
function btn_cerrar_producto(){
     const cerrar = document.querySelector('#seleccionarProducto');
     cerrar.style.display='none';
}

function agregarClienteInput(id,nombre,nit){
     const cliente = document.querySelector('#cliente');
     cliente.value = `${nombre} - ${nit}`;
     btn_cerrar();
     // const producto = $('#producto').val();
}

function agregarProductoInput(id,productoNombre,precio,codigo,stock){
     const producto = document.querySelector('#producto');
     const precioNormal = document.querySelector('#precioNormal');
     const txtCantidadProducto = document.querySelector('#txtCantidadProducto');
     const idProducto = document.querySelector('#idProducto');
     precioNormal.value = precio;

     idProducto.value=id;


     txtCantidadProducto.textContent=`Cantidad: ${stock}`



     const precioD = document.querySelector('#precio');
     precioD.value = precio;

     producto.value = `${productoNombre} - ${codigo}`;
     btn_cerrar_producto();
     // const producto = $('#producto').val();
}

function btn_calcular_total(){
     const cant = document.querySelector('#cantidad').value;
     const p = document.querySelector('#precio').value;
     const total = document.querySelector('#total');
     total.value=`${cant*p}`;



}

function generarVenta(){
//     console.log({'carrito': JSON.stringify(carrito)})
     var lista_carrito = JSON.stringify(carrito);
    var ob = {
         carritoo: lista_carrito
    };


        $.ajax({
                    //el protocolo
                    type: "POST",
                    //a donde quiero mandar el objeto
                    url: 'http://localhost/svespro/index.php/venta/carrito',    
                    data: ob,
                    dataType: "JSON",
                    //que quieres mostrar como recargable al iniciar
                    
                    //al finalizar
                    success: function(data)
                    {
                        
                    }
                });
}
function envioCarrito() {
     const ventasTota = document.querySelector('#ventasTotal').value;
     var obj = {
          arreglo:JSON.stringify(carrito),
          ventasTotal:ventasTota
     };
     console.log(obj);
     $.ajax({
          type: "POST",
          url:'venta/carrito',
          data:obj,
          success: function(data){
               // console.log(data);
               window.location.href=`http://localhost/svespro/venta/imprimir/${data}`;
          }
     })
}


function agregarProduct( idProdcuto, codigo, nombreProducto, precio, stock ) {





     const producto = {
          idProducto: idProdcuto,
          codigo: codigo,
          nombreProducto:nombreProducto,
          precio: precio,
          precioVenta: precio,
          stock: stock,
          cantidad:0,
          total:0,

     }

     // console.log(producto);

     carritoProductos = [producto, ...carritoProductos];
     console.log(carritoProductos);
     listarProduct();
}

function listarProduct() {
     

     const filaVacia = document.querySelector("#sin-productos");
     if (carritoProductos.length == 0) {
          filaVacia.style.display="block";
          return;
     }
     //filaVacia.style.display="none";

     crearHTML();
     
}

function crearHTML(){
     limpiarHTML();
     if(carritoProductos.length>0){
          carritoProductos.forEach((prod,i)=>{
          const {idProducto,
               codigo,
               nombreProducto,
               precio,
               precioVenta,
               stock,
               cantidad,
               total} = prod;
          const row = document.createElement('tr');
          row.innerHTML = `
          <input type="hidden" id="idProducto" value="${idProducto}" name="idProducto[]">
               <td>${++i}</td>
               <td>${codigo}</td>
               <td>${nombreProducto}</td>
               <td class="stock">${stock}</td>
               <td><input type="number" class="form-control cantidad" placeholder="Cantidad" id="cantidad" name="cantidad[]" value="${cantidad}" max="${stock}"></td>
               <td class="precioVenta">${precioVenta}</td>
               
               <input type="hidden" name="precioVenta[]" value="${precioVenta}">

               <td class="totalVenta">${total}</td>

               <td class="text-center">
                    <a class="borrar-producto text-white" data-id='${idProducto}' style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
               </td>
          `;
              listaCarrito.appendChild(row);

              const cantidadInput = row.querySelector('.cantidad');

              cantidadInput.addEventListener('input', cambio);

              row.querySelector('.borrar-producto').addEventListener('click', e => e.preventDefault());


          })
     }
     cambiarAlAgregar();
}

function cambio() {
     let cantidad = Number(this.parentElement.parentElement.querySelector(".cantidad").value);
     const precioVenta = Number(this.parentElement.parentElement.querySelector(".precioVenta").textContent);

     const stock = Number(this.parentElement.parentElement.querySelector(".stock").textContent);

     if ((cantidad > stock)) {
          this.parentElement.parentElement.querySelector(".cantidad").value = stock;
          cantidad = stock;
     }



     const totalVenta = precioVenta * cantidad;

     this.parentElement.parentElement.querySelector(".totalVenta").textContent = totalVenta;

     const calculoDelTotal = calcularInputs(".totalVenta");
     document.querySelector("#tVentas").value = calculoDelTotal;

     document.querySelector(".venta-cobro__total").textContent = `Total Venta Bs.- ${calculoDelTotal}`; 

     document.querySelector(".enta-cobro__total-venta-span").textContent = calculoDelTotal; 
     // document.querySelector(".").textContent = calculoDelTotal;

}

function cambiarAlAgregar() {
     const calculoDelTotal = calcularInputs(".totalVenta");
     document.querySelector("#tVentas").value = calculoDelTotal;

     document.querySelector(".venta-cobro__total").textContent = `Total Venta Bs.- ${calculoDelTotal}`; 

     document.querySelector(".enta-cobro__total-venta-span").textContent = calculoDelTotal; 
     // document.querySelector(".tVentas-span").textContent = calculoDelTotal;
}

function calcularInputs(identificador) {
     const etiquetas = document.querySelectorAll(identificador);
     const arrayFromNodeList = Array.from(etiquetas);
     const sumaTotal = arrayFromNodeList.reduce((accumulator, currentValue) => accumulator + Number(currentValue.textContent), 0);
     return sumaTotal;
}

function limpiarHTML(){

     while(listaCarrito.firstChild){
          
          console.log(listaCarrito.firstChild);
         listaCarrito.removeChild(listaCarrito.firstChild);
     }
}


function agregarElProducto(e){
     if(e.target.classList.contains('btnAgregarProd')){
          // console.log(e.target.parentElement.parentElement);

          const elementoHijo = e.target.parentElement.parentElement;
          const r = e.target.parentElement;


          if (elementoHijo.classList.contains("seleccionado")) {
               //estoy desagregando
               elementoHijo.classList.remove("seleccionado");
               e.target.style.display = "none";
               const t = r.querySelector(".btnAgregarProd");
               t.style.display="block";



          } else {
               //estoy agregando
               elementoHijo.classList.add("seleccionado");
               e.target.style.display = "none";
               const t = r.querySelector(".ultimo");
               t.style.display="block";
          }

     }
}

function desagregarSeleccionadoEnModal(id){

     const selector = ".idProducto-"+id;
     console.log(selector);
     const tarjeta = document.querySelector(selector);
     const btnDesahagregar = tarjeta.querySelector(".ultimo");
     const btnAgregar = tarjeta.querySelector(".primero");
     
     tarjeta.classList.remove("seleccionado");
     btnDesahagregar.style.display = "none";
     btnAgregar.style.display = "block";

     

     
}

$(document).ready(function()
{


     const contenedorImgProductos = document.querySelector('.imgProductosP');


     contenedorImgProductos.addEventListener("click", agregarElProducto)
     
     



     const btnCategorias = document.querySelectorAll('.categoria');
     let categoriaSeleccionada = 0;

     btnCategorias.forEach(e => {
          e.addEventListener("click",filtrarCategoria);
     });



     function filtrarCategoria(ev) {
          btnCategorias.forEach(e => {
               
               e.classList.remove("badge-success");
               e.classList.add("badge-primary");
          });
          
          
          ev.target.classList.add("badge-success");
          categoriaSeleccionada = "."+ev.target.id;

          const prod = document.querySelectorAll(".product");


          prod.forEach(e => {
               
                    e.style.display="block";
               
              }) 

         //console.log(prod);
         if (ev.target.id == "id-0") return;
         prod.forEach(e => {
          if(e.classList[4] != ev.target.id){
               e.style.display="none";
          }
         }) 
     }    
     
     $('#btnGuardar').click(function() {

          if (listaCarrito.length <= 0) {
               console.log("Debes agregar productos");
               return;
          }

          const formData = $('#formDatos').serialize();

          console.log(formData);

          $.ajax({
               type: "POST",
               url: "venta/insertar",
               data: formData,
               success: function(r) {
                    console.log(r);
                    if (r == "true") {
                         window.location.href = "http://localhost:8080/svespro/venta/rc";
                    } else {
                         console.log("error en la insercion");
                    }
               }
          });


     });

//alert('gsdgdfgdfg');

// $('#btnGuardar').click(function(){

//  	var  formData=$('#FormDatos').serialize();
     //alert(formData);
     //return false;

     // $.ajax({
     //      type: "POST",
     //      url: "usuario/insert",
     //      data: formData,
     //      success: function(r){

     //      }
     // });

          //return false; // elimina que la pagina se recargue
	// });




});