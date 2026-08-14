<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta name="theme-color" content="#191819" />
  <title>Wellness Dashboard • WAHClub</title>
  <!-- Google Fonts: Inter for sharp, readable UI — add more if needed -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <!-- Material Icons for universal medicine, wellness, fitness glyphs -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <style>
/* ========= GLOBAL ROOT: COLOR VARIABLES ========= */
:root {
  /* Primary Colors */
  --brand-primary: #343434;
  --brand-dark: #191819;
  --brand-accent: #e9204f;
  --brand-blue: #3096da;
  --brand-black: #000000;

  /* Derived/Dark Mode Adjustments */
  --brand-primary-lite: #1e1e1e;
  --brand-accent-lite: #3a1a22;
  --brand-blue-lite: #1a2e40;

  --success: #28a745;
  --error: #ff5c5c;
  --warning: #ffc107;

  --gray-dark: #e0e0e0;
  --gray-base: #aaaaaa;
  --gray-lite: #555555;
  --gray-pale: #2a2a2a;

  --text-main: #e0e0e0;
  --border-default: #3a3a3a;

  --bg-main: #191819;
  --bg-card: #343434;
  --bg-highlight: #2a2a2a;

  --card-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
  --radius-lg: 16px;
  --radius-md: 12px;
  --radius-sm: 6px;
  --shadow: 0 2px 8px rgba(0,0,0,0.3);
  --shadow-card: 0 4px 16px rgba(0, 0, 0, 0.4);
  --transition: 0.17s cubic-bezier(.27,.36,.22,.99);
}

/* Base */
html, body {
  background: var(--bg-main);
  color: var(--text-main);
  font-family: 'Inter', system-ui, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.6;
  transition: background 0.4s, color 0.16s;
}

/* Scrollbars */
::-webkit-scrollbar {
  width: 8px;
  background: var(--gray-pale);
}
::-webkit-scrollbar-thumb {
  background: var(--gray-lite);
  border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
  background: var(--gray-base);
}
.scrollbar-thin {
  scrollbar-width: thin;
  scrollbar-color: var(--gray-lite) var(--gray-pale);
}

/* Text Utility */
.text-muted {
  color: var(--gray-base);
}
.text-accent {
  color: var(--brand-accent);
}
.text-error {
  color: var(--error);
}
.text-success {
  color: var(--success);
}

/* Borders */
.border {
  border: 1px solid var(--border-default);
}
hr {
  border-color: var(--border-default);
}

/* Cards / Boxes / Panels */
.card, .box, .section {
  background: var(--bg-card);
  color: var(--text-main);
  border: 1px solid var(--border-default);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-card);
}

/* Links */
a {
  color: var(--brand-accent);
  text-decoration: none;
  transition: color 0.16s;
}
a:hover {
  text-decoration: underline;
}

/* Buttons & Badges */
.bg-brand {
  background: var(--brand-primary);
  color: #fff;
}
.bg-accent {
  background: var(--brand-accent);
  color: #fff;
}
.bg-error {
  background: var(--error);
  color: #fff;
}
.bg-success {
  background: var(--success);
  color: #fff;
}

/* Inputs, Highlights, Other Minor Elements */
input, select, textarea, button {
  background: var(--bg-highlight);
  color: var(--text-main);
  border: 1px solid var(--border-default);
  border-radius: var(--radius-sm);
}
/* ========= CSS RESET & BASE ========= */
/* Box-sizing border-box for sanity everywhere */
*, *::before, *::after { box-sizing: border-box; }

html {
  font-size: 14px; /* Reduced from 16px to fix zoom issue */
}

html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  background: var(--bg-main);
  color: var(--gray-dark);
  font-family: 'Inter', system-ui, Arial, sans-serif;
  /* Opt-in modern font rendering */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  line-height: 1.6;
  scroll-behavior: smooth;
  transition: background 0.4s, color 0.16s;
}

body {
  min-height: 100vh;
}

/* Remove outlines except for keyboard nav (a11y) */
*:focus:not(:focus-visible) {
  outline: none;
}

