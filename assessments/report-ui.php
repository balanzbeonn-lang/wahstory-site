<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Well-Being Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
   <!-- Chart.js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #e9eff6;
    }
    .header {
      background: #0F497B;
      color: white;
      padding-top: 5px;
    }
    .info-box {
      background: #F8F9FA;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .score-box {
      background: #F44336;
      color: white;
      padding: 10px;
      border-radius: 8px;
      font-size: 18px;
    }
    .standard-score-box {
      background: #0F497B;
      color: white;
      padding: 10px;
      border-radius: 8px;
      font-size: 18px;
    }
    .chart-box {
      padding: 10px;
      margin-bottom: 30px;
    }
    canvas {
      background: #FFFFFF;
    }
	.bg-tab-1 {
		background: #F44336;
	}
	.bg-tab-2 {
		background: #0F497B;
	}

  .horiz-bars-wrapper {
    display: flex;
    width: 100%;
  }
  .horiz-bars-wrapper .item{
    width: 25%;
  }
  
  h4 {
      font-weight: 500;
  }
  .donut-chart {
          width: 100%;
      }
  @media (max-width: 767px) {
      .donut-chart {
          width: 100%;
      }
      .col-sm-6 {
          flex: 0 0 auto;
            width: 50%;
      }
      
  }
  
    .card-item {
        background: #fff;
        transition: all .5s ease-in-out;
        position: relative;
        border: 1px solid #DEE1ED;
        border-radius: 8px;
        box-shadow: 0 10px 20px rgba(197, 202, 220, 0.1);
        padding: 10px;
    }

  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row header">
        <div class="col-md-12 text-center py-1">
            <h1 class="h4">Your Well-Being Dashboard</h1>
        </div>
    </div> 
    <div class="row text-center mt-3">
        <div class="col-md-2">
            <div class="card-item">
              <strong>Name</strong><br />Avneet Kaur <!-- 👩  👨 🧑-->
            </div>
        </div>
       <div class="col-md-2">
          <div class="card-item">
            <strong>Gender</strong><br /> 👩
          </div>
        </div>
         
        <div class="col-md-2">
          <div class="card-item"> 
            <strong>Age Group</strong><br />18 to 29
          </div>
        </div>
        
        <div class="col-md-2">
          <div class="card-item">
            <strong>Body Type</strong><br />Fit
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card-item">
            <strong>Mindset during Survey</strong><br />Fair
          </div>
        </div>

    </div>
    <div class="row text-center mt-4">
      <div class="col-md-3 bg-tab-1" >
		<div class="score-box"> Your Well-Being Score: 55 </div>
	  </div>
      <div class="col-md-6 bg-tab-2">
		<div class="standard-score-box"> Standard Well-Being Score: 57 </div>
	  </div>
      <div class="col-md-3 bg-tab-1">
		    <div class="score-box"> Good </div>
	    </div>
	 
    </div>
    <!-- Main Chart Section -->
    <div class="row text-center chart-box">
	    <div class="col-md-3 mt-3 mb-3">
          <div class="card-item">
            <h5>HEALTH & FITNESS</h5>
    		<div class="row">
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 text-center">
    				<p class="mb-0">Standard Score</p>
    				<canvas id="healthChart2" class="donut-chart"></canvas>
    			</div> 
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 offset-lg-1 text-center">
    				<p class="mb-0">Individual Score </p>
    				<canvas id="healthChart" class="donut-chart"></canvas>
    			</div>
    			<div class="col-md-12 col-lg-12 col-xl-12">
    				<canvas id="healthBaarChart"></canvas>
    			</div>
    		</div>
          </div>
      </div>
	 
      <div class="col-md-3 mt-3 mb-3">
          <div class="card-item">
            <h5>LIFE</h5>		
    		<div class="row">
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 offset-lg-1">
    				<p class="mb-0">Standard Score </p>
    				<canvas id="lifeChart2" class="donut-chart"></canvas>
    			</div> 
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 offset-lg-1">
    				<p class="mb-0">Individual Score </p>
    				<canvas id="lifeChart" class="donut-chart"></canvas>
    			</div>
    			<div class="col-md-12 col-lg-12 col-xl-12">
    				<canvas id="lifeBaarChart"></canvas>
    			</div>
    			
    		</div>
    		
    	  </div>
		
      </div>
      <div class="col-md-3 mt-3 mb-3">
          <div class="card-item">
            <h5>FINANCIAL</h5>
    		
    		<div class="row">
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 offset-lg-1">
    				<p class="mb-0">Standard Score </p>
    				<canvas id="financeChart2" class="donut-chart"></canvas>
    			</div> 
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 offset-lg-1">
    				<p class="mb-0">Individual Score </p>
    				<canvas id="financeChart" class="donut-chart"></canvas>
    			</div>
    			<div class="col-md-12 col-lg-12 col-xl-12">
    				<canvas id="financeBaarChart"></canvas>
    			</div>
    		</div>
    		
          </div>
      </div>
      <div class="col-md-3 mt-3 mb-3">
          <div class="card-item">
            <h5>INTELLECTUAL</h5>
    		
    		<div class="row">
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 offset-lg-1">
    				<p class="mb-0">Standard Score </p>
    				<canvas id="intellectChart2" class="donut-chart"></canvas>
    			</div> 
    			<div class="col-sm-6 col-md-5 col-lg-5 col-xl-5 offset-lg-1">
    				<p class="mb-0">Individual Score </p>
    				<canvas id="intellectChart" class="donut-chart"></canvas>
    			</div>
    			<div class="col-md-12 col-lg-12 col-xl-12">
    				<canvas id="intellectBaarChart"></canvas>
    			</div>
    		</div>
    		
          </div>
      </div>
    </div>
    <!-- Bar Chart Section -->
    
    <div class="row bg-tab-2 py-2">
      <div class="col-md-12 text-center text-white"> 
        <h5 class="mb-0">  COMMON LIFE EVENTS </h5>
      </div>
    </div>
    
    
    <div class="row chart-box">
      <div class="col-md-4 py-3">
          <div class="card-item">
            <h4>Reason of Stress</h4>
            <canvas id="stressReasonsChart"></canvas>
          </div>
      </div>
      <div class="col-md-4 py-3">
          <div class="card-item">
            <h4>Professional Development</h4>
            <canvas id="profDevChart"></canvas>
          </div>
      </div>
      <div class="col-md-4 py-3">
          <div class="card-item">
            <h4>Organisation Support</h4>
            <canvas id="orgSupportChart"></canvas>
          </div>
      </div>
      
      <div class="col-md-6 py-3">
          <div class="card-item">
            <h4>Manage Stress</h4>
            <canvas id="manageStressChart"></canvas>
          </div>
      </div>
      <div class="col-md-6 py-3">
          <div class="card-item">
            <h4>Personal Development</h4>
            <canvas id="personalDevChart"></canvas>
          </div>
      </div>
      
      
    </div>
  </div>
  
  <div class="container-fluid">
      <div class="row"> 
        <div class="col-md-12 py-1 text-center">
            Powered by <a href="https://www.wahstory.com/" target="_blank">WAHStory</a>.
        </div>
      </div>
  </div>
  
  <script>
    const doughnutConfig = (label, score, emptycolor, fillcolor) => ({
      type: 'doughnut',
      data: {
        labels: false,
        datasets: [{
          data: [score.standard, score.individual],
          backgroundColor: [emptycolor, fillcolor],
        }]
      },
      options: {
		responsive: false,
        cutout: '50%',
        plugins: {
		legend: { display: true },
		}
      },
	  plugins: [{
		id: 'centerText',
		beforeDraw: function(chart) {
		  const width = chart.width;
		  const height = chart.height;
		  const ctx = chart.ctx;
		 
		  ctx.restore();
		 
		  // Font settings
		  const fontSize = (height / 5).toFixed(2);
		  ctx.font = `bold ${fontSize}px sans-serif`;
		  ctx.textBaseline = "middle";
		  ctx.textAlign = "center";
		 
		  const text = score.standard.toString();
		 
		  ctx.fillStyle = "#000";
		 
		  const textX = width / 2;
		  const textY = height / 1.8;
		 
		  ctx.fillText(text, textX, textY);
		  ctx.save();
		}
	  }]
    });
	
	
	const baarChartConfig = (p1, p2, p3, p4, bgcolor) => ({
		  type: 'bar',
		  data: {
			labels: ['Excellent', 'Good', 'Fair', 'At Risk'],
			datasets: [{
			  label: 'Reasons',
			  data: [p1, p2, p3, p4],
			  backgroundColor: bgcolor,
			  borderRadius: 10
			}]
		  },
		  options: {
			responsive: false,
			plugins: { legend: { display: false } },		
			scales: {
			  x: {
				grid: {
				  display: false // Hides vertical grid lines
				},
				
			  },
			  y: {
				ticks: {
				  stepSize: 20, // Adjust the step size (gap between ticks)
				},
				axis: {
				  display: false // Hides the actual y-axis line
				}
			  }
			},
		  }
	});
	
	
  
  function horizbaarChartConfig(elementId, labels, data, backgroundColors, Thickness, legendDisplay = false, showDataLabels = false) {
    const pluginsArray = [];

    // Add ChartDataLabels only if needed
    if (showDataLabels) {
      pluginsArray.push(ChartDataLabels);
    }

    new Chart(document.getElementById(elementId), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: backgroundColors,
          borderRadius: 5,
          barThickness: Thickness
        }]
      },
      options: {
        indexAxis: 'y',
        plugins: {
          legend: {
            display: legendDisplay
          },
          datalabels: showDataLabels ? {
            enabled: true,
            color: '#000',
            font: {
              weight: 'bold',
              size: 12
            },
            anchor: 'end',
            align: 'start',
            offset: 10,
            formatter: function(value) {
              return value + '%';
            }
          } : {}
        },
        scales: {
          x: {
            ticks: {
              stepSize: 10
            },            
          },
          y: {
            grid: {
              display: false // Hides vertical grid lines
            }
          }
        }
      },
      plugins: pluginsArray
    });
  }

    new Chart(document.getElementById('healthChart'), doughnutConfig('Health & Fitness', {individual: 40, standard: 60}, '#7ED957', '#00B980'));
    new Chart(document.getElementById('healthChart2'), doughnutConfig('Health & Fitness', {individual: 40, standard: 60}, '#737373', '#949494'));
    new Chart(document.getElementById('lifeChart'), doughnutConfig('Life', {individual: 37, standard: 63}, '#CB6CE6', '#915BC5'));
    new Chart(document.getElementById('lifeChart2'), doughnutConfig('Life', {individual: 33, standard: 67}, '#737373', '#949494'));
    new Chart(document.getElementById('financeChart'), doughnutConfig('Life', {individual: 56, standard: 44}, '#37C9EF', '#2E9AD5'));	
    new Chart(document.getElementById('financeChart2'), doughnutConfig('Life', {individual: 50, standard: 50}, '#737373', '#949494'));	
    new Chart(document.getElementById('intellectChart'), doughnutConfig('Life', {individual: 48, standard: 52}, '#FF914D', '#E45D56'));	
    new Chart(document.getElementById('intellectChart2'), doughnutConfig('Life', {individual: 42, standard: 58}, '#737373', '#949494'));
	
	// Circle  Baar Chats
	
    new Chart(document.getElementById('healthBaarChart'), baarChartConfig(0, 60, 0, 0, '#7ED957'));
    new Chart(document.getElementById('lifeBaarChart'), baarChartConfig(0, 63, 0, 0, '#CB6CE6'));
    new Chart(document.getElementById('financeBaarChart'), baarChartConfig(0, 0, 44, 0, '#37C9EF'));
    new Chart(document.getElementById('intellectBaarChart'), baarChartConfig(0, 58, 0, 0, '#FF914D'));
	
	// Circle  Baar Chats Ends	
	
	// Chart 1: Stress Reasons
	horizbaarChartConfig(
	  'stressReasonsChart',
	  ['Workload', 'Financial Worries', 'Health', 'Relationships', 'Bereavement'],
	  [28, 22, 19, 18, 13],
	  ['#DB93EF', '#F8F3F3', '#F8F3F3', '#F8F3F3', '#F8F3F3'],
    30,
	  false, 
    true
	);
	
  horizbaarChartConfig(
	  'manageStressChart',
	  ['Holiday', 'Reduce Work Hours', 'Sick Leave', 'Meditation', 'Overeating', 'Alcohol', 'Smoking'],
	  [34, 20, 14, 10, 10, 8, 7],
	  ['#F8F3F3', '#F8F3F3', '#ff7272', '#F8F3F3', '#F8F3F3', '#F8F3F3', '#F8F3F3'],
    25,
	  false, 
    true
	);
  
	
  horizbaarChartConfig(
	  'personalDevChart',
	  ['Fitness', 'Devote Time', 'Diet', 'Sleep', 'Spirituality', 'Travel', 'Meditate'],
	  [22, 19, 16, 16, 11, 10, 7],
	  ['#F8F3F3', '#F8F3F3', '#0f99dd', '#0f99dd', '#0f99dd', '#F8F3F3', '#0f99dd'],
    25,
	  false, 
    true
	);
  
	
  horizbaarChartConfig(
	  'profDevChart',
	  ['External Training', 'Exposure to Role', 'Coaching', 'Mentoring', 'In-house', 'Consultant'],
	  [25, 23, 17, 17, 10, 8],
	  ['#F8F3F3', '#F8F3F3', '#F8F3F3', '#7ed957', '#F8F3F3', '#F8F3F3'],
    28,
	  false, 
    true
	);
  
  horizbaarChartConfig(
	  'orgSupportChart',
	  ['Work-Life Balance', 'Training', 'Lifestyle', 'Health Events', 'Fitness Events', 'Advisory'],
	  [21, 17, 15, 13, 8, 6],
	  ['#F8F3F3', '#F8F3F3', '#FFBD58', '#F8F3F3', '#FFBD58', '#F8F3F3'],
    28,
	  false, 
    true
	);
  
  
  </script>
</body>
</html>