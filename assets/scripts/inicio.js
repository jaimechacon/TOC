window.onload = function () {
  var baseurl = window.origin + '/minsal/Inicio/listarPromedioEvaluacionesCampanias';
  var campaniasData = {};
  campaniasOptions = {};
  var dataPoints = [];
  jQuery.ajax({
  type: "POST",
  url: baseurl,
  dataType: 'json',
  //data: {idEquipo: idEquipo},
  success: function(data) {
    if (data)
    {
      for (var i = 0; i < data.length; i++) {
        dataPoints.push({
          label: data[i]["c_nombre"],
          y: parseFloat(data[i]["promedio_evaluaciones"]),
          name: data[i]["c_nombre"]
        });
      }

       for (var i = 0; i < data.length; i++) {
          var idCampania = data[i]["id_campania"];
          var dataPoints2 = [];
          for (var f = 0; f < data[i]["eacs"].length; f++) {
              var eac = data[i]["eacs"][f]["u_nombres"] + ' ' + data[i]["eacs"][f]["u_apellidos"];
              dataPoints2.push({
                label: eac,
                y: parseFloat(data[i]["eacs"][f]["porcentaje"]),
                name: data[i]["eacs"][f]["c_nombre"],
                idCampania: data[i]["eacs"][f]["id_campania"],
                id_usuario: data[i]["eacs"][f]["id_usuario"]
              });
          }

            campaniasData[data[i]["c_nombre"]] = {
            name: data[i]["c_nombre"],
            exportEnabled: true,
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
              text: data[i]["c_nombre"]
            },
            subtitles: [{
              text: "Promedios en porcentajes( % )"
            }],
             legend:{
              horizontalAlign: "center",
              verticalAlign: "center"
            },
            axisX:{
              crosshair: {
                enabled: true,
                snapToDataPoint: true
              }
            },
            axisY: {
              title: "Porcentaje ( % )",
              includeZero: false,
              valueFormatString: "#0.##",
              crosshair: {
                enabled: true,
                snapToDataPoint: true,
                labelFormatter: function(e) {
                  return "%" + CanvasJS.formatNumber(e.value, "##0.00");
                }
              }
            },
            data: [{
                type: "area",//"doughnut", "pie", "column", "bar"
                click: onClick,
                //radius: "90%",
                //click: visitorsChartDrilldownHandler,
                name: data[i]["c_nombre"],
                cursor: "pointer",
                markerType: "circle",
                toolTip:{
                  shared:true
                },  

                //startAngle: 170,
                showInLegend: false,
                indexLabelPlacement: "outside",
                legendText: "{label} {y} %",
                horizontalAlign: "left",
                verticalAlign: "bottom",
                toolTipContent: "{label}: <strong>{y} %</strong>",
                //indexLabel: "{label} ({y} %)", //(#percent%)
                yValueFormatString:"#,##0.#"%"",
                indexLabelPlacement: "inside",
                dataPoints: dataPoints2
            }]
          }
        }

       

     // $("#chartContainer3").CanvasJSChart(optionsEACS2);

      

      

      //campaniasOptions.push(optionsEACS2);
        campaniasOptions.data = campaniasData["Evaluaciones por Campaña"];
        $("#chartContainer2").CanvasJSChart(campaniasOptions);
    }
  }
  });


   campaniasData = {
     "Evaluaciones por Campaña" :[{
      type: "bar",//"doughnut", "pie", "column", "bar"
      //radius: "90%",
      click: visitorsChartDrilldownHandler,
      name: "Evaluaciones por Campaña",
      //startAngle: 170,
      showInLegend: false,
      horizontalAlign: "left",
      verticalAlign: "bottom",
      legendText: "{label} {y} %",
      toolTipContent: "{label}: <strong>({y} %)</strong>",
      indexLabel: "{label} ({y} %)", //(#percent%)
      yValueFormatString:"#,##0.#"%"",
      axisY:{
        title : "Campañas",
        labelAngle: 30,
        labelFontSize: 12,
        labelAutoFit:  true,
        labelMaxWidth: 100
      },
      //indexLabelPlacement: "inside",
      dataPoints: dataPoints
    }]
  };

  campaniasOptions = {
    exportEnabled: true,
    animationEnabled: true,
    //cursor: "pointer",
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title: {
      text: "Evaluaciones por Campaña"
    },
    axisX:{
        title : "Campañas",
        labelAngle: 0,
        labelFontSize: 12,
        labelAutoFit:  true
    },
    axisY:{
        title : "Porcentaje (%)"
    },
    indexLabelPlacement: "outside",
    subtitles: [{
      text: "Promedios en porcentajes( % )"
    }],
    /*showInLegend: true,
    legend:{
      horizontalAlign: "bottom",
      verticalAlign: "bottom"
    },*/
    data: []
  };

  campaniasOptions.data = campaniasData["Evaluaciones por Campaña"];
  $("#chartContainer2").CanvasJSChart(campaniasOptions);


