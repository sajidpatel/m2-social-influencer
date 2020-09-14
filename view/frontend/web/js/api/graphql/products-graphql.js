define(['apollo-boost'], function(Apollo) {
    'use strict';

    const client = new Apollo.ApolloClient({url: '/graphql'});
    const myQuery = Apollo.gql(`
query searchInfluencerProduct($pageSize: Int!, $currentPage: Int!, $influencerId: String!) {
                        searchInfluencerProduct (
                            filter: {
                                sku: { like: "%%" }
                                influencer_id: { in: [$influencerId] }
                                enabled: {eq: "1"}
                                created_at: {from: "2020-06-18", to: "2020-07-01"}
                                updated_at: {from: "2020-06-18", to: "2020-07-01"}
                            }
                            pageSize: $pageSize
                            currentPage: $currentPage
                        ) {
                            total_count
                            products {
                                id
                                sku
                                influencer_id
                                enabled
                                created_at
                                updated_at
                                product {
                                    sku
                                    name
                                    url_rewrites {
                                        url
                                    }
                                    image {
                                        url
                                    }
                                }

                                influencer {
                                    social_name
                                    id
                                }

                            }
                        }
                    }
        `);

    return function(pageSize, currentPage, influencerId ) {
        return client.query({
                query: myQuery,
                variables: {
                    pageSize: pageSize,
                    currentPage: currentPage,
                    influencerId: influencerId
                }
            });
    }
});
