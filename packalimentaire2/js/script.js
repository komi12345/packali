// DOM Elements
const cartIcon = document.querySelector('.cart-icon');
const cartModal = document.querySelector('.cart-modal');
const closeCart = document.querySelector('.close-cart');
const cartItems = document.querySelector('.cart-items');
const cartTotal = document.querySelector('.cart-total span');
const cartCount = document.querySelector('.cart-count');
const checkoutBtn = document.querySelector('.btn-checkout');
const clearCartBtn = document.querySelector('.btn-clear-cart');
const addToCartBtns = document.querySelectorAll('.add-to-cart');
const mobileMenuBtn = document.querySelector('.mobile-menu');
const navLinks = document.querySelector('.nav-links');

// Cart Array
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    // Initialize cart
    loadCart();
    updateCartUI();

    // Add to cart buttons
    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', addToCart);
    });

    // Cart icon click
    cartIcon.addEventListener('click', () => {
        cartModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    // Close cart
    closeCart.addEventListener('click', () => {
        cartModal.classList.remove('active');
        document.body.style.overflow = 'auto';
    });

    // Click outside to close
    cartModal.addEventListener('click', (e) => {
        if (e.target === cartModal) {
            cartModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Checkout button
    checkoutBtn.addEventListener('click', checkout);

    // Clear cart button
    clearCartBtn.addEventListener('click', clearCart);

    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });

    // Close mobile menu when clicking on a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
        });
    });
});

// Add to cart function
function addToCart(e) {
    const btn = e.currentTarget;
    const id = btn.dataset.id;
    const name = btn.dataset.name;
    const price = parseInt(btn.dataset.price);
    const image = btn.dataset.image;

    // Check if item already in cart
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        // Increase quantity
        existingItem.quantity++;
        showNotification(`Quantité de ${name} augmentée!`);
    } else {
        // Add new item
        cart.push({
            id,
            name,
            price,
            image,
            quantity: 1
        });
        showNotification(`${name} ajouté au panier!`);
    }

    // Update UI and save to localStorage
    updateCartUI();
    saveCart();
}

// Update cart UI
function updateCartUI() {
    // Clear cart items
    cartItems.innerHTML = '';

    // Update cart count
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    cartCount.textContent = totalItems;

    // If cart is empty
    if (cart.length === 0) {
        cartItems.innerHTML = `<div class="empty-cart">Votre panier est vide</div>`;
        cartTotal.textContent = '0 FCFA';
        return;
    }

    // Add items to cart
    cart.forEach(item => {
        const cartItemEl = document.createElement('div');
        cartItemEl.classList.add('cart-item');
        cartItemEl.innerHTML = `
            <div class="cart-item-img">
                <img src="${item.image}" alt="${item.name}">
            </div>
            <div class="cart-item-details">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-price">${item.price.toLocaleString()} FCFA</div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn decrease" data-id="${item.id}">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn increase" data-id="${item.id}">+</button>
                </div>
            </div>
            <div class="cart-item-remove" data-id="${item.id}">
                <i class="fas fa-trash"></i>
            </div>
        `;

        cartItems.appendChild(cartItemEl);
    });

    // Add event listeners to quantity buttons and remove buttons
    document.querySelectorAll('.quantity-btn.decrease').forEach(btn => {
        btn.addEventListener('click', decreaseQuantity);
    });

    document.querySelectorAll('.quantity-btn.increase').forEach(btn => {
        btn.addEventListener('click', increaseQuantity);
    });

    document.querySelectorAll('.cart-item-remove').forEach(btn => {
        btn.addEventListener('click', removeItem);
    });

    // Update total
    const total = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    cartTotal.textContent = `${total.toLocaleString()} FCFA`;
}

// Decrease quantity
function decreaseQuantity(e) {
    const id = e.currentTarget.dataset.id;
    const item = cart.find(item => item.id === id);

    if (item.quantity > 1) {
        item.quantity--;
    } else {
        // Remove item if quantity is 1
        cart = cart.filter(item => item.id !== id);
    }

    updateCartUI();
    saveCart();
}

// Increase quantity
function increaseQuantity(e) {
    const id = e.currentTarget.dataset.id;
    const item = cart.find(item => item.id === id);
    item.quantity++;

    updateCartUI();
    saveCart();
}