/*
var options3 = {
  animationEnabled: true,
  title:{
    text: "Stock Price of BMW - September"
  },
  axisX:{
    valueFormatString: "DD MMM",
    crosshair: {
      enabled: true,
      snapToDataPoint: true
    }
  },
  axisY: {
    title: "Closing Price (in USD)",
    includeZero: false,
    valueFormatString: "$##0.00",
    crosshair: {
      enabled: true,
      snapToDataPoint: true,
      labelFormatter: function(e) {
        return "$" + CanvasJS.formatNumber(e.value, "##0.00");
      }
    }
  },
  data: [{
    type: "area",
    xValueFormatString: "DD MMM",
    yValueFormatString: "$##0.00",
    dataPoints: [
      { x: new Date(2017, 08, 01), y: 85.83 },

      { x: new Date(2017, 08, 04), y: 84.42 },
      { x: new Date(2017, 08, 05), y: 84.97 },
      { x: new Date(2017, 08, 06), y: 84.89 },
      { x: new Date(2017, 08, 07), y: 84.78 },
      { x: new Date(2017, 08, 08), y: 85.09 },
      { x: new Date(2017, 08, 09), y: 85.14 },

      { x: new Date(2017, 08, 11), y: 84.46 },
      { x: new Date(2017, 08, 12), y: 84.71 },
      { x: new Date(2017, 08, 13), y: 84.62 },
      { x: new Date(2017, 08, 14), y: 84.83 },
      { x: new Date(2017, 08, 15), y: 84.37 },
      
      { x: new Date(2017, 08, 18), y: 84.07 },
      { x: new Date(2017, 08, 19), y: 83.60 },
      { x: new Date(2017, 08, 20), y: 82.85 },
      { x: new Date(2017, 08, 21), y: 82.52 },
      
      { x: new Date(2017, 08, 25), y: 82.65 },
      { x: new Date(2017, 08, 26), y: 81.76 },
      { x: new Date(2017, 08, 27), y: 80.50 },
      { x: new Date(2017, 08, 28), y: 79.13 },
      { x: new Date(2017, 08, 29), y: 79.00 }
    ]
  }]
};

$("#chartContainer3").CanvasJSChart(options3);
*/

