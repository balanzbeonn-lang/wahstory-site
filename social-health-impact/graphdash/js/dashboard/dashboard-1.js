

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var screenWidth = $(window).width();
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	
	
	var donutChart1 = function(){
		$("span.donut2").peity("donut", {
			width: "50",
			height: "50"
		})
	}
	var donutChart2 = function(){
		$("span.donut3").peity("donut", {
			width: "80",
			height: "80"
		})
	}
	var reservationChart = function(){
		 var options = {
          series: [{
          name: 'Total Hours',
          data: [4, 4, 6.5, 5, 9, 7.5, 8.5]
        }, {
          name: 'Total Hours',
          data: [3.5, 3.5, 4.2, 3.7, 5, 4, 5.5]
        }],
          chart: {
          height: 250,
          type: 'line',
		  toolbar:{
			  show:false
		  }
        },
		colors:["#53CAFD","#E43BFF"],
        dataLabels: {
          enabled: false
        },
        stroke: {
			width:6,
			curve: 'smooth',
        },
		legend:{
			show:false
		},
		grid:{
			borderColor: 'rgba(255,255,255,0.10)',
			strokeDashArray: 0,
			 xaxis: {
				lines: {
					show: true
				}
			},   
			yaxis: {
				lines: {
					show: true
				}
			}, 
		},
		markers:{
			strokeWidth: 6,
			 hover: {
			  size: 15,
			}
		},
		yaxis: {
		  labels: {
			offsetX:-12,
			style: {
				colors: '#fff',
				fontSize: '13px',
				fontFamily: 'Poppins',
				fontWeight: 400
				
			}
		  },
		},
        xaxis: {
          categories: ["SUN","MON","TUE","WED","THU","FRI","SAT"],
		  labels:{
			  
			  style: {
				colors: '#fff',
				fontSize: '13px',
				fontFamily: 'Poppins',
				fontWeight: 400
				
			},
		  },
			axisBorder: {
				 show: false,
			},
			  axisTicks: {
				 show: true,
				  borderType: 'solid',
				  color: '#78909C',
				  height: 6,
				  width:6,
				  offsetX: 0,
				  offsetY: 0
			  },
        },
		fill:{
			type:"solid",
			/* opacity:0.1 */
		},
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };
		if(jQuery("#reservationChart").length > 0){

			var dzchart = new ApexCharts(document.querySelector("#reservationChart"), options);
			dzchart.render();
            
            jQuery('#dzNewSeries').on('change',function(){
                jQuery(this).toggleClass('disabled');
                dzchart.toggleSeries('Monthly');
            });
            
            jQuery('#dzOldSeries').on('change',function(){
                jQuery(this).toggleClass('disabled');
                dzchart.toggleSeries('Weekly');
            });
            
		}
	}
	var activeUser = function(){
		if(jQuery('#activeUser').length > 0 ){
			var data = {
				labels: ["0", "1", "2", "3", "4", "5", "6", "0", "1", "2", "3", "4", "5", "6"],
				datasets: [{
					label: "My First dataset",
					backgroundColor: "#FFAA2B",
					strokeColor: "rgba(255,255,255,0.3)",
					pointColor: "rgba(0,0,0,0)",
					pointStrokeColor: "rgba(58,223,174,1)",
					pointHighlightFill: "rgba(58,223,174,1)",
					pointHighlightStroke: "rgba(58,223,174,1)",
					borderCapStyle: 'round',
					
					data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40]
				}]
			};

			var ctx = document.getElementById("activeUser").getContext("2d");
			var chart = new Chart(ctx, {
				type: "bar",
				data: data,
				options: {
					responsive: !0,
					maintainAspectRatio: false,
					legend: {
						display: !1
					},
					tooltips: {
						enabled: false
					},
					scales: {
						xAxes: [{
							display: !1,
							gridLines: {
								display: !1
							},
							barPercentage: 1,
							categoryPercentage: 0.5
						}],
						yAxes: [{
							display: !1,
							ticks: {
								padding: 10,
								stepSize: 20,
								max: 100,
								min: 0
							},
							gridLines: {
								display: !0,
								drawBorder: !1,
								lineWidth: 1,
								zeroLineColor: "rgba(255.255,255.0.3)",
							}
						}]
					}
				}
			});
			
			setInterval(function() {
				chart.config.data.datasets[0].data.push(
					Math.floor(10 + Math.random() * 80)
				);
				chart.config.data.datasets[0].data.shift();
				chart.update();
			}, 2000);
			
		}
	}
	
	var engagesocialchartBarRunning = function(){
		
		var options  = {
			series: [
				{
					name: 'Users',
					 data: [80, 60, 30]
				},
				
			],
			chart: {
			type: 'bar',
			height: 200,						
				toolbar: {
					show: false,
				},
			},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '45%',
			borderRadius: 8,
			distributed: true,
			
		  },
		},
		dataLabels: {
		  enabled: false,
		},
		markers: {
			shape: "circle",
		},
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 0,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 15,	
			}
		},
		stroke: {
		  show: true,
		  width: 5,
		  curve: 'stepline',
		  colors: ['transparent'],
		  lineCap: 'butt',
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['Excelent', 'Good', 'Fair'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
			
		  },
		  crosshairs: {
		  show: false,
		  },
		   axisBorder: {
				  show: false,
		   },
		    axisTicks: {
				
				show: false,
			}
		},
		yaxis: {
			labels: {
				offsetX:-16,
			   style: {
				  colors: '#fff',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#607180', '#607180', '#ff5e83'],
		},
		tooltip: {
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:180
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#engagesocialchartBarRunning'),
    options
  );
  chart.render();			
	}
	
	var socialplatformschartBarRunning = function(){
		
		var options  = {
			series: [
				{
					name: 'Score',
					 data: [80, 60, 30]
				}, 
				
			],
			chart: {
			type: 'bar',
			height: 200,						
				toolbar: {
					show: false,
				},
			},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '45%',
			borderRadius: 8,			
			distributed: true,
			
		  },
		},
		dataLabels: {
		  enabled: false,
		},
		markers: {
			shape: "circle",
		},
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 0,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 15,	
			}
		},
		stroke: {
		  show: true,
		  width: 5,
		  curve: 'stepline',
		  colors: ['transparent'],
		  lineCap: 'butt',
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['Excelent', 'Good', 'Fair'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
			
		  },
		  crosshairs: {
		  show: false,
		  },
		   axisBorder: {
				  show: false,
		   },
		    axisTicks: {
				
				show: false,
			}
		},
		yaxis: {
			labels: {
			   style: {
				  colors: '#fff',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#607180', '#ff5e83', '#607180'],
		},
		tooltip: {
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:180
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#socialplatformschartBarRunning'),
    options
  );
  chart.render();			
	}
	
	
	
	var chartBarRunning3 = function(){
		
		var options  = {
			series: [
				{
					name: 'Score',
					 data: [80, 60, 30]
				}, 				
			],
			chart: {
			type: 'bar',
			height: 200,						
				toolbar: {
					show: false,
				},
			},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '45%',
			borderRadius: 8,
			distributed: true,
			
		  },
		},
		colors:['#816CFF'],
		dataLabels: {
		  enabled: false,
		},
		markers: {
			shape: "circle",
		},
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 0,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 15,	
			}
		},
		stroke: {
		  show: true,
		  width: 5,
		  curve: 'stepline',
		  colors: ['transparent'],
		  lineCap: 'butt',
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['Excelent', 'Good', 'Fair'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
			
		  },
		  crosshairs: {
		  show: false,
		  },
		   axisBorder: {
				  show: false,
		   },
		    axisTicks: {
				
				show: false,
			}
		},
		yaxis: {
			labels: {
			   style: {
				  colors: '#fff',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#607180', '#607180', '#ff5e83'],
		},
		tooltip: {
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:180
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#chartBarRunning3'),
    options
  );
  chart.render();			
	}
	
	
	
	var chartBarRunning4 = function(){
		
		var options  = {
			series: [
				{
					name: 'Score',
					 data: [80, 60, 30]
				}, 				
			],
			chart: {
			type: 'bar',
			height: 200,						
				toolbar: {
					show: false,
				},
			},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '45%',
			borderRadius: 8,
			distributed: true,
			
		  },
		},
		colors:['#77248B'],
		dataLabels: {
		  enabled: false,
		},
		markers: {
			shape: "circle",
		},
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 0,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 15,	
			}
		},
		stroke: {
		  show: true,
		  width: 5,
		  curve: 'stepline',
		  colors: ['transparent'],
		  lineCap: 'butt',
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['Excelent', 'Good', 'Fair'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
			
		  },
		  crosshairs: {
		  show: false,
		  },
		   axisBorder: {
				  show: false,
		   },
		    axisTicks: {
				
				show: false,
			}
		},
		yaxis: {
			labels: {
			   style: {
				  colors: '#fff',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#607180', '#607180', '#ff5e83'],
		},
		tooltip: {
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:180
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#chartBarRunning4'),
    options
  );
  chart.render();			
	}
	
	var pieChart1 = function(){
		var options = {
		 series: [90, 68],
		 chart: {
		 type: 'donut',
		 height:150,
	   },
	  dataLabels:{
			enabled: false
		},
		stroke: {
          width: 0,
		},  
	   
	   colors:['#DD3CFF', '#FFE27A', '#53CAFD'],
	   legend: {
			 position: 'bottom',
			 show:false
		   },
	   responsive: [{
			breakpoint: 1490,
			options: {
				chart: {
					width:100,
					height:150
				},
			},
			breakpoint: 1100,
			options: {
				chart: {
					height:150
				},
			}
	   }]
	   };

	   var chart = new ApexCharts(document.querySelector("#pieChart1"), options);
	   chart.render();
   } 
    
   
   

   var NewCustomers = function(){
	var options = {
	  series: [
		{
			name: 'Net Profit',
			data: [300, 80, 800, 300, 900],
			/* radius: 30,	 */
		}, 				
	],
		chart: {
		type: 'line',
		height: 60,
		width: 120,
		toolbar: {
			show: false,
		},
		zoom: {
			enabled: false
		},
		sparkline: {
			enabled: true
		}
		
	},
	
	colors:['var(--primary)'],
	dataLabels: {
	  enabled: false,
	},

	legend: {
		show: false,
	},
	stroke: {
	  show: true,
	  width: 6,
	  curve:'smooth',
	  colors:['var(--primary)'],
	},
	
	grid: {
		show:false,
		borderColor: '#eee',
		padding: {
			top: 0,
			right: 0,
			bottom: 0,
			left: 0

		}
	},
	states: {
			normal: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			hover: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			active: {
				allowMultipleDataPointsSelection: false,
				filter: {
					type: 'none',
					value: 0
				}
			}
		},
	xaxis: {
		categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
		axisBorder: {
			show: false,
		},
		axisTicks: {
			show: false
		},
		labels: {
			show: false,
			style: {
				fontSize: '12px',
			}
		},
		crosshairs: {
			show: false,
			position: 'front',
			stroke: {
				width: 1,
				dashArray: 3
			}
		},
		tooltip: {
			enabled: true,
			formatter: undefined,
			offsetY: 0,
			style: {
				fontSize: '12px',
			}
		}
	},
	yaxis: {
		show: false,
	},
	fill: {
        type: "gradient",
        gradient: {
          shade: "dark",
          type: "horizontal",
          shadeIntensity: 0.5,
          gradientToColors: ["#E43BFF"],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
	tooltip: {
		enabled:false,
		style: {
			fontSize: '12px',
		},
		y: {
			formatter: function(val) {
				return "$" + val + " thousands"
			}
		}
	}
	};

	var chartBar1 = new ApexCharts(document.querySelector("#NewCustomers"), options);
	chartBar1.render(); 
}
	var columnChart = function(){
		
			if(jQuery('#columnChart').length > 0 ){
		
				var optionsTimeline = {
					chart: {
						type: "bar",
						height: 250,
						stacked: true,
						toolbar: {
							show: false
						},
						sparkline: {
							//enabled: true
						},
						backgroundBarRadius: 5,
						offsetX: 0,
					},
					series: [
						 {
							name: "New Clients",
							data: [10, 50, 65, 20, 30,20,30]
						},
						{
							name: "Retained Clients",
							data: [-40, -60, -90, -25, -40,-20,-30]
						} 
					],
					
					plotOptions: {
						bar: {
							columnWidth: "10%",
							endingShape: "rounded",
							 maxHeight: 120,
							colors: {
								backgroundBarColors: ['rgba(255,255,255,0.2)', 'rgba(255,255,255,0.2)', 'rgba(255,255,255,0.2)', 'rgba(255,255,255,0.2)', 'rgba(255,255,255,0.2)'],
								backgroundBarOpacity: 1,
								backgroundBarRadius: 4,
								opacity:0
							},
							

						},
					distributed: true,
					

					},
					colors:['var(--primary)', 'var(--primary)'],
					
					grid: {
						show: false,
					},
					legend: {
						show: false
					},
					fill: {
						opacity: 1
					},
					dataLabels: {
						enabled: false,
						colors:['#2953E8', '#09268A'],
						dropShadow: {
							enabled: true,
							top: 1,
							left: 1,
							blur: 1,
							opacity: 1
						}
					},
					stroke: {
						width: 6,
						
						curve: 'smooth',
						lineCap: 'butt',
						
					},
					xaxis: {
						categories: ['01', '02', '03', '04', '05'],
						labels: {
							show: false,	
							style: {
								colors: '#787878',
								fontSize: '13px',
								fontFamily: 'Poppins',
								fontWeight: 400,
								minHeight: 90,
								
							},
						},
						crosshairs: {
							show: false,
						},
						axisBorder: {
							show: false,
						},
						axisTicks: {
							show: false
						},
					},
					
					yaxis: {
						//show: false
						labels: {
							show: false,
							offsetX:-15,
							style: {
								colors: '#787878',
								fontSize: '13px',
								fontFamily: 'Poppins',
								fontWeight: 400
								
							},
						},
					},
					
					tooltip: {
						x: {
							show: true
						}
					}
				};
				var chartTimelineRender =  new ApexCharts(document.querySelector("#columnChart"), optionsTimeline);
				chartTimelineRender.render();
			}
		}
  
  
  //GenderspieChart################
	var GenderspieChart = function(){
		var options = {
		 series: [90, 68],
		 labels: ["Male", "Female"],
		 chart: {
		 type: 'donut',
		 height:130,
	   },
	  dataLabels:{
			enabled: false
		},
		stroke: {
          width: 0,
		},
		plotOptions: {
			  pie: {
				expandOnClick: true,
				donut: {
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
					  fontSize: "16px",
					  color: "#ff5e83",
					  label: 'Male',
					},
				  },
				},
			  },
			},	   
	   colors:['#ff5e83', '#607180'],
	   legend: {
			 position: 'bottom',
			 show:false
		   },
	   responsive: [{
			breakpoint: 1490,
			options: {
				chart: {
					width:100,
					height:150
				},
			},
			breakpoint: 1100,
			options: {
				chart: {
					height:150
				},
			}
	   }]
	   };

	   var chart = new ApexCharts(document.querySelector("#GenderspieChart"), options);
	   chart.render();
   } 
  
  //AgeGrouppieChart################
   var AgeGrouppieChart = function(){
		var options = {
		 series: [60, 68, 30],
		 labels: ["18 to 29", "30 to 39", "40+"],
		 chart: {
		 type: 'pie',
		 height:250,
	   },
	  dataLabels:{
			enabled: true
		},
		stroke: {
          width: 0,
		},
		plotOptions: {
			  pie: {
				expandOnClick: true,
				donut: {
				  labels: {
					show: true,
					value: {
					  show: false,
					},
					name: {
					  show: false,
					},
				
				  },
				},
			  },
			},	   
	   colors:[
          '#ff5e83',
          '#5b7596',
          '#91a7bf'],
	   legend: {
			show:true,
			position: 'bottom',
		   },
	   responsive: [{
			breakpoint: 1490,
			options: {
				chart: {
					width:100,
					height:150
				},
			},
			breakpoint: 1100,
			options: {
				chart: {
					height:150
				},
			}
	   }]
	   };

	   var chart = new ApexCharts(document.querySelector("#AgeGrouppieChart"), options);
	   chart.render();
	} 
	
  //OccupationChart################
	var OccupationChart = function(){
	var options = {
          series: [
          {
            data: [580, 610, 678, 740, 880, 990],
            name: "",
          },
        ],
          chart: {
          type: 'bar',
          height: 280,
		  position: "center",		  
			offsetY: 20,
		  toolbar: {
			show: false,
		  },
        },
		grid: {
		  show: false,
		},
        plotOptions: {
          bar: {
            borderRadius: 0,
            horizontal: true,
            distributed: true,
            barHeight: '90%',
            isFunnel: true,
			
          },
        },
        colors: [
          '#607180',
          '#607180',
          '#607180',
          '#ff5e83',
          '#607180',
          '#607180',
        ],
        dataLabels: {
          enabled: true,
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ': (' + Math.round(val/3978*100) + '%)' 
          },
          dropShadow: {
            enabled: false,
          },
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
          categories: ['Self Employed', 'Professional', 'Salaried', 'Business', 'Home Maker', 'Others'],
		  axisTicks: {
			show: false,
		  },
		  labels: {
			show: false,
		  },
		  axisBorder: {
			show: false,
		  },
        },
        yaxis: {
		  axisTicks: {
			show: false,
		  },
		  labels: {
			show: false,
		  },
        },
        legend: {
          show: false,
        },
        tooltip: {
          theme: "dark",
        },
		
        };

        var chart = new ApexCharts(document.querySelector("#OccupationChart"), options);
        chart.render();
	}
	
	
	
  //Preferred SocialChart ##################
  var preferredSocialChart = function(){	  
  var options = {
          series: [{
          name: "Users",
          data: [21, 22, 10, 28, 23, 16],
        }],
          chart: {
          height: 260,
          type: 'bar',
		  toolbar: {
				show: false,
			  },
			offsetY: 30,			  
        },
        colors:[		
          '#607180',
          '#ff5e83',
          '#607180',
          '#607180',
          '#607180',
          '#607180',],
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
			barHeight: "100%",
          }
        },
        dataLabels: {
          enabled: true,
		  position: 'top',
		  formatter: function (val) {
				return Math.round(val / 97 * 100) + '%';
			},
          dropShadow: {
            enabled: false,
          },
        },
        legend: {
          show: false
        },
        xaxis: {			
          categories: [
            ['Facebook'],
            ['Instagram'],
            ['LinkedIn'],
            ['Twitter'],
            ['YouTube'],
            ['TikTok'],
          ],
          labels: {
            style: {
              fontSize: '12px'
            }
          }
        },
		tooltip: {
			theme: "dark",
		},
		
        };

        var chart = new ApexCharts(document.querySelector("#preferredSocialChart"), options);
        chart.render();		
	}	
	

	//SocialTimeEffectiveChart################	
   var SocialTimeEffectiveChart = function(){		
		var options  = {
			series: [
				{
					name: 'Users',
					data: [31, 11]
				},				
			],
			chart: {
			type: 'bar',
			height: 130,						
				toolbar: {
					show: false,
				},
			},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '65%',
			borderRadius: 8,
			distributed: true,			
		  },
		},
		dataLabels: {
		  enabled: false,
		},
		markers: {
			shape: "circle",
		},
		legend: {
			show: false,			
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['Yes', 'No'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '8px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},			
		  },
		  crosshairs: {
		  show: false,
		  },
		   axisBorder: {
				  show: false,
		   },
		    axisTicks: {				
				show: false,
			}
		},
		yaxis: {
			labels: {
				show: false,
			   style: {
				  colors: '#fff',
				  fontSize: '10px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#ff5e83', '#607180'],
		},
		tooltip: {
			theme: 'dark',
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:100
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#SocialTimeEffectiveChart'),
    options
  );
  chart.render();			
	}
   
   //Do you follow social media influencers Chart################	
   var DoUFollowsocialinfluencersChart = function(){		
		var options  = {
			series: [
				{
					name: 'Users',
					data: [31, 11]
				},				
			],
			chart: {
			type: 'bar',
			height: 130,						
				toolbar: {
					show: false,
				},
			},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '65%',
			borderRadius: 8,
			distributed: true,			
		  },
		},
		dataLabels: {
		  enabled: false,
		},
		markers: {
			shape: "circle",
		},
		legend: {
			show: false,			
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['Yes', 'No'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '8px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},			
		  },
		  crosshairs: {
		  show: false,
		  },
		   axisBorder: {
				  show: false,
		   },
		    axisTicks: {				
				show: false,
			}
		},
		yaxis: {
			labels: {
				show: false,
			   style: {
				  colors: '#fff',
				  fontSize: '10px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#607180', '#ff5e83'],
		},
		tooltip: {
			theme: 'dark',
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:100
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#DoUFollowsocialinfluencersChart'),
    options
  );
  chart.render();			
	}
	
	//Do you Purchase From social media influencers Chart################	
   var DoUPurchaseFrominfluencersChart = function(){		
		var options  = {
			series: [
				{
					name: 'Users',
					data: [31, 11]
				},				
			],
			chart: {
			type: 'bar',
			height: 130,						
				toolbar: {
					show: false,
				},
			},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '65%',
			borderRadius: 8,
			distributed: true,			
		  },
		},
		dataLabels: {
		  enabled: false,
		},
		markers: {
			shape: "circle",
		},
		legend: {
			show: false,			
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['Yes', 'No'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '8px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},			
		  },
		  crosshairs: {
		  show: false,
		  },
		   axisBorder: {
				  show: false,
		   },
		    axisTicks: {				
				show: false,
			}
		},
		yaxis: {
			labels: {
				show: false,
			   style: {
				  colors: '#fff',
				  fontSize: '10px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#ff5e83', '#607180'],
		},
		tooltip: {
			theme: 'dark',
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:100
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#DoUPurchaseFrominfluencersChart'),
    options
  );
  chart.render();			
	}
	
	//ActivelySocialEngage Chart
	var ActivelySocialEngageChart = function(){
		
		var options  = {
		series: [ 
			{
			  name: 'Users',
			   data: [80, 100, 70]
			}, 				
		],
		chart: {
		type: 'bar',
		height: 150,						
			toolbar: {
				show: false,
			},
		},	
		plotOptions: {
		  bar: {
			horizontal: false,
			endingShape:'rounded',
			columnWidth: '45%',
			borderRadius: 8,
			distributed: true,
			
		  },
		},
		dataLabels: {
		  enabled: true,
		  formatter: function (val) {
            return Math.round(val/250*100) + '%' 
          },
		  
		},
		markers: {
			shape: "triangle",
		},
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#ffffff',				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 0,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 15,	
			}
		},
		stroke: {
		  show: true,
		  width: 60,
		  curve: 'stepline',
		  colors: ['transparent'],
		  lineCap: 'butt',
		},
		grid: {
			borderColor: 'rgba(255,255,255,0.10)',
		},
		xaxis: {
		  categories: ['1-2 Platfs', '3-4 Platfs', '5 Or More'],
		  labels: {
		   style: {
			  colors: '#fff',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
			
		  },
		  crosshairs: {
			show: false,
		  },
		  axisBorder: {	
			show: false,
		  },
			axisTicks: {
				show: false,
			}
		},
		yaxis: {
			labels: {				
				show: false,
			   style: {
				  colors: '#fff',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
		  opacity: 1,
		  colors:['#607180', '#ff5e83', '#607180'],
		},
		tooltip: {
			theme: "dark",
		  y: {
			formatter: function (val) {
			  return val
			}
		  }
		},
		
		responsive: [{
			breakpoint: 1400,
			options: {
				chart:{
					height:185
				},
			},
		 }]	
		};

		var chart = new ApexCharts(
    document.querySelector('#ActivelySocialEngageChart'),
    options
  );
  chart.render();			
	}
	
 //Challanges You Face Chart ############## 
	var ChallangesyoufaceChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [9, 8, 7, 6],		  
        }],
          chart: {
          height: 160,
          type: 'bar',
		  toolbar: {
			show: false,
		  },
        },
        plotOptions: {
          bar: {
            horizontal: false,			
            columnWidth: '35%',
			barHeight: "90%",
			isFunnel: true,
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
        colors:[
          '#607180',
          '#ff5e83',
          '#607180',
          '#ff5e83',],
        dataLabels: {
          formatter: function (val) {
				return Math.round(val/10*100) + "%";
			},
        },
        legend: {
          show: true,
		  labels: {
			colors: '#ffffff',				
			},
        },
		tooltip: {
          theme: "dark",
        },		
        };		

        var chart = new ApexCharts(document.querySelector("#ChallangesyoufaceChart"), options);
        chart.render();
		
	} 
		
	
	//Primary Target Audience  Chart
	var PrimaryTargetAudienceChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [9, 8, 7, 6],		  
        }],
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
            columnWidth: '35%',
			barHeight: "90%",
			isFunnel: true,
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
			categories: ["General public", "Industry pros", "Potential customers", "Friends & family"],
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
        colors:[
          '#607180',
          '#607180',
          '#ff5e83',
          '#607180',
		  ],
        dataLabels: {
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + val + ")";
			},
        },
        legend: {
          show: false,
        },
		tooltip: {
          theme: "dark",
        },		
        };		

        var chart = new ApexCharts(document.querySelector("#PrimaryTargetAudienceChart"), options);
        chart.render();
		
	} //------
	
	//SharingContentType Chart
	var SharingContentTypeChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [9, 8, 7, 6],		  
        }],
          chart: {
          height: 230,
          type: 'bar',
		  toolbar: {
			show: false,
		  },
        },
        plotOptions: {
          bar: {
            horizontal: true,			
            columnWidth: '35%',
			barHeight: "90%",
			isFunnel: true,
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
			categories: ["Images", "Articles", "Videos", "Opinions"],
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
        colors:[
          '#ff5e83',
          '#ff5e83',
          '#ff5e83',
          '#607180',],
        dataLabels: {
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + val + ")";
			},
        },
        legend: {
          show: false,
        },
		tooltip: {
          theme: "dark",
        },
		
		
        };
		

        var chart = new ApexCharts(document.querySelector("#SharingContentTypeChart"), options);
        chart.render();
		
	}
	
	//SocialContentEngagement Chart ##############
	var SocialContentEngagementChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [90, 85, 76, 64, 70, 80],
		  
        }],
          chart: {
          height: 250,
          type: 'bar',
		  toolbar: {
			show: false,
		  },
        },
        plotOptions: {
          bar: {
            horizontal: true,			
            columnWidth: '35%',
			barHeight: "90%",
			isFunnel: true,
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
		colors:[
          '#ff5e83',
          '#ff5e83',
          '#607180',
          '#607180',
          '#607180',
          '#607180',],		
		xaxis: {
			categories: ["News and Current Events", "Entertainment (e.g., memes, videos)", "Updates from Friends & Family", "Inspiration / Motivation", "Educational / Informatives", "Product/Service Recommendations"],
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
		
        dataLabels: {
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val/100*100) + "%)";
			},
        },
        legend: {
          show: false,
		  markers: {
			width: 18,
			height: 18,
			strokeWidth: 0,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 15,	
			}
        },
		
		tooltip: {
          theme: "dark",
        },
        };

        var chart = new ApexCharts(document.querySelector("#SocialContentEngagementChart"), options);
        chart.render();
		
	}
	
	//PrimaryObjectiveSocialEngaging Chart
	var PrimaryObjectiveSocialEngagingChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
          data: [9, 8, 7, 6, 7],
		  
        }],
          chart: {
          height: 230,
          type: 'bar',
		  toolbar: {
			show: false,
		  },
        },
        plotOptions: {
          bar: {
            horizontal: true,			
            columnWidth: '35%',
			barHeight: "90%",
			isFunnel: true,
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
		colors:[
          '#ff5e83',
          '#ff5e83',
          '#607180',
          '#607180',
          '#607180',],		
		xaxis: {
			categories: ["Personal branding", "Networking", "Showcasing products/services", "Thought leadership", "Entertainment"],
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
		
        dataLabels: {
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val/17*100) + "%)";
			},
        },
        legend: {
          show: false,
		  markers: {
			width: 18,
			height: 18,
			strokeWidth: 0,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 15,	
			}
        },
		
		tooltip: {
          theme: "dark",
        },
        };

        var chart = new ApexCharts(document.querySelector("#PrimaryObjectiveSocialEngagingChart"), options);
        chart.render();
		
	}
	
	var SocialMediaGoalsChart = function(){
		
		var options = {
			
			series: [{
          data: [81, 60, 78, 59, 82, 109, 89, 82, 109],
		  
        }],
          chart: {
          height: 330,
          type: 'bar',
		  toolbar: {
			show: false,
		  },
        },
        plotOptions: {
          bar: {
            horizontal: true,			
            columnWidth: '35%',
			barHeight: "90%",
            distributed: true,
          }
        },
		xaxis: {
			categories: ["Building a personal brand", "Social Connections", "Promoting products or services", "Sharing insights", "Providing entertainment", "General public", "Professionals in your industry", "Potential customers", "Friends and family"],
		  labels: {
			show: true,
		  },
        },
		grid: {
			show: false,
		  },
		yaxis: {
			labels: {
			show: false,
		  },
        },
        scales: {
		  x: {
			stacked: true,
		  },
		  y: {
			stacked: true
		  }
		},	
		colors:[
          '#ff5e83',
          '#ff5e83',
          '#ff5e83',
          '#607180',
          '#607180',
          '#607180',
          '#607180',
          '#ff5e83',
          '#607180',],
        dataLabels: {
			textAnchor: 'middle',
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " : (" + Math.round(val/100*100) + '%)';
			},
        },
        legend: {
          show: false,
        },
		tooltip: {
          theme: "dark",
        },
        };

        var chart = new ApexCharts(document.querySelector("#SocialMediaGoalsChart"), options);
        chart.render();
		
	}	
	
	//ImpactSocialEngagement Chart################
	var ImpactSocialEngagementChart = function(){
		var options = {
		 series: [90, 68, 80, 58],
		 labels: ["Minimal", "Moderate", "Strong", "Very strong"],
		 chart: {
		 type: 'donut',
		 height:230,
	   },
	  dataLabels:{
			enabled: true
		},
		stroke: {
          width: 0,
		},
		plotOptions: {
			  pie: {
				expandOnClick: true,
				donut: {
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
					  fontSize: "20px",
					  color: "#53cafd",
					  label: 296,
					},
				  },
				},
			  },
			},	   
	   colors:['#53cafd', '#e43bff', '#53cafd', '#e43bff'],
	   legend: {
			 position: 'bottom',
			 show:true,
			 labels: {
				colors: '#ffffff',
				},
		   },
	   responsive: [{
			breakpoint: 1490,
			options: {
				chart: {
					width:100,
					height:150
				},
			},
			breakpoint: 1100,
			options: {
				chart: {
					height:150
				},
			}
	   }]
	   };

	   var chart = new ApexCharts(document.querySelector("#ImpactSocialEngagementChart"), options);
	   chart.render();
   }
	
	//TimeSpentonSocial  Chart################
	var TimeSpentonSocialChart = function(){
		var options = {
		 series: [90, 68, 80, 58],
		 labels: ["30mins or less", "30mins - 1hr", "1hr - 2hrs", "2hrs or more"],
		 chart: {
		 type: 'pie',
		 height:250,
	   },
	  dataLabels:{
			enabled: true
		},
		stroke: {
          width: 0,
		},
		plotOptions: {
			  pie: {
				expandOnClick: true,
				donut: {
				  labels: {
					show: false,
				  },
				},
			  },
			},	   
	   colors:['#53cafd', '#e43bff', '#0ff5bf', '#ffe27a'],
	   legend: {
			 position: 'bottom',
			 show:true,
			 labels: {
				colors: '#ffffff',
				},
		   },
	   responsive: [{
			breakpoint: 1490,
			options: {
				chart: {
					width:100,
					height:250
				},
			},
			breakpoint: 1100,
			options: {
				chart: {
					height:150
				},
			}
	   }]
	   };

	   var chart = new ApexCharts(document.querySelector("#TimeSpentonSocialChart"), options);
	   chart.render();
   }
	
	
	 var handlePietyDonut = function(){
		if(jQuery('span.donut').length > 0 ){
			$("span.donut").peity("donut", {
				width: "100",
				height: "100"
			});
		}
	}
	
	
	
	  // -----------------------------------------------------------------------
  // Graph 1 (Area)
  // -----------------------------------------------------------------------
  var overview_campaign = function(){ 
  var options = {
          series: [{
          name: 'Facebook',
          data: [31, 40, 28, 51, 42, 109]
        }, {
          name: 'Instagram',
          data: [11, 32, 45, 32, 34, 52]
        }, {
          name: 'Twitter',
          data: [17, 36, 48, 38, 30, 59]
        }, {
          name: 'LinkedIn',
          data: [32, 11, 65, 37, 39, 59]
        }, {
          name: 'TikTok',
          data: [61, 30, 40, 39, 35, 50]
        }],
          chart: {
          height: 300,
          type: 'area',
		  toolbar: {
			show: false,
		  },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
			categories: ["Facebook", "Instagram", "LinkedIn", "Twitter", "YouTube", "TikTok"],
		  labels: {
			show: true,
		  },
        },
		legend: {
          show: false,
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector(".overview-campaign"), options);
        chart.render();
  }
	
	
	
	
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				donutChart1();
				reservationChart();
				engagesocialchartBarRunning();
				socialplatformschartBarRunning();
				chartBarRunning3();
				chartBarRunning4();
				NewCustomers();
				pieChart1();
				columnChart();
				donutChart2();
				activeUser();
				
				GenderspieChart();
				AgeGrouppieChart();
				OccupationChart();				
				handlePietyDonut();
				overview_campaign();						
				preferredSocialChart();
				SocialTimeEffectiveChart();
				DoUFollowsocialinfluencersChart();
				DoUPurchaseFrominfluencersChart();				
				PrimaryTargetAudienceChart();				
				ChallangesyoufaceChart();
				ActivelySocialEngageChart();
				
				SharingContentTypeChart();
				PrimaryObjectiveSocialEngagingChart();
				SocialContentEngagementChart();
				
				ImpactSocialEngagementChart();
				TimeSpentonSocialChart();
				
				SocialMediaGoalsChart();	
				//activeUserchart();
			},
			
			resize:function(){
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);