<?php
// Trait mapping for 40 questions (adjust as per your actual mapping)
$trait_mapping = [
    1 => ['Communicate ideas clearly', 'Professional Communication'],
    2 => ['Give impactful presentations', 'Professional Communication'],
    3 => ['Establishing Presence', 'Give impactful presentations'],
    4 => ['Professional Communication', 'Interpersonal Communication'],
    5 => ['Socialize without difficult', 'Interpersonal Communication'],
    6 => ['Navigating Uncertainties', 'Crafting a Vision of future'],
    7 => ['Creativity, originality & Initiative', 'Inclusive leadership'],
    8 => ['Built a networking web', 'Relationship Management'],
    9 => ['Diversity, Inclusion and Belonging', 'Inclusive leadership'],
    10 => ['Creativity, originality & Initiative', 'Overcome creative blockage'],
    11 => ['Trust building', 'Interpersonal Communication'],
    12 => ['Increase accountability', 'Authenticity'],
    13 => ['Diversity, Inclusion and Belonging', 'Condition Positive Attitude / Happiness'],
    14 => ['Increase accountability', 'Enhance productivity/Build high performing Teams'],
    15 => ['Diversity, Inclusion and Belonging', 'Fostering team-building spirits/ Motivating & Inspiring'],
    16 => ['Breakthrough Feedback', 'Analytical Thinking'],
    17 => ['Navigating Change', 'Resilience, Stress Tolerance & Flexibility'],
    18 => ['Enhance productivity/Build high performing Teams', 'Fostering team-building spirits/ Motivating & Inspiring'],
    19 => ['Collaborating & Leading Remotely', 'Trust building'],
    20 => ['Fostering team-building spirits/ Motivating & Inspiring', 'Inclusive leadership'],
    21 => ['Breakthrough Feedback', 'Enhancing self confidence'],
    22 => ['Collaborating & Leading Remotely', 'Enhance productivity/Build high performing Teams'],
    23 => ['Overpower challenging events/conflict, alignment, cascading', 'Trust building'],
    24 => ['Explore your possibilities', 'Strengthen your imagination/ Innovation'],
    25 => ['Knowledge Of performance/operating on your edge', 'Analytical Thinking'],
    26 => ['Subdue mid-life crisis', 'Resilience, Stress Tolerance & Flexibility'],
    27 => ['Overpower challenging events/conflict, alignment, cascading', 'Interpersonal Communication'],
    28 => ['Crafting a Vision of future', 'Explore your possibilities'],
    29 => ['Overcome creative blockage', 'Creativity, originality & Initiative'],
    30 => ['Authenticity', 'Enhancing self confidence'],
    31 => ['Finding Balance', 'Condition Positive Attitude / Happiness'],
    32 => ['Authenticity', 'Inclusive leadership'],
    33 => ['Resilience, Stress Tolerance & Flexibility', 'Mindfulness & Meditation'],
    34 => ['Mindfulness & Meditation', 'Resilience, Stress Tolerance & Flexibility'],
    35 => ['Condition Positive Attitude / Happiness', 'Mindfulness & Meditation'],
    36 => ['Ensure Physical wellbeing', 'Nutrition & Heathy eating'],
    37 => ['Condition Positive Attitude / Happiness', 'Resilience, Stress Tolerance & Flexibility'],
    38 => ['Develop emotional intelligence', 'Trust building'],
    39 => ['Relationship Management', 'Trust building'],
    40 => ['Nutrition & Heathy eating', 'Ensure Physical wellbeing']
];

// Collect responses from POST, default to 0 if missing
$responses = [];
for ($i = 1; $i <= 40; $i++) {
    $responses[$i] = isset($_POST["q$i"]) ? (int)$_POST["q$i"] : 0;
}

// Aggregate per trait: sum, count, responses collection
$all_traits_with_data = [];
foreach ($trait_mapping as $q => $traits) {
    foreach ($traits as $trait) {
        if (!isset($all_traits_with_data[$trait])) {
            $all_traits_with_data[$trait] = [
                'sum' => 0,
                'count' => 0,
                'responses' => []
            ];
        }
        $score = $responses[$q];
        $all_traits_with_data[$trait]['sum'] += $score;
        $all_traits_with_data[$trait]['count']++;
        $all_traits_with_data[$trait]['responses'][] = $score;
    }
}

// Helper function to calculate population standard deviation
function stats_standard_deviation(array $a) {
    $n = count($a);
    if ($n === 0) return 0;
    $mean = array_sum($a) / $n;
    $sum_sq_diff = 0;
    foreach ($a as $v) {
        $sum_sq_diff += ($v - $mean) ** 2;
    }
    return sqrt($sum_sq_diff / $n);
}

