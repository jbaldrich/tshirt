# T-Shirts
## A simple bounded context to CRUD T-Shirts in DDD

⚠️ DISCLAIMER: This package has been made just for academic purposes, please never use in production environments.

### 🎭 Scenario

We have a T-shirt e-commerce. Each T-shirt has a name and multiple sizes (S/M/L) called variants. Each variant has a price and an optional offer price.

### 🎬 Use cases

* Create T-shirts and variants
* Change T-shirt name
* Change variant prices
* Remove T-shirts and variants
* Query T-shirts and variants to get the cheapest variant, the average price and the average discount for a T-shirt.

### 🤔 Strategic decisions

The first approach was the most logical one: a module with the **entity T-shirt as the aggregate root**, and the **entity variant as a simple aggregate depending on the aggregate root**.

However, I found the entity variant with pretty much potential to grow so I decided to **split the two entities into segregated modules**. This way they are easier to maintain and test.

The only problem with this decision is in terms of **transactionality** but it can be resolved by using **domain events**.

#### 👯 CQRS

There is a basic example of command and query segregation responsibility. There are **query/commands and handlers for every use case**. However, buses have no implementation to remain the example very simple.

#### 🎟️ Domain Events

The aggregate roots are responsible to **store any change on their state as a domain event**. Then they would be able to communicate these changes to any subscribed element inside or outside the module through an event bus. This bus has no implementation for the same reason as the query/command buses.

### 🔧 Installation

Just clone the repo and install dependencies.

``
git clone https://github.com/jbaldrich/tshirt.git
cd tshirt
composer install
``

### 🕵️ Testing

Run the unit tests with the following command:

``
composer test
``

### 🚴‍♂️ WorkFlow file

The WorkFlow file has been made to help the tester understand the workflow of the application. It just makes all possible changes and finally dumps the state of the T-Shirt Aggregate Root.

``
php tests/WorkFlow/index.php
``

or

``
composer workflow
``

