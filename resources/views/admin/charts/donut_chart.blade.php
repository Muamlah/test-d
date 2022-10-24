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
am4core.useTheme(am4themes_material);
// Themes end

// Create chart instance
var donut_chart = am4core.create("chartdiv-{{$id}}", am4charts.PieChart);
// Add data
//example:
/* data = [{
    'title': "Test",
    'value': 102
}] */
donut_chart.data = "{{ json_encode($data) }}";
donut_chart.data = JSON.parse(donut_chart.data.replace(/&quot;/g,'"'));

var title = donut_chart.titles.create();
            title.text = "{{$title}}";
            title.fontSize = 16;
            title.marginBottom = 30;
            title.align  = "center";
@if(app()->getLocale() == "ar")
    donut_chart.rtl = true;
@endif
// Add and configure Series
var pieSeries = donut_chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "value";
pieSeries.dataFields.category = "title";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;


var rgm = new am4core.RadialGradientModifier();
rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
pieSeries.slices.template.fillModifier = rgm;
pieSeries.slices.template.strokeModifier = rgm;
pieSeries.slices.template.strokeOpacity = 0.4;
pieSeries.slices.template.strokeWidth = 0;
pieSeries.slices.template.text = "({value.percent.formatNumber('#.#')}%) [bold]{value.value}[/]";

donut_chart.legend = new am4charts.Legend();
donut_chart.legend.position = "right";
donut_chart.legend.valueLabels.template.text = "({value.percent.formatNumber('#.#')}%) [bold]{value.value}[/]";
// @if(app()->getLocale() == "ar")
//     donut_chart.legend.itemContainers.template.reverseOrder = true;
// @endif
// donut_chart.legend.reverseOrder  = true;

var label = pieSeries.createChild(am4core.Label);
label.text = "Hi there!";
label.horizontalCenter = "middle";
label.verticalCenter = "middle";
label.fontSize = 40;
label.text = "{values.value.sum}";
// Enable export
donut_chart.exporting.menu = new am4core.ExportMenu();
// donut_chart.exporting.filePrefix = moment();
}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv-{{$id}}"></div>