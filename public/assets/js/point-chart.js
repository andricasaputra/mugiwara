 function getDataPoint(url, token, date, type = null){

  $.ajax({
    url : url,
    method : 'POST',
    headers : {
      'X-CSRF-TOKEN' : token
    },
    data: {
      date : date
    },
    success : function(res) {

      let data_point_in = [];
      let tanggal_point_in = [];

      let data_point_out = [];
      let tanggal_point_out = [];

      res.point_in.map(t => {

          type == 'month' ? tanggal_point_in.push(monthName(t.tanggal)) : tanggal_point_in.push(t.tanggal);

          data_point_in.push(t.data);
          
      });

      res.point_out.map(t => {

          type == 'month' ? tanggal_point_out.push(monthName(t.tanggal)) : tanggal_point_out.push(t.tanggal);

          data_point_out.push(t.data);
          
      });

      pointChart(pointCanvas, data_point_in, data_point_out, tanggal_point_in);

    },
    error : function(err){
      console.log(err)
    }
  });
}

function pointChart(ctx, data_point_in, data_point_out, tanggal){

  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: tanggal,
        datasets: [
          {
            label: 'Poin Masuk',
            data: data_point_in,
            backgroundColor: '#98BDFF'
          },
          {
            label: 'Point Keluar',
            data: data_point_out,
            backgroundColor: '#4B49AC'
          }
        ]
      },
      options: {
      cornerRadius: 5,
      responsive: true,
      maintainAspectRatio: true,
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 20,
          bottom: 0
        }
      },
      scales: {
        yAxes: [{
          display: true,
          gridLines: {
            display: true,
            drawBorder: false,
            color: "#F2F2F2"
          },
          ticks: {
            display: true,
            min: 0,
            max: Math.max.apply(null, data_point_in),
            callback: function(value, index, values) {
              return  value;
            },
            autoSkip: true,
            maxTicksLimit: 1,
            fontColor:"#6C7383"
          }
        }],
        xAxes: [{
          stacked: false,
          ticks: {
            beginAtZero: true,
            fontColor: "#6C7383"
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
            display: false
          },
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      }
    },
  });

}