// == Query Loop: Related Posts ==
wp.blocks.registerBlockVariation('core/query', {
	name: 'heureux-mix/related-posts',
	title: 'Related Posts',
	description: 'Display a list of related posts based on the current post.',
	icon: 'screenoptions',
	category: 'loops',
	// isActive: ({ namespace, query }) => {
	// 	return namespace === VARIATION_NAME && query.postType === 'post';
	// },
	attributes: {
		namespace: 'heureux-mix/related-posts',
	},
});

// == Query Loop: Homepage FAQ ==
wp.blocks.registerBlockVariation('core/query', {
	name: 'heureux-mix/homepage-faq',
	title: 'Homepage FAQ',
	description: 'Display a list of FAQ posts on the homepage.',
	icon: 'screenoptions',
	category: 'loops',
	attributes: {
		namespace: 'heureux-mix/homepage-faq',
	},
});
