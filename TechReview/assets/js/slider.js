document.addEventListener('DOMContentLoaded', () => {
	const sliderWrappers = document.querySelectorAll('.hero-slider-wrapper');

	if (!sliderWrappers.length) {
		return;
	}

	const DEFAULT_INTERVAL = 10 * 1000;
	const MANUAL_INTERVAL = 20 * 1000;

	sliderWrappers.forEach((wrapper) => {
		const slides = Array.from(wrapper.querySelectorAll('.slide'));
		const progressItems = Array.from(wrapper.querySelectorAll('.slider-progress-item'));
		const progressFills = progressItems.map((item) => item.querySelector('.slider-progress-fill'));
		const prevButton = wrapper.querySelector('.slider-arrow-prev');
		const nextButton = wrapper.querySelector('.slider-arrow-next');

		if (!slides.length) {
			return;
		}

		if (slides.length === 1) {
			if (prevButton) {
				prevButton.hidden = true;
			}
			if (nextButton) {
				nextButton.hidden = true;
			}
			if (progressItems.length) {
				progressItems.forEach((item) => {
					item.hidden = true;
				});
			}
			return;
		}

		let currentIndex = slides.findIndex((slide) => slide.classList.contains('active'));
		if (currentIndex < 0) {
			currentIndex = 0;
		}

		let currentDelay = DEFAULT_INTERVAL;
		let timeoutId = null;
		let progressAnimationFrame = null;

		const setActiveSlide = (index) => {
			slides.forEach((slide, slideIndex) => {
				slide.classList.toggle('active', slideIndex === index);
			});
		};

		const resetProgressBars = () => {
			progressItems.forEach((item, itemIndex) => {
				item.classList.toggle('is-active', itemIndex === currentIndex);
				item.classList.toggle('is-complete', itemIndex < currentIndex);
				const fill = progressFills[itemIndex];
				if (fill) {
					fill.style.animation = 'none';
					fill.style.transform = itemIndex < currentIndex ? 'scaleX(1)' : 'scaleX(0)';
				}
			});
		};

		const animateCurrentProgress = () => {
			const fill = progressFills[currentIndex];
			if (!fill) {
				return;
			}

			if (progressAnimationFrame) {
				cancelAnimationFrame(progressAnimationFrame);
			}

			fill.style.animation = 'none';
			fill.style.transform = 'scaleX(0)';
			progressAnimationFrame = requestAnimationFrame(() => {
				fill.style.animation = `slider-progress-fill ${currentDelay}ms linear forwards`;
			});
		};

		const stopTimers = () => {
			if (timeoutId) {
				clearTimeout(timeoutId);
				timeoutId = null;
			}

			if (progressAnimationFrame) {
				cancelAnimationFrame(progressAnimationFrame);
				progressAnimationFrame = null;
			}
		};

		const startCycle = (delay) => {
			stopTimers();

			currentDelay = delay;
			resetProgressBars();

			animateCurrentProgress();

			timeoutId = setTimeout(() => {
				progressItems[currentIndex]?.classList.remove('is-active');
				progressItems[currentIndex]?.classList.add('is-complete');
				currentIndex = (currentIndex + 1) % slides.length;
				setActiveSlide(currentIndex);
				startCycle(DEFAULT_INTERVAL);
			}, currentDelay);
		};

		const goToSlide = (index, isManual = false) => {
			currentIndex = (index + slides.length) % slides.length;
			setActiveSlide(currentIndex);
			startCycle(isManual ? MANUAL_INTERVAL : DEFAULT_INTERVAL);
		};

		if (prevButton) {
			prevButton.addEventListener('click', () => {
				goToSlide(currentIndex - 1, true);
			});
		}

		if (nextButton) {
			nextButton.addEventListener('click', () => {
				goToSlide(currentIndex + 1, true);
			});
		}

		setActiveSlide(currentIndex);
		resetProgressBars();
		startCycle(DEFAULT_INTERVAL);
	});
});
