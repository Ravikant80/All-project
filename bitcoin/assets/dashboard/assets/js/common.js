// JavaScript Document
var jsjson = {
    chart: {
        renderTo: 'graph_container',
        defaultSeriesType: 'line',
        marginRight: 25,
        marginBottom: 40,
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        zoomType: 'x',
        reflow: true,
        resetZoomButton: {
            position: {
                align: 'right', // by default
                verticalAlign: 'top', // by default
                x: -100,
                y: -25
            },
            relativeTo: 'chart'
        }
    },
    title: {
        text: ''
    },
    exporting: { enabled: false },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'datetime'
    },
    yAxis: {
        labels: {
            formatter: function() {
                if (this.value === 0.00001) {
                    return 0;
                } else if (this.value < 10) {
                    return Highcharts.numberFormat(this.value, 4, '.', ',');
                } else {
                        return Highcharts.numberFormat(this.value, 0, '.', ',');
                }
            }
        },
        type: 'linear',
        showFirstLabel: false,
        title: {
            text: 'Measurement'
        },
        plotLines: [{
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function() {
            var date = new Date(this.x);
            var dateStr = date.getFullYear() + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + ('0' + date.getDate()).slice(-2) + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
            var tooltip = '<b>' + dateStr + '</b><br/><b>' + this.series.name + '</b>: ';

            if (this.y === 0.00001) {
                tooltip += '<= 0.00001';
            } else {
                if (this.y % 1 != 0 && this.y <= 10) {
                    tooltip += Highcharts.numberFormat(this.y, 3, '.', ',');
                } else {
                    tooltip += Highcharts.numberFormat(this.y, 0, '.', ',');
                }
            }

            return tooltip;
        }
    },
    plotOptions: {
        series: {
            marker: {
                enabled: false
            },
            states: {
                hover: {
                    enabled: false
                }
            }
        }
    },
    credits: {
        enabled: false
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -10,
        y: 100,
        borderWidth: 0
    },
    series: [{
        name: 'Series name',
        showInLegend: false
    }],
    colors: ['#039bd3'],
    navigation: {
        buttonOptions: {
            height: 20,
            width: 20,
            symbolSize: 20,
            symbolX: 10,
            symbolY: 10,
            y: -40,
            x: -15
        },
        menuItemStyle: {
            fontSize: "13px",
            fontFamily: "\"Helvetica Neue\",Helvetica,Arial,sans-serif",
            marginBottom: "2px"
        }
    }
};

var chart;

function qs(key) {
    var match = location.search.match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
    return match && match[1].replace(/\+/g, " ");
}

function updateQueryString(key, value, url) {
    url = url ? url : window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"), hash;

    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null) {
            document.location = url.replace(re, '$1' + key + "=" + value + '$2$3');
        } else {
            hash = url.split('#');
            url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            document.location = url;
        }
    } else {
        if (typeof value !== 'undefined' && value !== null) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            hash = url.split('#');
            url = hash[0] + separator + key + '=' + value;
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            document.location = url;
        } else {
            document.location = url;
        }
    }
}

function fail(err) {
    console.log(err);
    if (err.status != 404) {
        $("#chartloading").hide();
        $("#charterror").show();
    }
}

function ajaxCall(url, success, error) {
    var errCb = (typeof error != 'undefined') ? error : fail;
    $.ajax({
        url: url,
        crossDomain: true,
        dataType: 'json',
        success: success,
        error: errCb,
        statusCode: {
            404: function() {
                document.location = 'https://blockchain.info/404';
            }
        }
    });
}

