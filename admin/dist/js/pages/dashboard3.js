$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  $.ajax({
    url: "views/ajax/sale_chart_fetch.php",
    type: "GET",
    dataType: 'JSON',
    success: function (response) {
      var months = ['Janeuary', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var month = [], amount = [];
      console.log(response);      

      response.forEach(element => {
        var d = new Date(element.themonth);
        var monthIndex = d.getMonth();
        month.push(months[monthIndex]);
        amount.push(isNull(element.amount));
      });

      var $salesChart = $('#sales-chart')
      var salesChart  = new Chart($salesChart, {
        type   : 'bar',
        data   : {
          labels  : month,
          datasets: [
            {
              label          : 'Amount',
              backgroundColor: 'rgba(54, 162, 235, 0.6)',
              borderColor    : 'rgba(54, 162, 235, 1)',
              borderWidth    : 1,
              data           : amount
            },
            // {
            //   label          : 'Amount',
            //   backgroundColor: 'rgba(255, 206, 86, 0.6)',
            //   borderColor    : 'rgba(255, 206, 86, 1)',
            //   borderWidth    : 1,
            //   data           : [7000, 17000, 27000, 20000, 18000, 150000, 20000]
            // },
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips           : {
            mode     : mode,
            intersect: intersect
          },
          hover              : {
            mode     : mode,
            intersect: intersect
          },
          legend             : {
            display  : false,
          },
          scales             : {
            yAxes: [{
              display: true,
              gridLines: {
                // display      : true,
                lineWidth    : '4px',
                color        : 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks    : $.extend({
                beginAtZero: true,
                stepSize: 50000,
    
                // Include a dollar sign in the ticks
                callback: function (value, index, values) {
                  if (value >= 1000) {
                    value /= 1000
                    value += 'k'
                  }
                  return 'Rp ' + value
                }
              }, ticksStyle)
            }],
            xAxes: [{
              display  : true,
              gridLines: {
                // display: true
              },
              ticks    : ticksStyle
            }]
          }
        }
      })
    }
  });


  $.ajax({
    url: "views/ajax/order_chart_fetch.php",
    type: "GET",
    dataType: 'JSON',
    success: function (response) {
      var date = [];
      var orders = [];
      response.forEach(element => {
        date.push(element.thedate);
        orders.push(element.orders);
      });
      // console.log(date);
      // console.log(orders);

      var $visitorsChart = $('#visitors-chart')
      var visitorsChart  = new Chart($visitorsChart, {
        type: 'line',
        data   : {
          labels  : date,
          datasets: [{
            label               : 'This week',
            data                : orders,
            backgroundColor     : 'transparent',
            borderColor         : '#007bff',
            pointBorderColor    : '#007bff',
            pointBackgroundColor: '#007bff',
            fill                : true,
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
          }]
          // {
          //   type                : 'line',
          //   data                : [60, 80, 70, 67, 80, 77, 100],
          //   backgroundColor     : 'tansparent',
          //   borderColor         : '#ced4da',
          //   pointBorderColor    : '#ced4da',
          //   pointBackgroundColor: '#ced4da',
          //   fill                : false,
          //   pointHoverBackgroundColor: '#ced4da',
          //   pointHoverBorderColor    : '#ced4da'
          // }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          tooltips           : {
            mode     : mode,
            intersect: intersect
          },
          hover              : {
            mode     : mode,
            intersect: intersect
          },
          legend             : {
            display: false,
          },
          hAxis              : {
            title: 'Date',
          },
          scales             : {
            yAxes: [{
              display: true,
              gridLines: {
                display      : true,
                lineWidth    : '4px',
                color        : 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks    : $.extend({
                padding: 50,
                beginAtZero : true,
                precision: 0,
                // stepSize: 5,
                // suggestedMax: 10,
              }, ticksStyle)
            }],
            xAxes: [{
              display  : true,
              gridLines: {
                display: true
              },
              ticks    : ticksStyle,
              padding  : 20
            }]
          }
        }
      })
    }
  });
})

function isNull(value) {
  return value == null ? 0 : value;
}