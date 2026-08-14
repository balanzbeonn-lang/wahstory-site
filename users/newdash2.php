<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WAHstory Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    :root {
      --main-bg: #191819;
      --main-pink: #e9204f;
      --main-grey: #232329;
      --white: #fff;
      --grey-text: #aaa;
      --card-hover: #2a2a30;
      --gradient-pink: linear-gradient(135deg, #e9204f, #ff4f7a);
      --gradient-blue: linear-gradient(135deg, #4f46e5, #7c3aed);
      --gradient-green: linear-gradient(135deg, #10b981, #06d6a0);
      --gradient-orange: linear-gradient(135deg, #f59e0b, #f97316);
      --gradient-purple: linear-gradient(135deg, #8b5cf6, #a855f7);
      --gradient-teal: linear-gradient(135deg, #14b8a6, #06b6d4);
    }
    
    body {
      background: var(--main-bg);
      color: var(--white);
      font-family: 'Poppins', Arial, sans-serif;
      min-height: 100vh;
    }
    
    .sidebar {
      background: var(--main-grey);
      min-width: 260px;
      max-width: 260px;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 100;
      display: flex;
      flex-direction: column;
      padding-top: 24px;
    }
    
    .sidebar .logo {
      font-size: 1.6rem;
      font-weight: bold;
      margin-left: 24px;
      margin-bottom: 40px;
      color: var(--white);
      letter-spacing: 1px;
    }
    
    .sidebar .logo span {
      color: var(--main-pink);
    }
    
    .sidebar .nav-link {
      color: var(--white);
      font-size: 1.08rem;
      padding: 12px 24px;
      border-radius: 30px 0 0 30px;
      margin-bottom: 6px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .sidebar .nav-link.active, .sidebar .nav-link:hover {
      background: var(--main-pink);
      color: var(--white);
      transform: translateX(5px);
    }
    
    .sidebar .nav-link i {
      font-size: 1.2rem;
    }
    
    .sidebar .logout {
      margin-top: auto;
      margin-bottom: 24px;
    }
    
    .main-content {
      margin-left: 260px;
      padding: 32px 32px 0 32px;
      min-height: 100vh;
      background: var(--main-bg);
    }
    
    .topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
    }
    
    .topbar .nav {
      gap: 32px;
    }
    
    .topbar .nav-link {
      color: var(--white);
      font-size: 1rem;
      margin-right: 12px;
      padding: 0;
      background: none;
      border: none;
      transition: color 0.3s ease;
    }
    
    .topbar .nav-link:hover {
      color: var(--main-pink);
    }
    
    .topbar .nav-link.dropdown-toggle::after {
      margin-left: 5px;
    }
    
    .topbar .search-bar {
      background: var(--main-grey);
      border-radius: 20px;
      padding: 6px 14px;
      border: none;
      color: var(--white);
      width: 200px;
      margin-right: 18px;
      outline: none;
      transition: all 0.3s ease;
    }
    
    .topbar .search-bar:focus {
      box-shadow: 0 0 0 2px var(--main-pink);
    }
    
    .topbar .icon-btn {
      background: none;
      border: none;
      color: var(--white);
      font-size: 1.3rem;
      margin-left: 10px;
      transition: all 0.3s ease;
      padding: 8px;
      border-radius: 50%;
    }
    
    .topbar .icon-btn:hover {
      background: var(--main-grey);
      color: var(--main-pink);
    }
    
    .dashboard-cards {
      display: flex;
      gap: 24px;
      flex-wrap: wrap;
    }
    
    .dashboard-card {
      background: linear-gradient(135deg, var(--main-grey), #2a2a35);
      border-radius: 20px;
      padding: 28px;
      flex: 1 1 280px;
      min-width: 240px;
      margin-bottom: 24px;
      color: var(--white);
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.3s ease;
      border: 1px solid transparent;
      position: relative;
      overflow: hidden;
    }
    
    .dashboard-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--gradient-pink);
      transition: height 0.3s ease;
    }
    
    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 48px rgba(0,0,0,0.4);
      border-color: var(--main-pink);
    }
    
    .dashboard-card:hover::before {
      height: 6px;
    }
    
    .dashboard-card .card-title {
      font-size: 1.2rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .dashboard-card .card-title i {
      color: var(--main-pink);
      font-size: 1.5rem;
      padding: 8px;
      background: rgba(233, 32, 79, 0.1);
      border-radius: 12px;
    }
    
    .dashboard-card .bi-three-dots-vertical {
      color: var(--grey-text);
      font-size: 1.4rem;
      cursor: pointer;
      padding: 8px;
      border-radius: 50%;
      transition: all 0.3s ease;
    }
    
    .dashboard-card .bi-three-dots-vertical:hover {
      background: var(--main-pink);
      color: var(--white);
    }
    
    .activity-section, .wahclub-section {
      display: flex;
      gap: 20px;
      margin-bottom: 32px;
      flex-wrap: wrap;
    }
    
    .activity-box, .wahclub-box {
      background: linear-gradient(135deg, var(--main-bg), #1f1f25);
      border-radius: 20px;
      padding: 24px 20px;
      flex: 1 1 180px;
      min-width: 160px;
      color: var(--white);
      text-align: center;
      border: 1px solid var(--main-grey);
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }
    
    .activity-box::before, .wahclub-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: var(--gradient-pink);
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: 0;
    }
    
    .activity-box:nth-child(1)::before { background: var(--gradient-pink); }
    .activity-box:nth-child(2)::before { background: var(--gradient-blue); }
    .activity-box:nth-child(3)::before { background: var(--gradient-green); }
    
    .wahclub-box:nth-child(1)::before { background: var(--gradient-orange); }
    .wahclub-box:nth-child(2)::before { background: var(--gradient-purple); }
    .wahclub-box:nth-child(3)::before { background: var(--gradient-teal); }
    
    .activity-box:hover, .wahclub-box:hover {
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
      border-color: transparent;
    }
    
    .activity-box:hover::before, .wahclub-box:hover::before {
      opacity: 0.1;
    }
    
    .activity-box > *, .wahclub-box > * {
      position: relative;
      z-index: 1;
    }
    
    .activity-box .icon, .wahclub-box .icon {
      font-size: 2.2rem;
      margin-bottom: 12px;
      padding: 16px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 70px;
      height: 70px;
      transition: all 0.3s ease;
    }
    
    .activity-box:nth-child(1) .icon { 
      background: rgba(233, 32, 79, 0.15);
      color: #ff4f7a;
    }
    .activity-box:nth-child(2) .icon { 
      background: rgba(79, 70, 229, 0.15);
      color: #7c3aed;
    }
    .activity-box:nth-child(3) .icon { 
      background: rgba(16, 185, 129, 0.15);
      color: #06d6a0;
    }
    
    .wahclub-box:nth-child(1) .icon { 
      background: rgba(245, 158, 11, 0.15);
      color: #f97316;
    }
    .wahclub-box:nth-child(2) .icon { 
      background: rgba(139, 92, 246, 0.15);
      color: #a855f7;
    }
    .wahclub-box:nth-child(3) .icon { 
      background: rgba(20, 184, 166, 0.15);
      color: #06b6d4;
    }
    
    .activity-box:hover .icon, .wahclub-box:hover .icon {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .activity-box .label, .wahclub-box .label {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 8px;
      letter-spacing: 0.5px;
    }
    
    .activity-box .detail, .wahclub-box .detail {
      font-size: 0.9rem;
      background: var(--white);
      color: var(--main-bg);
      border-radius: 20px;
      padding: 8px 16px;
      margin-top: 8px;
      font-weight: 500;
      display: inline-block;
      transition: all 0.3s ease;
      cursor: pointer;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 0.8rem;
    }
    
    .activity-box:hover .detail, .wahclub-box:hover .detail {
      background: var(--main-pink);
      color: var(--white);
      transform: scale(1.05);
    }
    
    .section-title {
      font-size: 1.4rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: var(--white);
      position: relative;
      padding-left: 20px;
    }
    
    .section-title::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 4px;
      height: 24px;
      background: var(--gradient-pink);
      border-radius: 2px;
    }
    
    .profile-card {
      background: linear-gradient(135deg, var(--main-grey), #2a2a35);
      border-radius: 24px;
      padding: 28px;
      color: var(--white);
      margin-bottom: 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: 260px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
    }
    
    .profile-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 48px rgba(0,0,0,0.4);
    }
    
    .profile-pic {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--main-pink), #ff4f7a);
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: bold;
      box-shadow: 0 8px 25px rgba(233, 32, 79, 0.3);
    }
    
    .profile-card .profile-name {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 4px;
      text-align: center;
    }
    
    .profile-card .profile-link {
      font-size: 1rem;
      color: var(--main-pink);
      text-decoration: none;
      margin-bottom: 8px;
      display: inline-block;
      transition: all 0.3s ease;
    }
    
    .profile-card .profile-link:hover {
      color: #ff4f7a;
      transform: scale(1.05);
    }
    
    .social-health-card {
      background: var(--gradient-pink);
      border-radius: 24px;
      padding: 28px;
      color: var(--white);
      text-align: center;
      margin-bottom: 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      box-shadow: 0 8px 32px rgba(233, 32, 79, 0.4);
      transition: all 0.3s ease;
    }
    
    .social-health-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 48px rgba(233, 32, 79, 0.5);
    }
    
    .social-health-card .score-label {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 20px;
    }
    
    .speedometer {
      position: relative;
      width: 120px;
      height: 120px;
      margin: 0 auto 20px auto;
    }
    
    .speedometer-track {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 8px solid rgba(255, 255, 255, 0.2);
      position: relative;
      overflow: hidden;
    }
    
    .speedometer-fill {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 8px solid transparent;
      border-top-color: #fff;
      border-right-color: #fff;
      border-bottom-color: rgba(255, 255, 255, 0.3);
      border-left-color: rgba(255, 255, 255, 0.3);
      transform: rotate(45deg);
      animation: speedometer-pulse 2s ease-in-out infinite alternate;
    }
    
    .speedometer-center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 20px;
      height: 20px;
      background: #fff;
      border-radius: 50%;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }
    
    .speedometer-needle {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 2px;
      height: 40px;
      background: #fff;
      transform-origin: bottom;
      transform: translate(-50%, -100%) rotate(45deg);
      border-radius: 1px;
      animation: needle-move 3s ease-in-out infinite alternate;
    }
    
    .speedometer-score {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 1.4rem;
      font-weight: bold;
      margin-top: 10px;
    }
    
    @keyframes speedometer-pulse {
      0% { transform: rotate(45deg) scale(1); }
      100% { transform: rotate(45deg) scale(1.05); }
    }
    
    @keyframes needle-move {
      0% { transform: translate(-50%, -100%) rotate(20deg); }
      100% { transform: translate(-50%, -100%) rotate(70deg); }
    }
    
    .social-health-card .score-btn {
      background: var(--white);
      color: var(--main-pink);
      border: none;
      border-radius: 20px;
      padding: 10px 24px;
      font-weight: 600;
      font-size: 1rem;
      margin-top: 2px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .social-health-card .score-btn:hover {
      background: rgba(255, 255, 255, 0.9);
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .connected-socials {
      background: linear-gradient(135deg, var(--main-grey), #2a2a35);
      border-radius: 24px;
      padding: 28px;
      color: var(--white);
      margin-bottom: 24px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
    }
    
    .connected-socials:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 48px rgba(0,0,0,0.4);
    }
    
    .connected-socials .social-label {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 16px;
    }
    
    .connected-socials .social-links {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    
    .connected-socials .social-link {
      color: var(--white);
      text-decoration: none;
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.3s ease;
      padding: 8px 12px;
      border-radius: 12px;
    }
    
    .connected-socials .social-link:hover {
      background: rgba(255, 255, 255, 0.1);
      transform: translateX(5px);
    }
    
    .connected-socials .social-link .bi-facebook { color: #1877f3; }
    .connected-socials .social-link .bi-instagram { color: #e1306c; }
    .connected-socials .social-link .bi-linkedin { color: #0a66c2; }
    .connected-socials .social-link .bi-twitter { color: #1da1f2; }
    .connected-socials .social-link .bi-youtube { color: #ff0000; }
    
    .connected-socials .bi-globe {
      color: var(--main-pink);
      margin-right: 8px;
      font-size: 1.3rem;
    }
    
    @media (max-width: 991px) {
      .main-content {
        margin-left: 0;
        padding: 18px 4vw 0 4vw;
      }
      .sidebar {
        position: static;
        width: 100vw;
        max-width: 100vw;
        min-width: 0;
        height: auto;
        flex-direction: row;
        padding: 0;
        overflow-x: auto;
      }
      .sidebar .nav-link {
        border-radius: 0;
        margin-bottom: 0;
        padding: 14px 18px;
        font-size: 1.01rem;
      }
    }
    
    @media (max-width: 767px) {
      .dashboard-cards {
        flex-direction: column;
      }
      .activity-section, .wahclub-section {
        flex-direction: column;
      }
      .profile-card, .social-health-card, .connected-socials {
        min-width: 0;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar flex-column">
      <div class="logo mb-4">
        <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo" style="height: 40px;">
      </div>
      <a href="#" class="nav-link active"><i class="bi bi-house-door-fill"></i> Dashboard</a>
      <a href="#" class="nav-link"><i class="bi bi-people-fill"></i> My Connections</a>
      <a href="#" class="nav-link"><i class="bi bi-calendar-event-fill"></i> Meetings</a>
      <a href="#" class="nav-link"><i class="bi bi-clock-fill"></i> My Availability</a>
      <a href="#" class="nav-link"><i class="bi bi-chat-dots-fill"></i> Live Chat</a>
      <a href="#" class="nav-link"><i class="bi bi-people"></i> WAH Community</a>
      <a href="#" class="nav-link"><i class="bi bi-key-fill"></i> Change Password</a>
      <div class="logout">
        <a href="#" class="nav-link"><i class="bi bi-box-arrow-right"></i> Log Out</a>
      </div>
      <form method="POST" style="margin: 16px 24px 0 24px;">
        <input type="hidden" name="SendUpgradeRequest" value="1">
        <button type="submit" class="nav-link" style="background:#e9204f;color:#fff;border-radius:20px;"><i class="bi bi-star-fill"></i> Upgrade Account</button>
      </form>
    </nav>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
      <!-- Topbar -->
      <div class="topbar">
        <nav class="nav">
          <a class="nav-link" href="#">ABOUT US</a>
          <a class="nav-link" href="#">STORIES</a>
          <a class="nav-link" href="#">WAHCLUB</a>
          <a class="nav-link" href="#">WAHCOMMUNITY</a>
          <a class="nav-link" href="#">WAHSPOTLIGHT</a>
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" data-bs-toggle="dropdown" aria-expanded="false">MORE</a>
            <ul class="dropdown-menu" aria-labelledby="moreDropdown">
              <li><a class="dropdown-item" href="#">Option 1</a></li>
              <li><a class="dropdown-item" href="#">Option 2</a></li>
            </ul>
          </div>
        </nav>
        <div class="d-flex align-items-center">
          <input type="text" class="search-bar" placeholder="Search Here">
          <button class="icon-btn"><i class="bi bi-search"></i></button>
          <button class="icon-btn"><i class="bi bi-bell-fill"></i></button>
          <button class="icon-btn"><i class="bi bi-envelope-fill"></i></button>
        </div>
      </div>

      <div class="row">
        <!-- Main dashboard area -->
        <div class="col-lg-8">
          <div class="dashboard-cards">
            <div class="dashboard-card">
              <div class="card-title"><i class="bi bi-calendar2-check-fill"></i> Approve Booking</div>
              <i class="bi bi-three-dots-vertical"></i>
            </div>
            <div class="dashboard-card">
              <div class="card-title"><i class="bi bi-calendar-event"></i> Upcoming Meetings</div>
              <i class="bi bi-three-dots-vertical"></i>
            </div>
          </div>
          
          <div class="mb-4">
            <div class="section-title">My Activity</div>
            <div class="activity-section">
              <div class="activity-box">
                <div class="icon"><i class="bi bi-heart-fill"></i></div>
                <div class="label">Liked Stories</div>
                <div class="detail">See Detail</div>
              </div>
              <div class="activity-box">
                <div class="icon"><i class="bi bi-bookmark-fill"></i></div>
                <div class="label">Saved Stories</div>
                <div class="detail">See Detail</div>
              </div>
              <div class="activity-box">
                <div class="icon"><i class="bi bi-pencil-square"></i></div>
                <div class="label">Blog Published</div>
                <div class="detail">See Detail</div>
              </div>
            </div>
          </div>
          
          <div>
            <div class="section-title">WAHClub</div>
            <div class="wahclub-section">
              <div class="wahclub-box">
                <div class="icon"><i class="bi bi-eye-fill"></i></div>
                <div class="label">Profile Views</div>
                <div class="detail">See Detail</div>
              </div>
              <div class="wahclub-box">
                <div class="icon"><i class="bi bi-person-check-fill"></i></div>
                <div class="label">Profile Connections</div>
                <div class="detail">See Detail</div>
              </div>
              <div class="wahclub-box">
                <div class="icon"><i class="bi bi-briefcase-fill"></i></div>
                <div class="label">Work Request</div>
                <div class="detail">See Detail</div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Profile and right side -->
        <div class="col-lg-4">
          <div class="profile-card">
            <div class="profile-pic">PK</div>
            <div class="profile-name">Pratham Kakkar</div>
            <a href="#" class="profile-link">View Profile</a>
          </div>
          
          <div class="social-health-card">
            <div class="score-label">Social Health Score</div>
            <div class="speedometer">
              <div class="speedometer-track">
                <div class="speedometer-fill"></div>
                <div class="speedometer-center"></div>
                <div class="speedometer-needle"></div>
              </div>
              <div class="speedometer-score">75%</div>
            </div>
            <button class="score-btn">View Score</button>
          </div>
          
          <div class="connected-socials">
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-globe"></i>
              <div class="social-label">Connected Socials</div>
            </div>
            <div class="social-links">
              <a href="#" class="social-link"><i class="bi bi-facebook"></i> Facebook</a>
              <a href="#" class="social-link"><i class="bi bi-instagram"></i> Instagram</a>
              <a href="#" class="social-link"><i class="bi bi-linkedin"></i> Linkedin</a>
              <a href="#" class="social-link"><i class="bi bi-twitter"></i> Twitter</a>
              <a href="#" class="social-link"><i class="bi bi-youtube"></i> Youtube</a>
            </div>