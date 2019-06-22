jQuery(document).ready(function( $ ) {

	/* premium indicator */
    $("input.premium").attr('disabled', 'disabled');
    var prem = $("input.premium").parent();
	$(prem).append('<span class="pro">PRO</span>');

	/* autocomplete for pages */

    if ( $( autocomplete['pages']).length > 0 ) {

        var pages = [];

        $(autocomplete['pages']).each(function () {
            var page = {
                id: this[1],
                text: this[0] + ' (ID: ' + this[1] + ')',
            }
            pages.push(page);
        });

        $('.select-pages').selectWoo({
            data: pages,
            multiple: true,
        });
    }

    /* autocomplete for posts */

     if ( $( autocomplete['posts']).length > 0 ) {

        var posts = [];

        $(autocomplete['posts']).each(function () {
            var post = {
                id: this[1],
                text: this[0] + ' (ID: ' + this[1] + ')',
            }
            posts.push(post);
        });

        $('.select-posts').selectWoo({
            data: posts,
            multiple: true,
        });
    }

    /* autocomplete for categories */

     if ( $( autocomplete['categories']).length > 0 ) {

        var categories = [];

        $(autocomplete['categories']).each(function () {
            var category = {
                id: this[1],
                text: this[0] + ' (ID: ' + this[1] + ')',
            }
            categories.push(category);
        });

        $('.select-categories').selectWoo({
            data: categories,
            multiple: true,
        });
    }

     /* autocomplete for products */

     if ( $( autocomplete['products']).length > 0 ) {

        var products = [];

        $(autocomplete['products']).each(function () {
            var product = {
                id: this[1],
                text: this[0] + ' (ID: ' + this[1] + ')',
            }
            products.push(product);
        });

        $('.select-products').selectWoo({
            data: products,
            multiple: true,
        });
    }

     /* autocomplete for product categories */

     if ( $( autocomplete['product_categories']).length > 0 ) {

        var product_categories = [];

        $(autocomplete['product_categories']).each(function () {
            var product_category = {
                id: this[1],
                text: this[0] + ' (ID: ' + this[1] + ')',
            }
            product_categories.push(product_category);
        });

        $('.select-product-categories').selectWoo({
            data: product_categories,
            multiple: true,
        });
    }

});

