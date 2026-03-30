(function ($) {
    'use strict';

    function handleFormSubmission(submitButtonSelector, formSelector) {
    const submitButton = document.querySelector(submitButtonSelector);
    const form = document.querySelector(formSelector);

    if (submitButton) {
        submitButton.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default form submission behavior
            submitButton.classList.add('processing');
            // Serialize the form data
            const formData = new FormData(form);

            fetch('/subscribepost.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json()) // Assuming you expect a JSON response
            .then(data => {
                // Handle the response data here
                localStorage.setItem('WAHStorySubscriber', data.email);

                const subscribeForms = document.querySelectorAll('.SubscribeForms');
                subscribeForms.forEach(form => {
                    form.style.display = 'none';
                });
                const subscribeMsg = document.querySelectorAll('.SubscribeCucMsg');
                subscribeMsg.forEach(msg => {
                    msg.style.display = 'block';
                });
                // successMessage.style.display = 'block';
            })
            .catch(error => {
                // Handle any errors that occurred during the fetch
                console.error('Error:', error);
            });
        });
    }
}

// Call the function for both form submissions
handleFormSubmission('.SubscribeFormBTN', '.SubscribeForm');
handleFormSubmission('.SubscribeFormBTN2', '.SubscribeForm2');



    const subscriberEmail = localStorage.getItem('WAHStorySubscriber');

    if (subscriberEmail) {
        const subscribeForms = document.querySelectorAll('.SubscribeForms');
            subscribeForms.forEach(form => {
                form.style.display = 'none';
            });
            const subscribeMsg = document.querySelectorAll('.SubscribeCucMsg');
                subscribeMsg.forEach(msg => {
                    msg.style.display = 'block';
                });
    }

})(jQuery);
