<footer class="mt-5">
    <div class="top-footer container">
        <div class="footer-left">
            <p><strong class="text-white">Per Info</strong></p>
            <span><i class="fa-solid fa-phone"></i> (+39) 123-456-7890</span>
            <span><i class="fa-solid fa-envelope"></i> prova@example.com</span>
        </div>
        <div class="footer-center">
            <div class="links">
                <p><strong class="text-white">Informazioni</strong></p>
                <ul class="p-0">
                    <li v-for="link in footerLink.links"><a href="#">Bookmark</a></li>
                    <li v-for="link in footerLink.links"><a href="#">Features</a></li>
                    <li v-for="link in footerLink.links"><a href="#">Sitemap</a></li>
                    <li v-for="link in footerLink.links"><a href="#">Lists</a></li>
                    <li v-for="link in footerLink.links"><a href="#">Contact US</a></li>
                </ul>
            </div>
            <div class="links">
                <p><strong class="text-white">Extra</strong></p>
                <ul class="p-0">
                    <li v-for="link in footerLink.links"><a href="#">Delivery</a></li>
                    <li v-for="link in footerLink.links"><a href="#">Cart</a></li>
                    <li v-for="link in footerLink.links"><a href="#">Terms conditions</a></li>
                    <li v-for="link in footerLink.links"><a href="#">My account</a></li>
                    <li v-for="link in footerLink.links"><a href="#">About us</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-right">
            <p><strong class="text-white">Our Newsletter</strong></p>
            <span>Tieni traccia delle nuove aperture nella tua zona.</span>
            <div class="newsletter-input">
                <input type="text">
                <i class="fa-regular fa-paper-plane"></i>
            </div>

            <div class="socials">
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
    </div>
    <hr>
    <div class="bottom-footer container-centered">
        <div class="copyright">
            <p>Copyright &copy; Deliveboo 2023</p>
        </div>
    </div>
</footer>