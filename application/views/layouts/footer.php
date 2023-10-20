        
					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2023. <a href="#">proyecto</a> por <a href="" target="_blank">Creativa</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<?php 
		if (!$this->session->userdata('idEmpleado')) {

			echo '<script>window.location.href = "login";</script>';
		}
	 ?>
    <!-- scripts del proyecto -->
	<!-- <script src="<?php echo base_url(); ?>Limitless/global_assets/js/demo_pages/dashboard.js"></script> -->
<?php 
if ($this->uri->segment(1)=='producto') {?> 
    <script type="text/javascript" src="<?php echo base_url(); ?>js/producto.js"></script><?php }
if ($this->uri->segment(1)=='categoria') {?> 
    <script type="text/javascript" src="<?php echo base_url(); ?>js/categoria.js"></script><?php }
if ($this->uri->segment(1)=='marca') {?> 
    <script type="text/javascript" src="<?php echo base_url(); ?>js/marca.js"></script><?php }
if ($this->uri->segment(1)=='cliente') {?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/cliente.js"></script><?php }
if ($this->uri->segment(1)=='empleado') {?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/empleado.js"></script><?php }
if ($this->uri->segment(1)=='usuario') {?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/usuario.js"></script><?php }
if ($this->uri->segment(1)=='venta') {
	if ($this->uri->segment(2)=='edit') {
		include './js/venta.php';
	}else{
		
	
	?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/venta.js"></script>
	
	<?php } }
if ($this->uri->segment(1)=='color') {?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/color.js"></script><?php }
	
if ($this->uri->segment(1)=='material') {?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/material.js"></script><?php }
if ($this->uri->segment(1)=='talla') {?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/talla.js"></script><?php }
if ($this->uri->segment(1)=='proveedor') {?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/proveedor.js"></script><?php }
if ($this->uri->segment(1)=='compra') {?> 
	<?php
	include './js/compra.php';
}
if ($this->uri->segment(1)=='reporte') {
	if($this->uri->segment(2)=='cliente'){

	
	?> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/reporte_cliente.js"></script><?php 
	}
	if($this->uri->segment(2)=='ventas'){

		?> 
		<script type="text/javascript" src="<?php echo base_url(); ?>js/reporte_venta.js"></script><?php 
	}
	if($this->uri->segment(2)=='compra'){

		?> 
		<script type="text/javascript" src="<?php echo base_url(); ?>js/reporte_compra.js"></script><?php 
	}
}
?>


</body>
</html>
