document.addEventListener('DOMContentLoaded', () => {
	const modal = document.querySelector('.hm-modal');
	const modalClose = modal?.querySelector('.hm-modal__close');
	const modalStatus = getCookie('hm-modal') || 'closed';

	if (!modal || !modalStatus) return;

	// == Display modal after 3 seconds
	setTimeout(() => {
		toggleModal('open');
	}, 4000);

	// == Toggle function
	function toggleModal(status) {
		if (status === 'open') {
			modal.classList.add('active');
		} else {
			modal.classList.remove('active');

			// == Remember user action
			setCookie('hm-modal', 'closed', 14); // Cookie expires in 14 days
		}
	}

	modalClose?.addEventListener('click', () => {
		toggleModal('close');
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') {
			toggleModal('close');
		}
	});

	function setCookie(name, value, days) {
		const date = new Date();
		date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
		document.cookie = `${name}=${value}; expires=${date.toUTCString()}; path=/`;
	}

	function getCookie(name) {
		const cookies = document.cookie.split('; ');
		for (const cookie of cookies) {
			const [key, val] = cookie.split('=');
			if (key === name) return val;
		}
		return null;
	}
});
