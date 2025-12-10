document.addEventListener('DOMContentLoaded', () => {
	const form = document.querySelector('.wpcf7-form');
	if (!form) return;

	const messageType = form.querySelector('select[name="your-subject"]');

	// == Display event fields if the message type is an event
	if (messageType) {
		messageType.addEventListener('change', () => {
			const isEvent = messageType.value === 'Animation de soirée';
			document.querySelector('#event-information').classList.toggle('visible', isEvent);
		});
	}
});
