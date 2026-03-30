<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>WAHStory - Claim Your NFC Card</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      overflow-x: hidden;
    }
    
    .header {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: white;
      text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    
    .nav-links {
      display: flex;
      gap: 30px;
    }
    
    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: opacity 0.3s;
    }
    
    .nav-links a:hover {
      opacity: 0.8;
    }
    
    .hero-section {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }
    
    .content-wrapper {
      display: grid;
      grid-template-columns: 1fr 900px;
      gap: 60px;
      align-items: center;
      max-width: 1400px;
      width: 100%;
      padding: 0 40px;
    }
    
    .text-content {
      max-width: 500px;
    }
    
    .hero-title {
      font-size: 3.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      background: linear-gradient(45deg, #fff, #f0f0f0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      line-height: 1.1;
    }
    
    .hero-subtitle {
      font-size: 1.3rem;
      margin-bottom: 30px;
      opacity: 0.9;
      line-height: 1.6;
    }
    
    .cta-button {
      background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
      color: white;
      border: none;
      padding: 18px 40px;
      font-size: 1.2rem;
      font-weight: bold;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .cta-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(255, 107, 107, 0.6);
    }
    
    .features {
      margin-top: 40px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    
    .feature {
      display: flex;
      align-items: center;
      gap: 15px;
      opacity: 0.9;
    }
    
    .feature-icon {
      width: 24px;
      height: 24px;
      background: linear-gradient(45deg, #4facfe, #00f2fe);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      font-size: 14px;
    }
    
    /* 3D Card Carousel Styles - Keeping your original code */
    .carousel-container {
      width: 900px;
      height: 700px;
      perspective: 1800px;
      position: relative;
    }
    
    .carousel {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0; left: 0;
      transform-style: preserve-3d;
      cursor: grab;
      transition: transform 0.2s cubic-bezier(.17,.67,.83,.67);
    }
    
    .card {
      position: absolute;
      width: 180px;
      height: 270px;
      left: 50%; top: 50%;
      transform-style: preserve-3d;
      border-radius: 14px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.25);
      overflow: hidden;
      background: #fff;
      transition: box-shadow 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .card:hover {
      box-shadow: 0 24px 48px rgba(0,0,0,0.4);
      z-index: 2;
    }
    
    .card-face {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      border-radius: 14px;
      overflow: hidden;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .card-face img {
      width: 270px;
      height: 180px;
      object-fit: cover;
      display: block;
      pointer-events: none;
      user-select: none;
      transform: rotate(90deg);
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%) rotate(90deg);
    }
    
    .card-back {
      transform: rotateY(180deg);
      background: #fff;
    }
    
    .reflection {
      position: absolute;
      width: 100%;
      height: 40px;
      left: 0;
      bottom: -44px;
      background: linear-gradient(to bottom, rgba(255,255,255,0.15), transparent 80%);
      opacity: 0.7;
      pointer-events: none;
      z-index: 1;
      filter: blur(2px);
      border-radius: 0 0 14px 14px;
    }
    
    .floating-elements {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      pointer-events: none;
      z-index: 1;
    }
    
    .floating-card {
      position: absolute;
      width: 60px;
      height: 60px;
      background: rgba(255,255,255,0.1);
      border-radius: 10px;
      animation: float 6s ease-in-out infinite;
    }
    
    .floating-card:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
    .floating-card:nth-child(2) { top: 60%; right: 15%; animation-delay: 2s; }
    .floating-card:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 4s; }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    .info-section {
      background: rgba(255,255,255,0.1);
      backdrop-filter: blur(10px);
      padding: 60px 40px;
      text-align: center;
    }
    
    .info-title {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }
    
    .info-description {
      font-size: 1.2rem;
      max-width: 800px;
      margin: 0 auto 40px;
      opacity: 0.9;
      line-height: 1.6;
    }
    
    .benefits-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      max-width: 1000px;
      margin: 0 auto;
    }
    
    .benefit-card {
      background: rgba(255,255,255,0.1);
      padding: 30px;
      border-radius: 15px;
      backdrop-filter: blur(5px);
      border: 1px solid rgba(255,255,255,0.2);
    }
    
    .benefit-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(45deg, #4facfe, #00f2fe);
      border-radius: 50%;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
    }
    
    .benefit-title {
      font-size: 1.3rem;
      margin-bottom: 15px;
      font-weight: bold;
    }
    
    .benefit-description {
      opacity: 0.9;
    }
    
    @media (max-width: 1200px) {
      .content-wrapper {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 40px;
      }
      
      .carousel-container {
        width: 600px;
        height: 500px;
      }
      
      .hero-title {
        font-size: 2.5rem;
      }
    }
    
    @media (max-width: 768px) {
      .header {
        padding: 15px 20px;
      }
      
      .content-wrapper {
        padding: 0 20px;
      }
      
      .carousel-container {
        width: 400px;
        height: 400px;
      }
      
      .hero-title {
        font-size: 2rem;
      }
      
      .hero-subtitle {
        font-size: 1.1rem;
      }
      
      .nav-links {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="floating-elements">
    <div class="floating-card"></div>
    <div class="floating-card"></div>
    <div class="floating-card"></div>
  </div>
  
  <header class="header">
    <div class="logo">WAHStory</div>
    <nav class="nav-links">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#features">Features</a>
      <a href="#contact">Contact</a>
    </nav>
  </header>
  
  <section class="hero-section">
    <div class="content-wrapper">
      <div class="text-content">
        <h1 class="hero-title">Your Digital Story Starts Here</h1>
        <p class="hero-subtitle">Experience the future of networking with WAHStory NFC cards. Share your story, connect instantly, and make lasting impressions.</p>
        
        <button class="cta-button" onclick="claimCard()">Claim Your NFC Card</button>
        
        <div class="features">
          <div class="feature">
            <div class="feature-icon">✓</div>
            <span>Instant contact sharing</span>
          </div>
          <div class="feature">
            <div class="feature-icon">✓</div>
            <span>Customizable digital profile</span>
          </div>
          <div class="feature">
            <div class="feature-icon">✓</div>
            <span>Professional networking made simple</span>
          </div>
        </div>
      </div>
      
      <div class="carousel-container">
        <div class="carousel" id="carousel"></div>
      </div>
    </div>
  </section>
  
  <section class="info-section">
    <h2 class="info-title">Why Choose WAHStory NFC Cards?</h2>
    <p class="info-description">Transform the way you network and share your professional story. Our NFC cards combine cutting-edge technology with elegant design to create meaningful connections.</p>
    
    <div class="benefits-grid">
      <div class="benefit-card">
        <div class="benefit-icon">🚀</div>
        <h3 class="benefit-title">Instant Connection</h3>
        <p class="benefit-description">Simply tap your card to any smartphone to instantly share your contact information and digital profile.</p>
      </div>
      
      <div class="benefit-card">
        <div class="benefit-icon">🎨</div>
        <h3 class="benefit-title">Fully Customizable</h3>
        <p class="benefit-description">Design your digital profile with your brand colors, images, and content that tells your unique story.</p>
      </div>
      
      <div class="benefit-card">
        <div class="benefit-icon">📱</div>
        <h3 class="benefit-title">Smart Technology</h3>
        <p class="benefit-description">Works with all NFC-enabled devices. No apps required for your contacts to receive your information.</p>
      </div>
      
      <div class="benefit-card">
        <div class="benefit-icon">🌍</div>
        <h3 class="benefit-title">Eco-Friendly</h3>
        <p class="benefit-description">Reduce paper waste with our sustainable digital business card solution that never runs out.</p>
      </div>
    </div>
  </section>

  <script>
    // Your original 3D carousel code
    const rows = 1;
    const cols = 8;
    const cardW = 180;
    const cardH = 270;
    const radius = 400;
    const vGap = 70;

    const frontImg = 'https://www.nfc.wahstory.com/cards/image(7)1290125926.png';
    const backImg = 'https://www.nfc.wahstory.com/cards/whclb-mynfc-card-b.webp';

    const cards = [];
    for (let row = 0; row < rows; row++) {
      for (let col = 0; col < cols; col++) {
        const angleY = (360 / cols) * col;
        const y = ((row - (rows-1)/2) * vGap);
        cards.push({angleY, y});
      }
    }

    const carousel = document.getElementById('carousel');
    cards.forEach((cardData, i) => {
      const card = document.createElement('div');
      card.className = 'card';
      card.innerHTML = `
        <div class="card-face card-front">
          <img src="${frontImg}" alt="front" draggable="false"/>
        </div>
        <div class="card-face card-back">
          <img src="${backImg}" alt="back" draggable="false"/>
        </div>
        <div class="reflection"></div>
      `;
      carousel.appendChild(card);
    });

    let rotY = 0, rotX = 0;
    let isDragging = false;
    let startX, startY, lastRotY = 0, lastRotX = 0;

    function updateCards() {
      const cardElems = carousel.children;
      cards.forEach((cardData, i) => {
        const totalRotY = rotY + cardData.angleY;
        const rad = totalRotY * Math.PI / 180;
        const x = Math.sin(rad) * radius;
        const z = Math.cos(rad) * radius;
        const y = cardData.y;

        cardElems[i].style.transform =
          `translate3d(${x}px, ${y}px, ${z}px) rotateY(${totalRotY}deg)`;

        let relAngle = ((totalRotY % 360) + 360) % 360;
        if (relAngle > 180) relAngle -= 360;
        if (Math.abs(relAngle) > 90) {
          cardElems[i].children[0].style.transform = 'rotateY(180deg)';
          cardElems[i].children[1].style.transform = 'rotateY(0deg)';
        } else {
          cardElems[i].children[0].style.transform = 'rotateY(0deg)';
          cardElems[i].children[1].style.transform = 'rotateY(180deg)';
        }
      });
      carousel.style.transform = `rotateX(${rotX}deg)`;
    }

    carousel.addEventListener('mousedown', (e) => {
      isDragging = true;
      startX = e.clientX;
      startY = e.clientY;
      carousel.style.cursor = 'grabbing';
    });
    
    window.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      const dx = e.clientX - startX;
      const dy = e.clientY - startY;
      rotY = lastRotY + dx * 0.5;
      rotX = lastRotX - dy * 0.3;
      rotX = Math.max(-60, Math.min(60, rotX));
      updateCards();
    });
    
    window.addEventListener('mouseup', () => {
      if (!isDragging) return;
      isDragging = false;
      lastRotY = rotY;
      lastRotX = rotX;
      carousel.style.cursor = 'grab';
    });

    carousel.addEventListener('touchstart', (e) => {
      if (e.touches.length !== 1) return;
      isDragging = true;
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
    });
    
    window.addEventListener('touchmove', (e) => {
      if (!isDragging || e.touches.length !== 1) return;
      const dx = e.touches[0].clientX - startX;
      const dy = e.touches[0].clientY - startY;
      rotY = lastRotY + dx * 0.5;
      rotX = lastRotX - dy * 0.3;
      rotX = Math.max(-60, Math.min(60, rotX));
      updateCards();
    }, {passive: false});
    
    window.addEventListener('touchend', () => {
      if (!isDragging) return;
      isDragging = false;
      lastRotY = rotY;
      lastRotX = rotX;
    });

    setInterval(() => {
      if (!isDragging) {
        rotY += 0.2;
        updateCards();
        lastRotY = rotY;
      }
    }, 30);

    updateCards();

    // CTA Button Action
    function claimCard() {
      alert('Welcome to WAHStory! Your NFC card claim process will begin shortly. Please provide your details to get started.');
      // You can replace this with actual claim functionality
      // window.location.href = '/claim';
    }
  </script>
</body>
</html>