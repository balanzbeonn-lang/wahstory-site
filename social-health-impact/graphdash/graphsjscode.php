<script>
(function($) {
    /* "use strict" */
    
    <?php 
    @session_start();
    $DataRow = $postObj->getDataEmail($_SESSION['email']);
    
    $Memberscount = $postObj->getNoOfMembersCount();?>
	
 var dlabChartlist = function(){
	
	var screenWidth = $(window).width();
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	
	
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
  
// Charts Starts From Here !!!!!!!!!!!!!!!!!!!!!!! ###################  
// Charts Starts From Here !!!!!!!!!!!!!!!!!!!!!!! ###################  
  
  //GenderspieChart################
	var GenderspieChart = function(){
		var options = {
		 series: [<?=$postObj->getGenderCount('Male')?>, <?=$postObj->getGenderCount('Female')?>, <?=$postObj->getGenderCount('Other')?>],
		 labels: ["Male", "Female", "Other"],
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
					  label: '<?=$DataRow['gender']?>',
					},
				  },
				},
			  },
			},	   
	   colors: [
    '<?php echo ($DataRow['gender'] == 'Male') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['gender'] == 'Female') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['gender'] == 'Other') ? '#ff5e83' : '#91a7bf'; ?>'],

	   legend: {
			 position: 'bottom',
			 show:false
		   },
		tooltip: {
          enabled: false,
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
   
  
  <?php 
  $Age18to29 = $postObj->getByAgeRange(18, 29); 
  $Age30to39 = $postObj->getByAgeRange(30, 39); 
  $Age40to50 = $postObj->getByAgeRange(40, 50); 
  $Age50to100 = $postObj->getByAgeRange(50, 100); 
    ?>
  //AgeGrouppieChart################
   var AgeGrouppieChart = function(){
		var options = {
		 series: [<?=$Age18to29['count']?>, <?=$Age30to39['count']?>, <?=$Age40to50['count']?>, <?=$Age50to100['count']?>],
		 labels: ["18-29", "30-39", "40-50", "50+"],
		 chart: {
		 type: 'pie',
		 height:250,
	   },
	  dataLabels:{
			enabled: true,
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
			
		colors: [
    '<?php echo ($DataRow['age'] < 30) ? '#ff5e83' : '#5b7596'; ?>',
    '<?php echo ($DataRow['age'] > 29 && $DataRow['age'] < 40) ? '#ff5e83' : '#5b7596'; ?>',
    '<?php echo ($DataRow['age'] > 39 && $DataRow['age'] < 51) ? '#ff5e83' : '#5b7596'; ?>',
    '<?php echo ($DataRow['age'] > 50) ? '#ff5e83' : '#91a7bf'; ?>'],
    
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
	   }],
	   
	   tooltip: {
          enabled: false,
        },
	   
	   };

	   var chart = new ApexCharts(document.querySelector("#AgeGrouppieChart"), options);
	   chart.render();
	} 
	
	
<?php 
  $self_employedOccp = $postObj->getCountByOccupation('self_employed');
  $professionalOccp = $postObj->getCountByOccupation('professional');
  $salariedOccp = $postObj->getCountByOccupation('salaried');
  $businessOccp = $postObj->getCountByOccupation('business');
  $studentOccp = $postObj->getCountByOccupation('student');
  $home_makerOccp = $postObj->getCountByOccupation('home_maker');
  $othersOccp = $postObj->getCountByOccupation('others');
  
  if($self_employedOccp['count'] < 50){ $self_employedOccp['count'] = 40;}
  if($professionalOccp['count'] < 50){ $professionalOccp['count'] = 45;}
  if($salariedOccp['count'] < 50){ $salariedOccp['count'] = 50;}
  if($businessOccp['count'] < 50){ $businessOccp['count'] = 55;}
  if($studentOccp['count'] < 50){ $studentOccp['count'] = 60;}
  if($home_makerOccp['count'] < 50){ $home_makerOccp['count'] = 70;}
  if($othersOccp['count'] < 50){ $othersOccp['count'] = 80;}
  ?>
	
  //OccupationChart################
	var OccupationChart = function(){
	var options = {
          series: [
          {
            data: [
                <?=$self_employedOccp['count']?>, 
                <?=$professionalOccp['count']?>,
                <?=$salariedOccp['count']?>,
                <?=$businessOccp['count']?>,
                <?=$studentOccp['count']?>,
                <?=$home_makerOccp['count']?>,
                <?=$othersOccp['count']?>,
                ],
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
    '<?php echo ($DataRow['occupation'] == 'self_employed') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['occupation'] == 'professional') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['occupation'] == 'salaried') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['occupation'] == 'business') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['occupation'] == 'student') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['occupation'] == 'home_maker') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['occupation'] == 'others') ? '#ff5e83' : '#607180'; ?>'],
       
        dataLabels: {
          enabled: true,
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ': (' + Math.round(val/400*100) + '%)' 
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
          categories: ['Self Employed', 'Professional', 'Salaried', 'Business', 'Student', 'Home Maker', 'Others'],
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
            enabled: false,
          theme: "dark",
        },
		
        };

        var chart = new ApexCharts(document.querySelector("#OccupationChart"), options);
        chart.render();
	}
	
	<?php
	$preferredFb = $postObj->getCountBypreferedsocial('Facebook');
	$preferredInsta = $postObj->getCountBypreferedsocial('Instagram');
	$preferredLINKD = $postObj->getCountBypreferedsocial('LinkedIn');
	$preferredTwitter = $postObj->getCountBypreferedsocial('Twitter');
	$preferredYoutb = $postObj->getCountBypreferedsocial('YouTube');
	$preferredTikTok = $postObj->getCountBypreferedsocial('TikTok');
	?>
	
  //Preferred SocialChart ##################
  var preferredSocialChart = function(){	  
  var options = {
          series: [{
          name: "Users",
          data: [
              <?=$preferredFb['count']?>,
              <?=$preferredInsta['count']?>,
              <?=$preferredLINKD['count']?>,
              <?=$preferredTwitter['count']?>,
              <?=$preferredYoutb['count']?>,
              <?=$preferredTikTok['count']?>,],
        }],
          chart: {
          height: 260,
          type: 'bar',
		  toolbar: {
				show: false,
			  },
			offsetY: 30,			  
        },
        
        colors: [
    '<?php echo ($DataRow['prefered_social'] == 'Facebook') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['prefered_social'] == 'Instagram') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['prefered_social'] == 'LinkedIn') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['prefered_social'] == 'Twitter') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['prefered_social'] == 'YouTube') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['prefered_social'] == 'TikTok') ? '#ff5e83' : '#607180'; ?>'],
        
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
		  offsetY: 20,
		  formatter: function (val) {
				return Math.round(val / <?=$Memberscount['count']?> * 100) + '%';
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
		    enabled: false,
			theme: "dark",
		},
		
        };

        var chart = new ApexCharts(document.querySelector("#preferredSocialChart"), options);
        chart.render();		
	}	
	
	
    <?php 
        $IsTimeWellSpentYes = $postObj->getCountByTimeWellSpent('Yes');
        $IsTimeWellSpentNo = $postObj->getCountByTimeWellSpent('No');
    ?>
	//SocialTimeEffectiveChart################	
   var SocialTimeEffectiveChart = function(){		
		var options  = {
			series: [
				{
					name: 'Users',
					data: [<?=$IsTimeWellSpentYes['count']?>, <?=$IsTimeWellSpentNo['count']?>]
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
		  enabled: true,
		  position: 'top',
		  offsetY: 30,
		  formatter: function (val) {
				return Math.round(val / <?=$Memberscount['count']?> * 100) + '%';
			}
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
		  colors:['<?php echo ($DataRow['is_time_well_spent'] == 'Yes') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['is_time_well_spent'] == 'No') ? '#ff5e83' : '#607180'; ?>'],
		},
		tooltip: {
		    enabled: false,
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
   
   <?php 
        $FollowfluencersYes = $postObj->getCountByFollowsfluencers('Yes');
        $FollowfluencersNo = $postObj->getCountByFollowsfluencers('No');
    ?>
   //Do you follow social media influencers Chart################	
   var DoUFollowsocialinfluencersChart = function(){		
		var options  = {
			series: [
				{
					name: 'Users',
					data: [<?=$FollowfluencersYes['count']?>, <?=$FollowfluencersNo['count']?>]
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
		  enabled: true,
		  position: 'top',
		  offsetY: 30,
		  formatter: function (val) {
				return Math.round(val / <?=$Memberscount['count']?> * 100) + '%';
			}
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
		  colors:['<?php echo ($DataRow['social_media_influencers'] == 'Yes') ? '#ff5e83' : '#607180'; ?>',
    '<?php echo ($DataRow['social_media_influencers'] == 'No') ? '#ff5e83' : '#607180'; ?>'],
		},
		tooltip: {
		    enabled: false,
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
	
	
	<?php 
	    $fluencersPurchaseYes = $postObj->getCountByfluencersPurchase('Yes');
        $fluencersPurchaseNo = $postObj->getCountByfluencersPurchase('No');
	?>
	
	//Do you Purchase From social media influencers Chart################	
   var DoUPurchaseFrominfluencersChart = function(){		
		var options  = {
			series: [
				{
					name: 'Users',
					data: [<?=$fluencersPurchaseYes['count']?>, <?=$fluencersPurchaseNo['count']?>]
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
		  enabled: true,
		  position: 'top',
		  offsetY: 30,
		  formatter: function (val) {
				return Math.round(val / <?=$Memberscount['count']?> * 100) + '%';
			}
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
		  colors:['<?php if($DataRow['service_recommendation'] == 'Yes') { echo '#ff5e83';}else{ echo '#607180';} ?>',
    '<?php if($DataRow['service_recommendation'] == 'No') { echo '#ff5e83';}else{ echo '#607180';} ?>'],
		},
		tooltip: {
		    enabled: false,
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
	
	
	<?php 
	    $SocialPlatformByOne1_2 = $postObj->getCountUsingSocialPlatformByOne('1-2');
        $SocialPlatformByOne3_4 = $postObj->getCountUsingSocialPlatformByOne('3-4');
        $SocialPlatformByOne5_ = $postObj->getCountUsingSocialPlatformByOne('5 or more');
        
	?>
	
	//ActivelySocialEngage Chart
	var ActivelySocialEngageChart = function(){
		
		var options  = {
		series: [ 
			{
			  name: 'Users',
			   data: [<?=$SocialPlatformByOne1_2['count']?>, <?=$SocialPlatformByOne3_4['count']?>, <?=$SocialPlatformByOne5_['count']?>]
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
		  position: 'top',
		  offsetY: 40,
		  formatter: function (val) {
				return Math.round(val / <?=$Memberscount['count']?> * 100) + '%';
			}
		  
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
		  
		  colors:[
		        '<?php echo ($DataRow['professionalpurposes'] == '1-2') ? '#ff5e83' : '#607180'; ?>',
                '<?php echo ($DataRow['professionalpurposes'] == '3-4') ? '#ff5e83' : '#607180'; ?>',
                '<?php echo ($DataRow['professionalpurposes'] == '5 or more') ? '#ff5e83' : '#607180'; ?>'],
		},
		tooltip: {
		    enabled: false,
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
	
	
	<?php 
	    $Challangesfaced1 = $postObj->getCountChallangesfaced('Content creation');
	    $Challangesfaced2 = $postObj->getCountChallangesfaced('Consistency');
	    $Challangesfaced3 = $postObj->getCountChallangesfaced('Audience engagement');
	    $Challangesfaced4 = $postObj->getCountChallangesfaced('Time management');
	?>
	
 //Challanges You Face Chart ############## 
	var ChallangesyoufaceChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [<?=$Challangesfaced1['count']?>, <?=$Challangesfaced2['count']?>, <?=$Challangesfaced3['count']?>, <?=$Challangesfaced4['count']?>],		  
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
		
		<?php $challenges = explode(',', $DataRow['social_impact_challenges']);?>
		
		colors:['<?php echo (in_array("Content creation", $challenges)) ? '#ff5e83' : '#607180'; ?>',
                '<?php echo (in_array("Consistency", $challenges)) ? '#ff5e83' : '#607180'; ?>',
                '<?php echo (in_array("Audience engagement", $challenges)) ? '#ff5e83' : '#607180'; ?>',
                '<?php echo (in_array("Time management", $challenges)) ? '#ff5e83' : '#607180'; ?>'],
        dataLabels: {
        //   position: 'top',
		  formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val / <?=$Memberscount['count']?> * 100) + '%' + ")";
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
          theme: "dark",
        },		
        };		

        var chart = new ApexCharts(document.querySelector("#ChallangesyoufaceChart"), options);
        chart.render();
		
	} 
		
	
	<?php 
	    $TargetAudience1 = $postObj->getCountTargetAudience('General public');
	    $TargetAudience2 = $postObj->getCountTargetAudience('Professionals in your industry');
	    $TargetAudience3 = $postObj->getCountTargetAudience('Potential customers');
	    $TargetAudience4 = $postObj->getCountTargetAudience('Friends and family');
	?>
	
	//Primary Target Audience  Chart
	var PrimaryTargetAudienceChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [<?=$TargetAudience1['count']?>, <?=$TargetAudience2['count']?>, <?=$TargetAudience3['count']?>, <?=$TargetAudience4['count']?>],		  
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
			categories: ["General public", "Industry professionals", "Potential customers", "Friends & family"],
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
            '<?php echo ($DataRow['primary_target_audience'] == 'General public') ? '#ff5e83' : '#607180' ?>',
            '<?php echo ($DataRow['primary_target_audience'] == 'Professionals in your industry') ? '#ff5e83' : '#607180' ?>',
            '<?php echo ($DataRow['primary_target_audience'] == 'Potential customers') ? '#ff5e83' : '#607180' ?>',
            '<?php echo ($DataRow['primary_target_audience'] == 'Friends and family') ? '#ff5e83' : '#607180' ?>',
		  ],
		  
        dataLabels: {
            textAnchor : 'start',
            offsetX: -20,
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val / <?=$Memberscount['count']?> * 100) + '%' + ")";
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
          theme: "dark",
        },		
        };		

        var chart = new ApexCharts(document.querySelector("#PrimaryTargetAudienceChart"), options);
        chart.render();
		
	} //------
	
	
	<?php 
	    $SharingContentType1 = $postObj->getCountSharingContentType('Images');
	    $SharingContentType2 = $postObj->getCountSharingContentType('Articles');
	    $SharingContentType3 = $postObj->getCountSharingContentType('Videos');
	    $SharingContentType4 = $postObj->getCountSharingContentType('Opinions');
	    ?>
	
	//SharingContentType Chart
	var SharingContentTypeChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [<?=$SharingContentType1['count']?>, <?=$SharingContentType2['count']?>, <?=$SharingContentType3['count']?>, <?=$SharingContentType4['count']?>],		  
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
		
		<?php $content_type = explode(',', $DataRow['content_type']);?>
		
        colors:[
            '<?php echo (in_array("Images", $content_type)) ? '#ff5e83' : '#607180'; ?>',
    		'<?php echo (in_array("Articles", $content_type)) ? '#ff5e83' : '#607180'; ?>',
    		'<?php echo (in_array("Videos", $content_type)) ? '#ff5e83' : '#607180'; ?>',
    		'<?php echo (in_array("Opinions", $content_type)) ? '#ff5e83' : '#607180'; ?>'],
        dataLabels: {
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val / <?=$Memberscount['count']?> * 100) + '%' + ")";
			},
        },
        legend: {
          show: false,
        },
		tooltip: {
		    enabled: false,
          theme: "dark",
        },
		
		
        };
		

        var chart = new ApexCharts(document.querySelector("#SharingContentTypeChart"), options);
        chart.render();
		
	}
	
	
	
	<?php 
	    $PrimaryObjective1 = $postObj->getCountSocialPrimaryObjective('Building a personal brand');
	    $PrimaryObjective2 = $postObj->getCountSocialPrimaryObjective('Connecting with friends and colleagues');
	    $PrimaryObjective3 = $postObj->getCountSocialPrimaryObjective('Promoting products or services');
	    $PrimaryObjective4 = $postObj->getCountSocialPrimaryObjective('Sharing insights');
	    $PrimaryObjective5 = $postObj->getCountSocialPrimaryObjective('Providing entertainment');
	?>
	//PrimaryObjectiveSocialEngaging Chart
	var SocialMediaGoalsChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
          data: [<?=$PrimaryObjective1['count']?>, <?=$PrimaryObjective2['count']?>, <?=$PrimaryObjective3['count']?>, <?=$PrimaryObjective4['count']?>, <?=$PrimaryObjective5['count']?>,],
		  
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
		    '<?php echo ($DataRow['important_social_objective'] == 'Building a personal brand') ? '#ff5e83' : '#607180' ?>',
		    '<?php echo ($DataRow['important_social_objective'] == 'Connecting with friends and colleagues') ? '#ff5e83' : '#607180' ?>',
		    '<?php echo ($DataRow['important_social_objective'] == 'Promoting products or services') ? '#ff5e83' : '#607180' ?>',
		    '<?php echo ($DataRow['important_social_objective'] == 'Sharing insights') ? '#ff5e83' : '#607180' ?>',
		    '<?php echo ($DataRow['important_social_objective'] == 'Providing entertainment') ? '#ff5e83' : '#607180' ?>'],		
		xaxis: {
			categories: ["Building a personal brand", "Social Connections", "Promoting products or services", "Sharing insights", "Providing entertainment"],
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
            textAnchor: 'start', // Center-align text labels
      offsetX: 0, // Offset for fine-tuning label position
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val / <?=$Memberscount['count']?> * 100) + '%' + ")";
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
          theme: "dark",
        },
        };

        var chart = new ApexCharts(document.querySelector("#SocialMediaGoalsChart"), options);
        chart.render();
		
	}
	
	
	
	<?php 
	
	$EngagementObjective1 = $postObj->getCountEngagementObjective('Personal branding');
	$EngagementObjective2 = $postObj->getCountEngagementObjective('Networking');
	$EngagementObjective3 = $postObj->getCountEngagementObjective('Showcasing products/services');
	$EngagementObjective4 = $postObj->getCountEngagementObjective('Thought leadership');
	$EngagementObjective5 = $postObj->getCountEngagementObjective('Entertainment');
	?>
	//PrimaryObjectiveSocialEngaging Chart
	var PrimaryObjectiveSocialEngagingChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
          data: [<?=$EngagementObjective1['count']?>, <?=$EngagementObjective2['count']?>, <?=$EngagementObjective3['count']?>, <?=$EngagementObjective4['count']?>, <?=$EngagementObjective5['count']?>,],
		  
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
            position: "right",
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
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val/<?=$Memberscount['count']?>*100) + "%)";
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
		    enabled: false,
          theme: "dark",
        },
        };

        var chart = new ApexCharts(document.querySelector("#PrimaryObjectiveSocialEngagingChart"), options);
        chart.render();
		
	}
	
	<?php 
	$ContentInterest1 = $postObj->getCountContentInterest('News and Current Events');
	$ContentInterest2 = $postObj->getCountContentInterest('Entertainment');
	$ContentInterest3 = $postObj->getCountContentInterest('Personal Updates from Friends and Family');
	$ContentInterest4 = $postObj->getCountContentInterest('Inspirational or Motivational Posts');
	$ContentInterest5 = $postObj->getCountContentInterest('Educational/Informative Content');
	$ContentInterest6 = $postObj->getCountContentInterest('Product/Service Recommendations');
	?>
	
	
	//SocialContentEngagement Chart ##############
	var SocialContentEngagementChart = function(){
		
		var options = {			
			series: [{
				name: "Users",
				data: [<?=$ContentInterest1['count']?>, <?=$ContentInterest2['count']?>, <?=$ContentInterest3['count']?>, <?=$ContentInterest4['count']?>, <?=$ContentInterest5['count']?>, <?=$ContentInterest6['count']?>],
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
			barHeight: "95%",
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
		
		<?php $content_type_engage = explode(',', $DataRow['content_type_engage']);?>
		
		colors:[
		    '<?php echo (in_array("News and Current Events", $content_type_engage)) ? '#ff5e83' : '#607180'; ?>',
        	'<?php echo (in_array("Entertainment", $content_type_engage)) ? '#ff5e83' : '#607180'; ?>',
        	'<?php echo (in_array("Personal Updates from Friends and Family", $content_type_engage)) ? '#ff5e83' : '#607180'; ?>',
        	'<?php echo (in_array("Inspirational or Motivational Posts", $content_type_engage)) ? '#ff5e83' : '#607180'; ?>',
        	'<?php echo (in_array("Educational/Informative Content", $content_type_engage)) ? '#ff5e83' : '#607180'; ?>',
        	'<?php echo (in_array("Product/Service Recommendations", $content_type_engage)) ? '#ff5e83' : '#607180'; ?>'],		
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
           textAnchor: 'start', // Center-align text labels
            offsetX: -50, // Offset for fine-tuning label position
          formatter: function (val, opt) {
				return opt.w.globals.labels[opt.dataPointIndex] + " (" + Math.round(val / <?=$Memberscount['count']?> * 100) + '%' + ")";
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
          theme: "dark",
        },
        };

        var chart = new ApexCharts(document.querySelector("#SocialContentEngagementChart"), options);
        chart.render();
		
	}
	
	
	var engagesocialchartBarRunning = function(){
		
		var options  = {
			series: [
				{
					name: 'Users',
					 data: [75, 50, 30]
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
		  categories: ['Excellent', 'Good', 'Fair'],
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
	<?php 
	    $SMEngagementGraphScore = round(($SMEngagementScore / 16) * 100); 
	?>
		fill: {
		  opacity: 1,
		  colors:[
		      '<?php if($SMEngagementGraphScore > 74 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($SMEngagementGraphScore < 75 && $SMEngagementGraphScore > 49 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($SMEngagementGraphScore < 50 ){ echo '#ff5e83';}else{ echo '#607180';}?>',]
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
					 data: [75, 50, 30]
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
		  categories: ['Excellent', 'Good', 'Fair'],
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
		<?php 
    	   $FrequencyNContentGraphScore = round(($FrequencyNContentScore / 14) * 100); 
    	?>
		fill: {
		  opacity: 1,
		  colors:[
		      '<?php if($FrequencyNContentGraphScore > 74 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($FrequencyNContentGraphScore < 75 && $FrequencyNContentGraphScore > 49 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($FrequencyNContentGraphScore < 50 ){ echo '#ff5e83';}else{ echo '#607180';}?>',]
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
	
	
	
	var SocialObjectivechartBar = function(){
		
		var options  = {
			series: [
				{
					name: 'Score',
					 data: [75, 50, 30]
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
		  categories: ['Excellent', 'Good', 'Fair'],
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
		<?php 
    	   $SocialObjectiveGraphScore = round(($SocialObjectiveScore / 34) * 100); 
    	?>
		fill: {
		  opacity: 1,
		  colors:[
		      '<?php if($SocialObjectiveGraphScore > 74 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($SocialObjectiveGraphScore < 75 && $SocialObjectiveGraphScore > 49 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($SocialObjectiveGraphScore < 50 ){ echo '#ff5e83';}else{ echo '#607180';}?>',]
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
    document.querySelector('#SocialObjectivechartBar'),
    options
  );
  chart.render();			
	}
	
	
	
	var ContentStrategychartBar = function(){
		
		var options  = {
			series: [
				{
					name: 'Score',
					 data: [75, 50, 30]
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
		  categories: ['Excellent', 'Good', 'Fair'],
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
		<?php 
    	   $ContentStrategyGraphScore = round(($ContentStrategyScore / 4) * 100); 
    	?>
		fill: {
		  opacity: 1,
		  colors:[
		      '<?php if($ContentStrategyGraphScore > 74 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($ContentStrategyGraphScore < 75 && $ContentStrategyGraphScore > 49 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($ContentStrategyGraphScore < 50 ){ echo '#ff5e83';}else{ echo '#607180';}?>',]
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
    document.querySelector('#ContentStrategychartBar'),
    options
  );
  chart.render();			
	}
	
	
	
	var EngagementMetricschartBar = function(){
		
		var options  = {
			series: [
				{
					name: 'Score',
					 data: [75, 50, 30]
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
		  categories: ['Excellent', 'Good', 'Fair'],
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
		<?php 
    	   $EngagementMatricsGraphScore = round(($EngagementMatricsScore / 28) * 100); 
    	?>
		fill: {
		  opacity: 1,
		  colors:[
		      '<?php if($EngagementMatricsGraphScore > 74 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($EngagementMatricsGraphScore < 75 && $EngagementMatricsGraphScore > 49 ){ echo '#ff5e83';}else{ echo '#607180';}?>',
		      '<?php if($EngagementMatricsGraphScore < 50 ){ echo '#ff5e83';}else{ echo '#607180';}?>',]
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
    document.querySelector('#EngagementMetricschartBar'),
    options
  );
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
				reservationChart();
				engagesocialchartBarRunning();
				socialplatformschartBarRunning();
				SocialObjectivechartBar();
				ContentStrategychartBar();
				EngagementMetricschartBar();
				NewCustomers();
				pieChart1();
				columnChart();
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
    
</script>