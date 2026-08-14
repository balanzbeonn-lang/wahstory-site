<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
 

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thankyou - Wellness Assessment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/images/wah_fav.ico">
  

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #0f0715 60%, #f12b59 100%);
      min-height: 100vh;
      color: #fff;
      font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .container {
      max-width: 50%;
      background: rgba(15, 7, 21, 0.97);
      border-radius: 1.5rem;
      box-shadow: 0 8px 32px rgba(241, 43, 89, 0.15), 0 1.5px 6px rgba(0,0,0,0.17);
      padding: 2.5rem 2rem 2rem 2rem;
      margin-top: 3rem;
      margin-bottom: 3rem;
    }
    h2 {
      color: #f12b59;
      font-weight: 700;
      letter-spacing: 1px;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(16px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .question-title {
      font-weight: 600;
      font-size: 1.15rem;
      margin-bottom: 1.2rem;
      color: #fff;
      letter-spacing: 0.2px;
    }
     
     
    ::-webkit-scrollbar {
      width: 8px;
      background: #1b1027;
    }
    ::-webkit-scrollbar-thumb {
      background: #f12b59;
      border-radius: 4px;
    }
    @media (max-width: 600px) {
      .container {
        padding: 1.2rem 0.6rem 1.2rem 0.6rem;
        margin-top: 0.7rem;
      }
      h2 { font-size: 1.45rem; }
    }
    
    .icon{
        animation: bounceAnimation 3s ease-in-out;
         
     }
     
     @keyframes bounceAnimation {
        0%, 50%, 100% {
            top: 0;
            transform: translateY(0);
        }
        25% {
            top: calc(100% - 40px);
            transform: translateY(-100%);
        }
        75% {
            top: calc(100% - 40px);
            transform: translateY(-50%);
        }
    }
     
    
  </style>
</head>
<body style="background-size: cover !important; filter: brightness(100%) !important; background-position: center !important; background-image: url(wellness-assessment-bg.jpg) !important; width: 100%; height: 100%; display: flex ; align-items: center; justify-content: center; flex-direction: column;">
    <div class="row">
        <div class="col-md-12">
            <a class="cs-site_branding" href="/">
                <img src="https://www.wahstory.com/images/logos/logo-white.png" alt="Logo" style="max-width: 200px">
             </a>
        </div>
    </div>
<div class="container my-5">
    
    <h2 class="text-white">
        <div class="icon mb-2">
            <svg width="50" height="50" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="10" cy="10" r="9" stroke="#25d986" stroke-width="2" fill="none" />
              <path d="M6 10.5L8.5 13L14 7.5" stroke="#25d986" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg> 
        </div>
      Thankyou!
    </h2>
   
  
  <div> 
      <h5 style=" line-height: 30px;"> Thank you for completing your Wellness Assessment! Your results are on their way and will be delivered to your email within 24 hours. </h5>
       
  </div>
  
    
 
</div>
      
</body>
</html>