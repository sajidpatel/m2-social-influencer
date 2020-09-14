define(['jquery', 'Magento_Customer/js/customer-data'], function ($, customer_data) {
    'use strict';

    const section_name = 'social_influencer_products';
    const socialInfluencerProductsSkus = function () {
        const socialInfluencerProducts = customer_data.get(section_name);
        return socialInfluencerProducts().skus || [];
    };

    const isSocialInfluencerProduct = function (sku) {
        return -1 !== socialInfluencerProductsSkus().indexOf(sku);
    };

    /** Is customer logged in */
    const isInfluencerLoggedIn = function () {
        var customer = customer_data.get('customer');

        return $.isEmptyObject(customer()) == false;
    };

    const influencerId = function () {
        return customer_data.get(section_name)().influencer.id

    }

    return function(config) {
        this.isSocialInfluencerProduct = isSocialInfluencerProduct;
        this.isInfluencerLoggedIn = isInfluencerLoggedIn;
        this.influencerId = influencerId;
        this.select = function(sku) {
            return function() {
                const url = config.update_url + sku + '/' + influencerId();
                if (true === this.isInfluencerLoggedIn() && influencerId() == undefined) {
                    window.location.reload();
                }
                if (isSocialInfluencerProduct(sku)) {
                    $.ajax(url, {method: 'DELETE'});
                } else {
                    $.ajax(url, {method: 'POST'});
                }
            }
        };
    };
});
