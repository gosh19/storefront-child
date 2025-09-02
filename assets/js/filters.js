document.addEventListener('DOMContentLoaded', function() {
    // Contador de cantidad
    const minusBtn = document.querySelector('.minus');
    const plusBtn = document.querySelector('.plus');
    const quantityInput = document.querySelector('.quantity-input');

    if (minusBtn && plusBtn && quantityInput) {
        minusBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > parseInt(quantityInput.min)) {
                quantityInput.value = currentValue - 1;
            }
        });

        plusBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    }

    // Acordeón de atributos
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const accordionItem = header.closest('.accordion-item');
            accordionItem.classList.toggle('active');
        });
    });

    // Filtro de precio personalizado
    const sliderWrapper = document.querySelector('.price-slider-wrapper');
    console.log(sliderWrapper,'sliderWrapper');
    
    if (sliderWrapper) {
        const minPriceInput = document.createElement('input');
        const maxPriceInput = document.createElement('input');
        const sliderTrackFill = document.createElement('div');

        minPriceInput.type = 'range';
        maxPriceInput.type = 'range';
        sliderTrackFill.classList.add('slider-track-fill');

        minPriceInput.min = 1;
        minPriceInput.max = 200;
        maxPriceInput.min = 1;
        maxPriceInput.max = 200;

        minPriceInput.value = 1;
        maxPriceInput.value = 200;

        sliderWrapper.appendChild(minPriceInput);
        sliderWrapper.appendChild(maxPriceInput);
        sliderWrapper.appendChild(sliderTrackFill);

        const minPriceDisplay = document.getElementById('min-price');
        const maxPriceDisplay = document.getElementById('max-price');

        if (minPriceDisplay && maxPriceDisplay) {
            const updateSlider = () => {
                const minVal = parseInt(minPriceInput.value);
                const maxVal = parseInt(maxPriceInput.value);

                if (minVal > maxVal) {
                    minPriceInput.value = maxVal;
                }

                const minPos = (minPriceInput.value / minPriceInput.max) * 100;
                const maxPos = (maxPriceInput.value / maxPriceInput.max) * 100;

                sliderTrackFill.style.left = minPos + '%';
                sliderTrackFill.style.width = (maxPos - minPos) + '%';
                
                minPriceDisplay.textContent = minVal + '€';
                maxPriceDisplay.textContent = maxVal + '€';
            };

            minPriceInput.addEventListener('input', updateSlider);
            maxPriceInput.addEventListener('input', updateSlider);

            // Actualización inicial
            updateSlider();
        }
    }

    // Filtros de WooCommerce
    const filterButtons = document.querySelectorAll('.filter-button');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Aquí puedes agregar la lógica para aplicar los filtros
            console.log('Filtro aplicado');
        });
    });

    // Inicializar filtros de atributos: click en checkbox aplica/quita filtro manteniendo múltiples
    document.querySelectorAll('.woocommerce-widget-layered-nav-list').forEach(list => {
        const attribute = list.getAttribute('data-attribute'); // p.ej. color
        if (!attribute) return;
        const paramName = 'filter_' + attribute;
        list.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.addEventListener('change', (e) => {
                const term = cb.getAttribute('data-term');
                const url = new URL(window.location.href);
                const current = url.searchParams.get(paramName);
                let values = current ? current.split(',').filter(Boolean) : [];
                if (cb.checked) {
                    if (!values.includes(term)) values.push(term);
                } else {
                    values = values.filter(v => v !== term);
                }
                if (values.length > 0) {
                    url.searchParams.set(paramName, values.join(','));
                } else {
                    url.searchParams.delete(paramName);
                }
                url.searchParams.delete('paged');
                window.location.assign(url.toString());
            });
        });
    });

    // Filtro de precio de WooCommerce
    const priceFilterForm = document.querySelector('.woocommerce-widget-price-filter form');
    if (priceFilterForm) {
        const priceInputs = priceFilterForm.querySelectorAll('input[type="number"]');
        priceInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Auto-submit del formulario cuando cambia el precio
                priceFilterForm.submit();
            });
        });
    }
});
