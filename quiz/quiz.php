<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leadership & Well-being Assessment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background: #fff;
      font-family: 'Segoe UI', Arial, sans-serif;
      font-size: 1.2em;
      margin: 0;
      padding: 0;
      color: #111;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }
    .form-container {
      width: 700px;
      max-width: 98vw;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(0,103,218,0.08);
      padding: 40px 48px;
      margin-top: 40px;
      box-sizing: border-box;
      border: 2px solid #f0f0f0;
    }
    h1 {
      text-align: center;
      color: #0067da;
      margin-bottom: 32px;
      font-size: 2.2em;
      font-weight: 700;
    }
    .progress-container {
      width: 100%;
      height: 10px;
      background: #f0f0f0;
      border-radius: 6px;
      margin: 24px 0;
      overflow: hidden;
      border: 1px solid #e0e0e0;
    }
    .progress-bar {
      height: 100%;
      background: #0067da;
      border-radius: 6px;
      width: 0%;
      transition: width 0.4s;
    }
    .question-counter {
      text-align: center;
      color: #0067da;
      font-weight: 600;
      margin-bottom: 20px;
      font-size: 1.1em;
    }
    .category-section {
      text-align: center;
      margin-bottom: 24px;
      padding: 18px 0 6px 0;
      color: #0067da;
      font-size: 1.5em;
      font-weight: 700;
      letter-spacing: 0.01em;
      display: none;
    }
    .category-section.active {
      display: block;
    }
    .form-group {
      display: none;
      animation: fadeIn 0.3s;
    }
    .form-group.active {
      display: block;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .question-label {
      font-weight: 600;
      margin-bottom: 20px;
      color: #111;
      font-size: 1.15em;
      line-height: 1.4;
    }
    .question-number {
      color: #0067da;
      font-weight: bold;
      margin-right: 8px;
      font-size: 1.1em;
    }
    .option-row {
      display: flex;
      justify-content: space-between;
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      background: #fafcff;
      margin-top: 15px;
      overflow: hidden;
      user-select: none;
      box-shadow: 0 2px 8px rgba(0,103,218,0.04);
    }
    .option-row label {
      flex: 1 1 0;
      text-align: center;
      padding: 20px 0;
      margin: 0;
      border-right: 2px solid #e0e0e0;
      cursor: pointer;
      font-size: 1.2em;
      font-weight: 600;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #fafcff;
      color: #111;
    }
    .option-row label:last-child {
      border-right: none;
    }
    .option-row label:hover {
      background: #e3f1fd;
      color: #0067da;
    }
    .option-row input[type="radio"] {
      display: none;
    }
    .option-row input[type="radio"]:checked + span {
      color: #fff;
      background: #0067da;
      font-weight: bold;
      border-radius: 8px;
      padding: 12px;
      box-shadow: 0 4px 12px rgba(0,103,218,0.15);
      transform: scale(1.05);
    }
    .option-row span {
      display: block;
      width: 100%;
      transition: all 0.2s;
    }
    .scale-labels {
      display: flex;
      justify-content: space-between;
      font-size: 0.95em;
      margin-top: 8px;
      color: #444;
      font-weight: 500;
    }
    .nav-buttons {
      margin-top: 40px;
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }
    button {
      font-size: 1.1em;
      padding: 14px 32px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: all 0.2s;
      font-weight: 600;
      background: #0067da;
      color: #fff;
      box-shadow: 0 2px 8px rgba(0,103,218,0.08);
    }
    .prev-btn {
      background: #111;
      color: #fff;
    }
    .prev-btn:hover:not(:disabled) {
      background: #333;
    }
    .next-btn:hover:not(:disabled) {
      background: #0053b3;
    }
    .submit-btn {
      background: #111;
      color: #fff;
    }
    .submit-btn:hover {
      background: #333;
    }
    button:disabled {
      background: #e0e0e0;
      color: #aaa;
      cursor: not-allowed;
      box-shadow: none;
    }
    @media (max-width: 800px) {
      .form-container {
        padding: 20px;
        margin-top: 20px;
      }
      .option-row {
        flex-direction: column;
      }
      .option-row label {
        border-right: none;
        border-bottom: 2px solid #e0e0e0;
      }
      .option-row label:last-child {
        border-bottom: none;
      }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Leadership & Well-being Assessment</h1>
    <div class="progress-container">
      <div class="progress-bar" id="progress"></div>
    </div>
    <div class="question-counter" id="counter">Question 1 of 40</div>
    <div class="category-section" id="category-header"></div>
    <form id="assessmentForm" method="post" action="results.php">
      <!-- Questions will be inserted here by JavaScript -->
    
    <div class="nav-buttons">
      <button type="button" class="prev-btn" id="prevBtn">← Previous</button>
      <button type="button" class="next-btn" id="nextBtn">Next →</button>
      <button type="submit" class="submit-btn" id="submitBtn" style="display: none;">Submit Assessment</button>
      </form>
    </div>
  </div>
<script>
const questions = [
  // COMMUNICATION
  ["I communicate my ideas clearly and effectively", "Communication"],
  ["I give impactful presentations that engage my audience.", "Communication"],
  ["I establish a strong presence in professional settings.", "Communication"],
  ["I communicate professionally in all situations.", "Communication"],
  ["I communicate effectively in social situations.", "Communication"],

  // COLLABORATION
  ["Creating detailed contingency plans comes naturally to me", "Collaboration"],
  ["I enjoy brainstorming sessions that combine different perspectives", "Collaboration"],
  ["I build and maintain a strong professional network", "Collaboration"],
  ["I foster diversity and inclusion in my team.", "Collaboration"],
  ["I use creativity to overcome challenges at work.", "Collaboration"],
  ["I build trust through consistent and honest communication.", "Collaboration"],
  ["I hold myself accountable for my actions and results.", "Collaboration"],
  ["I seek to understand and embrace diversity.", "Collaboration"],
  ["I hold myself accountable and encourage accountability in others.", "Collaboration"],
  ["I foster a positive and inclusive team culture.", "Collaboration"],

  // LEADERSHIP
  ["I regularly seek feedback to improve my leadership approach", "Leadership"],
  ["I adapt quickly to changes in my work environment", "Leadership"],
  ["I motivate my team to achieve high performance", "Leadership"],
  ["I collaborate effectively with remote team members.", "Leadership"],
  ["I encourage team-building and motivation.", "Leadership"],
  ["I use feedback to continuously improve.", "Leadership"],
  ["I lead remote teams with confidence.", "Leadership"],

  // NAVIGATE LIFE
  ["I feel confident mediating conflicts between team members", "Navigate Life"],
  ["I am open to exploring new possibilities and ideas.", "Navigate Life"],
  ["I analyze performance data to improve outcomes.", "Navigate Life"],
  ["I navigate mid-life challenges with resilience.", "Navigate Life"],
  ["I manage conflicts with empathy and fairness.", "Navigate Life"],
  ["I plan for the future with a clear vision.", "Navigate Life"],
  ["I am proactive in overcoming creative blocks.", "Navigate life"],

  // SELF ASSESSMENT
  ["I am authentic and true to myself in my actions.", "Self Assessment"],
  ["I balance work and personal life effectively.", "Self Assessment"],
  ["I lead with authenticity and integrity.", "Self Assessment"],
  ["I stay calm and focused under pressure.", "Self Assessment"],

  // WELL BEING
  ["I consciously practice mindfulness when facing stress", "Well being"],
  ["I handle stressful situations with calm and focus.", "Well being"],
  ["I manage my physical wellbeing through regular exercise.", "Well being"],
  ["I maintain a positive attitude even in difficult times.", "Well being"],
  ["I maintain emotional intelligence in difficult conversations.", "Well being"],
  ["I build strong relationships based on trust.", "Well being"],
  ["I maintain a healthy diet to support my wellbeing.", "Well being"]
];

const categoryDisplay = {
  "Communication": "Communication",
  "Collaboration": "Collaboration",
  "Leadership": "Leadership",
  "Navigate Life": "Navigate Life",
  "Self Assessment": "Self Assessment",
  "Well being": "Well-being"
};

const form = document.getElementById('assessmentForm');
questions.forEach((q, idx) => {
  const [text, category] = q;
  const div = document.createElement('div');
  div.className = 'form-group';
  div.setAttribute('data-step', idx);
  div.setAttribute('data-category', category);
  if (idx === 0) div.classList.add('active');
  div.innerHTML = `
    <div class="question-label">
      <span class="question-number">${idx + 1}.</span>
      ${text}
    </div>
    <div class="option-row">
      <label><input type="radio" name="q${idx+1}" value="1"><span>1</span></label>
      <label><input type="radio" name="q${idx+1}" value="2"><span>2</span></label>
      <label><input type="radio" name="q${idx+1}" value="3"><span>3</span></label>
      <label><input type="radio" name="q${idx+1}" value="4"><span>4</span></label>
      <label><input type="radio" name="q${idx+1}" value="5"><span>5</span></label>
    </div>
    <div class="scale-labels">
      <span>Strongly Disagree</span>
      <span>Strongly Agree</span>
    </div>
  `;
  form.appendChild(div);
});

const formGroups = Array.from(document.querySelectorAll('.form-group'));
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');
const progressBar = document.getElementById('progress');
const counter = document.getElementById('counter');
const categoryHeader = document.getElementById('category-header');
let currentStep = 0;
const totalSteps = formGroups.length;

function showStep(step) {
  formGroups.forEach((group, i) => {
    group.classList.toggle('active', i === step);
  });
  const cat = formGroups[step].getAttribute('data-category');
  categoryHeader.textContent = categoryDisplay[cat] || cat;
  categoryHeader.classList.add('active');
  if (step === 0 || questions[step][1] !== questions[step-1][1]) {
    categoryHeader.style.display = 'block';
  } else {
    categoryHeader.style.display = 'none';
  }
  counter.textContent = `Question ${step + 1} of ${totalSteps}`;
  progressBar.style.width = ((step + 1) / totalSteps) * 100 + '%';
  prevBtn.disabled = step === 0;
  nextBtn.style.display = step === totalSteps - 1 ? 'none' : 'inline-block';
  submitBtn.style.display = step === totalSteps - 1 ? 'inline-block' : 'none';
  updateNextButton();
}
function isAnswered(step) {
  const radios = formGroups[step].querySelectorAll('input[type="radio"]');
  return Array.from(radios).some(r => r.checked);
}
function updateNextButton() {
  if (currentStep < totalSteps - 1) {
    nextBtn.disabled = !isAnswered(currentStep);
  }
}
formGroups.forEach((group, idx) => {
  const radios = group.querySelectorAll('input[type="radio"]');
  radios.forEach(radio => {
    radio.addEventListener('change', () => {
      if (idx === currentStep) updateNextButton();
    });
  });
});
prevBtn.addEventListener('click', () => {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
});
nextBtn.addEventListener('click', () => {
  if (currentStep < totalSteps - 1 && isAnswered(currentStep)) {
    currentStep++;
    showStep(currentStep);
  } else if (!isAnswered(currentStep)) {
    alert('Please select an answer before proceeding.');
  }
});
form.addEventListener('submit', (e) => {
  // Temporarily remove this check to ensure submission happens
  // if (!isAnswered(currentStep)) {
  //   e.preventDefault();
  //   alert('Please answer the final question before submitting.');
  // }
});
showStep(0);
</script>
</body>
</html>
