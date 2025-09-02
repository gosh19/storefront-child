(function() {
    'use strict';

    function initializeProductCarousel() {
        const swiperElements = document.querySelectorAll('.custom-product-carousel-swiper');
        
        if (!swiperElements) return;
        swiperElements.forEach(element => initializeSwiper(element));
    }

    function initializeSwiper(swiperElement) {
        // Inicializa Swiper.js
        new Swiper(swiperElement, {
            slidesPerView: 'auto', // Configurado para que se ajuste al ancho de los items
            spaceBetween: 16, // El margen de 16px que tenés en tu CSS
            loop: true,
            breakpoints: {
                640: { slidesPerView: 'auto', spaceBetween: 16 },
                768: { slidesPerView: 'auto', spaceBetween: 16 },
                1024: { slidesPerView: 'auto', spaceBetween: 16 },
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            scrollbar: { el: '.swiper-scrollbar', hide: false },
            on: {
                slideChange: function () {
                    if (this.activeIndex >0) {
                        if (this.navigation.prevEl) {
                            this.navigation.prevEl.style.opacity = '1';
                        }
                    } else {
                        if (this.navigation.prevEl) {
                            
                            this.navigation.prevEl.style.opacity = '0';
                        }
                    }
                },
            },
        });
    }

    // Espera a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        console.log('wenas');
        
        initializeProductCarousel();

        // Escucha los clics en los botones de "Añadir a la cesta"
        document.body.addEventListener('click', function(event) {
            const button = event.target.closest('.add_to_cart_button');

            if (button) {
                event.preventDefault(); // Evita la recarga de la página

                const productId = button.getAttribute('data-product_id');
                const quantity = 1; // La cantidad es 1

                if (!productId) return; // Si no hay ID, no hace nada

                // Realiza la llamada AJAX a la API de WooCommerce
                const formData = new FormData();
                formData.append('product_id', productId);
                formData.append('quantity', quantity);

                button.classList.add('loading');
                button.disabled = true;

                fetch('/?wc-ajax=add_to_cart', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.fragments) {
                        // El producto se añadió correctamente.
                        // Dispara el evento que le dice a WooCommerce que actualice el mini-carrito.
                        document.body.dispatchEvent(new CustomEvent('added_to_cart', {
                            bubbles: true,
                            detail: {
                                fragments: data.fragments
                            }
                        }));
                    }
                })
                .catch(error => console.error('Error al añadir al carrito:', error))
                .finally(() => {
                    button.classList.remove('loading');
                    button.disabled = false;
                });
            }
        });




    });
})();