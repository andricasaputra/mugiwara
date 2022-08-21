function financeChart(ctx, data, tanggal){

  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: tanggal,
        datasets: [{
            label: 'Jumlah Pembayaran',
            data: data,
            backgroundColor: '#9E733E',
      }]
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
            max: Math.max.apply(null, data),
            callback: function(value, index, values) {
              return 'Rp ' +  value;
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
function getDataFinance(url, token, date, type = null){

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

      let data = [];
       let tanggal = [];

      res.map(t => {

          type == 'month' ? tanggal.push(monthName(t.tanggal)) : tanggal.push(t.tanggal);

          data.push(t.data);
          
      });

      financeChart(financeCanvas, data, tanggal);

    },
    error : function(err){
      console.log(err)
    }
  });
}
