define(['apollo-boost'], function(Apollo) {
    'use strict';

    const client = new Apollo.ApolloClient({url: '/graphql'});
    const myQuery = Apollo.gql(`
query searchInfluencer($pageSize: Int!, $currentPage: Int!, $socialName: String!) {
             searchInfluencer (
                filter: {
                  social_name: {like: $socialName}
                }
                pageSize: $pageSize
                currentPage: $currentPage
              ) {
                total_count
                influencers {
                  id
                  customer_id
                  social_name
                  enabled
                  products {
                    id
                    sku
                    influencer_id
                    product {
                        url_rewrites {
                            url
                        }
                        image {
                            url
                        }
                        price {
                            regularPrice {
                                amount {
                                    value
                                    currency
                                }
                            }
                        }
                        price_range {
                            maximum_price {
                                regular_price {
                                    value
                                }
                            }
                            minimum_price {
                                regular_price {
                                    value
                                }
                            }
                        }
                        name
                        sku
                    }
                  }
                }
              }

            }
        `);

    return function(pageSize, currentPage, socialName ) {
        return client.query({
                query: myQuery,
                variables: {
                    pageSize: pageSize,
                    currentPage: currentPage,
                    socialName: socialName
                }
            });
    }
});
