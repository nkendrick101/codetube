<script>
	autosize($('#channel_description'));

	$('#channel_description').maxlength({
		threshold: 6,
		alwaysShow: true,
		warningClass: "m-badge m-badge--success m-badge--rounded m-badge--wide m--margin-top-5",
		limitReachedClass: "m-badge m-badge--danger m-badge--rounded m-badge--wide m--margin-top-5",
		appendToParent: true,
		separator: ' of ',
		preText: 'You have ',
		postText: ' chars',
		validate: true
	});
</script>