/*
  var totalVisitors = 883000;
  var visitorsData = {
    "New vs Returning Visitors": [{
      click: visitorsChartDrilldownHandler,
      cursor: "pointer",
      explodeOnClick: false,
      innerRadius: "75%",
      legendMarkerType: "square",
      name: "New vs Returning Visitors",
      radius: "100%",
      showInLegend: true,
      startAngle: 90,
      type: "doughnut",
      dataPoints: [
        { y: 519960, name: "New Visitors", color: "#E7823A" },
        { y: 363040, name: "Returning Visitors", color: "#546BC1" }
      ]
    }],
      "Returning Visitors": [{
      color: "#E7823A",
      name: "New Visitors",
      type: "column",
      xValueFormatString: "MMM YYYY",
      dataPoints: [
        { x: new Date("1 Jan 2015"), y: 33000 },
        { x: new Date("1 Feb 2015"), y: 35960 },
        { x: new Date("1 Mar 2015"), y: 42160 },
        { x: new Date("1 Apr 2015"), y: 42240 },
        { x: new Date("1 May 2015"), y: 43200 },
        { x: new Date("1 Jun 2015"), y: 40600 },
        { x: new Date("1 Jul 2015"), y: 42560 },
        { x: new Date("1 Aug 2015"), y: 44280 },
        { x: new Date("1 Sep 2015"), y: 44800 },
        { x: new Date("1 Oct 2015"), y: 48720 },
        { x: new Date("1 Nov 2015"), y: 50840 },
        { x: new Date("1 Dec 2015"), y: 51600 }
      ]
    }],
    "New Visitors": [{
      color: "#546BC1",
      name: "Returning Visitors",
      type: "column",
      xValueFormatString: "MMM YYYY",
      dataPoints: [
        { x: new Date("1 Jan 2015"), y: 22000 },
        { x: new Date("1 Feb 2015"), y: 26040 },
        { x: new Date("1 Mar 2015"), y: 25840 },
        { x: new Date("1 Apr 2015"), y: 23760 },
        { x: new Date("1 May 2015"), y: 28800 },
        { x: new Date("1 Jun 2015"), y: 29400 },
        { x: new Date("1 Jul 2015"), y: 33440 },
        { x: new Date("1 Aug 2015"), y: 37720 },
        { x: new Date("1 Sep 2015"), y: 35200 },
        { x: new Date("1 Oct 2015"), y: 35280 },
        { x: new Date("1 Nov 2015"), y: 31160 },
        { x: new Date("1 Dec 2015"), y: 34400 }
      ]
    }]
  };

  var newVSReturningVisitorsOptions = {
    animationEnabled: true,
    theme: "light2",
    title: {
      text: "New VS Returning Visitors"
    },
    subtitles: [{
      text: "Click on Any Segment to Drilldown",
      backgroundColor: "#2eacd1",
      fontSize: 16,
      fontColor: "white",
      padding: 5
    }],
    legend: {
      fontFamily: "calibri",
      fontSize: 14,
      itemTextFormatter: function (e) {
        return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";  
      }
    },
    data: []
  };

  var visitorsDrilldownedChartOptions = {
    animationEnabled: true,
    theme: "light2",
    axisX: {
      labelFontColor: "#717171",
      lineColor: "#a2a2a2",
      tickColor: "#a2a2a2"
    },
    axisY: {
      gridThickness: 0,
      includeZero: false,
      labelFontColor: "#717171",
      lineColor: "#a2a2a2",
      tickColor: "#a2a2a2",
      lineThickness: 1
    },
    data: []
  };

  newVSReturningVisitorsOptions.data = visitorsData["New vs Returning Visitors"];
  $("#chartContainer").CanvasJSChart(newVSReturningVisitorsOptions);
*/
  function visitorsChartDrilldownHandler(e) {
    //e.chart.options = visitorsDrilldownedChartOptions;
    //e.chart.options.data = campaniasData[e.dataPoint.name];
    e.chart.options.title = { text: e.dataPoint.name }
    e.chart.render();
    $("#chartContainer2").CanvasJSChart(campaniasData[e.dataPoint.name]);
    
    $("#backButton").toggleClass("invisible");
  }

  $("#backButton").click(function() { 
    $(this).toggleClass("invisible");
    //newVSReturningVisitorsOptions.data = campaniasData["New vs Returning Visitors"];
    $("#chartContainer2").CanvasJSChart(campaniasOptions);
  });

  function onClick(e) {
    //alert(  e.dataSeries.type + ", dataPoint { idCampania:" + e.dataPoint.idCampania + ", id Usuario: "+ e.dataPoint.id_usuario + " }" );
    
    var ruta = window.location.href.replace("Inicio", "");
    var url = ruta + 'Evaluacion/ListarEvaluaciones?idCampania=' + e.dataPoint.idCampania + '&idEAC='+e.dataPoint.id_usuario;
    //$.redirectPost(window.location.href.replace("Inicio", url), {idCampania: e.dataPoint.idCampania, idEAC: e.dataPoint.id_usuario});
    window.location.href = url; // window.location.href.replace("Inicio", url);
  }

}

