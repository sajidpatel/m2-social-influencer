define(
    [
        'jquery',
        'ko',
        'apollo-client',
        'uiComponent',
        'SajidPatel_SocialInfluencer/js/api/graphql/influencer-graphql',
        'SajidPatel_SocialInfluencer/js/catalog/influencerComponent',
        'SajidPatel_SocialInfluencer/js/catalog/itemComponent'
    ], function (
        $,
        ko,
        ApolloBoost,
        Component,
        queryProducts,
        InfluencerComponent,
        ItemComponent
    ) {
    'use strict';

    return Component.extend({
        defaults: {
            query: ko.observable(),
            influencers: ko.observableArray([]),
            influencerName: ko.observable('search'),
            items: ko.observableArray([]),
            tracks: {
                items: true,
                influencers: true
            }
        },
        initObservable: function () {

            this._super()
                .observe({
                    influencerName: ko.observable('Please enter social influencer by name')
                });

            this.influencerName.subscribe(function (newValue) {
                if(newValue){
                    console.log(newValue);
                    this.searchInfluencer(newValue);
                }
            }, this);

            return this;
        },

        searchInfluencer: function(newValue) {
            let pageSize = 10, currentPage = 1, totalCount = 0;

            queryProducts(pageSize, currentPage, '%' + newValue+ '%').then(result => {
                totalCount = result.data.searchInfluencer.total_count;

                this.renderInfluencers(result.data.searchInfluencer.influencers);
            });
        },

        renderItem: function (item) {
            this.items.push(new ItemComponent({item: item.product}))
        },


        renderItems: function (items) {
            console.log(items);
            if (items.products !== undefined) {
                items.products.forEach(this.renderItem.bind(this))
            }
        },

        renderInfluencer: function (influencer) {
            this.influencers.destroyAll();
            this.influencers.push(new InfluencerComponent({influencer: influencer}))
        },

        renderInfluencers: function (influencers) {
            console.log(influencers);
            if (influencers !== undefined) {
                influencers.forEach(this.renderer.bind(this));

            }
        },

        renderer: function(item) {
            this.renderInfluencer(item);
            //this.renderItems(item);
        },

        setContentElement: function (domNode) {
            this.containerElement = domNode;
            this.renderInitialInfluencers();
        },

        updateProducts: function (product, productData) {
            const url = productData.product.url_rewrites[0].url;
            product.name = productData.product.name;
            product.url = '/' + (typeof url === 'undefined' ? '' : url);
            product.image = productData.product.image.url;
            this.items.push(new InfluencerComponent(product));
        },

        createEmptyProduct: function() {
            return ko.track({
                name: '....',
                url: '',
                image: 'https://image.shutterstock.com/image-vector/empty-placeholder-image-icon-design-260nw-1366372628.jpg'
            });
        },

        createEmptyProducts: function(n) {
            const products = [];

            while (n-- > 0) {
                products.push(this.createEmptyProduct());
            }

            return products;
        },

        renderInitialInfluencers: function() {
            let pageSize = 10, currentPage = 1, totalCount = 0;

            queryProducts(pageSize, currentPage, '%%').then(result => {
                totalCount = result.data.searchInfluencer.total_count;

                this.renderInfluencers(result.data.searchInfluencer.influencers);
            });
        },

        setSentinelelement: function(domNode) {
            return domNode;
        }
    });
});
