let isNoticeDisplayed = false;
const POST_TYPE = 'question';

wp.data.subscribe(() => {
	const hasCategory = wp.data.select('core/editor').getEditedPostAttribute('partner-taxonomies');
	const postType = wp.data.select('core/editor').getCurrentPostType();

	// == Check post validations
	if (postType === POST_TYPE && (!hasCategory || hasCategory.length === 0)) {
		if (!isNoticeDisplayed) {
			// Lock post saving and show a notice if not displayed already
			isNoticeDisplayed = true;
			wp.data.dispatch('core/editor').lockPostSaving('require-category');
			wp.data.dispatch('core/notices').createNotice('warning', 'You must select a category to save your question.', {
				id: 'require-category',
				isDismissible: false,
			});
		}
	} else if (isNoticeDisplayed) {
		// == If a category is selected but the notice is still displayed
		isNoticeDisplayed = false;
		wp.data.dispatch('core/editor').unlockPostSaving('require-category');
		wp.data.dispatch('core/notices').removeNotice('require-category');
	}
});
