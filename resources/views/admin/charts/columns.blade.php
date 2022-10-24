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
var column_chart = am4core.create("chartdiv-{{$id}}", am4charts.XYChart);
column_chart.scrollbarX = new am4core.Scrollbar();
var title = column_chart.titles.create();
            title.text = "{{$title}}";
            title.fontSize = 16;
            title.marginBottom = 30;
            title.align  = "center";
@if(app()->getLocale() == "ar")
    column_chart.rtl = true;
@endif
// Add data
column_chart.data = "{{ json_encode($data) }}";
column_chart.data = JSON.parse(column_chart.data.replace(/&quot;/g,'"'));

// Create axes
var categoryAxis = column_chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "title";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = column_chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;

// Create series
var series = column_chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "value";
series.dataFields.categoryX = "title";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
    return column_chart.colors.getIndex(target.dataItem.index);
});

// Cursor
column_chart.cursor = new am4charts.XYCursor();

column_chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()

</script>
<!-- HTML -->
<div id="chartdiv-{{$id}}"></div>