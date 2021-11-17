# Senior PHP Developer Challenge

## Introduction
You have to build a simple cataloging system as a REST API.

You are free to use any PHP libraries or modules in order to complete the challenge. You may choose either MySQL/MariaDB or MongoDB as your data layer.

Code should be covered by tests.

## Requirements

The API should be able to:
* list all products
* list all categories
* retrieve a single product
* create a product
* update a product
* delete a product


## Technical constraints:

* You need to use php.
* You need to persist the categories in a database, you can use any relational or NoSQL database.
* You need to provide a straight-forward method of running your project.
* You need to create _unit_ & _integration tests_ for your project, covering at least 70% of your code.


### Bonus points:

* You will provide a working Dockerfile to run your project and any dependencies, like the database.
* You will use the PATCH HTTP verb to update products.
* You will provide a proper API-Documentation.
* You will use the Cache headers, including the Etag header.


#### Data
> All entities should have timestamp fields (created_at, and modified_at)

Products have the following attributes: 
* name
* category
* SKU
* price
* quantity

Categories have the following attributes:
* name

##### Seed Data
Import the contents of [catalog.json](data/catalog.json) into your database of choice.  It's up to you how you want to construct relations.

### Criteria
For full transparency, the test will be scored according to the following:
* REST Structure
* Best practices
* Testing
* Logging
* Use of services, controllers, and models
* Use of Laravel as a framework
* Reusable code
* Decoupled code
* Ability to transform requirements into code