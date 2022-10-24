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

// Create chart instance
var chart = am4core.create("chartdiv-{{$id}}", am4charts.XYChart3D);
chart.paddingBottom = 30;
chart.angle = 35;
var title = chart.titles.create();
            title.text = "{{$title}}";
            title.fontSize = 16;
            title.marginBottom = 30;
            title.align  = "center";
@if(app()->getLocale() == "ar")
    chart.rtl = true;
@endif
// Add data
// Add data
chart.data = "{{ json_encode($data) }}";
chart.data = JSON.parse(chart.data.replace(/&quot;/g,'"'));

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "title";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.inside = true;
categoryAxis.renderer.grid.template.disabled = true;

let labelTemplate = categoryAxis.renderer.labels.template;
labelTemplate.rotation = -90;
labelTemplate.horizontalCenter = "left";
labelTemplate.verticalCenter = "middle";
labelTemplate.dy = 10; // moves it a bit down;
labelTemplate.inside = false; // this is done to avoid settings which are not suitable when label is rotated

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.grid.template.disabled = true;

// Create series
var series = chart.series.push(new am4charts.ConeSeries());
series.dataFields.valueY = "value";
series.dataFields.categoryX = "title";

var columnTemplate = series.columns.template;
columnTemplate.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

columnTemplate.adapter.add("stroke", function(stroke, target) {
  return chart.colors.getIndex(target.dataItem.index);
})
chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()
</script>
    
    <!-- HTML -->
    <div id="chartdiv-{{$id}}"></div>