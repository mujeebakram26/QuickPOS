document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', handleFormSubmit);
    }
});

/**
 * Handle form submission via AJAX
 * @param {Event} event - The form submission event
 */
async function handleFormSubmit(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const messageContainer = document.getElementById('form-message');
    
    // Clear previous errors
    clearErrors();
    messageContainer.className = 'form-message';
    messageContainer.textContent = '';

    try {
        // Send form data to server
        const response = await fetch('src/process-form.php', {
            method: 'POST',
            body: formData
        });

        // Parse response as JSON
        const result = await response.json();

        // Handle errors
        if (!result.success && result.errors && Object.keys(result.errors).length > 0) {
            displayErrors(result.errors);
            return;
        }

        // Handle success
        if (result.success) {
            messageContainer.className = 'form-message success';
            messageContainer.textContent = result.message;
            form.reset();
            
            // Optional: Redirect to thank you page after 2 seconds
            setTimeout(() => {
                window.location.href = 'thank-you.html';
            }, 2000);
        }

    } catch (error) {
        console.error('Error:', error);
        messageContainer.className = 'form-message error';
        messageContainer.textContent = 'An error occurred. Please try again.';
    }
}

/**
 * Display error messages for each field
 * @param {Object} errors - Object with field names as keys and error messages as values
 */
function displayErrors(errors) {
    for (const [field, message] of Object.entries(errors)) {
        const errorElement = document.getElementById(`${field}-error`);
        if (errorElement) {
            errorElement.textContent = message;
        }
    }
}

/**
 * Clear all error messages
 */
function clearErrors() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(element => {
        element.textContent = '';
    });
}

// ============================================
// SMOOTH SCROLLING
// ============================================

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            document.querySelector(href).scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// ============================================
// SIGN-UP BUTTON
// ============================================

const signupBtn = document.querySelector('.signup-btn');
if (signupBtn) {
    signupBtn.addEventListener('click', function() {
        alert('Sign up feature coming soon!');
        // Or redirect to signup page: window.location.href = 'signup.html';
    });
}