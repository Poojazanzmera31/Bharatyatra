<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy & Terms of Service</title>
    <link rel="stylesheet" href="footer.cssc">
    <link rel="stylesheet" href="header.css">
</head>
<style>
    body{
        background-color: white;
        margin: 0;
        padding-top: 0;
    }
    header {
        background-color: green;
        color: white;
        padding: 10px 0;
        text-align: center;
    }

    header h1 {
        margin: 0;
    }

    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin: 0 10px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    main {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: green;
        border-bottom: 2px solid #4CAF50;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    h3 {
        color: #333;
        margin-top: 20px;
    }

    ul {
        list-style-type: disc;
        margin-left: 20px;
    }

    /* Media Queries for Responsiveness */

    /* Mobile Devices */
    @media (max-width: 480px) {
        header {
            padding: 15px 0; /* Increase padding for mobile */
        }

        nav ul li {
            display: block; /* Stack navigation items vertically */
            margin: 5px 0; /* Adjust margins for vertical stacking */
        }

        main {
            margin: 10px; /* Reduce margin for small screens */
            padding: 15px; /* Reduce padding */
        }

        h2 {
            font-size: 24px; /* Smaller heading size */
        }

        h3 {
            font-size: 18px; /* Smaller subheading size */
        }
    }

    /* Tablets */
    @media (min-width: 481px) and (max-width: 768px) {
        header {
            padding: 12px 0; /* Adjust padding for tablets */
        }

        nav ul li {
            margin: 0 5px; /* Reduce margin for tablet screens */
        }

        main {
            padding: 18px; /* Adjust padding */
        }

        h2 {
            font-size: 28px; /* Adjust heading size */
        }

        h3 {
            font-size: 20px; /* Adjust subheading size */
        }
    }

    /* Small Desktops */
    @media (min-width: 769px) and (max-width: 1024px) {
        header {
            padding: 10px 0; /* Maintain standard padding */
        }

        main {
            padding: 20px; /* Maintain padding */
        }

        h2 {
            font-size: 30px; /* Standard heading size */
        }

        h3 {
            font-size: 22px; /* Standard subheading size */
        }
    }

    /* Large Desktops */
    @media (min-width: 1025px) {
        header {
            padding: 10px 0; /* Maintain larger padding */
        }

        main {
            padding: 20px; /* Maintain padding */
        }

        h2 {
            font-size: 32px; /* Larger heading size */
        }

        h3 {
            font-size: 24px; /* Larger subheading size */
        }
    }
</style>

<body>
<?php include_once("header.php");?>
    <header>
        <h1>Privacy Policy & Terms of Service</h1>
        <nav>
            <ul>
                <li><a href="#privacy-policy">Privacy Policy</a></li>
                <li><a href="#terms-of-service">Terms of Service</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="privacy-policy">
            <h2>Privacy Policy</h2>
            <p>Welcome to BharatYatra. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains what information we collect, how we use it, and what rights you have in relation to it.</p>
            <h3>1. Information We Collect</h3>
            <p>We collect personal information that you voluntarily provide to us when you register on the website, express an interest in obtaining information about us or our services, participate in activities on the website, or contact us directly.</p>
            <ul>
                <li><strong>Personal Data:</strong> Name, email address, phone number, postal address, and other similar information.</li>
                <li><strong>Payment Information:</strong> Credit card details or other payment information.</li>
                <li><strong>Usage Data:</strong> Information on how you use our website, including browsing history, search queries, and pages visited.</li>
                <li><strong>Cookies and Tracking Technologies:</strong> We use cookies and similar tracking technologies to track the activity on our website and store certain information.</li>
            </ul>
            <h3>2. How We Use Your Information</h3>
            <p>We use your personal data for the following purposes:</p>
            <ul>
                <li>To provide and maintain our service, including to monitor the usage of our service.</li>
                <li>To manage your account and provide customer support.</li>
                <li>To send you promotional communications.</li>
                <li>To process your transactions.</li>
                <li>To comply with legal obligations.</li>
            </ul>
            <h3>3. Sharing Your Information</h3>
            <p>We may share your information with third parties under the following circumstances:</p>
            <ul>
                <li><strong>Service Providers:</strong> We may share your information with third-party vendors who perform services on our behalf.</li>
                <li><strong>Business Transfers:</strong> In the event of a merger, sale, or transfer of assets, your information may be transferred to the new owner.</li>
                <li><strong>Legal Obligations:</strong> We may disclose your information if required to do so by law or in response to valid requests by public authorities.</li>
            </ul>
            <h3>4. Security of Your Information</h3>
            <p>We use administrative, technical, and physical security measures to help protect your personal information. However, no method of transmission over the Internet or method of electronic storage is 100% secure.</p>
            <h3>5. Your Privacy Rights</h3>
            <p>Depending on your location, you may have the following rights regarding your personal information:</p>
            <ul>
                <li>The right to access your information.</li>
                <li>The right to rectify inaccurate or incomplete information.</li>
                <li>The right to request deletion of your data.</li>
                <li>The right to restrict or object to the processing of your data.</li>
                <li>The right to data portability.</li>
            </ul>
            <h3>6. Changes to This Privacy Policy</h3>
            <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
            <h3>7. Contact Us</h3>
            <p>If you have any questions about this Privacy Policy, please contact us at <a href="contactus.php">Contact Us</a>.</p>
        </section>

        <section id="terms-of-service">
            <h2>Terms of Service</h2>
            <h3>1. Acceptance of Terms</h3>
            <p>By accessing or using BharatYatra , you agree to be bound by these Terms of Service and our Privacy Policy.</p>
            <h3>2. Use of the Website</h3>
            <p>You agree to use the website in compliance with all applicable laws and regulations. You are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer.</p>
            <h3>3. Intellectual Property</h3>
            <p>All content on this website, including text, graphics, logos, and images, is the property of [Your Website Name] or its content suppliers and is protected by intellectual property laws.</p>
            <h3>4. Booking and Payment</h3>
            <p>All bookings made through our website are subject to availability. Payments must be made at the time of booking unless otherwise stated. We reserve the right to cancel any booking if full payment is not received.</p>
            <h3>5. Cancellations and Refunds</h3>
            <p>Cancellations must be made in accordance with our cancellation policy. Refunds will be processed based on the terms set forth at the time of booking.</p>
            <h3>6. Limitation of Liability</h3>
            <p>[Your Website Name] shall not be liable for any direct, indirect, incidental, or consequential damages resulting from your use of the website or any services purchased through the website.</p>
            <h3>7. Changes to Terms</h3>
            <p>We reserve the right to modify these Terms of Service at any time. Any changes will be effective immediately upon posting on the website.</p>
            <h3>8. Governing Law</h3>
            <p>These Terms of Service are governed by and construed in accordance with the laws of [Your Jurisdiction].</p>
            <h3>9. Contact Us</h3>
            <p>If you have any questions about these Terms of Service, please contact us at <a href="contactus.php">Contact Us</a>.</p>
        </section>
    </main>
    <?php include_once("footer.php");?>
</body>
</html>