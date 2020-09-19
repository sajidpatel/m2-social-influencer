# Magento Module Social Influencer / Influencer Products Coding Challenge

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [How to use it](#markdown-header-how-to-use-it)

## Main Functionalities

* Created new Tables with Declarative Schema
* Used Data Patch to import Sample Data
* Used Private content and Local storage as well as Ajax for dynamic content
* Implemented GraphQL Endpoint with Filter Query
* Mutation to create a new Influencer and Influencer Product.
Do not use this in production, there are no security checks implemented.

-----
## Social Influencer Products Coding Challenge

The purpose of this Magento 2 module is as a coding challenge for suitable candidates.

This module is **NOT intended for production**!

## The Challenge

Will be emailed to candidates in due course.

-----

## Instalation 

### Type 1: Zip file

 - Unzip the zip file in to `app/code/SajidPatel/SocialInfluencer`
 - Enable the module by running `php bin/magento module:enable SajidPatel_SocialInfluencer`
 - Apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Install the module composer by running ```composer require sajidpatel/social-influencer```
 - enable the module by running `php bin/magento module:enable SajidPatel_SocialInfluencer`
 - apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

Fork the repository as a public repository in your own github account
Complete the coding challenge
Submit your git repo to sajid.patel@interactivedezine.co.uk

##### The Code is not for use on a ***production server***, it is only meant as a **proof of concept** coding challenge

## How to use it 

# GraphQL 
# Queries
```
searchInfluencer
searchInfluencerProducts
```

searchInfluencer

```
query {
 searchInfluencer(
    filter: {
      id: {in: ["1","2" ]}
    }
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
        product {
          sku
          name
          id
          description {
            	html
          }
          short_description {
            html
          }
          image {
            url
          }
        }
      }
    }
  } 
}
```
Success:
```
{
  "data": {
    "searchInfluencer": {
      "total_count": 1,
      "influencers": [
        {
          "id": 1,
          "customer_id": 4,
          "social_name": "Daily Dose",
          "enabled": "1",
          "products": [
            {
              "id": 1,
              "sku": "24-WG087",
              "product": {
                "sku": "24-WG087",
                "name": "Sprite Yoga Strap 10 foot",
                "id": 35,
                "description": {
                  "html": "<p>The Sprite Yoga Strap is your untiring partner in demanding stretches, holds and alignment routines. The strap's 100% organic cotton fabric is woven tightly to form a soft, textured yet non-slip surface. The plastic clasp buckle is easily adjustable, lightweight and durable under strain.</p>\n<ul>\n<li>10' long x 1.0\" wide.\n<li>100% soft and durable cotton.\n<li>Plastic cinch buckle is easy to use.\n<li>Three natural colors made from phthalate and heavy metal free dyes.\n</ul>"
                },
                "short_description": {
                  "html": ""
                },
                "image": {
                  "url": "https://m2react.test/media/catalog/product/cache/9c1e2ba4c5cf6cfe2bd7f7cb2898edcd/l/u/luma-yoga-strap.jpg"
                }
              }
            }
          ]
        }
      ]
    }
  }
}
```


searchInfluencerProduct:
```
query{
    searchInfluencerProduct (
        filter: { 
           sku: { like: "%%" }
           influencer_id: { eq: "1" }
          enabled: {eq: "1"}
          created_at: {from: "2020-06-18", to: "2020-06-19"}
          updated_at: {from: "2020-06-18", to: "2020-06-19"}
        }
        pageSize:6
        currentPage:1
    ) {
        total_count
        products {
            id
            sku
            influencer_id
            enabled
            created_at
            product {
                sku
                name
            }
            influencers {
                total_count
                influencers {
                    social_name
                }
            }
        }
    }
}

```
success:
```
{
  "data": {
    "searchInfluencerProduct": {
      "total_count": 4,
      "products": [
        {
          "id": 1,
          "sku": "24-WG087",
          "influencer_id": "1",
          "enabled": true,
          "created_at": "2020-06-18 12:35:00",
          "product": {
            "sku": "24-WG087",
            "name": "Sprite Yoga Strap 10 foot"
          },
          "influencers": {
            "total_count": 1,
            "influencers": [
              {
                "social_name": "Sajid Patel"
              }
            ]
          }
        },
        {
          "id": 2,
          "sku": "MJ09-XS-Blue",
          "influencer_id": "1",
          "enabled": true,
          "created_at": "2020-06-18 12:35:00",
          "product": {
            "sku": "MJ09-XS-Blue",
            "name": "Taurus Elements Shell-XS-Blue"
          },
          "influencers": {
            "total_count": 2,
            "influencers": [
              {
                "social_name": "Sajid Patel"
              },
              {
                "social_name": "Marco Mastrorilli"
              }
            ]
          }
        },
        {
          "id": 3,
          "sku": "MH02-M-Red",
          "influencer_id": "1",
          "enabled": true,
          "created_at": "2020-06-18 12:35:00",
          "product": {
            "sku": "MH02-M-Red",
            "name": "Teton Pullover Hoodie-M-Red"
          },
          "influencers": {
            "total_count": 1,
            "influencers": [
              {
                "social_name": "Sajid Patel"
              }
            ]
          }
        },
        {
          "id": 4,
          "sku": "MJ09-S-Blue",
          "influencer_id": "1",
          "enabled": true,
          "created_at": "2020-06-18 12:35:00",
          "product": {
            "sku": "MJ09-S-Blue",
            "name": "Taurus Elements Shell-S-Blue"
          },
          "influencers": {
            "total_count": 2,
            "influencers": [
              {
                "social_name": "Sajid Patel"
              },
              {
                "social_name": "Marco Mastrorilli"
              }
            ]
          }
        }
      ]
    }
  }
}

```


# Mutations
```
createInfluencer
createInfluencerProduct
```


Create Influencer :
```
    mutation {
        createInfluencer (
            input: {
                social_name: "Daily Dose"
                customer_id: 6
                enabled: true
            }    
        ) {
            message
            id
        }
    }
```

Success:

```
    "data": {
        "createInfluencer": {
            "message": "Influencer Successfully Created",
            "id": 36
        }
    }
```
    
Failure:
```
    "data": {
        "createInfluencer": {
            "message": "Unable to save the Influencer.",
            "id": null
        }
     }
```
Create Influencer Product:
```
    createInfluencerProduct (
        input: {
          sku: "24-UG03"
          influencer_id: 4
          enabled: true
        }    
    ) {
        message
        id
    }
```

Success:
```
    "createInfluencerProduct": {
      "message": "Influencer product successfully saved.",
      "id": 20
    }
```
Failure:
```
    "createInfluencerProduct": {
        "message": "Unable to save the Influencer's product.",
        "id": null
    }
```

*Licence:* BSD-3-Clause  
*Author:* Sajid Patel 
*Copyright:* 2020 Sajid Patel 
*Website:* [http://sajidpatel.me/](http://sajidpatel.me/)  
