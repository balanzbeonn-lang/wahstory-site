<html>
    
<head>
    <title>NFC Popup</title>
    <style>
    
        .nfcModel_content {
            background-color: #0A2A4A;
            background-image: url(https://img.freepik.com/free-vector/modern-halftone-pattern-background_1035-18855.jpg);
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
            color: white;
        }
    </style>
</head>
<body>
<script>
    function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }
    
        // Helper: Set cookie
        function setCookie(name, value, days) {
            const expires = new Date(Date.now() + days * 86400000).toUTCString();
            document.cookie = `${name}=${value}; expires=${expires}; path=/`;
        }
        
        if(!getCookie('OpenNFCPopup')) {
                setTimeout(function() {
                    const popupBtn = document.getElementById('OpenNFCPopup');
                    if (popupBtn) {
                        popupBtn.click();
                    }
                }, 3000); // Delay of 5 seconds
            }
            
            const declineNFCPopup = document.getElementById('declineNFCPopup');

            if (declineNFCPopup) {
                declineNFCPopup.addEventListener('click', function () {
                    setCookie('OpenNFCPopup', 'yes', 2);
                });
            }
</script>


   <!-- Button trigger modal -->
<button type="button" id="OpenNFCPopup" class="btn btn-primary py-0 " data-bs-toggle="modal" data-bs-target="#NFCPopup">
    Open NFC Popup
</button>

<!-- Modal -->
<div class="modal fade" id="NFCPopup" tabindex="-1" aria-labelledby="NFCPopupLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content nfcModel_content">
      <div class="modal-header">
        <h5 class="modal-title" id="NFCPopupLabel">Get Your Own NFC Card — Absolutely Free!</h5>
        <button type="button" class="btn-close" id="declineNFCPopup" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times text-white"></i></button>
      </div>
      <div class="modal-body">
        <iframe 
            src="https://nfc.wahstory.com/default.nfc.card.php" 
            width="100%" 
            height="300px" 
            style="border: none;">
        </iframe>
        <div class="d-block text-center">
            
            <a class="cs-btn cs-style1" href="https://nfc.wahstory.com/getnfccard.php?GetCode=true&token=96ec9e06dbf5d56778ec4f0c93579d8b0318dba4" target="_blank">
              <span>Get For Free</span>
              <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z" fill="currentColor"/>
              </svg>                
            </a>
            
        </div>
      </div>
      
    </div>
  </div>
</div>

  </body>
</html>