/* Hide default scrollbars, add pretty one */
::-webkit-scrollbar { width: 8px; background: #f8f9fa; }
::-webkit-scrollbar-thumb { background: #dee2e6; border-radius: 4px; }
::-webkit-scrollbar-thumb:hover { background: #adb5bd; }
.scrollbar-thin { scrollbar-width: thin; scrollbar-color: #dee2e6 #f8f9fa; }

/* Universal link styles */
a { color: var(--brand-accent); text-decoration: none; transition: color .16s; }
a:hover { text-decoration: underline; }

img { max-width: 100%; border-radius: var(--radius-sm); display: block; }
ul, ol { margin: 0; padding-left: 1.3em; }
button, input, select, textarea {
  font-family: inherit;
  font-size: inherit;
  background: none;
  border: none;
  outline: none;
  padding: 0;
}

.material-icons { font-size: 1.25em; vertical-align: middle; line-height: 1 !important; user-select: none; }

/* ========= TYPOGRAPHY SYSTEM ========= */
h1, .h1      { font-size: 2rem; font-weight: 800; margin: 0 0 0.5em 0; letter-spacing: -0.5px; }
h2, .h2      { font-size: 1.5rem; font-weight: 700; margin: 0 0 0.5em 0; letter-spacing: -0.3px;}
h3, .h3      { font-size: 1.25rem; font-weight: 600; margin: 0 0 0.3em 0;}
h4, .h4      { font-size: 1.1rem; font-weight: 600; margin: 0 0 0.23em 0;}
h5, .h5      { font-size: 1rem; font-weight: 600; margin: 0;}
h6, .h6      { font-size: 0.9rem; font-weight: 600; margin: 0;}

strong       { font-weight: 700; }
small        { font-size: 0.85rem; color: var(--gray-base); }

/* Soft UI cards */
.card, .card-ui {
  background: var(--bg-card);
  box-shadow: var(--shadow-card);
  border-radius: var(--radius-lg);
  padding: 20px 24px;
  transition: box-shadow var(--transition);
}

.card-ui.thin { padding: 12px 16px; }
.card-ui.hoverable:hover { box-shadow: 0 8px 24px 0 rgba(25,24,25,0.12), 0 0px 0px #fff; }

.bg-brand    { background: var(--brand-primary); color: #fff;}
.bg-accent   { background: var(--brand-accent); color: #fff;}
.bg-card     { background: var(--bg-card);}
.bg-highlight{ background: var(--bg-highlight);}
.bg-pale     { background: var(--gray-pale);}
.bg-error    { background: var(--error); color: #fff;}
.bg-success  { background: var(--success); color: #fff;}

/* Utility: Rounding, Spacing, Flex */
.rounded-lg  { border-radius: var(--radius-lg);}
.rounded-md  { border-radius: var(--radius-md);}
.rounded-sm  { border-radius: var(--radius-sm);}
.shadow      { box-shadow: var(--shadow);}
.shadow-card { box-shadow: var(--shadow-card);}
.mt-1 { margin-top: 8px; }   .mt-2 { margin-top: 16px; }
.mb-1 { margin-bottom: 8px; } .mb-2 { margin-bottom: 16px; }
.px-2 { padding-left:16px;padding-right:16px;}
.py-2 { padding-top:12px;padding-bottom:12px;}
.text-muted { color: var(--gray-base);}
.text-accent { color: var(--brand-accent);}
.text-success { color: var(--success);}
.text-error { color: var(--error);}
.d-flex { display: flex; }
.flex-1 { flex: 1 1 0; }
.items-center { align-items: center;}
.space-x-1 > * + * { margin-left: 8px;}
.space-y-1 > * + * { margin-top: 8px;}
.justify-between { justify-content: space-between; }

/* ========= GRID SKELETON ========= */
.dashboard-grid {
  display: grid;
  grid-template-columns: 240px 1fr 320px;
  gap: 20px;
  width: 100vw; 
  min-height: 100vh;
  padding: 24px;
  /* Natural page background */
  background: var(--bg-main);
}

@media (max-width: 1200px) {
  .dashboard-grid { grid-template-columns: 200px 1fr 200px; }
}
@media (max-width: 950px) {
  .dashboard-grid { grid-template-columns: 1fr; gap: 12px; padding: 12px;}
  aside.sidebar { display: none; }
  aside.sidepanel, main.main { max-width: 99vw; }
}
@media (max-width: 700px) {
  main.main { padding: 8px; }
}

aside.sidebar,
aside.sidepanel {
  background: var(--bg-card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-card);
  min-width: 200px;
  min-height: 80vh;
  display: flex;
  flex-direction: column;
  padding: 24px 16px;
  transition: box-shadow var(--transition);
  position: relative;
}

@media (max-width: 650px){
  .dashboard-grid { padding: 2vw; }
}

main.main {
  background: var(--bg-card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-card);
  min-height: 83vh;
  padding: 28px;
  display: flex;
  flex-direction: column;
}

/* ========= Animations ========= */
.fade-in {
  animation: fadein .55s cubic-bezier(.4,.25,.2,1);
}
@keyframes fadein {
  0% { opacity: 0; transform: translateY(15px);}
  88% { opacity: 0.93;}
  100%{ opacity: 1; transform: none;}
}

.sidebar {
  display: flex;
  flex-direction: column;
  min-width: 200px;
  max-width: 260px;
  padding: 28px 16px 24px 16px;
  background: var(--bg-card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-card);
  transition: box-shadow var(--transition);
  gap: 16px;
}
.sidebar-logo-area {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 12px;
}
.sidebar-link {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 10px;
  font-weight: 600;
  color: var(--gray-base);
  transition: background 0.16s, color 0.14s;
  font-size: 1rem;
  margin-bottom: 6px;
  letter-spacing: 0.02em;
  outline: none;
}
.sidebar-link .menu-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--bg-highlight);
  color: var(--brand-primary);
  font-size: 1.1em;
  box-shadow: 0 2px 8px rgba(52,52,52,0.06);
}
.sidebar-link.active,
.sidebar-link:hover {
  background: var(--brand-primary-lite);
  color: var(--brand-primary);
  box-shadow: 0 2px 8px rgba(52,52,52,0.08);
}
.sidebar-link.active .menu-icon,
.sidebar-link:hover .menu-icon {
  background: var(--brand-primary);
  color: #fff;
  box-shadow: 0 3px 12px rgba(52,52,52,0.12);
}
.sidebar-link .menu-title {
  font-size: 1rem;
}
.sidebar-promo {
  margin-top: auto;
  margin-bottom: 8px;
  background: var(--brand-accent-lite);
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(233,32,79,0.08);
  padding: 16px 12px;
  font-size: 1rem;
  color: var(--brand-accent);
  transition: box-shadow .17s;
}

.trend-card, .macro-card, .recommendation-card, .insight-card, .mood-card, .sleep-qual-card, .exercise-card {
  transition: box-shadow .18s, transform .18s;
}
.card-ui.hoverable:hover,
.menu-carousel-card.hoverable:hover,
.exercise-card.hoverable:hover {
  box-shadow: 0 8px 24px rgba(25,24,25,0.12), 0 0px 0px #fff;
  transform: translateY(-2px) scale(1.01);
}

/* Carousel scroll improvements */
.carousel-wrap::-webkit-scrollbar {height:0!important;}

/* Cards in carousels */
.menu-carousel-card, .exercise-card {
  cursor: pointer;
}

.sidepanel {
  display: flex;
  flex-direction: column;
  gap: 18px;
  background: var(--bg-card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-card);
  padding: 24px 20px;
  min-width: 250px;
  max-width: 320px;
  min-height: 80vh;
  overflow: hidden;
  user-select: none;
}

.usercard img {
  object-fit: cover;
  box-shadow: 0 4px 16px rgba(52,52,52,0.15);
  border: 2px solid var(--brand-primary-lite);
}

.side-section-title {
  font-weight: 700;
  font-size: 1.1rem;
  color: var(--brand-primary);
  margin-bottom: 8px;
  user-select: text;
}

.calendar-days {
  display: flex;
  gap: 8px;
  overflow-x: auto;
  padding-bottom: 6px;
}

.calendar-days::-webkit-scrollbar {
  height: 6px;
}
.calendar-days::-webkit-scrollbar-thumb {
  background: var(--brand-primary-lite);
  border-radius: 4px;
}
.calendar-days::-webkit-scrollbar-track {
  background: var(--bg-main);
  border-radius: 4px;
}

.calendar-day {
  flex: 1 0 30px;
  height: 30px;
  background: var(--brand-primary-lite);
  color: var(--brand-primary);
  border-radius: 8px;
  font-weight: 600;
  font-size: 1rem;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: background 0.22s, color 0.22s;
  user-select: none;
  box-shadow: 0 0 0 0px transparent;
}
.calendar-day.today, .calendar-day:hover {
  background: var(--brand-primary);
  color: #fff;
  box-shadow: 0 2px 8px rgba(52,52,52,0.2);
}

.today-meals-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.meal-item {
  border-radius: 8px;
  padding: 8px 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 600;
  user-select: text;
}

.meal-label {
  min-width: 80px;
}
.meal-info {
  flex: 1;
  font-weight: 500;
  text-align: right;
  font-size: 0.9rem;
  color: var(--gray-base);
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

.activity-feed {
  overflow-y: auto;
  max-height: 240px;
  padding-right: 6px;
  user-select: text;
}

.activity-feed::-webkit-scrollbar {
  width: 8px;
}
.activity-feed::-webkit-scrollbar-thumb {
  background: var(--gray-lite);
  border-radius: 4px;
}

/* ========= End Section 1 ========= */

  </style>
</head>
<body>
  <div class="dashboard-grid">
    <!-- Section 2: Sidebar Navigation -->
<aside class="sidebar fade-in">
  <div class="sidebar-logo-area">
    <span class="sidebar-logo-icon bg-brand" style="border-radius:50%;padding:6px 8px;display:inline-block;background:var(--brand-primary);">
      <span class="material-icons" style="font-size:1.5rem;color:#fff;">spa</span>
    </span>
    <span class="sidebar-logo-txt" style="font-size:1.2rem;font-weight:800;margin-left:10px;color:var(--brand-primary);vertical-align:middle;letter-spacing:.5px;user-select:none;">
      WAHClub
    </span>
  </div>
  <nav class="sidebar-menu mt-2">
    <ul style="margin:16px 0 0 0;list-style:none;padding:0;">
      <li>
        <a class="sidebar-link active" href="#">
          <span class="menu-icon bg-brand" style="background:var(--brand-primary-lite);">
            <span class="material-icons">dashboard</span>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li>
        <a class="sidebar-link" href="#">
          <span class="menu-icon bg-brand" style="background:var(--brand-blue-lite);color:var(--brand-blue);">
            <span class="material-icons">calendar_today</span>
          </span>
          <span class="menu-title">Calendar</span>
        </a>
      </li>
      <li>
        <a class="sidebar-link" href="#">
          <span class="menu-icon bg-brand" style="background:var(--brand-primary-lite);color:var(--brand-primary);">
            <span class="material-icons">restaurant</span>
          </span>
          <span class="menu-title">Nutrition</span>
        </a>
      </li>
      <li>
        <a class="sidebar-link" href="#">
          <span class="menu-icon bg-brand" style="background:var(--brand-accent);color:#fff;">
            <span class="material-icons">favorite</span>
          </span>
          <span class="menu-title">Wellness</span>
        </a>
      </li>
      <li>
        <a class="sidebar-link" href="#">
          <span class="menu-icon bg-brand" style="background:var(--brand-accent-lite);color:var(--brand-accent);">
            <span class="material-icons">insights</span>
          </span>
          <span class="menu-title">Insights</span>
        </a>
      </li>
      <li>
        <a class="sidebar-link" href="#">
          <span class="menu-icon" style="background:var(--brand-blue-lite);color:var(--brand-blue);">
            <span class="material-icons">insert_chart</span>
          </span>
          <span class="menu-title">Progress</span>
        </a>
      </li>
      <li>
        <a class="sidebar-link" href="#">
          <span class="menu-icon" style="background:var(--bg-highlight);color:var(--gray-dark);">
            <span class="material-icons">logout</span>
          </span>
          <span class="menu-title">Logout</span>
        </a>
      </li>
    </ul>
  </nav>
  <div class="sidebar-promo mt-2" style="background:var(--brand-accent-lite);border-radius:12px;padding:16px 12px;margin-top:auto;text-align:center;box-shadow:0 2px 8px rgba(233,32,79,0.08)">
    <span class="material-icons" style="vertical-align:middle;font-size:1.4em;color:var(--brand-accent);">eco</span>
    <br />
    <span style="font-weight:600;color:var(--brand-accent);font-size:1rem;">Free 1-month Pro!</span>
    <div style="color:var(--brand-primary);font-size:0.9rem;margin-top:3px;">Claim your healthy gift 🎁</div>
  </div>
</aside>
    <!-- Section 3: Main Panel -->
   <!-- Section 3: Main Dashboard Panel -->
<main class="main fade-in">

  <!-- Top greeting and search bar -->
  <div class="dashboard-header d-flex items-center justify-between mb-2">
    <div>
      <h1 style="font-size:2rem;font-weight:800;letter-spacing:-0.5px;margin:0 0 4px 0;">Hello, Adam!</h1>
      <div class="text-muted" style="font-size:1.1rem;margin-bottom:3px;letter-spacing:.01em;">
        Let's begin your wellbeing journey
      </div>
    </div>
    <form class="dashboard-search" style="position:relative;max-width:240px;width:100%;">
      <input type="text" placeholder="Search anything..." style="width:100%;padding:10px 36px 10px 14px;border-radius:10px;border:none;background:var(--bg-highlight);box-shadow:0 2px 8px 0 rgba(25,24,25,0.04);font-size:0.95rem;" />
      <span class="material-icons" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:var(--gray-base);">search</span>
    </form>
  </div>

  <!-- KPI/Stats Grid -->
  <div class="kpi-grid d-flex" style="gap:16px;flex-wrap:wrap;margin-bottom:24px;">
    <!-- Weight -->
    <section class="kpi-card card-ui thin d-flex flex-1 items-center" style="min-width:180px;max-width:250px;gap:16px;">
      <span class="material-icons" style="font-size:1.8rem;background:var(--brand-primary-lite);color:var(--brand-primary);padding:12px;border-radius:50%;margin-right:3px;">fitness_center</span>
      <div>
        <div class="kpi-title text-muted" style="font-weight:600;">Weight</div>
        <div class="kpi-value" style="font-size:1.4rem;font-weight:800;margin-top:2px;">78&nbsp;kg</div>
        <div class="kpi-desc" style="color:var(--success);font-size:0.9rem;margin-top:2px;">Goal: 75&nbsp;kg</div>
      </div>
      <div style="margin-left:auto;">
        <svg width="34" height="34" viewBox="0 0 34 34">
          <circle cx="17" cy="17" r="15" fill="none" stroke="#f5f5f5" stroke-width="4"/>
          <circle cx="17" cy="17" r="15" fill="none" stroke="#343434" stroke-width="4" stroke-dasharray="94.2" stroke-dashoffset="20" style="transition:stroke-dashoffset .7s;"/>
        </svg>
        <div class="kpi-ring-val" style="color:var(--brand-primary);font-size:0.9rem;text-align:center;">83%</div>
      </div>
    </section>
    <!-- Steps -->
    <section class="kpi-card card-ui thin d-flex flex-1 items-center" style="min-width:180px;max-width:250px;gap:16px;">
      <span class="material-icons" style="font-size:1.8rem;background:var(--brand-blue-lite);color:var(--brand-blue);padding:12px;border-radius:50%;">directions_walk</span>
      <div>
        <div class="kpi-title text-muted" style="font-weight:600;">Steps</div>
        <div class="kpi-value" style="font-size:1.4rem;font-weight:800;margin-top:2px;">8,050</div>
        <div class="kpi-desc" style="color:var(--brand-blue);font-size:0.9rem;margin-top:2px;">76% to goal</div>
      </div>
      <div style="margin-left:auto;">
        <svg width="34" height="34" viewBox="0 0 34 34">
          <circle cx="17" cy="17" r="15" fill="none" stroke="#e8f4fd" stroke-width="4"/>
          <circle cx="17" cy="17" r="15" fill="none" stroke="#3096da" stroke-width="4" stroke-dasharray="94.2" stroke-dashoffset="23" style="transition:stroke-dashoffset .7s;"/>
        </svg>
        <div class="kpi-ring-val" style="color:var(--brand-blue);font-size:0.9rem;text-align:center;">76%</div>
      </div>
    </section>
    <!-- Sleep -->
    <section class="kpi-card card-ui thin d-flex flex-1 items-center" style="min-width:180px;max-width:250px;gap:16px;">
      <span class="material-icons" style="font-size:1.8rem;background:var(--brand-primary-lite);color:var(--brand-primary);padding:12px;border-radius:50%;">local_hotel</span>
      <div>
        <div class="kpi-title text-muted" style="font-weight:600;">Sleep</div>
        <div class="kpi-value" style="font-size:1.4rem;font-weight:800;margin-top:2px;">6.5&nbsp;h</div>
        <div class="kpi-desc" style="color:var(--brand-primary);font-size:0.9rem;">Goal: 8h</div>
      </div>
      <div style="margin-left:auto;">
        <svg width="34" height="34" viewBox="0 0 34 34">
          <circle cx="17" cy="17" r="15" fill="none" stroke="#f5f5f5" stroke-width="4"/>
          <circle cx="17" cy="17" r="15" fill="none" stroke="#343434" stroke-width="4" stroke-dasharray="94.2" stroke-dashoffset="19" style="transition:stroke-dashoffset .7s;"/>
        </svg>
        <div class="kpi-ring-val" style="color:var(--brand-primary);font-size:0.9rem;text-align:center;">80%</div>
      </div>
    </section>
    <!-- Water -->
    <section class="kpi-card card-ui thin d-flex flex-1 items-center" style="min-width:180px;max-width:250px;gap:16px;">
      <span class="material-icons" style="font-size:1.8rem;background:var(--brand-blue-lite);color:var(--brand-blue);padding:12px;border-radius:50%;">local_drink</span>
      <div>
        <div class="kpi-title text-muted" style="font-weight:600;">Water</div>
        <div class="kpi-value" style="font-size:1.4rem;font-weight:800;margin-top:2px;">0.7&nbsp;L</div>
        <div class="kpi-desc" style="color:var(--brand-blue);font-size:0.9rem;">1.3L to go</div>
      </div>
      <div style="margin-left:auto;">
        <svg width="34" height="34" viewBox="0 0 34 34">
          <circle cx="17" cy="17" r="15" fill="none" stroke="#e8f4fd" stroke-width="4"/>
          <circle cx="17" cy="17" r="15" fill="none" stroke="#3096da" stroke-width="4" stroke-dasharray="94.2" stroke-dashoffset="62" style="transition:stroke-dashoffset .7s;"/>
        </svg>
        <div class="kpi-ring-val" style="color:var(--brand-blue);font-size:0.9rem;text-align:center;">34%</div>
      </div>
    </section>
    <!-- Heart -->
    <section class="kpi-card card-ui thin d-flex flex-1 items-center" style="min-width:180px;max-width:250px;gap:16px;">
      <span class="material-icons" style="font-size:1.8rem;background:var(--brand-accent-lite);color:var(--brand-accent);padding:12px;border-radius:50%;">favorite</span>
      <div>
        <div class="kpi-title text-muted" style="font-weight:600;">Heart Rate</div>
        <div class="kpi-value" style="font-size:1.4rem;font-weight:800;margin-top:2px;">77&nbsp;bpm</div>
        <div class="kpi-desc text-muted" style="font-size:0.9rem;">Normal</div>
      </div>
      <div style="margin-left:auto;">
        <svg width="34" height="34" viewBox="0 0 34 34">
          <circle cx="17" cy="17" r="15" fill="none" stroke="#fef1f4" stroke-width="4"/>
          <circle cx="17" cy="17" r="15" fill="none" stroke="#e9204f" stroke-width="4" stroke-dasharray="94.2" stroke-dashoffset="37" style="transition:stroke-dashoffset .7s;"/>
        </svg>
        <div class="kpi-ring-val" style="color:var(--brand-accent);font-size:0.9rem;text-align:center;">61%</div>
      </div>
    </section>
    <!-- BP -->
  
  <!-- Health Widgets Row -->
  <div class="dashboard-widgets-row d-flex" style="gap:20px;flex-wrap:wrap;margin-bottom:28px;">
    <!-- Calories Intake -->
    <section class="widget-card card-ui d-flex flex-1 items-center" style="min-width:220px;max-width:300px;gap:18px;background:var(--bg-highlight);">
      <span class="material-icons" style="background:var(--brand-accent);color:#fff;padding:14px 15px 14px 13px;border-radius:12px;font-size:2rem;box-shadow:0 4px 12px rgba(233,32,79,0.15);">insights</span>
      <div>
        <div class="widget-title text-muted" style="font-weight:700;">Calories Intake</div>
        <div class="dashboard-ring d-flex items-center" style="gap:8px;margin:4px 0 0 0;">
          <span style="font-size:1.9rem;font-weight:700;color:var(--brand-accent);">1240</span>
          <span class="text-muted" style="font-size:1.1rem;">/ 1750 kcal</span>
        </div>
        <div class="progress-bar" style="margin-top:6px;background:#fef1f4;height:6px;border-radius:4px;width:140px;overflow:hidden;">
          <div style="width:71%;height:6px;background:linear-gradient(90deg,#e9204f,#f14268);transition:width .7s;"></div>
        </div>
      </div>
    </section>
    <!-- Sleep Ring -->
    <section class="widget-card card-ui d-flex flex-1 items-center" style="min-width:220px;max-width:300px;gap:18px;background:var(--brand-primary-lite);">
      <span class="material-icons" style="background:var(--brand-primary);color:#fff;padding:14px 14px 14px 15px;border-radius:12px;font-size:2rem;box-shadow:0 4px 12px rgba(52,52,52,0.15);">local_hotel</span>
      <div>
        <div class="widget-title" style="color:var(--brand-primary);font-weight:700;">Sleep Last Night</div>
        <div style="font-size:1.9rem;font-weight:700;color:var(--brand-primary);">6.5 h</div>
        <div class="progress-bar" style="background:#f5f5f5;height:6px;border-radius:4px;width:140px;overflow:hidden;">
          <div style="width:81%;height:6px;background:linear-gradient(90deg,#343434,#5a5a5a);transition:width .7s;"></div>
        </div>
      </div>
    </section>
    <!-- Steps day chart area -->
    <section class="widget-card card-ui d-flex flex-1 items-center" style="min-width:220px;max-width:300px;gap:18px;">
      <span class="material-icons" style="background:var(--brand-blue);color:#fff;padding:14px 12px 14px 14px;border-radius:12px;font-size:2rem;box-shadow:0 4px 12px rgba(48,150,218,0.12);">show_chart</span>
      <div style="flex:1;">
        <div class="widget-title" style="color:var(--brand-blue);font-weight:700;">Steps History</div>
        <canvas id="stepsSparkLine" width="90" height="24" style="margin:4px 0 0 0;"></canvas>
        <div class="d-flex space-x-1" style="margin-top:2px;font-size:.85rem;">
          <span class="text-muted">Mon</span>
          <span class="text-muted">Tue</span>
          <span class="text-muted">Wed</span>
          <span class="text-muted">Thu</span>
          <span class="text-muted">Fri</span>
          <span class="text-muted">Sat</span>
          <span class="text-muted">Sun</span>
        </div>
      </div>
    </section>
  </div>

  <!-- Workout Progress & Recommendations -->
  <div class="dashboard-progress-wrap d-flex" style="gap:18px;flex-wrap:wrap;align-items:stretch;">
    <!-- Running -->
    <section class="progress-card card-ui thin d-flex flex-1 items-center bg-success" style="background:linear-gradient(93deg,#d4edda 35%,#e8f5e8 100%);box-shadow:0 4px 12px rgba(40,167,69,0.08);min-width:190px;max-width:280px;">
      <span class="material-icons" style="color:var(--success); background:#fff; padding:10px 11px;border-radius:50%;margin-right:8px;font-size:1.3rem;">directions_run</span>
      <div>
        <div style="font-weight:700;font-size:1rem;color:var(--success);">Running</div>
        <div class="text-muted" style="font-size:.9rem;">5 km this week</div>
      </div>
      <div class="ml-auto" style="margin-left:auto;text-align:center;">
        <div style="font-size:1.1rem;font-weight:800;color:var(--success);">75%</div>
        <div class="progress-bar" style="background:#d4edda;height:6px;border-radius:4px;width:60px;margin-top:2px;overflow:hidden;">
          <div style="width:75%;height:6px;background:linear-gradient(90deg,#28a745,#34ce57);"></div>
        </div>
      </div>
    </section>
    <!-- Squats -->
    <section class="progress-card card-ui thin d-flex flex-1 items-center" style="background:linear-gradient(97deg,#fff3cd 35%,#fff8e1 100%);box-shadow:0 4px 12px rgba(255,193,7,0.08);min-width:190px;max-width:280px;">
      <span class="material-icons" style="color:var(--warning); background:#fff; padding:10px 11px;border-radius:50%;margin-right:8px;font-size:1.3rem;">directions_bike</span>
      <div>
        <div style="font-weight:700;font-size:1rem;color:var(--warning);">Squats</div>
        <div class="text-muted" style="font-size:.9rem;">55 reps</div>
      </div>
      <div class="ml-auto" style="margin-left:auto;text-align:center;">
        <div style="font-size:1.1rem;font-weight:800;color:var(--warning);">66%</div>
        <div class="progress-bar" style="background:#fff3cd;height:6px;border-radius:4px;width:60px;margin-top:2px;overflow:hidden;">
          <div style="width:66%;height:6px;background:linear-gradient(90deg,#ffc107,#ffce3d);"></div>
        </div>
      </div>
    </section>
    <!-- Stretch -->
    <section class="progress-card card-ui thin d-flex flex-1 items-center" style="background:linear-gradient(91deg,#f5f5f5 33%,#fafafa 100%);box-shadow:0 4px 12px rgba(52,52,52,0.08);min-width:190px;max-width:280px;">
      <span class="material-icons" style="color:var(--brand-primary); background:#fff; padding:10px 11px;border-radius:50%;margin-right:8px;font-size:1.3rem;">self_improvement</span>
      <div>
        <div style="font-weight:700;font-size:1rem;color:var(--brand-primary);">Stretching</div>
        <div class="text-muted" style="font-size:.9rem;">5 / 10 min</div>
      </div>
      <div class="ml-auto" style="margin-left:auto;text-align:center;">
        <div style="font-size:1.1rem;font-weight:800;color:var(--brand-primary);">50%</div>
        <div class="progress-bar" style="background:#e9ecef;height:6px;border-radius:4px;width:60px;margin-top:2px;overflow:hidden;">
          <div style="width:50%;height:6px;background:linear-gradient(90deg,#343434,#5a5a5a);"></div>
        </div>
      </div>
    </section>
  </div>
  
  <!-- SECTION 4: ADVANCED VISUAL WIDGETS, CHARTS, AND RECOMMENDATIONS -->

<!-- ========== Progress & Trends ========== -->
<div class="dashboard-advanced-grid d-flex" style="gap:24px;flex-wrap:wrap;margin-top:32px;">
  <!-- Weight Trend Chart -->
  <section class="trend-card card-ui" style="min-width:280px;max-width:460px;margin-bottom:18px;background:var(--bg-highlight);padding-bottom:12px;">
    <div class="d-flex items-center justify-between mb-1">
      <div class="h3" style="font-weight:700;letter-spacing:-0.3px;color:var(--brand-primary);">Weight Progress</div>
      <div class="text-muted" style="font-size:0.9rem;">Last 14 days</div>
    </div>
    <canvas id="weightTrendChart" width="420" height="100" aria-label="Weight trend over 2 weeks" role="img"></canvas>
    <div class="d-flex items-center space-x-1 mt-1">
      <span class="material-icons text-success" style="font-size:1.1rem;background:var(--brand-primary-lite);border-radius:6px;padding:2px 6px 2px 5px;">trending_up</span>
      <span style="color:var(--success);font-weight:600;font-size:1rem;">-1.3 kg</span>
      <span class="text-muted">since last week</span>
    </div>
  </section>

  <!-- Heart Rate Chart -->
  <section class="trend-card card-ui" style="min-width:280px;max-width:460px;margin-bottom:18px;background:var(--brand-accent-lite);padding-bottom:12px;">
    <div class="d-flex items-center justify-between mb-1">
      <div class="h3" style="font-weight:700;letter-spacing:-0.3px;color:var(--brand-accent);">Heart Rate</div>
      <div class="text-muted" style="font-size:0.9rem;">Daily avg bpm</div>
    </div>
    <canvas id="hrTrendChart" width="420" height="100" aria-label="Heart rate trend" role="img"></canvas>
    <div class="d-flex items-center space-x-1 mt-1">
      <span class="material-icons" style="font-size:1.1rem;color:#e9204f;">favorite</span>
      <span style="color:var(--brand-accent);font-weight:600;font-size:1rem;">76-81 bpm</span>
      <span class="text-muted">stable</span>
    </div>
  </section>
</div>

<!-- ========== Nutrients + Macros ========== -->
<div class="macro-cards-row d-flex" style="gap:20px;margin-bottom:28px;flex-wrap:wrap;">
  <!-- Macros (Pie chart style) -->
  <section class="macro-card card-ui" style="min-width:220px;max-width:280px;">
    <div class="d-flex items-center justify-between mb-1">
      <div style="font-weight:700;font-size:1rem;color:var(--brand-primary);">Macros</div>
      <span class="material-icons" style="color:var(--brand-primary);background:var(--brand-primary-lite);border-radius:6px;padding:4px 6px 4px 6px;">pie_chart</span>
    </div>
    <canvas id="macroPie" width="110" height="110"></canvas>
    <div class="d-flex space-x-1 mt-1" style="font-size:0.9rem;">
      <span style="color:var(--brand-primary);font-weight:600;">Carbs</span>
      <span style="color:var(--brand-blue);font-weight:600;">Protein</span>
      <span style="color:var(--brand-accent);font-weight:600;">Fats</span>
    </div>
  </section>
  <!-- Water intake -->
  <section class="macro-card card-ui" style="min-width:200px;max-width:240px;background:var(--brand-blue-lite);">
    <div class="d-flex items-center justify-between mb-1">
      <div style="font-weight:700;font-size:1rem;color:var(--brand-blue);">Water Intake</div>
      <span class="material-icons" style="color:var(--brand-blue);background:#fff;border-radius:6px;padding:4px 6px 4px 6px;">local_drink</span>
    </div>
    <div style="font-size:1.8rem;font-weight:800;color:var(--brand-blue);margin-top:16px;margin-bottom:4px;">1.5L</div>
    <div class="progress-bar" style="margin-top:3px;background:#ffffff;height:7px;border-radius:4px;width:90%;overflow:hidden;">
      <div style="width:65%;height:7px;background:linear-gradient(90deg,#3096da,#5faee3);transition:width .7s;"></div>
    </div>
    <div class="d-flex items-center space-x-1 mt-1" style="font-size:0.9rem;">
      <span class="material-icons" style="font-size:1rem;color:#3096da;">add</span>
      <span class="text-muted">250 ml to add</span>
      <span class="material-icons" style="font-size:1rem;color:#3096da;">remove</span>
    </div>
  </section>
  <!-- Calories burned -->
  <section class="macro-card card-ui" style="min-width:200px;max-width:240px;background:var(--brand-accent-lite);">
    <div class="d-flex items-center justify-between mb-1">
      <div style="font-weight:700;font-size:1rem;color:var(--brand-accent);">Calories Burned</div>
      <span class="material-icons" style="color:var(--brand-accent);background:#ffffff;border-radius:6px;padding:4px 6px;">local_fire_department</span>
    </div>
    <div style="font-size:1.8rem;font-weight:800;color:var(--brand-accent);margin-top:16px;margin-bottom:4px;">510</div>
    <div class="progress-bar" style="margin-top:3px;background:#ffffff;height:7px;border-radius:4px;width:90%;overflow:hidden;">
      <div style="width:47%;height:7px;background:linear-gradient(90deg,#e9204f,#ee4669);transition:width .7s;"></div>
    </div>
    <div class="text-muted" style="font-size:.9rem;margin-top:6px;">Target: 1,100 kcal burned</div>
  </section>
</div>

<!-- ========== Recommended Menu Grid (Cards Carousel style) ========== -->
<div class="recommendation-carousel-area" style="margin:32px 0 20px 0;">
  <div class="h3" style="font-weight:700;letter-spacing:-0.3px;color:var(--brand-primary);margin-bottom:12px;">Recommended Menu</div>
  <!-- Carousel Scroll Row -->
  <div class="carousel-wrap" style="display:flex;gap:20px;overflow-x:auto;scroll-snap-type:x mandatory;padding-bottom:4px;">
    <!-- Menu Card 1 -->
    <div class="menu-carousel-card card-ui hoverable" style="min-width:230px;max-width:250px;scroll-snap-align:start;position:relative;">
      <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=80" alt="Oatmeal Breakfast" style="width:100%;height:90px;object-fit:cover;border-radius:10px 10px 12px 12px;margin-bottom:8px;"/>
      <div style="font-weight:700;color:var(--brand-primary);">Oatmeal with Berries</div>
      <div style="color:var(--gray-base);font-size:0.9rem;margin-bottom:4px;">Rich in fiber, great start for the day</div>
      <div class="d-flex space-x-1" style="font-size:.85rem;margin-bottom:2px;">
        <span style="color:var(--brand-primary);font-weight:600;">350 kcal</span>
        <span style="color:var(--brand-blue);">Carb 49g</span>
        <span style="color:var(--brand-accent);">Fat 9g</span>
      </div>
    </div>
    <!-- Menu Card 2 -->
    <div class="menu-carousel-card card-ui hoverable" style="min-width:230px;max-width:250px;scroll-snap-align:start;">
      <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" alt="Salad Lunch" style="width:100%;height:90px;object-fit:cover;border-radius:10px 10px 12px 12px;margin-bottom:8px;"/>
      <div style="font-weight:700;color:var(--brand-blue);">Grilled Chicken Salad Bowl</div>
      <div style="color:var(--gray-base);font-size:0.9rem;margin-bottom:4px;">High protein, minerals & vitamins</div>
      <div class="d-flex space-x-1" style="font-size:.85rem;margin-bottom:2px;">
        <span style="color:var(--brand-blue);font-weight:600;">430 kcal</span>
        <span style="color:var(--brand-primary);">Carb 38g</span>
        <span style="color:var(--brand-accent);">Fat 8g</span>
      </div>
    </div>
    <!-- Menu Card 3 -->
    <div class="menu-carousel-card card-ui hoverable" style="min-width:230px;max-width:250px;scroll-snap-align:start;">
      <img src="https://images.unsplash.com/photo-1464306076886-debca5e8a6b0?w=400&q=80" alt="Dinner Salmon" style="width:100%;height:90px;object-fit:cover;border-radius:10px 10px 12px 12px;margin-bottom:8px;"/>
      <div style="font-weight:700;color:var(--brand-accent);">Baked Salmon and Beans</div>
      <div style="color:var(--gray-base);font-size:0.9rem;margin-bottom:4px;">Omega-3 & antioxidants to end your day</div>
      <div class="d-flex space-x-1" style="font-size:.85rem;margin-bottom:2px;">
        <span style="color:var(--brand-accent);font-weight:600;">510 kcal</span>
        <span style="color:var(--brand-primary);">Carb 26g</span>
        <span style="color:var(--brand-blue);">Protein 35g</span>
      </div>
    </div>
    <!-- Menu Card 4 -->
    <div class="menu-carousel-card card-ui hoverable" style="min-width:230px;max-width:250px;scroll-snap-align:start;">
      <img src="https://images.unsplash.com/photo-1502741338009-cac2772e18bc?w=400&q=80" alt="Snack Bowl" style="width:100%;height:90px;object-fit:cover;border-radius:10px 10px 12px 12px;margin-bottom:8px;"/>
      <div style="font-weight:700;color:var(--brand-primary);">Greek Yogurt & Berries</div>
      <div style="color:var(--gray-base);font-size:0.9rem;margin-bottom:4px;">Snack rich in live cultures & protein</div>
      <div class="d-flex space-x-1" style="font-size:.85rem;margin-bottom:2px;">
        <span style="color:var(--brand-primary);font-weight:600;">210 kcal</span>
        <span style="color:var(--brand-primary);">Carb 19g</span>
        <span style="color:var(--brand-blue);">Protein 12g</span>
      </div>
    </div>
  </div>
</div>

<!-- ========== Recommendations & Insights ========== -->
<div class="insight-recommend-grid d-flex" style="gap:24px;flex-wrap:wrap;">
  <!-- Health Insights Card - Fixed Recommended Exercises Section -->
  <section class="insight-card card-ui" style="min-width:280px;max-width:400px;background:var(--bg-highlight);">
    <div class="h3" style="color:var(--brand-primary);font-weight:700;margin-bottom:12px;">
      Recommended Exercises
    </div>
    <div class="exercises-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <!-- Exercise Card 1 -->
      <div class="exercise-card card-ui hoverable" style="min-width:0;padding:12px;">
        <img src="https://images.unsplash.com/photo-1571731956672-643be09a1d94?w=400&q=80" alt="Walking" style="width:100%;height:70px;object-fit:cover;border-radius:8px;margin-bottom:6px;"/>
        <div class="d-flex items-center space-x-1 mb-1" style="gap:4px;">
          <span class="material-icons" style="color:var(--brand-primary);font-size:1rem;background:var(--brand-primary-lite);border-radius:50%;padding:3px;">directions_walk</span>
          <span style="font-weight:700;color:var(--brand-primary);font-size:0.9rem;">Brisk Walking</span>
        </div>
        <div class="text-muted" style="font-size:0.8rem;">20 min • Cardio</div>
        <div style="margin-top:2px;font-size:0.85rem;color:var(--brand-blue);font-weight:600;">+210 kcal burned</div>
      </div>
      <!-- Exercise Card 2 -->
      <div class="exercise-card card-ui hoverable" style="min-width:0;padding:12px;">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&q=80" alt="Squats" style="width:100%;height:70px;object-fit:cover;border-radius:8px;margin-bottom:6px;"/>
        <div class="d-flex items-center space-x-1 mb-1" style="gap:4px;">
          <span class="material-icons" style="color:var(--brand-accent);font-size:1rem;background:var(--brand-accent-lite);border-radius:50%;padding:3px;">fitness_center</span>
          <span style="font-weight:700;color:var(--brand-accent);font-size:0.9rem;">Bodyweight Squats</span>
        </div>
        <div class="text-muted" style="font-size:0.8rem;">3×15 reps • Strength</div>
        <div style="margin-top:2px;font-size:0.85rem;color:var(--brand-accent);font-weight:600;">+110 kcal burned</div>
      </div>
      <!-- Exercise Card 3 -->
      <div class="exercise-card card-ui hoverable" style="min-width:0;padding:12px;">
        <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?w=400&q=80" alt="Yoga" style="width:100%;height:70px;object-fit:cover;border-radius:8px;margin-bottom:6px;"/>
        <div class="d-flex items-center space-x-1 mb-1" style="gap:4px;">
          <span class="material-icons" style="color:var(--brand-primary);font-size:1rem;background:var(--brand-primary-lite);border-radius:50%;padding:3px;">self_improvement</span>
          <span style="font-weight:700;color:var(--brand-primary);font-size:0.9rem;">Yoga Flexibility</span>
        </div>
        <div class="text-muted" style="font-size:0.8rem;">12 min • Flexibility</div>
        <div style="margin-top:2px;font-size:0.85rem;color:var(--brand-primary);font-weight:600;">Great for balance</div>
      </div>
      <!-- Exercise Card 4 -->
      <div class="exercise-card card-ui hoverable" style="min-width:0;padding:12px;">
        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=400&q=80" alt="Stretching" style="width:100%;height:70px;object-fit:cover;border-radius:8px;margin-bottom:6px;"/>
        <div class="d-flex items-center space-x-1 mb-1" style="gap:4px;">
          <span class="material-icons" style="color:var(--brand-blue);font-size:1rem;background:var(--brand-blue-lite);border-radius:50%;padding:3px;">nordic_walking</span>
          <span style="font-weight:700;color:var(--brand-blue);font-size:0.9rem;">Stretch & Move</span>
        </div>
        <div class="text-muted" style="font-size:0.8rem;">8 min • Mobility</div>
        <div style="margin-top:2px;font-size:0.85rem;color:var(--brand-blue);font-weight:600;">Boosts circulation</div>
      </div>
    </div>
  </section>
</div>

</main>
    <!-- Section 5: Right Side Panel -->
<aside class="sidepanel fade-in" aria-label="User Profile and Daily Overview">
  <!-- User Profile Card -->
  <div class="usercard d-flex items-center" style="gap:12px;padding-bottom:12px;border-bottom:1px solid var(--gray-pale);">
    <img src="https://randomuser.me/api/portraits/men/47.jpg" alt="User Avatar" width="48" height="48" style="border-radius:50%;border:2px solid var(--brand-primary-lite);box-shadow:0 4px 16px rgba(52,52,52,0.15);object-fit: cover;" />
    <div style="flex:1;min-width:0;">
      <div class="name" style="font-weight:700;font-size:1.2rem;line-height:1.15;color:var(--gray-dark);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
        Adam Vasylneko
      </div>
      <div class="role text-muted" style="font-size:0.95rem;line-height:1;color:var(--gray-base);margin-top:2px;">Member</div>
    </div>
    <button aria-label="Notifications" title="Notifications" style="background:none;border:none;cursor:pointer;outline:none;color:var(--gray-base);font-size:1.4rem;line-height:1;transition:color .15s;">
      <span class="material-icons">notifications_none</span>
    </button>
  </div>

  <!-- Calendar Section -->
  <section class="calendar-block" aria-label="Monthly calendar" style="margin-top:20px;">
    <div class="side-section-title" style="font-weight:700;font-size:1.1rem;color:var(--brand-primary);margin-bottom:8px;">
      July 2025
    </div>
    <div class="calendar-days" id="calendarDays" role="list" aria-live="polite" style="display:flex;gap:6px;flex-wrap:nowrap;overflow-x:auto;">
      <!-- Calendar days dynamically generated by JS -->
    </div>
  </section>

  <!-- Today's Meals -->
  <section aria-label="Today's Meals" style="margin-top:24px;">
    <div class="side-section-title" style="font-weight:700;font-size:1.1rem;margin-bottom:10px;color:var(--brand-primary);">
      Today's Meals
    </div>
    <div class="today-meals-list" style="display:flex;flex-direction:column;gap:10px;">
      <div class="meal-item d-flex justify-between items-center" style="background:#d4edda;border-radius:8px;padding:8px 12px;">
        <span class="meal-label" style="color:var(--success);font-weight:700;">Breakfast</span>
        <span class="meal-info" style="color:#155724;font-size:0.9rem;flex-shrink:0;">Scrambled Eggs & Spinach • 300 kcal</span>
      </div>
      <div class="meal-item d-flex justify-between items-center" style="background:var(--brand-primary-lite);border-radius:8px;padding:8px 12px;">
        <span class="meal-label" style="color:var(--brand-primary);font-weight:700;">Lunch</span>
        <span class="meal-info" style="color:var(--brand-primary);font-size:0.9rem;flex-shrink:0;">Grilled Chicken Salad • 420 kcal</span>
      </div>
      <div class="meal-item d-flex justify-between items-center" style="background:var(--brand-accent-lite);border-radius:8px;padding:8px 12px;">
        <span class="meal-label" style="color:var(--brand-accent);font-weight:700;">Snack</span>
        <span class="meal-info" style="color:var(--brand-accent);font-size:0.9rem;flex-shrink:0;">Greek Yogurt & Berries • 210 kcal</span>
      </div>
      <div class="meal-item d-flex justify-between items-center" style="background:var(--brand-blue-lite);border-radius:8px;padding:8px 12px;">
        <span class="meal-label" style="color:var(--brand-blue);font-weight:700;">Dinner</span>
        <span class="meal-info" style="color:var(--brand-blue);font-size:0.9rem;flex-shrink:0;">Baked Salmon & Greens • 510 kcal</span>
      </div>
    </div>
  </section>

  <!-- Activity Feed -->
  <section aria-label="Recent Activity" style="margin-top:24px;flex-grow:1;overflow-y:auto;max-height:48vh;scroll-behavior:smooth;">
    <div class="side-section-title" style="font-weight:700;font-size:1.1rem;color:var(--brand-primary);margin-bottom:10px;">
      Recent Activity
    </div>
    <div id="activityFeed" style="font-size:0.9rem;line-height:1.42;color:var(--gray-base);">
      <div class="activity-item" style="padding:6px 0; border-bottom:1px solid #f0f4f2;">
        ✔️ <strong>8:30 AM:</strong> Met 76% step goal!
      </div>
      <div class="activity-item" style="padding:6px 0; border-bottom:1px solid #f0f4f2;">
        ✔️ <strong>9:10 AM:</strong> Had Breakfast: Scrambled Eggs
      </div>
      <div class="activity-item" style="padding:6px 0; border-bottom:1px solid #f0f4f2;">
        ✔️ <strong>12:40 PM:</strong> Completed 15 min Yoga
      </div>
      <div class="activity-item" style="padding:6px 0;">
        ✔️ <strong>2:00 PM:</strong> Blood Pressure logged
      </div>
    </div>
  </section>
</aside>
  </div>

<script>
// ========== INITIALIZE CHARTS AFTER DOM LOADS ==========
document.addEventListener('DOMContentLoaded', function() {
  // Weight Trend (2 weeks)
  if (document.getElementById('weightTrendChart')) {
    new Chart(document.getElementById('weightTrendChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: [
          'Mon','Tue','Wed','Thu','Fri','Sat','Sun',
          'Mon','Tue','Wed','Thu','Fri','Sat','Sun'
        ],
        datasets: [{
          label: "Weight (kg)",
          data: [79,78.6,78.5,78.2,78.1,78.0,77.7,77.6,77.5,77.3,77.3,77.1,76.9,76.8],
          borderColor: "#343434",
          backgroundColor: "rgba(52,52,52,0.1)",
          tension: .39,
          fill: true,
          pointRadius: 2,
          borderWidth: 3,
        }]
      },
      options: {
        plugins: {legend: {display: false}},
        scales: {
          x: { display: false },
          y: { beginAtZero: false, min: 76, max: 80, grid: {color:'#f5f5f5'}}
        },
        responsive:true
      }
    });
  }

  // Heart Rate Trend (last 14 days)
  if (document.getElementById('hrTrendChart')) {
    new Chart(document.getElementById('hrTrendChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: [
          'Mon','Tue','Wed','Thu','Fri','Sat','Sun',
          'Mon','Tue','Wed','Thu','Fri','Sat','Sun'
        ],
        datasets: [{
          label: "Heart Rate (bpm)",
          data: [80, 78, 77, 79, 77, 75, 78, 77, 78, 76, 78, 79, 76, 77],
          backgroundColor: "#e9204f",
          borderRadius: 6,
          borderWidth: 0
        }]
      },
      options: {
        plugins: {legend: {display: false}},
        scales: {
          x: { display: false },
          y: { beginAtZero: false, min: 73, max: 84, grid: {color:'#fef1f4'}}
        },
        responsive:true
      }
    });
  }

  // Macros Pie
  if (document.getElementById('macroPie')) {
    new Chart(document.getElementById('macroPie').getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ["Carbs", "Protein", "Fats"],
        datasets: [{
          data: [120, 70, 20],
          backgroundColor: ["#343434", "#3096da", "#e9204f"],
          borderWidth: 4,
          borderColor: "#fff"
        }]
      },
      options: {
        cutout: "70%",
        plugins: {
          legend: {display: false}
        }
      }
    });
  }

  // Tiny steps sparkline
  if (document.getElementById("stepsSparkLine")) {
    new Chart(document.getElementById("stepsSparkLine").getContext('2d'),{
      type:'line',
      data:{
        labels:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
        datasets:[{
          data:[6300,8200,7900,8050,9020,10020,9023],
          borderColor:"#3096da",
          pointRadius:0,
          borderWidth:2,
          fill:true,
          backgroundColor:"rgba(48,150,218,0.1)"
        }]
      },
      options:{
        scales:{ x:{display:false}, y:{display:false} },
        plugins:{legend:{display:false}},
        elements:{ line:{tension:.46} },
        responsive:true
      }
    });
  }

  // Initialize other dashboard functions
  initDashboard();
});

function renderCalendarDays() {
  const today = new Date();
  const calendarDaysContainer = document.getElementById('calendarDays');
  if (!calendarDaysContainer) return;
  
  calendarDaysContainer.innerHTML = '';

  // Get first day of the week (Monday as start)
  const currentDate = today.getDate();
  const dayOfWeek = today.getDay(); // Sunday=0, Monday=1,...Saturday=6
  const mondayOffset = (dayOfWeek === 0) ? -6 : 1 - dayOfWeek;
  const startDate = new Date(today);
  startDate.setDate(today.getDate() + mondayOffset);

  for(let i = 0; i < 7; i++) {
    const iterDate = new Date(startDate);
    iterDate.setDate(startDate.getDate() + i);
    const dayNum = iterDate.getDate();

    const dayEl = document.createElement('div');
    dayEl.className = 'calendar-day';
    dayEl.setAttribute('role', 'listitem');
    dayEl.textContent = dayNum;

    // Highlight today
    if(
      iterDate.getDate() === today.getDate() &&
      iterDate.getMonth() === today.getMonth() &&
      iterDate.getFullYear() === today.getFullYear()
    ) {
      dayEl.classList.add('today');
      dayEl.setAttribute('aria-current', 'date');
    }

    calendarDaysContainer.appendChild(dayEl);
  }
}

// ========== UTILITY: Animate Circular Progress Rings ==========
function animateRing(svgCircle, targetPercent, duration = 1200) {
  const radius = svgCircle.r.baseVal.value;
  const circumference = 2 * Math.PI * radius;

  svgCircle.style.strokeDasharray = circumference;
  let start = null;
  let currentOffset = circumference;

  function animate(time) {
    if (!start) start = time;
    const elapsed = time - start;
    let progress = Math.min(elapsed / duration, 1);
    let offset = circumference * (1 - targetPercent * progress / 100);
    svgCircle.style.strokeDashoffset = offset;

    if (progress < 1) {
      requestAnimationFrame(animate);
    } else {
      svgCircle.style.strokeDashoffset = circumference * (1 - targetPercent / 100);
    }
  }
  requestAnimationFrame(animate);
}

// Initialize all circular rings in KPI and widgets
function initProgressRings() {
  const cards = document.querySelectorAll('.kpi-card, .widget-card, .progress-card');
  cards.forEach(card => {
    const svgCircle = card.querySelector('circle:nth-child(2)');
    if (!svgCircle) return;

    let percent = 0;

    // Try data attribute or fallback based on value text parsing
    if (card.dataset.percent) {
      percent = Number(card.dataset.percent);
    } else if(card.querySelector('.kpi-ring-val')) {
      let valEl = card.querySelector('.kpi-ring-val');
      let text = valEl.textContent || "";
      let p = parseInt(text);
      if(!isNaN(p)) percent = p;
    } else {
      // Custom heuristics for main panel circulars
      const val = card.querySelector('.kpi-desc, .kpi-value');
      if(val) {
        const valStr = val.textContent.match(/\d+\.?\d*/);
        if(valStr) {
          percent = Math.min(parseFloat(valStr[0])*1.1, 100);
        }
      }
    }

    if (percent > 0) {
      animateRing(svgCircle, percent);
    }
  });
}

// ========== Animate Horizontal Progress Bars ==========
function animateProgressBars() {
  const progressDivs = document.querySelectorAll('.progress-bar > div');
  progressDivs.forEach(div => {
    let width = div.style.width || '0%';
    if (!width.endsWith('%')) return;

    div.style.width = '0%';
    const target = width;

    setTimeout(() => {
      div.style.transition = 'width 1.2s ease-in-out';
      div.style.width = target;
    }, 10);
  });
}

// ========== Sidebar Navigation Interaction ==========
function initSidebarNavigation() {
  const links = document.querySelectorAll('.sidebar-link');
  links.forEach(link => {
    link.addEventListener('click', e => {
      links.forEach(l => l.classList.remove('active'));
      e.currentTarget.classList.add('active');
      // You can add navigation logic here (e.g., load different dashboard sections)
      e.preventDefault();
    });
  });
}

// ========== Search Input Interactivity ==========
function initSearchFilter() {
  const searchInput = document.querySelector('.dashboard-search input');
  if(!searchInput) return;

  searchInput.addEventListener('input', e => {
    const val = e.target.value.toLowerCase();

    // For demo, filter recommended menus & exercises by name
    const menuCards = document.querySelectorAll('.menu-carousel-card');
    const exerciseCards = document.querySelectorAll('.exercise-card');

    menuCards.forEach(card => {
      const title = card.querySelector('div').textContent.toLowerCase();
      card.style.display = title.includes(val) ? 'block' : 'none';
    });

    exerciseCards.forEach(card => {
      const titleEl = card.querySelector('div.d-flex > span:nth-child(2)');
      if (titleEl) {
        const title = titleEl.textContent.toLowerCase();
        card.style.display = title.includes(val) ? 'block' : 'none';
      }
    });
  });
}

// ========== Activity Feed Auto-scroll on Update ==========
function appendActivity(feedEl, message) {
  const div = document.createElement('div');
  div.className = 'activity-item';
  div.style.padding = '6px 0';
  div.style.borderBottom = '1px solid #f0f4f2';
  div.textContent = message;
  feedEl.appendChild(div);
  feedEl.scrollTop = feedEl.scrollHeight;
}

// Demo: Add new activity every 30s (simulate dynamic feed)
function activityFeedDemo() {
  const feed = document.getElementById('activityFeed');
  if(!feed) return;
  let counter = 0;
  const activities = [
    '🎯 Achieved hydration goal!',
    '💤 Improved sleep quality to 84%.',
    '🏃‍♂️ Completed 2 km run.',
    '🍎 Logged healthy lunch.',
    '❤️ Heart rate steady at 78 bpm.',
    '📅 Scheduled next workout.',
  ];
  setInterval(() => {
    appendActivity(feed, activities[counter % activities.length]);
    counter++;
  }, 30000);
}

// ========== Initialize All ==========
function initDashboard() {
  renderCalendarDays();
  initSidebarNavigation();
  initProgressRings();
  animateProgressBars();
  initSearchFilter();
  activityFeedDemo();
}
</script> 
</body>
</html>