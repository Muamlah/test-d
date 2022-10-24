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
    var line_chart = am4core.create("chartdiv-{{$id}}", am4charts.XYChart);
    
    line_chart.data = "{{ json_encode($data) }}";
    line_chart.data = JSON.parse(line_chart.data.replace(/&quot;/g,'"'));
    var title = line_chart.titles.create();
                title.text = "{{$title}}";
                title.fontSize = 16;
                title.marginBottom = 30;
                title.align  = "center";
    @if(app()->getLocale() == "ar")
        line_chart.rtl = true;
    @endif
    @if(isset($format))
    line_chart.dateFormatter.inputDateFormat = "{{$format}}";

    @else
    // Set input format for the dates
    line_chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
    @endif
    
    // Create axes
    var dateAxis = line_chart.xAxes.push(new am4charts.DateAxis());
    var valueAxis = line_chart.yAxes.push(new am4charts.ValueAxis());
    
    // Create series
    var series = line_chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "value";
    series.dataFields.dateX = "date";
    series.tooltipText = "{value}"
    series.strokeWidth = 2;
    series.minBulletDistance = 15;
    
    // Drop-shaped tooltips
    series.tooltip.background.cornerRadius = 20;
    series.tooltip.background.strokeOpacity = 0;
    series.tooltip.pointerOrientation = "vertical";
    series.tooltip.label.minWidth = 40;
    series.tooltip.label.minHeight = 40;
    series.tooltip.label.textAlign = "middle";
    series.tooltip.label.textValign = "middle";
    
    // Make bullets grow on hover
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.strokeWidth = 2;
    bullet.circle.radius = 4;
    bullet.circle.fill = am4core.color("#fff");
    
    var bullethover = bullet.states.create("hover");
    bullethover.properties.scale = 1.3;
    
    // Make a panning cursor
    line_chart.cursor = new am4charts.XYCursor();
    line_chart.cursor.behavior = "panXY";
    line_chart.cursor.xAxis = dateAxis;
    line_chart.cursor.snapToSeries = series;
    
    // Create vertical scrollbar and place it before the value axis
    line_chart.scrollbarY = new am4core.Scrollbar();
    line_chart.scrollbarY.parent = line_chart.leftAxesContainer;
    line_chart.scrollbarY.toBack();
    
    // Create a horizontal scrollbar with previe and place it underneath the date axis
    line_chart.scrollbarX = new am4charts.XYChartScrollbar();
    line_chart.scrollbarX.series.push(series);
    line_chart.scrollbarX.parent = line_chart.bottomAxesContainer;
    
    dateAxis.start = 0.79;
    dateAxis.keepSelection = true;
    
    line_chart.exporting.menu = new am4core.ExportMenu();
    }); // end am4core.ready()
    </script>
    
    <!-- HTML -->
    <div id="chartdiv-{{$id}}"></div>