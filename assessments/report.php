<?php 
session_start();
    require_once('functions.php');
    $obj = new Assessment();
    if(isset($_GET['fiticon']) && $_GET['fiticon'] != '') {
        $userScore = $obj->GetScoreBySlug($_GET['fiticon']);
        if($userScore == NULL) {
            echo " Invalid URL, Ensure you're using the latest link sent to you in the email. Double-check for any missing characters or typos.";
            exit();
        }
    } else {
        exit();
    }
    $total_participants = $obj->GetCountOfTotalUsers();
    include('calc_score.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Well-Being Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #181818;
      color: #fff;
    }
    .header {
      background: #000;
      color: #fff;
      padding-top: 5px;
      border-bottom: 3px solid #343434;
    }
    .highlight {
        background: #e9204f;
        } 
    .standard-score-box {
      background: #000000;
      color: #cccccc;
      padding: 10px;
      border-radius: 8px;
      font-size: 18px;
      font-weight: bold;
      border: 2px solid #cccccc;
    }
    .chart-box {
      padding: 10px;
      margin-bottom: 30px;
    }
    canvas {
      background: #000000;
      border-radius: 8px;
    }
    .bg-tab-1 {
      background: #000000;
    }
    .bg-tab-2 {
      background: #1a1819;
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
        background: #000000;
        transition: all .5s ease-in-out;
        position: relative;
        border: 1px solid #444;
        border-radius: 8px;
        box-shadow: 0 10px 20px rgba(106,112,161, 0.08);
        padding: 10px;
        color: #cccccc;
    }
    
    .card-item p{
        font-size: .98rem;
        padding: 5px 0px;
    }
    
    .table li {
        list-style: none;
    }
    .table thead tr {
      color: #e9204f;
      background: #000000;
    }
    .table tbody tr {
      background: #1a1819;
      color: #cccccc;
    }
    .table tbody tr td, .table thead tr th {
      border-color: #444;
    }
    .refer-btn {
        position: fixed;
        right: 10px;
        bottom: 0; 
        transform-origin: left top;
        background: linear-gradient(90deg, #e9204f 60%, #000000 100%);
        color: white !important;
        padding: 6px 20px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 8px;
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(233, 32, 79, 0.15);
        transition: background 0.2s;
        border: 2px solid #000000;
    }
    .refer-btn:hover {
        background: linear-gradient(90deg, #000000 60%, #e9204f 100%);
        color: #e9204f;
        border: 2px solid #343434;
    }
    a, a:visited {
      color: #e9204f;
    }
    a:hover {
      color: #fff;
    }
    ::-webkit-scrollbar {
      width: 8px;
      background: #1a1819;
    }
    ::-webkit-scrollbar-thumb {
      background: #6a70a1;
      border-radius: 8px;
    }
    
    .dropdown-menu {
        background-color: #181818;
    border-top: 2px solid #e9204f;
    padding: 10px 0;
    border-radius: 0 0 5px 5px;
    }
    button.btn {
        background: transparent;
        border: 1px solid #444;
        color: #fff;
        padding: 5px 32px;
    }
    button.btn:hover, button.btn:active, button.btn:visited, button.btn:focus {
        background: #ff5e83;
        border-color: #ff5e83;
    }
    /*ul.dropdown-menu {
        background: #000000;
        border: 2px solid #444;
        border-top: none;
    }*/
    ul.dropdown-menu li a{
        color: #fff;
        font-size: 0.88rem;
        transition: color 0.2s;
    } 
    ul.dropdown-menu li:hover a{
        color: #ff5e83; 
        background: transparent; 
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row header">
        <div class="col-md-4 text-center py-1">
            <a class="d-block" href="/">
                <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo" width="150px">
            </a>
        </div>
        <div class="col-md-4 text-center py-1">
            <div class="d-flex justify-content-center" style=" align-items: center; height: 60px; ">
                <h1 class="h4 fw-semibold">Your Well-Being Dashboard</h1>
            </div>
        </div>
        
        <div class="col-md-4 text-center py-1">
        
        <?php if(isset($_SESSION['email']) and $_SESSION['email'] !=''){ 
            $UserRow = $obj->GetUserById($_SESSION['userid']);
        ?>
        
            <div class="d-flex justify-content-center" style=" align-items: center; height: 60px; ">
                <div class="dropdown">
                    <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown">
                        <?php if($UserRow['profile_image'] != '') { ?>
                            <img src="/images/users/<?=$UserRow['profile_image']?>" height="30px" class="rounded-circle" alt="">
                        <?php } else { ?>
                            <img src="/social-health-impact/graphdash/images/placeholder.png" width="30px" class="rounded-circle" alt="">
                        <?php } ?>
                        
                        <?= ucwords($userScore['full_name']) ?>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/users/" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Dashboard</a></li>
                      <li><a class="dropdown-item" href="/users/user.profile.php" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile</a></li>
                      <li><a class="dropdown-item" href="/logout?LogoutUser"><svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Logout</a></li> 
                    </ul>
                </div>
            </div>
		 
        <?php } else {?>
             <div class="d-flex justify-content-center" style=" align-items: center; height: 60px; ">
                <div class="dropdown">
                    <button type="button" class="btn" >
                        <img src="/social-health-impact/graphdash/images/placeholder.png" width="30px" class="rounded-circle" alt="">
                        <?= ucwords($userScore['full_name']) ?>
                    </button>
                     
                </div>
            </div>
                
        <?php } ?>
    
        </div>
    </div> 
    <div class="row text-center mt-3">
        <div class="col-md-2">
            <div class="card-item">
              <strong>Name</strong><br /><?= ucwords($userScore['full_name']) ?>
            </div>
        </div>
       <div class="col-md-2">
          <div class="card-item">
            <strong>Gender</strong><br /> 
            <?php 
            if($userScore['gender'] === 'Female') { 
                echo "<span>&#128105;</span>";
                } else if($userScore['gender'] === 'Male'){ 
                    echo "<span>&#128104;</span>";
                } else {
                    echo "<span>&#128104;</span>";
                }?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card-item"> 
            <strong>Age Group</strong><br /> <?=$userScore['age_group']?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card-item">
            <strong>Body Type</strong><br /> <?=$userScore['weight_status']?>
          </div>
        </div>
        <?php $mindsetscore = ($userScore['happy_level_yesterday'] + $userScore['relaxed_level_yesterday'] + $userScore['fitness_level_yesterday'] + $userScore['excitement_level_yesterday']) / 4; 
            if ($mindsetscore <= 1.4) {
                $MindsetStatus = "Negative";
              } else if ($mindsetscore <= 2.9) {
                $MindsetStatus = "Fair";
              } else {
                $MindsetStatus = "Positive";
              }
        ?>
        <div class="col-md-4">
          <div class="card-item">
            <strong>Mindset during Survey</strong><br /><?=$MindsetStatus;?>
          </div>
        </div>
    </div>
    <div class="row text-center mt-4">
      <div class="col-md-3" >
        <div class="standard-score-box"> Standard Well-Being Score: <?=$STANDARD_WELLBEING_SCORE?> </div>
      </div>
      <div class="col-md-6">
        
        <div class="standard-score-box"> Your Well-Being Score: <?=$INDIVIDUAL_WELLBEING_SCORE?> </div>
      </div>
      <div class="col-md-3">
        <div class="standard-score-box"> <?=$YOURSCORE_GRADE?> </div>
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
      <div class="col-md-12 text-center"> 
        <h4 class="mb-0 fw-semibold">Common Life Events</h4>
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
            <h4>Manage Stress</h4>
            <canvas id="manageStressChart"></canvas>
          </div>
      </div>
      <div class="col-md-4 py-3">
          <div class="card-item">
            <h4>Personal Development</h4>
            <canvas id="personalDevChart"></canvas>
          </div>
      </div>
      <div class="col-md-6 py-3">
          <div class="card-item">
            <h4>Professional Development</h4>
            <canvas id="profDevChart"></canvas>
          </div>
      </div>
      <div class="col-md-6 py-3">
          <div class="card-item">
            <h4>Organisation Support</h4>
            <canvas id="orgSupportChart"></canvas>
          </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row bg-tab-2 py-2">
      <div class="col-md-12 text-center">  
        <h4 class="mb-0 fw-semibold">Actionable Tips to Improve Your Wellness</h4>
      </div>
    </div>
    <div class="row"> 
      <div class="col-md-12 p-4">
        <div class="card-item">
          <table class="table table-dark" style="min-width: 800px">
            <thead>
              <tr>
                <th>Score Range</th>
                <th>Category</th>
                <th>What It Means</th>
                <th>Recommended Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>81 – 100</strong></td>
                <td>✅ Excellent</td>
                <td>You are doing great! Your habits and mindset show a strong sense of well-being in this area. Keep it up.</td>
                <td>
                  <ul>
                    <li>- Continue current routines</li>
                    <li>- Be a role model</li>
                    <li>- Try helping others improve</li>
                    <li>- Explore ways to maintain and evolve</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td><strong>61 – 80</strong></td>
                <td>🟢 Good</td>
                <td>You're on the right path with some room for growth. A few tweaks can elevate your wellness to the next level.</td>
                <td>
                  <ul>
                    <li>- Reflect on minor weak spots</li>
                    <li>- Introduce 1–2 healthy habits</li>
                    <li>- Monitor progress regularly</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td><strong>41 – 60</strong></td>
                <td>🟡 Moderate</td>
                <td>There’s a noticeable imbalance. Some areas of concern are emerging and should be addressed sooner rather than later.</td>
                <td>
                  <ul>
                    <li>- Set small, achievable goals</li>
                    <li>- Track mood/sleep/energy levels</li>
                    <li>- Talk to a coach/counselor if needed</li>
                    <li>- Create a 7-day improvement plan</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td><strong>21 – 40</strong></td>
                <td>🔶 Needs Attention</td>
                <td>Your wellness in this area is at risk. Consistent effort and support can help rebuild balance and stability.</td>
                <td>
                  <ul>
                    <li>- Consider lifestyle changes</li>
                    <li>- Consult a professional if needed</li>
                    <li>- Join support groups or wellness programs</li>
                    <li>- Prioritize this area</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td><strong>0 – 20</strong></td>
                <td>🔴 Critical</td>
                <td>This score indicates urgent concern. Immediate support and structured action are necessary for your well-being.</td>
                <td>
                  <ul>
                    <li>- Speak to a professional (doctor, counselor)</li>
                    <li>- Limit stress triggers</li>
                    <li>- Build a basic wellness routine</li>
                    <li>- Seek accountability partner</li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
      <div class="row"> 
        <div class="col-md-12 py-1 text-center" style="color:#e9204f;">
            Powered by <a href="https://www.wahstory.com/" target="_blank">WAHStory</a>.
        </div>
      </div>
  </div>
  
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<!-- PAGE TITLE HERE -->
	
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	
  <script>
    // Color palette
    const mainPink = '#ff5e83';
    const mutedBlue = '#3c9ee5';
    const darkGray = '#000000';
    const medGray = '#566471';
    const lightGray = '#cccccc';

    // Donut chart config
    const doughnutConfig = (score, colors) => ({
      type: 'doughnut',
      data: {
        labels: ["Score", "Score"],
        datasets: [{
          data: [score.standard, score.individual],
          backgroundColor: colors,
          borderWidth: 0
        }]
      },
      options: {
        responsive: false,
        cutout: '50%',
        plugins: {
          legend: { display: false }
        }
      },
      plugins: [{
        id: 'centerText',
        beforeDraw: function(chart) {
          const width = chart.width;
          const height = chart.height;
          const ctx = chart.ctx;
          ctx.restore();
          const fontSize = (height / 5).toFixed(2);
          ctx.font = `bold ${fontSize}px sans-serif`;
          ctx.textBaseline = "middle";
          ctx.textAlign = "center";
          const text = score.standard.toString();
          ctx.fillStyle = colors[0];
          const textX = width / 2;
          const textY = height / 1.8;
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }]
    });

    // Bar chart config
    const baarChartConfig = (dataArr, colors) => ({
      type: 'bar',
      data: {
        labels: ['Excellent', 'Good', 'Fair', 'At Risk'],
        datasets: [{
          label: 'Reasons',
          data: dataArr,
          backgroundColor: colors,
          borderRadius: 10
        }]
      },
      options: {
        responsive: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false } },
          y: { ticks: { stepSize: 20 }, axis: { display: false } }
        }
      }
    });

    function horizbaarChartConfig(elementId, labels, data, backgroundColors, Thickness, legendDisplay = false, showDataLabels = false) {
      const pluginsArray = [];
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
            legend: { display: legendDisplay },
            datalabels: showDataLabels ? {
              enabled: true,
              color: '#fff',
              font: { weight: 'bold', size: 12 },
              anchor: 'end',
              align: 'start',
              offset: 10,
              formatter: function(value) { return value + '%'; }
            } : {}
          },
          scales: {
            x: { ticks: { stepSize: 10 }, grid: { color: medGray } },
            y: { grid: { display: false } }
          }
        },
        plugins: pluginsArray
      });
    }

    // Donut charts
    new Chart(document.getElementById('healthChart'), 
      doughnutConfig(
        {individual: <?=100 - $HEALTHnFITNESS_SCORE?>, standard: <?=$HEALTHnFITNESS_SCORE?>}, 
        [mainPink, medGray]
      )
    );
    new Chart(document.getElementById('healthChart2'), 
      doughnutConfig(
        {individual: <?=100 - $HEALTHnFITNESS_SCORE_Standard?>, standard: <?=$HEALTHnFITNESS_SCORE_Standard?>}, 
        [mutedBlue, medGray]
      )
    );
    new Chart(document.getElementById('lifeChart'), 
      doughnutConfig(
        {individual: <?=100 - $LIFE_SCORE?>, standard: <?=$LIFE_SCORE?>}, 
        [mainPink, medGray]
      )
    );
    new Chart(document.getElementById('lifeChart2'), 
      doughnutConfig(
        {individual: <?=100 - $LIFE_SCORE_Standard?>, standard: <?=$LIFE_SCORE_Standard?>}, 
        [mutedBlue, medGray]
      )
    );
    new Chart(document.getElementById('financeChart'), 
      doughnutConfig(
        {individual: <?=100 - $FINANCIAL_SCORE?>, standard: <?=$FINANCIAL_SCORE?>}, 
        [mainPink, medGray]
      )
    );
    new Chart(document.getElementById('financeChart2'), 
      doughnutConfig(
        {individual: <?=100 - $FINANCIAL_SCORE_Standard?>, standard: <?=$FINANCIAL_SCORE_Standard?>}, 
        [mutedBlue, medGray]
      )
    );
    new Chart(document.getElementById('intellectChart'), 
      doughnutConfig(
        {individual: <?=100 - $INTELLECTUAL_SCORE?>, standard: <?=$INTELLECTUAL_SCORE?>}, 
        [mainPink, medGray]
      )
    );
    new Chart(document.getElementById('intellectChart2'), 
      doughnutConfig(
        {individual: <?=100 - $INTELLECTUAL_SCORE_Standard?>, standard: <?=$INTELLECTUAL_SCORE_Standard?>}, 
        [mutedBlue, medGray]
      )
    );

    // Bar charts (replace PHP variables with arrays as needed)
    new Chart(document.getElementById('healthBaarChart'), 
      baarChartConfig([<?=$Health_Grade?>], [mainPink])
    );
    new Chart(document.getElementById('lifeBaarChart'), 
      baarChartConfig([<?=$Life_Grade?>], [mainPink])
    );
    new Chart(document.getElementById('financeBaarChart'), 
      baarChartConfig([<?=$Financial_Grade?>], [mainPink])
    );
    new Chart(document.getElementById('intellectBaarChart'), 
      baarChartConfig([<?=$Intellectual_Grade?>], [mainPink])
    );
  
    // Horizontal bar charts for events
    horizbaarChartConfig(
      'stressReasonsChart',
      ['Workload', 'Financial Worries', 'Health', 'Relationships', 'Bereavement'],
        [
          <?=$stressAvgs['stress_work_avg']?>,
          <?=$stressAvgs['stress_finance_avg']?>,
          <?=$stressAvgs['stress_health_avg']?>,
          <?=$stressAvgs['stress_relationship_avg']?>,
          <?=$stressAvgs['stress_bereavement_avg']?>
        ],
        [
    <?= ($userScore['stress_work'] > 1) ? 'mainPink' : 'medGray' ?>,
    <?= ($userScore['stress_finance'] > 1) ? 'mainPink' : 'medGray' ?>,
    <?= ($userScore['stress_health'] > 1) ? 'mainPink' : 'medGray' ?>,
    <?= ($userScore['stress_relationship'] > 1) ? 'mainPink' : 'medGray' ?>,
    <?= ($userScore['stress_bereavement'] > 1) ? 'mainPink' : 'medGray' ?>
        ],
        30, false, true
    );
    
    horizbaarChartConfig(
      'manageStressChart',
      ['Holiday', 'Reduce Work Hours', 'Sick Leave', 'Meditation', 'Overeating', 'Alcohol', 'Smoking'],
        [
          <?=$MNGstressAvgs['manage1_avg']?>,
          <?=$MNGstressAvgs['manage2_avg']?>,
          <?=$MNGstressAvgs['manage3_avg']?>,
          <?=$MNGstressAvgs['manage4_avg']?>,
          <?=$MNGstressAvgs['manage5_avg']?>,
          <?=$MNGstressAvgs['manage6_avg']?>,
          <?=$MNGstressAvgs['manage7_avg']?>
        ],
        [<?= $mngstressed1 ?>, <?= $mngstressed2 ?>, <?= $mngstressed3 ?>, <?= $mngstressed4 ?>, <?= $mngstressed5 ?>, <?= $mngstressed6 ?>, <?= $mngstressed7 ?> ],
      23, false, true
    );
    horizbaarChartConfig(
      'personalDevChart',
      [ 'Meditate', 'Fitness', 'Travel', 'Spirituality', 'Diet', 'Sleep', 'Devote Time'],
      [<?=$WellbeingGoalsAvgs['wellg1_avg']?>, <?=$WellbeingGoalsAvgs['wellg2_avg']?>, <?=$WellbeingGoalsAvgs['wellg3_avg']?>, <?=$WellbeingGoalsAvgs['wellg4_avg']?>, <?=$WellbeingGoalsAvgs['wellg5_avg']?>, <?=$WellbeingGoalsAvgs['wellg6_avg']?>,  <?=$WellbeingGoalsAvgs['wellg7_avg']?>],
      [<?= $Wellbeing1 ?>, <?= $Wellbeing2 ?>, <?= $Wellbeing3 ?>, <?= $Wellbeing4 ?>, <?= $Wellbeing5 ?>, <?= $Wellbeing6 ?>, <?= $Wellbeing7 ?> ],
      23, false, true
    );
    horizbaarChartConfig(
      'profDevChart',
      ['In-house Training', 'External Training', 'On Job Coaching',  'Help From Consultant', 'Mentoring by senior',  'Exposure to Role', 'Other'],
      [<?=$JobImproveAvgs['jobimp1_avg']?>, <?=$JobImproveAvgs['jobimp2_avg']?>, <?=$JobImproveAvgs['jobimp3_avg']?>, <?=$JobImproveAvgs['jobimp4_avg']?>, <?=$JobImproveAvgs['jobimp5_avg']?>, <?=$JobImproveAvgs['jobimp6_avg']?>,  <?=$JobImproveAvgs['jobimp7_avg']?>],
      [<?= $jobImprove1 ?>, <?= $jobImprove2 ?>, <?= $jobImprove3 ?>, <?= $jobImprove4 ?>, <?= $jobImprove5 ?>, <?= $jobImprove6 ?>, <?= $jobImprove7 ?> ],
      28, false, true
    );
    horizbaarChartConfig(
      'orgSupportChart',
      ['Work-Life Balance', 'Training', 'Lifestyle', 'Health Events', 'Fitness Events', 'Advisory', 'Yoga / Meditation session'],
      [<?=$OrgAvgs['orgsup1_avg']?>, <?=$OrgAvgs['orgsup2_avg']?>, <?=$OrgAvgs['orgsup3_avg']?>, <?=$OrgAvgs['orgsup4_avg']?>, <?=$OrgAvgs['orgsup5_avg']?>, <?=$OrgAvgs['orgsup6_avg']?>,  <?=$OrgAvgs['orgsup7_avg']?>],
      [<?= $OrgSup1 ?>, <?= $OrgSup2 ?>, <?= $OrgSup3 ?>, <?= $OrgSup4 ?>, <?= $OrgSup5 ?>, <?= $OrgSup6 ?>, <?= $OrgSup7 ?> ],
      28, false, true
    );
  </script>
  <!--<a href="https://www.wahstory.com/assessments/wellness-assessment.php" class="refer-btn" target="_blank" title="Refer Friend for Assessment">Refer Friend</a>-->
</body>
</html>


