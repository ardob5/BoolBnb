$(document).ready(function(){

  var idApartment = $('#id_apt').val();
  // console.log(idApartment);

  // STATS CHART
  var ctx = $('#views');

    $.ajax({
      url: 'http://localhost:8000/api/stats_apt',
      method: 'GET',
      data: {
        id: idApartment
      },
      success: function(views){
        var myChart = new Chart (ctx, {
          type: 'line',
          data: {
            labels: moment.months(),
            datasets: [{
              label: 'Visualizzazioni Appartamento',
              data: views,
              borderColor: [
                'rgba(225, 60, 60)'
              ],
              borderWidth: 2
            }]
          },
          options: {
            scales: {
                yAxes: [{
                    ticks: {
                        max: 100,
                        beginAtZero: true
                    }
                }]
            },
            animation: {
              duration: 1500,
              easing: 'easeInBounce'
            },
            legend: {
              align: 'center'
            }
          }
        })
      }
    })

    // MESSAGES CHART
    var cxt = $('#messages');

      $.ajax({
        url: 'http://localhost:8000/api/messages_apt',
        method: 'GET',
        data: {
          id: idApartment
        },
        success: function(messages){
          var myChart = new Chart (cxt, {
            type: 'line',
            data: {
              labels: moment.months(),
              datasets: [{
                label: 'Messaggi Ricevuti',
                data: messages,
                borderColor: [
                  'rgba(225, 60, 60)'
                ],
                borderWidth: 2
              }]
            },
            options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          max: 100,
                          beginAtZero: true
                      }
                  }]
              },
              animation: {
                duration: 1500,
                easing: 'easeInBounce'
              },
              legend: {
                align: 'center'
              }
            }
          })
        }
      })



});
