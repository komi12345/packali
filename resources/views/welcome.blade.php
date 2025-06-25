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
                @forelse($packsAlimentaires as $pack)
                    <div class="pack-card">
                        <div class="pack-image">
                            @if($pack->image)
                                <img src="{{ asset('site_assets/images/' . $pack->image) }}" alt="{{ $pack->nom }}">
                            @else
                                <img src="{{ asset('site_assets/images/default-pack.jpg') }}" alt="{{ $pack->nom }}">
                            @endif
                            @if($pack->tag)
                                <div class="pack-tag">{{ $pack->tag }}</div>
                            @endif
                        </div>
                        <div class="pack-details">
                            <h3>{{ $pack->nom }}</h3>
                            <p class="pack-description">{{ $pack->description }}</p>
                            <div class="pack-content">
                                <h4>Contenu du pack:</h4>
                                <div class="pack-content-text">
                                    {!! nl2br(e($pack->contenu)) !!}
                                </div>
                            </div>
                            <div class="pack-footer">
                                @if($pack->en_promotion)
                                    <div class="pack-price">
                                        <span class="original-price" style="text-decoration: line-through; color: #999; margin-right: 10px;">{{ number_format($pack->prix_original, 0, ',', ' ') }} FCFA</span>
                                        <span class="promo-price" style="color: #e74c3c; font-weight: bold;">{{ number_format($pack->prix, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                @else
                                    <div class="pack-price">{{ number_format($pack->prix, 0, ',', ' ') }} FCFA</div>
                                @endif
                                <button class="add-to-cart" 
                                    data-id="{{ $pack->id }}" 
                                    data-name="{{ $pack->nom }}" 
                                    data-price="{{ $pack->prix }}" 
                                    data-image="{{ $pack->image ? asset('site_assets/images/' . $pack->image) : asset('site_assets/images/default-pack.jpg') }}">
                                    Ajouter au panier
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-packs">
                        <p>Aucun pack alimentaire disponible pour le moment.</p>
                    </div>
                @endforelse
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
