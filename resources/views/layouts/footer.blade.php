<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <span class="logo-text mb-3 d-block">
                    <span class="tec">Tec</span><span class="bet">Bet</span>
                </span>
                <p class="footer-description">El sitio de apuestas más<br>confiable que vas a ver.</p>
            </div>
            <div class="col-md-3">
                <h5 class="footer-title">Contacto</h5>
                <ul class="footer-list">
                    <li><i class="fas fa-phone"></i> +51 977658439</li>
                    <li><i class="fas fa-envelope"></i> info@TecBet.pe</li>
                    <li><i class="fas fa-map-marker-alt"></i> Lima, Perú</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="footer-title">Enlaces</h5>
                <ul class="footer-list">
                    <li><a href="#" class="text-decoration-none text-white-50">Apuestas</a></li>
                    <li><a href="{{ route('informacion') }}" class="text-decoration-none text-white-50">Información</a></li>
                    <li><a href="#" class="text-decoration-none text-white-50">Blog</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="footer-title">Síguenos</h5>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="text-center">
            <p class="copyright">© 2025 TecBet. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<style>
.footer {
    background-color: #000;
    padding: 60px 0 30px;
    color: white;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.logo-text {
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    margin-bottom: 20px;
}

.logo-text .tec {
    color: white;
}

.logo-text .bet {
    color: #2FD35D;
}

.footer-description {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
}

.footer-title {
    color: #2FD35D;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.footer-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-list li {
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
    margin-bottom: 12px;
    transition: color 0.3s ease;
}

.footer-list li:hover {
    color: white;
}

.footer-list i {
    color: #2FD35D;
    margin-right: 10px;
    width: 20px;
}

.social-icons {
    display: flex;
    gap: 15px;
}

.social-icon {
    color: rgba(255, 255, 255, 0.7);
    font-size: 20px;
    transition: all 0.3s ease;
}

.social-icon:hover {
    color: #2FD35D;
    transform: translateY(-2px);
}

.footer-divider {
    margin: 40px 0 20px;
    border-color: rgba(255, 255, 255, 0.1);
}

.copyright {
    color: rgba(255, 255, 255, 0.5);
    font-size: 13px;
    margin: 0;
}
</style>

<!-- Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 