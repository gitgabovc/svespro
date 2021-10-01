$(document).ready(function()
{

$('#btnMostrar').click(function(){
    var tipoRepor = $('#cbxTipoReporte').val();
	var fechaInicio = $('#dtpFechaInicio').val();
 	var fechaFinal = $('#dtpFechaFinal').val();
//alert(tipoRepor);
		if (tipoRepor==1)
          {
            // aqui reporte global
          	$.post(
            	baseurl+"reportesc/reporfechas",
            	{
            		"fechaInicio":fechaInicio,
            		"fechaFinal":fechaFinal
            	},
            	function(data)
            	{;
                    //var montoTotal=0;
            		var cont=0;

            		var da=JSON.parse(data);

            		$('#file_export').empty();

                        var thead="<thead>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Usuario'+"</th>"+
                                        "<th>"+'Articulo'+"</th>"+
                                        "<th>"+'Cantidad'+"</th>"+
                                        "<th>"+'Precio Compra'+"</th>"+
                                        "<th>"+'Sub total'+"</th>"+
                                        "<th>"+'Fecha'+"</th>"+
                                    "</tr>"+
                                  "</thead>"+
                                    "<tbody>"+
                                                         
                                                        
                                    "</tbody>"+
                                    "<tfoot>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Usuario'+"</th>"+
                                        "<th>"+'Articulo'+"</th>"+
                                        "<th>"+'Cantidad'+"</th>"+
                                        "<th>"+'Precio Compra'+"</th>"+
                                        "<th>"+'Sub total'+"</th>"+
                                        "<th>"+'Fecha'+"</th>"+
                                    "</tr>"+
                                  "</tfoot>";

                    $('#file_export').append(thead);

            		$.each(da,function(i,item){
            			cont++;
            		var row = "<tr>" +
				                "<td >" + cont + "</td>" +
				                "<td >" + item.login + "</td>" +
                                "<td >" + item.articulo + "</td>" +
				                "<td >" + item.cantidad + "</td>" +
                                "<td >" + item.precioCompra + "</td>" +
                                "<td >" + item.subTotal + "</td>" +
				                "<td >" + item.fechaHora + "</td>" +
				               "</tr>";
            		$('#file_export > tbody').append(row);
            		// id en index example1 para que aparesca funciones de jquery de la
            		})
                    //$('#total').val(montoTotal);
            	}

            	)

          }else{
            // aqui reporte por articulos
            $.post(
                baseurl+"reportesc/reporXarticulos",
                {
                    "fechaInicio":fechaInicio,
                    "fechaFinal":fechaFinal
                },
                function(data)
                {;
                    var cont=0;
                    var da=JSON.parse(data);
                    $('#file_export').empty();

                        var thead="<thead>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Articulo'+"</th>"+
                                        "<th>"+'Cantidad Compra'+"</th>"+
                                        "<th>"+'Total Movimiento'+"</th>"+
                                    "</tr>"+
                                  "</thead>"+
                                    "<tbody>"+
                                                         
                                                        
                                    "</tbody>"+
                                    "<tfoot>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Articulo'+"</th>"+
                                        "<th>"+'Cantidad Compra'+"</th>"+
                                        "<th>"+'Total Movimiento'+"</th>"+
                                    "</tr>"+
                                  "</tfoot>";

                    $('#file_export').append(thead);

                    $.each(da,function(i,item){
                        cont++;
                    var row = "<tr>" +
                                "<td >" + cont + "</td>" +
                                "<td >" + item.articulo + "</td>" +
                                "<td >" + item.cantidad + "</td>" +
                                "<td >" + item.subTotal + "</td>" +
                               "</tr>";
                    $('#file_export > tbody').append(row);
                    // id en index example1 para que aparesca funciones de jquery de la
                    })
                    //$('#total').val(montoTotal);
                }

                )
          }


	});

// generar reporte

$('#btnGenerar').click(function(){
    var tipoRepor = $('#cbxTipoReporte').val();
	var fechaInicio = $('#dtpFechaInicio').val();
 	var fechaFinal = $('#dtpFechaFinal').val();

    //alert(tipoRepor+fechaInicio+fechaFinal);

    if (tipoRepor==1) {
        window.open(
                'reportesc/reporteGlobalPDF'+'/'+fechaInicio+'/'+fechaFinal,
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
        //window.location.href = "reportesc/reporteGlobalPDF"+"/"+fechaInicio+"/"+fechaFinal;
    }else{
        window.open(
                'reportesc/reporteXarticulosPDF'+'/'+fechaInicio+'/'+fechaFinal,
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
        //window.location.href = "reportesc/reporteXarticulosPDF"+"/"+fechaInicio+"/"+fechaFinal;
    }

    
    


});




});