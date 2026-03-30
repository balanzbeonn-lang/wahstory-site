    // -----------------------------------------------------------------------
  // Graph 2 (Baar)
  // -----------------------------------------------------------------------
  var genderbased = {
    series: [43, 57],
    labels: ["Male", "Female"],
    chart: {
      type: "donut",
      height: 260,
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
              fontSize: "13px",
              color: "#a1aab2",
              label: "Gender Specific",
            },
          },
        },
      },
    },
    colors: ["#77c3fe", "#239dff"],
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
    document.querySelector(".piedonut"),
    genderbased
  );
  chart_pie_donut.render();
  
  
  // -----------------------------------------------------------------------  
    // Graph 2 (Country Based)   // 
    //----------------------------------------------------------------------- 
  var countrybased = {
          series: [55, 17, 13, 15],
          chart: {
        //   width: '100%',
          type: 'pie',
          height: 360,
        },
        labels: ["India", "USA", "UK", "UAE"],
        theme: {
          monochrome: {
            enabled: true
          }
        },
        stroke: {
        width: 0,
    //   color: ["#333"],
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
          formatter(val, opts) {
            const name = opts.w.globals.labels[opts.seriesIndex]
            return [name, val.toFixed(1) + '%']
          }
        },
        legend: {
          show: false
        }
        };

        var chart = new ApexCharts(document.querySelector(".countrybased"), countrybased);
        chart.render();
    
   // -----------------------------------------------------------------------  
    // Graph 2 (Country Based)   // 
   //----------------------------------------------------------------------- 
  var worldwidelikesofstory = {
          series: [55, 17, 13, 15],
          chart: {
        //   width: '100%',
          type: 'pie',
          height: 210,
          
        },
        labels: ["India", "USA", "UK", "UAE"],
        theme: {
          monochrome: {
            enabled: true
          }
        },
        stroke: {
        width: 0,
    //   color: ["#333"],
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

        var chart = new ApexCharts(document.querySelector(".worldwidelikesofstory"), worldwidelikesofstory);
        chart.render();
    
   
   
    // -----------------------------------------------------------------------  
    // Graph 1 (Invested Timing)   // 
    //----------------------------------------------------------------------- 
    var Top10StoryinViews = {
    series: [
      {
        name: "Views",
        data: [16050, 15567, 14340, 13567, 13376, 12505, 12098, 11890, 11090, 10345],
      },
    ],
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      type: "bar",
      height: 280,
      stacked: true,
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: true,
      },
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
    },
    colors: ["#4fc3f7", "#f62d51"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          legend: {
            position: "bottom",
            offsetX: -10,
            offsetY: 0,
          },
        },
      },
    ],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
      },
    },
    dataLabels: {
      enabled: false,
      style: {
          colors: [
            "#000",
        ],
      },
    },
    grid: {
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: true,
      },
      axisTicks: {
        show: true,
      },
      categories: [
        "Luke Coutinho",
        "Dr. Oleg",
        "Sanjiv Patel",
        "Dr. Ankita",
        "Nupur Gadkari",
        "Sangeetha",
        "Debasree",
        "Melissa Worrel",
        "Vamini Sethi",
        "Shilpa Kulshrestha",
      ],
      labels: {
        style: {
          colors: [
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
          ],
        },
      },
    },
    yaxis: {
      labels: {
        style: {
            //Left top Lebels Color
          colors: ["#a1aab2"],
        },
      },
      axisBorder: {
        show: true,
      },
      axisTicks: {
        show: true,
        stepValue: 1,
      },
    },
    tooltip: {
      theme: "dark",
    },
    legend: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    
  };

  var chart_column_stacked = new ApexCharts(
    document.querySelector(".Top10StoryinViews"),
    Top10StoryinViews
  );
  chart_column_stacked.render();
  
  
  
  
  
    // -----------------------------------------------------------------------  
    // Graph 3 (Invested Timing)   // 
    //----------------------------------------------------------------------- 
  
  
  var options = {
          series: [{
          name: 'Website Blog',
          type: 'column',
          data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
        }, {
          name: 'Social Media',
          type: 'line',
          data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
        }],
          chart: {
          height: 350,
          type: 'line',
        },
        stroke: {
          width: [0, 4]
        },
         
        dataLabels: {
          enabled: true,
          enabledOnSeries: [1]
        },
        labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
        xaxis: {
          type: 'datetime'
        },
        yaxis: [{
           
        
        }, {
          opposite: false,
          title: {
            text: 'Social Media'
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector(".growthtrendline"), options);
        chart.render();
  
    // -----------------------------------------------------------------------  
    // Graph 3 (Invested Timing)   // 
    //----------------------------------------------------------------------- 
    var options = {
          series: [{
          name: 'Views',
          data: [5890, 5970, 6120, 6251, 6420, 6525, 6650]
        }],
          chart: {
          height: 200,
          type: 'line'
        },
        dataLabels: {
          enabled: false
        },
        toolbar: {
          enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3,
            colors: ['#35c0ff', '#00FFF6'], // Gradient Sky Blue Light Line
            gradient: {
              shade: 'light',
              type: 'horizontal',
              shadeIntensity: 0.5,
              inverseColors: true,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 100],
            },
          },
        xaxis: {
          type: 'text',
          categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
          labels: {
        style: {
            //Left top Lebels Color
          colors: [
              "#a1aab2", 
              "#a1aab2", 
              "#a1aab2", 
              "#a1aab2", 
              "#a1aab2", 
              "#a1aab2", 
              "#a1aab2", 
            ],
        },
      },
        },
    yaxis: {
      labels: {
        style: {
            //Left top Lebels Color
          colors: ["#a1aab2"],
          colors: ["#a1aab2"],
          colors: ["#a1aab2"],
          colors: ["#a1aab2"],
          colors: ["#a1aab2"],
          colors: ["#a1aab2"],
          colors: ["#a1aab2"],
        },
      },
      axisBorder: {
        show: true,
      },
      axisTicks: {
        show: true,
        stepValue: 1,
      },
    },
    tooltip: {
      theme: "dark",
    },
    };

    var chart = new ApexCharts(document.querySelector(".trendingviesofstory"), options);
    chart.render();
    
    // -----------------------------------------------------------------------  
    // Graph 10-A (Invested Timing)   // 
    //----------------------------------------------------------------------- 
    var baarchart2 = {
    series: [
      {
        name: "Views",
        data: [20, 15, 30, 18],
      },
      
      
    ],
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      type: "bar",
      height: 190,
      stacked: false,
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: true,
      },
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
    },
    colors: ["#0075ff", "#f62d51"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          legend: {
            position: "bottom",
            offsetX: -10,
            offsetY: 0,
          },
        },
      },
    ],
    plotOptions: {
      bar: {
        horizontal: true,
        columnWidth: "70%",
      },
    },
    dataLabels: {
        //   position: 'top',
            textAnchor: 'start',
		  formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val / 33 * 100) + '%' + ")";
			},
			 
        },
    grid: {
      show: false,
    },
    xaxis: {
      categories: ['Content creation', 'Consistency', 'Audience engagement', 'Time management'],
		  labels: {
			show: false,
		  },
		  axisTicks: {
			show: false,
		  },
    },
    yaxis: {
      labels: {
        style: {
            //Left top Lebels Color
          colors: ["#a1aab2"],
        },
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
        stepValue: 1,
      },
    },
    tooltip: {
      theme: "dark",
    },
    legend: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    
  };

  var chart_column_stacked = new ApexCharts(
    document.querySelector(".baarchart2"),
    baarchart2
  );
  chart_column_stacked.render();
  
  /* Challenges Chart ###################################### */
  /* Challenges Chart  ######################################  */
  
   var ChallengesChart = {
    series: [
      {
        name: "Users",
        data: [10, 18, 12, 17],	
      },
    ],
     chart: {
          height: 160,
          type: 'bar', 
		  toolbar: {
			show: false,
		  },
        },
        plotOptions: {
          bar: {
            horizontal: true,	 
			isFunnel: false,
            distributed: true,
          }
        },
		scales: {
		  x: {
			stacked: true,
		  },
		  y: {
			stacked: true
		  }
		},
		xaxis: {
			categories: ['Content creation', 'Consistency', 'Audience engagement', 'Time management'],
		  labels: {
			show: false,
		  },
		  axisTicks: {
			show: false,
		  }
        },
		yaxis: {
			labels: {
			show: false,
		  },
        },
		grid: {
			show: false,
		},
		colors: ["#0075ff"],
        dataLabels: {
        //   position: 'top',
            textAnchor: 'start',
		  formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val / 33 * 100) + '%' + ")";
			},
			style: {
			    fontSize: '11px',
			    fontWeight: '400',
			},
        },
        legend: {
          show: false,
		  labels: {
			colors: '#ffffff',				
			},
        },
		tooltip: {
		    enabled: false, 
        },
    
  };

  var chart_column_stacked = new ApexCharts(
    document.querySelector(".ChallengesChart"),
    ChallengesChart
  );
  chart_column_stacked.render();
  
  
  
  // -----------------------------------------------------------------------  
    // Graph 10-A (Invested Timing)   // 
    //----------------------------------------------------------------------- 
    var topvoters = {
    series: [
      {
        name: "Votes",
        data: [190, 175, 170, 168, 159, 153, 145, 138, 130, 129],
      },
      
    ],
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      type: "bar",
      height: 400,
      stacked: true,
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: true,
      },
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
    },
    colors: ["#4fc3f7", "#f62d51"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          legend: {
            position: "bottom",
            offsetX: -10,
            offsetY: 0,
          },
        },
      },
    ],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
      },
    },
    dataLabels: {
      enabled: true,
      style: {
          colors: [
            "#000",
        ],
      },
    },
    grid: {
      show: false,
    },
    xaxis: {
      axisBorder: {
        show: true,
      },
      axisTicks: {
        show: false,
      },
      categories: [
        "Rajpal",
        "Simerjeet",
        "Hitesh R",
        "Yash Birla",
        "Sumit",
        "Netta",
        "Sweta",
        "Ayesha",
        "Cindy",
        "Himanshu",
      ],
      labels: {
        style: {
          colors: [
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
            "#fff",
          ],
        },
      },
    },
    yaxis: {
      labels: {
        style: {
            //Left top Lebels Color
          colors: ["#a1aab2"],
        },
      },
      axisBorder: {
        show: true,
      },
      axisTicks: {
        show: true,
        stepValue: 1,
      },
    }, 
    legend: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
       
    },
    
  };

  var chart_column_stacked = new ApexCharts(
    document.querySelector(".topvoters"),
    topvoters
  );
  chart_column_stacked.render();
  
  
   // -----------------------------------------------------------------------
  // Graph 1 (Area)
  // -----------------------------------------------------------------------
 
  var option_visits = {
    series: [
      {
        name: "",
        data: [6, 4, 5, 5, 6, 7, 3, 6, 5, 4, 5, 6],
      },
    ],
    chart: {
      type: "bar",
      height: 90,
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true,
      },
    },
    colors: ["#4dd0e1"],
    grid: {
      show: false,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        startingShape: "flat",
        endingShape: "flat",
        columnWidth: "40%",
        barHeight: "100%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    xaxis: {
		type: "text",
      categories: [
        "Inclusive Leadership",
        "Pragmatic Approach",
        "Employee Oriented",
        "Performance Teams",
        "Cognitive Agility",
        "Navigating Changes",
        "Networking Skill",
        "Trustworthy",
        "Negotiation Skills",
        "Innovative thinking",
        "Accountability",
        "Diversity & Inclusion",
      ],
      labels: {
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
    },
    axisBorder: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
      style: {
        fontFamily: '"Nunito Sans", sans- serif',
      },
      x: {
        show: true,
      },
      y: {
        formatter: undefined,
      },
    },
  };

  var chart_column_visit = new ApexCharts(
    document.querySelector(".baarchart"),
    option_visits
  );
  chart_column_visit.render();



  var countrychart = {
          series: [14, 23, 21, 17, 15, 10, 12, 17, 21],
          chart: {
          type: 'polarArea',
        },
        stroke: {
          colors: ['#fff']
        },
        fill: {
          opacity: 0.8
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector(".countrychart"), countrychart);
        chart.render();
        
        
// Ring Chart

var ringchart = {
    series: [82, 18],
    labels: ["Others", "You"],
    chart: {
      type: "donut",
      height: 210,
    },
    dataLabels: {
      enabled: false,
    //   formatter(val, opts) {
    //         const name = opts.w.globals.labels[opts.seriesIndex]
    //         return [name]
    //       }
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
              fontSize: "33px",
              fontWeight: "700",
              color: "#fff",
              label: "10%",
            },
          },
        },
      },
    },
    colors: ["#0075ff", "#e9204f"],
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
    document.querySelector(".ringchart"),
    ringchart
  );
  chart_pie_donut.render();
  
  
  // -----------------------------------------------------------------------
  // Graph 1 (Area)
  // -----------------------------------------------------------------------
  var DailyReachAreaChart = {
    series: [
      {
        name: "Global",
        data: [5, 3, 4, 5],
      },
    ],
    chart: {
      fontFamily: "Nunito Sans,sans-serif",
      height: 82,
      type: "area",
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true,
      },
    },
    grid: {
      borderColor: "rgba(0,0,0,0.3)",
    },
    colors: ["#2961ff", "#4fc3f7"],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
      width: 1,
    },
    fill: {
      type: "solid",
      opacity: 0.4,
    },
    markers: {
      size: 3,
      colors: ["#2961ff", "#4fc3f7"],
      strokeColors: "transparent",
    },
    xaxis: {
      type: "text",
      categories: [
        "Inclusive Leadership",
        "Pragmatic Approach",
        "Employee Oriented",
        "Performance Teams",
      ],
      labels: {
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
    },
    yaxis: {
      labels: {
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
    },
    tooltip: {
      x: {
        format: "text",
      },
      theme: "dark",
    },
    legend: {
      labels: {
        colors: ["#a1aab2"],
      },
    },
  };

  var chart_area_spline = new ApexCharts(
    document.querySelector(".DailyReachAreaChart"),
    DailyReachAreaChart
  );
  chart_area_spline.render();

  