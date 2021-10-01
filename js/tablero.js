
$(function() {
    "use strict";
    // Bar chart

    

    var f=new Date();
    var mesactual=f.getMonth()+1;
    var anioactual=f.getFullYear();



    //var fechaInicio=anioactual+'/'+mesactual+'/'+'01';
    //var fechaFinal=anioactual+'/'+mesactual+'/'+'31';
    //alert(fechaInicio+' '+fechaFinal);

$.ajax({
      url: 'reportes/totalmes',
      type: 'POST',
      data:{mesactual:mesactual,anioactual:anioactual}
  }).done(function(data){
    
    //alert(data);
    var reg=eval(data);

    var mes1=reg[0][0].totalmes;
    var mes2=reg[1][0].totalmes;
    var mes3=reg[2][0].totalmes;
    var mes4=reg[3][0].totalmes;
    var mes5=reg[4][0].totalmes;

    //alert(mes1+' '+mes2+' '+mes3+' '+mes4+' '+mes5);

    // tipos de Grafi: horizontalBar, pie, bar, polarArea, radar, line 
    new Chart(document.getElementById("grafico"), {
        type: 'bar',
        data: {
            labels: [obtnermes(mesactual-4), obtnermes(mesactual-3), obtnermes(mesactual-2), obtnermes(mesactual-1), obtnermes(mesactual)],
            datasets: [{
                label: "Total ventas: ",
                backgroundColor: ["#03a9f4", "#e861ff", "#08ccce", "#e2b35b", "#7AB47D"],
                data: [mes5, mes4, mes3, mes2, mes1]
            }]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Ultimos 5 meses del '+anioactual
            }
        }
    });


    function obtnermes(mes){
   

   if (mes==1) {
    return "Enero";
   }else{
    if (mes==2) {
      return "Febrero";
    }else{
      if (mes==3) {
        return "Marzo";
      }else{
        if (mes==4) {
          return "Abril";
        }else{
          if (mes==5) {
            return "Mayo";
          }else{
            if (mes==6) {
              return "Junio";
            }else{
              if (mes==7) {
                return "Julio";
              }else{
                if (mes==8) {
                  return "Agosto";
                }else{
                  if (mes==9) {
                    return "Septiembre";
                  }else{
                    if (mes==10) {
                      return "Octubre";
                    }else{
                      if (mes==11) {
                        return "Noviembre";
                      }else{
                        return "Diciembre";
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
   }





    }

    

   
  });











    


})