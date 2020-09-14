define(
    [
        'ko',
        'SajidPatel_SocialInfluencer/js/api/graphql/products-apollo',
        'SajidPatel_SocialInfluencer/js/api/graphql/graphql-pager'
    ],
    function(
        ko,
        queryProducts,
        getPagingInfo
    ) {
        'use strict';

        function createEmptyProduct() {
            return ko.track({
                name: '....',
                url: '',
                image: 'https://image.shutterstock.com/image-vector/empty-placeholder-image-icon-design-260nw-1366372628.jpg'
            });
        }

        function createEmptyProducts(n) {
            const products = [];

            while (n-- > 0) {
                products.push(createEmptyProduct());
            }

            return products;
        }

        function updateProducts(product, productData) {
           product.name = productData.product.name;
           product.url = '/' + productData.product.url_rewrites[0].url;
           product.image = productData.product.image.url;
        }

        const products = {
            items: [],
            totalCount: Number.POSITIVE_INFINITY,
            returned: 0
        };

        function startLoadingProducts(products, toLoad) {
            const {currentPage, pageSize} = getPagingInfo(products.items.length, toLoad);
            const drop = pageSize > products.items.length ? products.items.length : 0;
            const newProducts = createEmptyProducts(pageSize - drop);
            products.items.push(...newProducts);
            console.log({currentPage, overFetched: pageSize - toLoad, pageSize, numberOfKnownProducts: products.items.length});

            queryProducts(pageSize, currentPage).then(result => {
                products.totalCount = result.data.searchInfluencerProduct.total_count;
                result.data.searchInfluencerProduct.products.splice(drop, products.totalCount).forEach(
                    productData => this.updateProducts(newProducts.shift(), productData)
                );
            });

            return newProducts;
        }

        return function (numberOfProductsRequested) {
            const toReturn = Math.min(numberOfProductsRequested, products.totalCount - products.items.length);
            const inBuffer = products.items.length - products.returned;
            const toLoad = Math.max(0, toReturn - inBuffer);

            if (toLoad > 0) {
                startLoadingProducts(products, toLoad);
                products.returned += toReturn;
                return products.items.slice(products.returned - toReturn, products.returned);
            }
        }
    }
);
