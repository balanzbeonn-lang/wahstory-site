<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Google Meet</title>
  <script src="https://apis.google.com/js/api.js"></script>
</head>
<body>

<h1>Create Google Meet Meeting</h1>

<form id="meetingForm">
  <label for="meetingTitle">Meeting Title: </label>
  <input type="text" id="meetingTitle" required><br><br>
  
  <label for="date">Date: </label>
  <input type="date" id="date" required><br><br>
  
  <label for="time">Time: </label>
  <input type="time" id="time" required><br><br>
  
  <button type="submit">Create Meeting</button>
</form>

<h3>Google Meet Link: <span id="meetLink"></span></h3>

<script>
// Load the Google API Client
function loadClient() {
  // Ensure gapi.client is loaded before proceeding
  gapi.client.setApiKey('AIzaSyBmiyqtCrHcbJ-bcOQMXKZ62r0-SHLoB-Q'); // Replace with your actual API key or OAuth credentials
  gapi.client.load('calendar', 'v3', function() {
    console.log('Google Calendar API loaded');
  });
}

// Sign-in callback function to handle OAuth authentication
function handleAuthClick() {
  gapi.auth2.getAuthInstance().signIn().then(() => {
    createGoogleMeet();
  });
} 
 
// Initialize Google API client
function init() {
  gapi.load('client:auth2', function() {
    gapi.auth2.init({
      client_id: '678125914070-9vkfumkdq8r1jue9imnhlra72mo10fi7.apps.googleusercontent.com', // Replace with your OAuth client ID
    }).then(() => {
      loadClient(); // Call loadClient after authentication setup
    });
  });
}

// Create Google Meet Event
function createGoogleMeet() {
  const title = document.getElementById('meetingTitle').value;
  const date = document.getElementById('date').value;
  const time = document.getElementById('time').value;

  if (!gapi.client || !gapi.client.calendar) {
    console.error("Google API client is not initialized.");
    return;
  }

  const eventDate = new Date(`${date}T${time}:00`);

  const event = {
    'summary': title,
    'start': {
      'dateTime': eventDate.toISOString(),
      'timeZone': 'UTC',
    },
    'end': {
      'dateTime': new Date(eventDate.getTime() + 60 * 60 * 1000).toISOString(), // 1 hour duration
      'timeZone': 'UTC',
    },
    'conferenceData': {
      'createRequest': {
        'requestId': 'sample123',
        'conferenceSolutionKey': {
          'type': 'hangoutsMeet',
        },
      },
    },
    'attendees': [],
  };

  const request = gapi.client.calendar.events.insert({
    'calendarId': 'primary',
    'resource': event,
    'conferenceDataVersion': 1,
  });

  request.execute(function(event) {
    if (event.error) {
      console.error("Error creating event: ", event.error);
      return;
    }
    console.log('Event created: ' + event.htmlLink);
    document.getElementById('meetLink').innerText = event.conferenceData.entryPoints[0].uri;
  });
}

// Listen for form submission
document.getElementById('meetingForm').addEventListener('submit', function(e) {
  e.preventDefault();
  handleAuthClick();
});
</script>

<script async defer src="https://apis.google.com/js/platform.js?onload=init"></script>

</body>
</html>
