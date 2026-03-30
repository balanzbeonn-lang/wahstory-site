<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with LinkedIn</title>
</head>
<body>
    <button id="linkedin-login">Login with LinkedIn</button>

    <script>
        const clientID = '7711mahny8lwx5'; // Add your LinkedIn client ID here
        const redirectURI = 'https://www.wahstory.com/loginwithlinkedin.php';
        const state = 'DCEeFWf45A53sdfKef424';

        document.getElementById('linkedin-login').addEventListener('click', () => {
            const linkedinAuthURL = `https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=${clientID}&redirect_uri=${encodeURIComponent(redirectURI)}&state=${state}&scope=r_liteprofile%20r_emailaddress%20w_member_social`;

            window.location.href = linkedinAuthURL;
        });

        // Handle the callback
        const params = new URLSearchParams(window.location.search);
        const code = params.get('code');
        const returnedState = params.get('state');

        if (code && returnedState === state) {
            fetch('https://www.wahstory.com/linkedin-auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ code: code, redirect_uri: redirectURI })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Login successful', data);
                if (data.success) {
                    console.log('Login successful', data);
                    // window.location.href = 'https://www.wahstory.com/users/index.php';
                } else {
                    console.error('Login failed11:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            console.error('State does not match or no code returned');
        }
    </script>
</body>
</html>