// Remove item
function removeItem(e) {
    const id = e.currentTarget.dataset.id;
    cart = cart.filter(item => item.id !== id);

    updateCartUI();
    saveCart();
    showNotification('Produit retiré du panier');
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Load cart from localStorage
function loadCart() {
    cart = JSON.parse(localStorage.getItem('cart')) || [];
}

// Clear cart
function clearCart() {
    cart = [];
    updateCartUI();
    saveCart();
    showNotification('Panier vidé');
}

// Checkout function - WhatsApp integration
function checkout() {
    if (cart.length === 0) {
        showNotification('Votre panier est vide', 'error');
        return;
    }

    // Format cart items for WhatsApp message
    let message = "Bonjour, je souhaite commander les packs suivants:\n\n";
    
    cart.forEach(item => {
        message += `*${item.name}* - Quantité: ${item.quantity} - Prix: ${item.price.toLocaleString()} FCFA\n`;
    });
    
    const total = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    message += `\n*Total: ${total.toLocaleString()} FCFA*`;
    
    // Encode message for URL
    const encodedMessage = encodeURIComponent(message);
    
    // WhatsApp phone number - replace with your actual number
    const phoneNumber = '123456789'; // Format: country code + number without +
    
    // Create WhatsApp URL
    const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
    
    // Open WhatsApp in new tab
    window.open(whatsappURL, '_blank');
}

// Show notification
function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.classList.add('notification', type);
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `;

    // Add to body
    document.body.appendChild(notification);

    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add notification styles
const notificationStyles = document.createElement('style');
notificationStyles.textContent = `
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transform: translateX(150%);
        transition: transform 0.3s ease;
        z-index: 2000;
        max-width: 350px;
    }
    
    .notification.show {
        transform: translateX(0);
    }
    
    .notification.success {
        background-color: #27ae60;
        color: white;
    }
    
    .notification.error {
        background-color: #e74c3c;
        color: white;
    }
    
    .notification-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .notification i {
        font-size: 1.2rem;
    }
    
    .empty-cart {
        text-align: center;
        padding: 30px;
        color: #777;
        font-size: 1.1rem;
    }
`;

document.head.appendChild(notificationStyles);

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80, // Adjust for header height
                behavior: 'smooth'
            });
        }
    });
});

// Add animation on scroll
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.feature-box, .pack-card, .about-content, .testimonial');
    
    elements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
        
        if (elementPosition < windowHeight - 100) {
            element.classList.add('animate');
        }
    });
};

// Add animation styles
const animationStyles = document.createElement('style');
animationStyles.textContent = `
    .feature-box, .pack-card, .about-content, .testimonial {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .feature-box.animate, .pack-card.animate, .about-content.animate, .testimonial.animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    .feature-box:nth-child(1) { transition-delay: 0.1s; }
    .feature-box:nth-child(2) { transition-delay: 0.2s; }
    .feature-box:nth-child(3) { transition-delay: 0.3s; }
    .feature-box:nth-child(4) { transition-delay: 0.4s; }
    
    .pack-card:nth-child(1) { transition-delay: 0.1s; }
    .pack-card:nth-child(2) { transition-delay: 0.2s; }
    .pack-card:nth-child(3) { transition-delay: 0.3s; }
    .pack-card:nth-child(4) { transition-delay: 0.1s; }
    .pack-card:nth-child(5) { transition-delay: 0.2s; }
    .pack-card:nth-child(6) { transition-delay: 0.3s; }
    
    .testimonial:nth-child(1) { transition-delay: 0.1s; }
    .testimonial:nth-child(2) { transition-delay: 0.2s; }
    .testimonial:nth-child(3) { transition-delay: 0.3s; }
`;

document.head.appendChild(animationStyles);

// Run animation on scroll
window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);

// Sticky header effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});

// Add sticky header styles
const stickyHeaderStyles = document.createElement('style');
stickyHeaderStyles.textContent = `
    header.sticky {
        padding: 10px 0;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    header.sticky .logo h1 {
        font-size: 1.6rem;
    }
    
    header {
        transition: padding 0.3s ease, box-shadow 0.3s ease;
    }
    
    .logo h1 {
        transition: font-size 0.3s ease;
    }
`;

document.head.appendChild(stickyHeaderStyles);