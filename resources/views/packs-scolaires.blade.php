<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PackAlimentaire - Packs Scolaires</title>
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
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/#packs">Packs Alimentaires</a></li>
                    <li><a href="/packs-scolaires" class="active">Packs Scolaires</a></li>
                    <li><a href="/#about">À Propos</a></li>
                    <li><a href="/#contact">Contact</a></li>
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
                <h1>Packs Scolaires pour Tous les Niveaux</h1>
                <p>Découvrez notre sélection de packs scolaires complets, adaptés à chaque niveau d'études, de la maternelle à l'université.</p>
                <a href="#packs-scolaires" class="btn-primary">Découvrir nos packs</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="feature-box">
                <i class="fas fa-graduation-cap"></i>
                <h3>Tous Niveaux</h3>
                <p>De la maternelle à l'université</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-check-double"></i>
                <h3>Qualité Premium</h3>
                <p>Matériel scolaire de marque</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-tags"></i>
                <h3>Prix Compétitifs</h3>
                <p>Rapport qualité-prix optimal</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-box"></i>
                <h3>Packs Complets</h3>
                <p>Tout le nécessaire inclus</p>
            </div>
        </div>
    </section>

    <!-- Packs Section -->
    <section id="packs-scolaires" class="packs">
        <div class="container">
            <div class="section-header">
                <h2>Nos Packs Scolaires</h2>
                <p>Des solutions complètes pour une année scolaire réussie</p>
            </div>

            <!-- Filtres par niveau -->
            <div class="filters">
                <button class="filter-btn active" data-filter="all">Tous les niveaux</button>
                <button class="filter-btn" data-filter="Maternelle">Maternelle</button>
                <button class="filter-btn" data-filter="Primaire">Primaire</button>
                <button class="filter-btn" data-filter="Collège">Collège</button>
                <button class="filter-btn" data-filter="Lycée">Lycée</button>
                <button class="filter-btn" data-filter="Universitaire">Universitaire</button>
            </div>

            <div class="packs-grid">
                @forelse($packsScolaires as $pack)
                    <div class="pack-card" data-niveau="{{ $pack->niveau_scolaire }}">
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
                                <div class="pack-price">{{ number_format($pack->prix, 0, ',', ' ') }} FCFA</div>
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
                        <p>Aucun pack scolaire disponible pour le moment.</p>
                    </div>
                @endforelse
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
                    <p>Votre fournisseur de packs alimentaires et scolaires de qualité</p>
                </div>
                <div class="footer-links">
                    <h3>Liens Rapides</h3>
                    <ul>
                        <li><a href="/">Accueil</a></li>
                        <li><a href="/#packs">Packs Alimentaires</a></li>
                        <li><a href="/packs-scolaires">Packs Scolaires</a></li>
                        <li><a href="/#about">À Propos</a></li>
                        <li><a href="/#contact">Contact</a></li>
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
    <script>
        // Filtrage des packs par niveau scolaire
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const packCards = document.querySelectorAll('.pack-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filter = this.dataset.filter;

                    packCards.forEach(card => {
                        if (filter === 'all' || card.dataset.niveau === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
