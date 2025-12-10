document.addEventListener('DOMContentLoaded', () => {
	const loader = document.querySelector('#hm-loader');

	if (!loader) return;

	document.documentElement.style.overflow = 'hidden';

	// == Entry animation
	setTimeout(() => {
		loader.classList.add('hidden');
	}, 1500);

	// == When animating
	setTimeout(() => {
		document.documentElement.style.overflow = 'auto';
	}, 2000);

	// == Exit animation
	setTimeout(() => {
		loader.remove();
	}, 3000);
});
