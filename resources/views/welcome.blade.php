<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PackAlimentaire - Votre Solution de Packs Alimentaires</title>
    <link rel="stylesheet" href="{{ asset('site_assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="logo">
                <h1>Pack<span>Alimentaire</span></h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="#" class="active">Accueil</a></li>
                    <li><a href="#packs">Packs Alimentaires</a></li>
                    <li><a href="/packs-scolaires">Packs Scolaires</a></li>
                    <li><a href="#about">À Propos</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </div>
            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Des Packs Alimentaires de Qualité Supérieure</h1>
                <p>Découvrez notre sélection de packs alimentaires complets, nutritifs et savoureux pour toutes vos occasions.</p>
                <a href="#packs" class="btn-primary">Découvrir nos packs</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="feature-box">
                <i class="fas fa-truck"></i>
                <h3>Livraison Rapide</h3>
                <p>Livraison dans toute la région</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-leaf"></i>
                <h3>Produits Frais</h3>
                <p>Qualité et fraîcheur garanties</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-check-circle"></i>
                <h3>Qualité Assurée</h3>
                <p>Produits sélectionnés avec soin</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-phone-alt"></i>
                <h3>Support 24/7</h3>
                <p>Service client à votre écoute</p>
            </div>
        </div>
    </section>

    <!-- Packs Section -->
    <section id="packs" class="packs">
        <div class="container">
            <div class="section-header">
                <h2>Nos Packs Alimentaires</h2>
                <p>Découvrez notre sélection de packs alimentaires adaptés à tous vos besoins</p>
            </div>
            <div class="packs-grid">
                <!-- Pack 1 -->
                <div class="pack-card">
                    <div class="pack-image">
                        <img src="images/pack1.jpg" alt="Pack Familial">
                        <div class="pack-tag">Populaire</div>
                    </div>
                    <div class="pack-details">
                        <h3>Pack Familial</h3>
                        <p class="pack-description">Un pack complet pour nourrir toute la famille pendant une semaine. Contient des produits frais et des aliments de base.</p>
                        <div class="pack-content">
                            <h4>Contenu du pack:</h4>
                            <ul>
                                <li>5kg de riz</li>
                                <li>2kg de pâtes</li>
                                <li>3L d'huile</li>
                                <li>2kg de viande</li>
                                <li>Assortiment de légumes</li>
                                <li>Fruits de saison</li>
                            </ul>
                        </div>
                        <div class="pack-footer">
                            <div class="pack-price">45,000 FCFA</div>
                            <button class="add-to-cart" data-id="1" data-name="Pack Familial" data-price="45000" data-image="images/pack1.jpg">Ajouter au panier</button>
                        </div>
                    </div>
                </div>

                <!-- Pack 2 -->
                <div class="pack-card">
                    <div class="pack-image">
                        <img src="images/pack2.jpg" alt="Pack Économique">
                        <div class="pack-tag">Économique</div>
                    </div>
                    <div class="pack-details">
                        <h3>Pack Économique</h3>
                        <p class="pack-description">Un pack essentiel à prix abordable contenant tous les aliments de base nécessaires pour une personne.</p>
                        <div class="pack-content">
                            <h4>Contenu du pack:</h4>
                            <ul>
                                <li>2kg de riz</li>
                                <li>1kg de pâtes</li>
                                <li>1L d'huile</li>
                                <li>1kg de viande</li>
                                <li>Assortiment de légumes</li>
                            </ul>
                        </div>
                        <div class="pack-footer">
                            <div class="pack-price">25,000 FCFA</div>
                            <button class="add-to-cart" data-id="2" data-name="Pack Économique" data-price="25000" data-image="images/pack2.jpg">Ajouter au panier</button>
                        </div>
                    </div>
                </div>

                <!-- Pack 3 -->
                <div class="pack-card">
                    <div class="pack-image">
                        <img src="images/pack3.jpg" alt="Pack Premium">
                        <div class="pack-tag">Premium</div>
                    </div>
                    <div class="pack-details">
                        <h3>Pack Premium</h3>
                        <p class="pack-description">Notre pack haut de gamme avec des produits de qualité supérieure et des spécialités gastronomiques.</p>
                        <div class="pack-content">
                            <h4>Contenu du pack:</h4>
                            <ul>
                                <li>5kg de riz basmati</li>
                                <li>2kg de pâtes italiennes</li>
                                <li>2L d'huile d'olive extra vierge</li>
                                <li>3kg de viandes assorties</li>
                                <li>Légumes bio</li>
                                <li>Fruits exotiques</li>
                                <li>Assortiment d'épices</li>
                            </ul>
                        </div>
                        <div class="pack-footer">
                            <div class="pack-price">75,000 FCFA</div>
                            <button class="add-to-cart" data-id="3" data-name="Pack Premium" data-price="75000" data-image="images/pack3.jpg">Ajouter au panier</button>
                        </div>
                    </div>
                </div>

                <!-- Pack 4 -->
                <div class="pack-card">
                    <div class="pack-image">
                        <img src="images/pack4.jpg" alt="Pack Végétarien">
                        <div class="pack-tag">Végétarien</div>
                    </div>
                    <div class="pack-details">
                        <h3>Pack Végétarien</h3>
                        <p class="pack-description">Un pack complet de produits végétariens riches en protéines et en nutriments essentiels.</p>
                        <div class="pack-content">
                            <h4>Contenu du pack:</h4>
                            <ul>
                                <li>3kg de riz complet</li>
                                <li>2kg de légumineuses</li>
                                <li>1L d'huile végétale</li>
                                <li>Assortiment de légumes frais</li>
                                <li>Fruits de saison</li>
                                <li>Noix et graines</li>
                            </ul>
                        </div>
                        <div class="pack-footer">
                            <div class="pack-price">35,000 FCFA</div>
                            <button class="add-to-cart" data-id="4" data-name="Pack Végétarien" data-price="35000" data-image="images/pack4.jpg">Ajouter au panier</button>
                        </div>
                    </div>
                </div>

                <!-- Pack 5 -->
                <div class="pack-card">
                    <div class="pack-image">
                        <img src="images/pack5.jpg" alt="Pack Petit Déjeuner">
                        <div class="pack-tag">Spécial</div>
                    </div>
                    <div class="pack-details">
                        <h3>Pack Petit Déjeuner</h3>
                        <p class="pack-description">Tout ce dont vous avez besoin pour des petits déjeuners équilibrés et énergisants pendant un mois.</p>
                        <div class="pack-content">
                            <h4>Contenu du pack:</h4>
                            <ul>
                                <li>Céréales variées</li>
                                <li>Pains spéciaux</li>
                                <li>Confitures artisanales</li>
                                <li>Miel naturel</li>
                                <li>Thé et café</li>
                                <li>Jus de fruits</li>
                            </ul>
                        </div>
                        <div class="pack-footer">
                            <div class="pack-price">30,000 FCFA</div>
                            <button class="add-to-cart" data-id="5" data-name="Pack Petit Déjeuner" data-price="30000" data-image="images/pack5.jpg">Ajouter au panier</button>
                        </div>
                    </div>
                </div>

                <!-- Pack 6 -->
                <div class="pack-card">
                    <div class="pack-image">
                        <img src="images/pack6.jpg" alt="Pack Fête">
                        <div class="pack-tag">Festif</div>
                    </div>
                    <div class="pack-details">
                        <h3>Pack Fête</h3>
                        <p class="pack-description">Un assortiment complet pour organiser vos événements et célébrations avec des produits de qualité.</p>
                        <div class="pack-content">
                            <h4>Contenu du pack:</h4>
                            <ul>
                                <li>Viandes pour grillades</li>
                                <li>Accompagnements variés</li>
                                <li>Sauces et épices</li>
                                <li>Boissons non alcoolisées</li>
                                <li>Desserts assortis</li>
                            </ul>
                        </div>
                        <div class="pack-footer">
                            <div class="pack-price">60,000 FCFA</div>
                            <button class="add-to-cart" data-id="6" data-name="Pack Fête" data-price="60000" data-image="images/pack6.jpg">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packs Scolaires Promo Section -->
    <section class="packs-scolaires-promo">
        <div class="container">
            <div class="promo-content">
                <div class="promo-text">
                    <h2>Découvrez Nos Packs Scolaires</h2>
                    <p>Préparez la rentrée scolaire avec nos packs complets adaptés à tous les niveaux d'études. De la maternelle à l'université, nous avons tout ce qu'il faut pour une année scolaire réussie.</p>
                    <div class="promo-features">
                        <div class="promo-feature">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Tous niveaux scolaires</span>
                        </div>
                        <div class="promo-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Matériel de qualité</span>
                        </div>
                        <div class="promo-feature">
                            <i class="fas fa-tags"></i>
                            <span>Prix avantageux</span>
                        </div>
                    </div>
                    <a href="/packs-scolaires" class="btn-primary">Voir les packs scolaires</a>
                </div>
                <div class="promo-image">
                    <div class="promo-cards">
                        <div class="mini-pack-card">
                            <h4>Pack Primaire</h4>
                            <p>Tout pour le primaire</p>
                            <span class="mini-price">25,000 FCFA</span>
                        </div>
                        <div class="mini-pack-card">
                            <h4>Pack Collège</h4>
                            <p>Matériel complet</p>
                            <span class="mini-price">45,000 FCFA</span>
                        </div>
                        <div class="mini-pack-card">
                            <h4>Pack Lycée</h4>
                            <p>Spécialisé sciences</p>
                            <span class="mini-price">65,000 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="images/about.jpg" alt="À propos de PackAlimentaire">
                </div>
                <div class="about-text">
                    <h2>À Propos de PackAlimentaire</h2>
                    <p>PackAlimentaire est votre partenaire de confiance pour des packs alimentaires de qualité. Nous sélectionnons avec soin chaque produit pour vous offrir le meilleur rapport qualité-prix.</p>
                    <p>Notre mission est de faciliter votre quotidien en vous proposant des solutions alimentaires complètes, adaptées à vos besoins et à votre budget.</p>
                    <p>Avec plus de 10 ans d'expérience dans le domaine, nous nous engageons à vous fournir des produits frais et de qualité, livrés directement chez vous.</p>
                    <a href="#contact" class="btn-secondary">Contactez-nous</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Ce que disent nos clients</h2>
                <p>Découvrez les témoignages de nos clients satisfaits</p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"J'ai commandé le Pack Familial et j'ai été impressionné par la qualité des produits. Tout était frais et bien emballé. Je recommande vivement!"</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/client1.jpg" alt="Client 1">
                        <div class="author-info">
                            <h4>Amadou Diallo</h4>
                            <span>Client fidèle</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"Le Pack Économique est parfait pour une personne seule comme moi. Les produits sont de bonne qualité et le prix est très abordable. Merci PackAlimentaire!"</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/client2.jpg" alt="Client 2">
                        <div class="author-info">
                            <h4>Fatou Sow</h4>
                            <span>Cliente régulière</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"Le service client est exceptionnel et la livraison est toujours ponctuelle. Les packs sont bien pensés et contiennent tout ce dont j'ai besoin."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/client3.jpg" alt="Client 3">
                        <div class="author-info">
                            <h4>Ibrahim Touré</h4>
                            <span>Client depuis 2 ans</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2>Contactez-nous</h2>
                <p>Nous sommes à votre écoute pour toute question ou demande</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Adresse</h3>
                            <p>123 Avenue Principale, Ville, Pays</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h3>Téléphone</h3>
                            <p>+123 456 789</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3>Email</h3>
                            <p>info@packalimentaire.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3>Heures d'ouverture</h3>
                            <p>Lun - Ven: 8h - 18h</p>
                            <p>Sam: 9h - 15h</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Votre nom" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Votre email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" placeholder="Votre téléphone" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Votre message" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Modal -->
    <div class="cart-modal">
        <div class="cart-content">
            <div class="cart-header">
                <h2>Votre Panier</h2>
                <span class="close-cart"><i class="fas fa-times"></i></span>
            </div>
            <div class="cart-items">
                <!-- Cart items will be dynamically added here -->
            </div>
            <div class="cart-footer">
                <div class="cart-total">
                    <h3>Total:</h3>
                    <span>0 FCFA</span>
                </div>
                <button class="btn-checkout">Commander via WhatsApp</button>
                <button class="btn-clear-cart">Vider le panier</button>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h2>Pack<span>Alimentaire</span></h2>
                    <p>Votre fournisseur de packs alimentaires de qualité</p>
                </div>
                <div class="footer-links">
                    <h3>Liens Rapides</h3>
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#packs">Packs Alimentaires</a></li>
                        <li><a href="/packs-scolaires">Packs Scolaires</a></li>
                        <li><a href="#about">À Propos</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-newsletter">
                    <h3>Newsletter</h3>
                    <p>Inscrivez-vous pour recevoir nos offres spéciales</p>
                    <form>
                        <input type="email" placeholder="Votre email" required>
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
                <div class="footer-social">
                    <h3>Suivez-nous</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 PackAlimentaire. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <script src="{{ asset('site_assets/js/script.js') }}"></script>
</body>
</html>
