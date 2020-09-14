define(['uiComponent'], function (Component) {
    'use strict';
    const width = 200, height = 300;

    const ItemContainer = Component.extend({
        defaults: {
            template: 'SajidPatel_SocialInfluencer/catalog/item',
            width,
            height
        },
        initConfig : function (options) {
            options.item.url = options.item.url_rewrites[0].url;
            options.item.image = options.item.image.url;

            this._super(options);

            this.item = options.item;
            return this;
        }
    });

    ItemContainer.width = width;
    ItemContainer.height = height;

    return ItemContainer;
});
