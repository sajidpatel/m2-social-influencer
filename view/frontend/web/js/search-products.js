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
                influencers: ko.observableArray([]),
                influencerProductName: ko.observable('search'),
                products: ko.observableArray([]),
                isSelected: ko.observable(false),

                tracks: {
                    products: true
                }
            },

            setIsSelected: function () {
                this.influencerName()
            },

            initObservable: function () {
                this._super()
                    .observe({
                        influencerName: ko.observable('Search')
                    });

                this.influencerName.subscribe(function (newValue) {
                    if(newValue){
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
                this.influencers.push(new InfluencerComponent({influencer: influencer}))
            },

            renderInfluencers: function (influencers) {
                console.log(influencers);
                if (influencers !== undefined) {
                    this.influencers.destroyAll();
                    influencers.forEach(this.renderer.bind(this));

                }
            },

            renderer: function(influencer) {
                this.renderInfluencer(influencer);
                //this.renderItems(item);
            },

            setContentElement: function (domNode) {
                this.containerElement = domNode;
                this.renderInitialInfluencers();
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
    }
);
