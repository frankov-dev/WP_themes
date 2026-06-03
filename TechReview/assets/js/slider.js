document.addEventListener('DOMContentLoaded', () => {
	const sliderWrappers = document.querySelectorAll('.hero-slider-wrapper');

	if (!sliderWrappers.length) {
		return;
	}

	const DEFAULT_INTERVAL = 10 * 1000;
	const MANUAL_INTERVAL = 20 * 1000;
	const TIMER_VISIBLE_WINDOW = 3 * 1000;

	sliderWrappers.forEach((wrapper) => {
		const slides = Array.from(wrapper.querySelectorAll('.slide'));
		const prevButton = wrapper.querySelector('.slider-arrow-prev');
		const nextButton = wrapper.querySelector('.slider-arrow-next');
		const timer = wrapper.querySelector('.slider-timer');

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
			if (timer) {
				timer.hidden = true;
			}
			return;
		}

		let currentIndex = slides.findIndex((slide) => slide.classList.contains('active'));
		if (currentIndex < 0) {
			currentIndex = 0;
		}

		let currentDelay = DEFAULT_INTERVAL;
		let timeoutId = null;
		let timerId = null;
		let deadline = 0;

		const setActiveSlide = (index) => {
			slides.forEach((slide, slideIndex) => {
				slide.classList.toggle('active', slideIndex === index);
			});
		};

		const formatCountdown = (secondsRemaining) => String(secondsRemaining).padStart(2, '0');

		const updateTimer = () => {
			if (!timer) {
				return;
			}

			const remaining = deadline - Date.now();
			if (remaining > TIMER_VISIBLE_WINDOW || remaining <= 0) {
				timer.hidden = true;
				return;
			}

			timer.textContent = formatCountdown(Math.ceil(remaining / 1000));
			timer.hidden = false;
		};

		const stopTimers = () => {
			if (timeoutId) {
				clearTimeout(timeoutId);
				timeoutId = null;
			}

			if (timerId) {
				clearInterval(timerId);
				timerId = null;
			}
		};

		const startCycle = (delay) => {
			stopTimers();

			currentDelay = delay;
			deadline = Date.now() + currentDelay;

			updateTimer();
			timerId = setInterval(updateTimer, 250);

			timeoutId = setTimeout(() => {
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
		startCycle(DEFAULT_INTERVAL);
	});
});
