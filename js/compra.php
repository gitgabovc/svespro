<script type="text/javascript">
     $(document).ready(function() {
          // Variables

          const txtProveedor = document.querySelector('#txtProveedor');
          const btnAddProducto = document.querySelector('#btnAddProducto');
          const txtProducto = document.querySelector('#txtProducto');
          const txtContenidoProducto = document.querySelector('#select2-txtProducto-container');
          const tablaProductos = document.querySelector('#listaCarrito tbody');
          let inputsCantidad;
          const r = document.querySelector(".select2-selection__rendered");
          let listaProductos = [];
          <?php
          if ($this->uri->segment(2) == 'edit') {
               //echo "r.textContent=".$getCompra->row()->idProveedor."\n";
               foreach ($getDetalleCompra->result() as $row) {
          ?>
                    listaProductos = [...listaProductos, {
                         nombreProducto: "<?php echo "NOMBRE: " . strtoupper($row->nombreProducto) . " -- TALLA: " . $row->nombreTalla . " -- CATEGORIA: " . $row->nombreCategoria . " -- Marca: " . $row->nombreMarca . " -- COLOR: " . $row->nombreColor . " -- MATERIAL: " . $row->nombreMaterial ?>",
                         idProducto: <?php echo $row->idProducto; ?>,
                         cantidad: <?php echo $row->cantidad; ?>,
                         precioCompra: <?php echo $row->precioCompra; ?>,
                         precioVenta: <?php echo $row->precioVenta; ?>,
                         totalCosto: 0,
                         totalVenta: 0,
                         utilidad: 0
                    }];


          <?php
               }
               echo "generarHTML();\n";
               echo "actualizarTotales();\n";
          }
          ?>


          tablaProductos.addEventListener("click", eliminarProducto);



          $('#txtProveedor').on('select2:select', (e) => {
               document.querySelector('#idProveedor').value = e.params.data.id;
          });


          btnAddProducto.addEventListener("click", agregarProducto)



          function agregarProducto(e) {
               e.preventDefault();

               if (document.querySelector('#idProveedor').value == 0) {
                    console.log("primero debes agregar un proveedor");
                    return;
               }

               if (listaProductos.length > 0) {
                    const idsDeProductos = listaProductos.map(prod => (prod.idProducto).toString());
                    const duplicado = document.querySelector('#duplicado');
                    console.log({idsDeProductos,duplicado,p: txtProducto.value});

                    
                    
                         if (idsDeProductos.includes( txtProducto.value) ){
                         duplicado.style.display = "block";
                         setTimeout(() => {
                              duplicado.style.display = "none";

                         }, 5000);
                         console.log("repetido");
                         return;
                         
                         }
               }



               const productoValue = txtProducto.value;
               const nombreProducto = txtContenidoProducto.textContent;

               if ([productoValue, nombreProducto].includes("")) {
                    console.log("se debe seleccionar un producto");
                    return;
               }

               const objetoProducto = {
                    nombreProducto,
                    idProducto: productoValue,
                    cantidad: 0,
                    precioCompra: 0,
                    precioVenta: 0,
                    totalCosto: 0,
                    totalVenta: 0,
                    utilidad: 0
               };


               listaProductos = [...listaProductos, objetoProducto];

               // Deja vacio el select
               $('#txtProducto').val('').trigger('change.select2');

               generarHTML();
          }

          function generarHTML() {
               limpiarHTML();
               verificarExistenciaProductos();
               actualizarTotales();
               if (listaProductos.length > 0) {
                    listaProductos.forEach((producto, i) => {
                         const {
                              nombreProducto,
                              idProducto,
                              cantidad,
                              precioCompra,
                              precioVenta,
                              totalCosto,
                              totalVenta,
                              utilidad
                         } = producto;

                         const row = document.createElement("tr");
                         row.innerHTML = `

                         <td>${++i}</td>
                         <input type="hidden" id="idProducto" value="${idProducto}" name="idProducto[]">
                         <td>${nombreProducto}</td>
                         <td>
                              <input type="number" class="form-control cantidad"  placeholder="" value="${cantidad}" name="cantidad[]"/>
                         </td>
                         <td>
                              <input type="number" class="form-control precioCompra" placeholder="Text input" value="${precioCompra}" name="precioCompra[]"/>
                         </td>
                         <td>
                              <input type="number" class="form-control precioVenta" placeholder="Text input" value="${precioVenta}" name="precioVenta[]"/>
                         </td>
                         <td class="totalCosto">${Number(cantidad)*Number(precioCompra)}</td>
                         <td class="totalVenta">${Number(cantidad)*Number(precioVenta)}</td>
                         <td class="utilidad">${Number(cantidad)*Number(precioVenta)-Number(cantidad)*Number(precioCompra)}</td>

                         <td class="text-center">
                              <a class="text-white borrar-producto" style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#" data-id="${idProducto}">X</a>
                         </td>

                    `;
                         tablaProductos.appendChild(row);

                         const cantidadInput = row.querySelector('.cantidad');
                         const precioCompraInput = row.querySelector('.precioCompra');
                         const precioVentaInput = row.querySelector('.precioVenta');
                         row.querySelector('.borrar-producto').addEventListener('click', e => e.preventDefault());

                         cantidadInput.addEventListener('input', cambio);
                         precioCompraInput.addEventListener('input', cambio);
                         precioVentaInput.addEventListener('input', cambio);
                    });

               }
          }

          function limpiarHTML() {
               while (tablaProductos.firstChild) {
                    tablaProductos.removeChild(tablaProductos.firstChild);
               }
          }

          function cambio(e) {

               const precioCompra = Number(this.parentElement.parentElement.querySelector(".precioCompra").value);
               const cantidad = Number(this.parentElement.parentElement.querySelector(".cantidad").value);
               const precioVenta = Number(this.parentElement.parentElement.querySelector(".precioVenta").value);

               const totalCosto = precioCompra * cantidad;
               const totalVenta = precioVenta * cantidad;
               const utilidad = totalVenta - totalCosto;

               this.parentElement.parentElement.querySelector(".totalCosto").textContent = totalCosto;
               this.parentElement.parentElement.querySelector(".totalVenta").textContent = totalVenta;
               this.parentElement.parentElement.querySelector(".utilidad").textContent = utilidad;


               document.querySelector("#tCompras").value = calcularInputs(".totalCosto");
               document.querySelector("#tVentas").value = calcularInputs(".totalVenta");
               document.querySelector("#tUtilidad").value = calcularInputs(".utilidad");

          }


          function calcularInputs(identificador) {
               const etiquetas = document.querySelectorAll(identificador);
               const arrayFromNodeList = Array.from(etiquetas);
               const sumaTotal = arrayFromNodeList.reduce((accumulator, currentValue) => accumulator + Number(currentValue.textContent), 0);
               return sumaTotal;
          }

          function eliminarProducto(e) {
               console.log('funciona');
               if (e.target.classList.contains('borrar-producto')) {
                    const id = e.target.getAttribute('data-id');
                    //console.log(id);
                    const productosActualizados = listaProductos.filter(prod => prod.idProducto != id);
                    listaProductos = [...productosActualizados];
                    generarHTML();
               }

          }

          $('#btnGuardar').click(function() {

               if (listaProductos.length <= 0) {
                    console.log("Debes agregar productos");
                    return;
               }

               const formData = $('#formDatos').serialize();

               $.ajax({
                    type: "POST",
                    url: "compra/insertar",
                    data: formData,
                    success: function(r) {
                         console.log(r);
                         if (r == "true") {
                              window.location.href = "compra";
                         } else {
                              console.log("error en la insercion");
                         }
                    }
               });


          });


          function verificarExistenciaProductos() {
               if (listaProductos.length > 0) {
                    txtProveedor.setAttribute('disabled', 'disabled');
               } else {
                    txtProveedor.removeAttribute('disabled');
               };
          }

          function actualizarTotales() {
               const totalCompra = document.querySelector("#tCompras")
               const totalVentas = document.querySelector("#tVentas");
               const totalUtilidad = document.querySelector("#tUtilidad");
               const costosTotales = document.querySelectorAll(".totalCosto");
               const totalVenta = document.querySelectorAll(".totalVenta");
               const utilidad = document.querySelectorAll(".utilidad");

               if (listaProductos.length > 0) {
                    totalCompra.value = calcular(costosTotales);
                    totalVentas.value = calcular(totalVenta);
                    totalUtilidad.value = calcular(utilidad);
               } else {
                    totalCompra.value = "";
                    totalVentas.value = "";
                    totalUtilidad.value = "";
               };
          }

          function calcular(x) {
               let total = 0
               x.forEach(c => {
                    total += Number(c.textContent);
               });
               return total;
          }



          // function buscarID(IDjugador) {
          //      var idj = IDjugador;

          //      $.ajax({
          //          url: 'cliente/buscarIDiden',
          //          type: 'POST',
          //          data: {
          //           idj: idj
          //          }
          //      }).done(function(data) { 

          //          //alert(data);

          //          var reg = eval(data);

          //            if (reg.length > 0) {
          //                 var nombreCliente="";
          //                for (var i = 0; i < reg.length; i++) {
          //                     nombreCliente= reg[i]['nombre'];
          //                }

          //               return  nombreCliente;

          //            } else {
          //                return "0";
          //            }

          //      });
          //      return false;  // comentando esta linea no registra
          //  }





     });
</script>