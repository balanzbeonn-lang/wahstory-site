    // -----------------------------------------------------------------------  
    // Graph 2 (Country Based)   // 
   //----------------------------------------------------------------------- 
  var AgeRangeofFriends = {
          series: [375, 1000, 700, 425],
          chart: {
          type: 'pie',
          height: 210,
          
        },
        labels: ["13-17", "18-30", "31-50", "50+"],
        theme: {
          monochrome: {
            enabled: true
          }
        },
        stroke: {
        width: 0,
    },
        plotOptions: {
          pie: {
            dataLabels: {
              offset: -5
            }
          }
        },
        
        title: {
        //   text: "Country Based"
        },
        dataLabels: {
            enabled: true,
          formatter(val, opts) {
            const name = opts.w.globals.labels[opts.seriesIndex]
            return [name, val.toFixed(1) + '%']
          }
        },
        legend: {
          show: false
        },
        colors: ['#FF5733', '#33FF33', '#3366FF', '#FFFF00'],
        
        };

        var chart = new ApexCharts(document.querySelector(".AgeRangeofFriends"), AgeRangeofFriends);
        chart.render();
    
   
    // -----------------------------------------------------------------------
    // Graph 2 (Baar)
    // -----------------------------------------------------------------------
      var genderdiversity = {
        series: [1200, 1000, 300],
        labels: ["Males", "Females", "Others"],
        chart: {
          type: "donut",
          height: 210,
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          width: 0,
        },
        plotOptions: {
          pie: {
            expandOnClick: true,
            donut: {
              size: "67",
              labels: {
                show: true,
                name: {
                  show: true,
                  offsetY: 8,
                },
                value: {
                  show: false,
                },
                total: {
                  show: true,
                  color: "#a1aab2",
                  label: "2500+",
                },
              },
            },
          },
        },
        dataLabels: {
            enabled: true,
        },
        colors: ["#0075ff", "#239dff", "#77c3fe"],
        tooltip: {
          show: true,
          fillSeriesColor: false,
        },
        legend: {
          show: false,
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 200,
                
              },
            },
          },
        ],
      };
    
      var chart_pie_donut = new ApexCharts(
        document.querySelector(".genderdiversity"),
        genderdiversity
      );
      chart_pie_donut.render();
      
   
  