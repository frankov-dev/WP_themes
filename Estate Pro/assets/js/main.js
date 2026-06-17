/**
 * Gallery Slider
 */
document.addEventListener( 'DOMContentLoaded', function() {
    const gallerySliders = document.querySelectorAll( '.gallery-slider' );

    gallerySliders.forEach( ( slider ) => {
        const track = slider.querySelector( '.gallery-track' );
        const slides = slider.querySelectorAll( '.gallery-slide' );
        const prevBtn = slider.querySelector( '.gallery-btn-prev' );
        const nextBtn = slider.querySelector( '.gallery-btn-next' );
        const dots = slider.querySelectorAll( '.gallery-dot' );

        if ( slides.length <= 1 ) return;

        let currentIndex = 0;
        const slideCount = slides.length;

        const updateSlider = ( index ) => {
            // Ensure index is within bounds
            if ( index < 0 ) {
                currentIndex = slideCount - 1;
            } else if ( index >= slideCount ) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }

            // Update track position
            const offset = -currentIndex * 100;
            track.style.transform = `translateX(${ offset }%)`;

            // Update dots
            dots.forEach( ( dot, i ) => {
                dot.classList.toggle( 'active', i === currentIndex );
            } );
        };

        // Previous button
        if ( prevBtn ) {
            prevBtn.addEventListener( 'click', () => {
                updateSlider( currentIndex - 1 );
            } );
        }

        // Next button
        if ( nextBtn ) {
            nextBtn.addEventListener( 'click', () => {
                updateSlider( currentIndex + 1 );
            } );
        }

        // Dot navigation
        dots.forEach( ( dot, index ) => {
            dot.addEventListener( 'click', () => {
                updateSlider( index );
            } );
        } );

        // Keyboard navigation
        document.addEventListener( 'keydown', ( e ) => {
            if ( e.key === 'ArrowLeft' ) {
                updateSlider( currentIndex - 1 );
            } else if ( e.key === 'ArrowRight' ) {
                updateSlider( currentIndex + 1 );
            }
        } );
    } );
} );
