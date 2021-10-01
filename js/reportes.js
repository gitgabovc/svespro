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
            	baseurl+"reportes/reporfechas",
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
                                        "<th>"+'Cliente...'+"</th>"+
                                        "<th>"+'Articulo'+"</th>"+
                                        "<th>"+'Cantidad'+"</th>"+
                                        "<th>"+'Precio Venta'+"</th>"+
                                        "<th>"+'Sub total'+"</th>"+
                                        "<th>"+'Utilidad'+"</th>"+
                                        "<th>"+'Fecha'+"</th>"+
                                        "<th>"+'Usuario'+"</th>"+
                                    "</tr>"+
                                  "</thead>"+
                                    "<tbody>"+
                                                         
                                                        
                                    "</tbody>"+
                                    "<tfoot>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Cliente...'+"</th>"+
                                        "<th>"+'Articulo'+"</th>"+
                                        "<th>"+'Cantidad'+"</th>"+
                                        "<th>"+'Precio Venta'+"</th>"+
                                        "<th>"+'Sub total'+"</th>"+
                                        "<th>"+'Utilidad'+"</th>"+
                                        "<th>"+'Fecha'+"</th>"+
                                        "<th>"+'Usuario'+"</th>"+
                                    "</tr>"+
                                  "</tfoot>";

                    $('#file_export').append(thead);

            		$.each(da,function(i,item){
            			cont++;
            		var row = "<tr>" +
				                "<td >" + cont + "</td>" +
				                "<td >" + item.cliente + "</td>" +
                                "<td >" + item.articulo + "</td>" +
				                "<td >" + item.cantidad + "</td>" +
                                "<td >" + item.precioVenta + "</td>" +
                                "<td >" + item.subTotal + "</td>" +
                                "<td >" + item.utilidad + "</td>" +
				                "<td >" + item.fechaHora + "</td>" +
				                "<td >" + item.login + "</td>" +
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
                baseurl+"reportes/reporXarticulos",
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
                                        "<th>"+'Cantidad Vendida'+"</th>"+
                                        "<th>"+'Total Movimiento'+"</th>"+
                                        "<th>"+'Utilidad'+"</th>"+
                                    "</tr>"+
                                  "</thead>"+
                                    "<tbody>"+
                                                         
                                                        
                                    "</tbody>"+
                                    "<tfoot>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Articulo'+"</th>"+
                                        "<th>"+'Cantidad Vendida'+"</th>"+
                                        "<th>"+'Total Movimiento'+"</th>"+
                                        "<th>"+'Utilidad'+"</th>"+
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
                                "<td >" + item.utilidad + "</td>" +
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
                'reportes/reporteGlobalPDF'+'/'+fechaInicio+'/'+fechaFinal,
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
        //window.location.href = "reportes/reporteGlobalPDF"+"/"+fechaInicio+"/"+fechaFinal;
    }else{
        window.open(
                'reportes/reporteXarticulosPDF'+'/'+fechaInicio+'/'+fechaFinal,
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
        //window.location.href = "reportes/reporteXarticulosPDF"+"/"+fechaInicio+"/"+fechaFinal;
    }

    
    


});




});