// Prepare trait stats
$trait_averages = [];
foreach ($all_traits_with_data as $trait => $data) {
    $max_possible_score = $data['count'] * 5; // 5 is max per question response scale
    $avg = $data['count'] ? ($data['sum'] / $data['count']) : 0;
    $normalized = $max_possible_score > 0 ? ($data['sum'] / $max_possible_score) * 100 : 0;
    $trait_averages[$trait] = [
        'average' => $avg,
        'max' => max($data['responses']),
        'stddev' => stats_standard_deviation($data['responses']),
        'count' => $data['count'],
        'normalized_score' => $normalized
    ];
}

// Sort descending by tiebreakers for Top 5 traits
uasort($trait_averages, function($a, $b) {
    if ($a['average'] != $b['average']) {
        return ($a['average'] > $b['average']) ? -1 : 1;
    }
    if ($a['max'] != $b['max']) {
        return ($a['max'] > $b['max']) ? -1 : 1;
    }
    if ($a['count'] != $b['count']) {
        return ($a['count'] > $b['count']) ? -1 : 1;
    }
    // Lowest stddev wins if everything else tied
    if ($a['stddev'] != $b['stddev']) {
        return ($a['stddev'] < $b['stddev']) ? -1 : 1;
    }
    return 0;
});
$top5 = array_slice($trait_averages, 0, 5, true);

// Sort ascending by tiebreakers for Bottom 5 traits
uasort($trait_averages, function($a, $b) {
    if ($a['average'] != $b['average']) {
        return ($a['average'] < $b['average']) ? -1 : 1;
    }
    if ($a['max'] != $b['max']) {
        return ($a['max'] < $b['max']) ? -1 : 1;
    }
    if ($a['count'] != $b['count']) {
        return ($a['count'] < $b['count']) ? -1 : 1;
    }
    if ($a['stddev'] != $b['stddev']) {
        return ($a['stddev'] > $b['stddev']) ? -1 : 1;
    }
    return 0;
});
$bottom5 = array_slice($trait_averages, 0, 5, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Quiz Results</title>
<style>
  body {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin: 20px;
    background-color: #f4f7fa;
    color: #333;
  }
  h1, h2 {
    color: #2c3e50;
  }
  table {
    border-collapse: collapse;
    width: 90%;
    max-width: 900px;
    margin-bottom: 40px;
    background: white;
    box-shadow: 0 0 12px rgba(0,0,0,0.1);
  }
  th, td {
    border: 1px solid #ddd;
    padding: 10px 15px;
    text-align: left;
  }
  th {
    background-color: #3498db;
    color: white;
  }
  .meter {
    height: 15px;
    background: #ddd;
    border-radius: 8px;
    overflow: hidden;
    width: 140px;
  }
  .meter-fill {
    height: 100%;
    background: linear-gradient(90deg, #e74c3c, #f1c40f, #2ecc71);
    width: 0;
    transition: width 1.2s ease-in-out;
  }
  /* Add responsiveness */
  @media (max-width: 700px) {
    table {
      width: 100%;
    }
    .meter {
      width: 100px;
    }
  }
</style>
</head>
<body>

<h1>Your Quiz Results</h1>

<h2>All Trait Scores (out of 100%)</h2>
<table>
  <thead>
    <tr>
      <th>Trait</th>
      <th>Score (%)</th>
      <th>Graphical Meter</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($trait_averages as $traitName => $data):
        $score = round($data['normalized_score'], 1);
    ?>
    <tr>
      <td><?= htmlspecialchars($traitName) ?></td>
      <td><?= $score ?>%</td>
      <td>
        <div class="meter">
          <div class="meter-fill" style="width: <?= $score ?>%;"></div>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<h2>Top 5 Traits</h2>
<table>
  <thead>
    <tr>
      <th>Rank</th>
      <th>Trait</th>
      <th>Average</th>
      <th>Normalized Score (%)</th>
    </tr>
  </thead>
  <tbody>
    <?php $rank = 1; foreach ($top5 as $traitName => $data): ?>
    <tr>
      <td><?= $rank++ ?></td>
      <td><?= htmlspecialchars($traitName) ?></td>
      <td><?= round($data['average'], 2) ?></td>
      <td><?= round($data['normalized_score'], 1) ?>%</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<h2>Bottom 5 Traits</h2>
<table>
  <thead>
    <tr>
      <th>Rank</th>
      <th>Trait</th>
      <th>Average</th>
      <th>Normalized Score (%)</th>
    </tr>
  </thead>
  <tbody>
    <?php $rank = 1; foreach ($bottom5 as $traitName => $data): ?>
    <tr>
      <td><?= $rank++ ?></td>
      <td><?= htmlspecialchars($traitName) ?></td>
      <td><?= round($data['average'], 2) ?></td>
      <td><?= round($data['normalized_score'], 1) ?>%</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<p><a href="quiz.php">Retake Quiz</a></p>

</body>
</html>
