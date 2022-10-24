<!-- Styles -->
<style>
    #chartdiv-{{$id}} {
      width: 100%;
      height: 500px;
      direction:ltr;
    }
    #chartdiv-{{$id}} .amcharts-amexport-menu-level-0.amcharts-amexport-top {
        top: 30px;
        bottom: auto;
    }
</style>
<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var pie_chart = am4core.create("chartdiv-{{$id}}", am4charts.PieChart3D);
pie_chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

pie_chart.legend = new am4charts.Legend();

pie_chart.data = "{{ json_encode($data) }}";
pie_chart.data = JSON.parse(pie_chart.data.replace(/&quot;/g,'"'));
var title = pie_chart.titles.create();
            title.text = "{{$title}}";
            title.fontSize = 16;
            title.marginBottom = 30;
            title.align  = "center";
@if(app()->getLocale() == "ar")
    pie_chart.rtl = true;
@endif
// Add and configure Series
var series = pie_chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "value";
series.dataFields.category = "title";
// Enable export
pie_chart.exporting.menu = new am4core.ExportMenu();
// pie_chart.exporting.filePrefix = moment();
}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv-{{$id}}"></div>