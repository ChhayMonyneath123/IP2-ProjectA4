    <template>
        <footer class="footer">
        <div class="footer-content">
            <!-- Brand section -->
            <div class="footer-brand">
            <div class="logo-wrapper">
                <img src="../assets/logofood_station.png" alt="La Libre Logo" class="logo" />
                <h2>La Libre</h2>
            </div>
            <p>Enjoy your meal with pleasure!</p>
    
            <!-- Social Icons -->
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
    
            <p class="copyright">
                © 2024 All Rights Reserved. <a href="#">Terms of Use</a> – La Libre
            </p>
            </div>
    
            <!-- Links section -->
            <div class="footer-links">
            <div class="link-group">
                <h4>Information</h4>
                <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#">Blog</a></li>
                </ul>
            </div>
    
            <div class="link-group">
                <h4>Company</h4>
                <ul>
                <li><a href="#">Community</a></li>
                <li><a href="#">Career</a></li>
                <li><a href="#">Our Story</a></li>
                </ul>
            </div>
    
            <div class="link-group">
                <h4>Contact</h4>
                <ul>
                <li><a href="#">Getting Started</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Resources</a></li>
                </ul>
            </div>
            </div>
        </div>
        </footer>
    </template>
    
    <script>
    export default {
        name: "FooterBar"
    }
    </script>
    
    <style scoped>
    .footer {
        background-color: #564c3b;
        color: white;
        padding: 20px 40px;
        font-family: 'Instrument Sans', sans-serif;
    }
    
    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 50px;
        max-width: 100%;
        margin: auto;
    }
    
    .footer-brand {
        flex: 1 1 200px;
    }
    
    .logo-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .logo {
        width: 60px;
    }
    
    .footer-brand h2 {
        font-size: 24px;
        font-weight: bold;
        font-family: 'IBM Plex Sans Condensed', sans-serif;
        margin: 0;
    }
    
    .footer-brand p {
        font-size: 14px;
        margin: 10px 0 20px;
    }
    
    .social-icons {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .social-icons a {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 36px;
        height: 36px;
        border: 1px solid white;
        border-radius: 50%;
        font-size: 14px;
        color: white;
        transition: 0.3s;
    }
    
    .social-icons a:hover {
        background-color: white;
        color: #564c3b;
    }
    
    .footer-links {
        display: flex;
        gap: 80px;
        flex: 2 1 300px;
        justify-content: flex-end;
    }
    
    .link-group h4 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .link-group ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .link-group li {
        margin-bottom: 10px;
    }
    
    .link-group a {
        text-decoration: none;
        color: white;
        font-size: 14px;
    }
    
    .link-group a:hover {
        text-decoration: underline;
        color: #ddd;
    }
    
    a {
        color: inherit;
    }
    
    a:hover {
        color: #ddd;
    }
    
    @media (max-width: 768px) {
        .footer-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 30px;
        }
    
        .footer-links {
        flex-direction: column;
        gap: 20px;
        width: 100%;
        }
    }
    </style>
    