<?php
// Start output buffering for redirects
ob_start();

// Set content type
header('Content-Type: text/html; charset=UTF-8');

// Get the current section from URL (default is home)
$section = isset($_GET['section']) ? $_GET['section'] : 'home';

// Sanitize input to prevent security issues
$allowed_sections = ['home', 'features', 'pricing', 'contact', 'thank-you'];
if (!in_array($section, $allowed_sections)) {
    $section = 'home';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickPOS - Modern POS System for Your Business</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- EPIC 1: HEADER SECTION -->
    <header class="header">
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <h1>QuickPOS</h1>
            </div>

            <!-- Navigation -->
            <nav class="nav">
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#features">Features</a></li>
                    <li><a href="index.php#pricing">Pricing</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
            </nav>

            <!-- Sign-up Button -->
            <button class="signup-btn">Sign Up</button>
        </div>
    </header>

    <!-- EPIC 2: HERO SECTION -->
    <section class="hero" id="hero">
        <div class="hero-content">
            <h1 class="hero-headline">Manage Your Business with QuickPOS</h1>
            <p class="hero-subheadline">Fast, Reliable POS System for Modern Retailers</p>
            <button class="cta-btn">Get Started Free</button>
        </div>
    </section>

    <!-- EPIC 3: FEATURES SECTION -->
    <section class="features" id="features">
        <div class="container">
            <h2>Why Choose QuickPOS?</h2>
            <div class="features-grid">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Real-time Analytics</h3>
                    <p>Track sales and inventory in real-time with comprehensive dashboards and reports</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Secure Payments</h3>
                    <p>Process payments safely with industry-standard encryption and PCI compliance</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="feature-icon">🔄</div>
                    <h3>Easy Integration</h3>
                    <p>Seamlessly integrate with your existing business tools and systems</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Mobile Support</h3>
                    <p>Manage your business on the go with our responsive mobile app</p>
                </div>
            </div>
        </div>
    </section>

    <!-- EPIC 4: PRICING SECTION -->
    <section class="pricing" id="pricing">
        <div class="container">
            <h2>Simple, Transparent Pricing</h2>
            <div class="pricing-grid">
                <!-- Basic Plan -->
                <div class="pricing-card">
                    <h3>Basic</h3>
                    <p class="price">$29<span>/month</span></p>
                    <ul class="features-list">
                        <li>✓ Up to 5 users</li>
                        <li>✓ 100 transactions/day</li>
                        <li>✓ Basic reporting</li>
                        <li>✗ Mobile app</li>
                        <li>✗ Advanced analytics</li>
                    </ul>
                    <button class="choose-plan-btn">Choose Plan</button>
                </div>

                <!-- Pro Plan -->
                <div class="pricing-card featured">
                    <h3>Pro</h3>
                    <p class="price">$79<span>/month</span></p>
                    <ul class="features-list">
                        <li>✓ Up to 25 users</li>
                        <li>✓ Unlimited transactions</li>
                        <li>✓ Advanced reporting</li>
                        <li>✓ Mobile app</li>
                        <li>✗ Custom integration</li>
                    </ul>
                    <button class="choose-plan-btn">Choose Plan</button>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card">
                    <h3>Enterprise</h3>
                    <p class="price">Custom</p>
                    <ul class="features-list">
                        <li>✓ Unlimited users</li>
                        <li>✓ Unlimited transactions</li>
                        <li>✓ Advanced analytics</li>
                        <li>✓ Mobile app</li>
                        <li>✓ Custom integration</li>
                    </ul>
                    <button class="choose-plan-btn">Contact Sales</button>
                </div>
            </div>
        </div>
    </section>

    <!-- EPIC 5: CONTACT FORM SECTION -->
    <section class="contact" id="contact">
        <div class="container contact-container">
            <h2>Get in Touch</h2>
            <form class="contact-form" method="POST" action="src/process-form.php">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required 
                        placeholder="Enter your full name"
                    >
                    <small id="name-error" class="error-message"></small>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        placeholder="Enter your email address"
                    >
                    <small id="email-error" class="error-message"></small>
                </div>

                <!-- Message Field -->
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea 
                        id="message" 
                        name="message" 
                        rows="5" 
                        required 
                        placeholder="Enter your message"
                    ></textarea>
                    <small id="message-error" class="error-message"></small>
                </div>

                <!-- Form Messages -->
                <div id="form-message" class="form-message"></div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </section>

    <!-- EPIC 6: FOOTER SECTION -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Social Links -->
            <div class="social-links">
                <a href="https://facebook.com" target="_blank" title="Facebook">
                    <i class="social-icon">f</i> Facebook
                </a>
                <a href="https://twitter.com" target="_blank" title="Twitter">
                    <i class="social-icon">𝕏</i> Twitter
                </a>
                <a href="https://linkedin.com" target="_blank" title="LinkedIn">
                    <i class="social-icon">in</i> LinkedIn
                </a>
                <a href="https://instagram.com" target="_blank" title="Instagram">
                    <i class="social-icon">📷</i> Instagram
                </a>
            </div>

            <!-- Copyright -->
            <p class="copyright">&copy; <?php echo date('Y'); ?> QuickPOS. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="../js/script.js"></script>
</body>
</html>
