define(['uiComponent', 'ko'], function (Component, ko) {
    'use strict';
    const width = 200, height = 100;

    const InfluencerContainer = Component.extend({
        defaults: {
            template: 'SajidPatel_SocialInfluencer/catalog/influencer',
            width,
            height,
            influencer: ko.observable()
        },
        initConfig : function (options) {

            this._super(options);
            this.influencer = options.influencer;
            return this;
        }
    });

    InfluencerContainer.width = width;
    InfluencerContainer.height = height;

    return InfluencerContainer;
});
