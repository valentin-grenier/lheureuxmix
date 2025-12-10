document.addEventListener('DOMContentLoaded', () => {
	const scrollButton = document.querySelector('.hm-scroll-to-top');

	scrollButton.addEventListener('click', () => {
		window.scrollTo({
			top: 0,
			behavior: 'smooth',
		});
	});
});
