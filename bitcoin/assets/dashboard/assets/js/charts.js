// JavaScript Document
$(document).ready(function() {
    var host = $(document.body).data('endpoint') + 'charts/';
    var chartName = window.location.pathname.split('/').pop();
	
    addEventListeners();
    
    function highlightTimespan(timespan) {
      if (!timespan) {
        if ($('#graph_container').data('period') == 'minute') timespan = '60days';
        else timespan = '1year'
      }
      
      $('.' + timespan).removeClass('btn-secondary').addClass('btn-primary')
                             .find('span').removeClass('primary').addClass('white');
    }

    function setData(raw) {
        var data = [];
        try {
            var logScale = parseInt(qs('scale'));
            for (var i = 0; i < raw['values'].length; i++) {
                if (logScale == 1 && raw['values'][i]['y'] < 0.00001) {
                    raw['values'][i]['y'] = 0.00001;
                }

                data.push([
                    raw['values'][i]['x'] * 1000,
                    raw['values'][i]['y']
                ]);
            }

            if ($('#graph_container').data('period') == 'minute') {
                $('#periodminute').show();
            } else {
                $('#periodnormal').show();
            }

            var timespan = qs('timespan');
            highlightTimespan(timespan);

            setup(data);
        } catch (e) {
            fail(e);
        }
    }

    ajaxCall(computeURL(host, chartName, jsjson, 'json'), setData);
});
