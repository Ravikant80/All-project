@extends('layouts.fontEnd')
@section('content')

    <!--header section start-->
    <section style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $page_title}}</h1>
                </div>
            </div>
        </div>
    </section><!--Header section end-->

    <!--about us page content start-->
    <section class="section-padding about-us-page">
        <div class="container">
            <div class="row match-height">
                <div class="col-xl-12 col-12">
                    <div class="card card-transparent">
                        <div class="card-header card-header-transparent py-20">
                            {{-- <div class="btn-group dropdown">
                                <h6>Bitcoin Price Chart</h6>
                            </div> --}}
                        </div>
                        <div id="container" style="min-width: 100%; height: 400px; margin: 0 auto; float:left;"></div>
                    </div>
                </div>   
                <div class="col-xl-2 col-12">
                	
                </div>             
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/assets/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/dashboard/assets/js/exporting.js') }}"></script>
<script src="{{ asset('assets/dashboard/assets/js/export-data.js') }}"></script>
    <script type="text/javascript">

        $.getJSON(
            'https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/usdeur.json',
            function (data) {
                var detailChart;
                //alert(data);
                // create the detail chart
                function createDetail(masterChart) {
        
                    // prepare the detail chart
                    var detailData = [],
                        detailStart = data[0][0];
        
                    $.each(masterChart.series[0].data, function () {
                        if (this.x >= detailStart) {
                            detailData.push(this.y);
                        }
                    });
        
                    // create a detail chart referenced by a global variable
                    detailChart = Highcharts.chart('detail-container', {
                        chart: {
                            marginBottom: 120,
                            reflow: false,
                            marginLeft: 0,
                            marginRight: 20,
                            style: {
                                position: 'absolute'
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        title: {
                            text: 'Transaction Rate'
                        },
                        subtitle: {
                            text: 'Transactions Per Second'
                        },
                        xAxis: {
                            type: 'minute'
                        },
                        yAxis: {
                            title: {
                                text: null
                            },
                            maxZoom: 0.1
                        },
                        tooltip: {
                            /*formatter: function () {
                                var point = this.points[0];
                                return '<b>' + point.series.name + '</b><br/>' + Highcharts.dateFormat('%A %B %e %Y', this.x) + ':<br/>' +
                                    '1 USD = ' + Highcharts.numberFormat(point.y, 2) + ' EUR';
                            },*/
                            shared: true
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false,
                                    states: {
                                        hover: {
                                            enabled: true,
                                            radius: 3
                                        }
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'USD to BTC',
                            pointStart: detailStart,
                            pointInterval: 24 * 3600 * 1000,
                            data: detailData
                        }],
        
                        exporting: {
                            enabled: false
                        }
        
                    }); // return chart
                }
        
                // create the master chart
                function createMaster() {
                    Highcharts.chart('master-container', {
                        chart: {
                            reflow: false,
                            borderWidth: 0,
                            backgroundColor: null,
                            marginLeft: 0,
                            marginRight: 20,
                            zoomType: 'x',
                            events: {
        
                                // listen to the selection event on the master chart to update the
                                // extremes of the detail chart
                                selection: function (event) {
                                    var extremesObject = event.xAxis[0],
                                        min = extremesObject.min,
                                        max = extremesObject.max,
                                        detailData = [],
                                        xAxis = this.xAxis[0];
        
                                    // reverse engineer the last part of the data
                                    $.each(this.series[0].data, function () {
                                        if (this.x > min && this.x < max) {
                                            detailData.push([this.x, this.y]);
                                        }
                                    });
        
                                    // move the plot bands to reflect the new detail span
                                    xAxis.removePlotBand('mask-before');
                                    xAxis.addPlotBand({
                                        id: 'mask-before',
                                        from: data[0][0],
                                        to: min,
                                        color: 'rgba(0, 0, 0, 0.2)'
                                    });
        
                                    xAxis.removePlotBand('mask-after');
                                    xAxis.addPlotBand({
                                        id: 'mask-after',
                                        from: max,
                                        to: data[data.length - 1][0],
                                        color: 'rgba(0, 0, 0, 0.2)'
                                    });
        
        
                                    detailChart.series[0].setData(detailData);
        
                                    return false;
                                }
                            }
                        },
                        title: {
                            text: null
                        },
                        xAxis: {
                            type: 'datetime',
                            showLastTickLabel: true,
                            maxZoom: 14 * 24 * 3600000, // fourteen days
                            plotBands: [{
                                id: 'mask-before',
                                from: data[0][0],
                                to: data[data.length - 1][0],
                                color: 'rgba(0, 0, 0, 0.2)'
                            }],
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            gridLineWidth: 0,
                            labels: {
                                enabled: false
                            },
                            title: {
                                text: null
                            },
                            min: 0.6,
                            showFirstLabel: false
                        },
                        tooltip: {
                            formatter: function () {
                                return false;
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        credits: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                fillColor: {
                                    linearGradient: [0, 0, 0, 70],
                                    stops: [
                                        [0, Highcharts.getOptions().colors[0]],
                                        [1, 'rgba(255,255,255,0)']
                                    ]
                                },
                                lineWidth: 1,
                                marker: {
                                    enabled: false
                                },
                                shadow: false,
                                states: {
                                    hover: {
                                        lineWidth: 1
                                    }
                                },
                                enableMouseTracking: false
                            }
                        },
        
                        series: [{
                            type: 'area',
                            name: 'USD to BTC',
                            pointInterval: 24 * 3600 * 1000,
                            pointStart: data[0][0],
                            data: data
                        }],
        
                        exporting: {
                            enabled: false
                        }
        
                    }, function (masterChart) {
                        createDetail(masterChart);
                    }); // return chart instance
                }
        
                // make the container smaller and add a second container for the master chart
                var $container = $('#container')
                    .css('position', 'relative');
        
                $('<div id="detail-container">')
                    .appendTo($container);
        
                $('<div id="master-container">')
                    .css({
                        position: 'absolute',
                        top: 300,
                        height: 100,
                        width: '100%'
                    })
                        .appendTo($container);
        
                // create master and in its callback, create the detail chart
                createMaster();
            }
        );
        
                </script>
@endsection