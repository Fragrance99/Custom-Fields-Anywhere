(function ($) {
    function loadPosts(postType, selectedPost) {
        let postDropdown = $('[data-setting="post_id"]');
        let nonce = customFieldsAnywhere.nonce; // WordPress security nonce

        postDropdown.empty().append('<option>Loading...</option>');

        $.ajax({
            url: customFieldsAnywhere.ajax_url,
            type: 'POST',
            data: {
                action: 'get_posts_by_type',
                post_type: postType,
                nonce: nonce
            },
            success: function (response) {
                postDropdown.empty();
                if (response.success) {
                    $.each(response.data, function (id, title) {
                        postDropdown.append(new Option(title, id));
                    });

                    // Set the saved value if it exists
                    if (selectedPost && response.data[selectedPost]) {
                        postDropdown.val(selectedPost).trigger('change');
                    }
                } else {
                    postDropdown.append('<option>No posts found</option>');
                }
            }
        });
    }

    // Load posts when post type changes
    $(document).on('change', '[data-setting="post_type"]', function () {
        let postType = $(this).val();
        loadPosts(postType, null);
    });

    // Restore the saved post selection when opening the widget
    $(document).ready(function () {
        let postType = $('[data-setting="post_type"]').val();
        let selectedPost = $('[data-setting="post_id"]').val();

        if (postType) {
            loadPosts(postType, selectedPost);
        }
    });

})(jQuery);
