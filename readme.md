# T-Shirts
## A simple bounded context to CRUD T-Shirts in DDD

⚠️ DISCLAIMER: This package has been made just for academic purposes, please never use in production environments.

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

