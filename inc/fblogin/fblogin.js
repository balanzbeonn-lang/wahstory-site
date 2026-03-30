window.fbAsyncInit = function() {
    FB.init({
      appId      : '668250491491323',
      cookie     : true,
      xfbml      : true,
      version    : 'v17.0',
      scope: 'email public_profile user_gender'
    });
      
    FB.AppEvents.logPageView();   
      
      
     // Check login status
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
    
    // function saveUserData(userData){
    //     $.post('saveFBData.php', {oauth_provider:'facebook',userData: JSON.stringify(userData)}, function(){ return true;
       
    //     });
        
    // }
    
    function statusChangeCallback(response) {
      if (response.status === 'connected') {
        // The user is logged in and authenticated
        var accessToken = response.authResponse.accessToken;
        // Fetch user data
        fetchUserData(accessToken);
      } else {
        // The user is not logged in to your app or not authenticated
        console.log('Not Logged In');
      }
    }
    
    function fetchUserData(accessToken) {
      FB.api('/me', { fields: 'name,email,id,gender,picture.width(200)' }, function(response) {
        if (!response || response.error) {
          console.log('Error fetching user data: ' + response.error);
        } else {
          // User data is available here
          var userName = response.name;
          var userEmail = response.email;
          var userId = response.id;
          var userGender = response.gender;
          var userProfileImage = response.picture.data.url;
    
          // Now you can use this user data as needed, such as displaying it on your webpage
          console.log('User Name: ' + userName);
          console.log('User Email: ' + userEmail);
          console.log('User ID: ' + userId);
          console.log('Profile Image URL: ' + userProfileImage);
          
          var fbloginbtn = document.getElementById('fbloginbtn');
            // Set the "display" style property to "none" to hide the element
            fbloginbtn.style.display = 'none';
            
          document.getElementById('userName').innerHTML = 'Name: ' + userName;
          document.getElementById('userProfileImage').innerHTML = '<img src="' + userProfileImage + '">';
          
        //   saveUserData(response);
          
        }
      });
    }

  };

 function checkLoginState() {
    // Call this function whenever you want to check the login state
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));