function computeURL(host, chartName, jsjson, format, noCors) {
    var logScale = parseInt(qs('scale'));
    var showDataPoints = qs('showDataPoints');
    var timespan = qs('timespan');
    var rollingAverage = qs('rollingAverage');
    var legacyAverage = qs('daysAverageString');
    var start = qs('start');
    var metadata = qs('metadata');
    var el;

    delete jsjson['yAxis']['min']; // Remove any minimum on yAxis if previously set
    if (logScale == 1) {
        jsjson['yAxis']['type'] = 'logarithmic';
        jsjson['yAxis']['min'] = 0.00001; // So that 0 values don't break the chart
        el = $("#toggleLogScale");
        el.find('span').text(el.data("alternate"));
    }

    if (showDataPoints == 'true') {
        jsjson['plotOptions']['series']['marker']['enabled'] = true;
        el = $("#toggleDataPoints");
        el.find('span').text(el.data("alternate"));
    }

    if (legacyAverage || rollingAverage) {
        el = $("#toggleAverage");
        el.find('span').text(el.data("alternate"));
    }

    var url = host + encodeURIComponent(chartName);
    var lang = $(document.body).data('lang');

    if (!noCors) {
        url += '?cors=true';
    } else {
        url += '?';
    }
    if (timespan != null) {
        url += '&timespan=' + timespan;
    }
    if (rollingAverage != null) {
        url += '&rollingAverage=' + rollingAverage;
    }
    if (start != null) {
        url += '&start=' + start;
    }
    if (legacyAverage) {
        url += '&daysAverageString=' + legacyAverage;
    }
    if (metadata == "false") {
        url += '&metadata=false';
    }
    if (format) {
        url += '&format=' + format;
    }
    if (typeof lang == 'undefined' || lang == '') {
        lang = 'en';
    }

    url += "&lang=" + lang;

    var address = qs('address');
    if (address) {
        url += "&address=" + address;
    }

    return url;
}

function addEventListeners() {
    $("#toggleAverage").click(function() {
        var average = parseInt(qs('daysAverageString')) || 0;

        if (average == 0) {
            updateQueryString("daysAverageString", 7);
        } else {
            updateQueryString("daysAverageString");
        }
    });

    $("#toggleDataPoints").click(function() {
        var dp = qs('showDataPoints');

        if (dp == undefined) {
            updateQueryString("showDataPoints", 'true');
        } else {
            updateQueryString("showDataPoints");
        }
    });
}

function resizeChart() {
  var w = $(window).width();
  var h = $(window).height() - $('.navbar').innerHeight() - $('.footer').innerHeight() - $('#chart_header').innerHeight() - 100;
  if (h < 550) h = 550;

  chart.setSize(w, h, false);
}

function refreshChart() {
    chart = new Highcharts.Chart(jsjson);

    $(".chart-export").each(function() {
        $("*[data-type]", this).each(function() {
            var jThis = $(this);
            var type = jThis.data("type");

            if (Highcharts.exporting.supports(type)) {
                jThis.off('click');
                jThis.click(function() {
                    chart.setTitle({text: $("#chart_title").text()});
                    chart.setTitle(null, {text: "source: blockchain.info"});

                    chart.exportChartLocal({
                        type: type,
                        filename: Highcharts.exporting.USE_TITLE_FOR_FILENAME,
                        scale: 1
                    });
                });
            } else {
                jThis.attr("disabled", "disabled");
            }
        });
    });

    resizeChart();
    $(window).resize(resizeChart);
}

function setup(data) {
    try {
        var container = $('#graph_container');
        var name = container.data('name');
        var unit = container.data('unit');

        jsjson['series'][0]['data'] = data;
        jsjson['yAxis']['title']['text'] = unit;
        jsjson['series'][0]['name'] = unit;

        $("#charterror").hide();
        $("#chartloading").hide();
        $("#chart_header").show();

        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        // Remove print button
        Highcharts.getOptions().exporting.buttons.contextButton.menuItems.shift();
        // Remove separator
        Highcharts.getOptions().exporting.buttons.contextButton.menuItems.shift();
        refreshChart();
    } catch(e) {
        console.log(e);
        $("#chartloading").hide();
        $("#charterror").show();
    }
}
