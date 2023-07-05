Microservice with Symfony 6. 

Ecommerce promotions engine that looking for best discount for a product.

composer install

symfony console make:docker:database

symfony server:start -d

symfony console make:migration
symfony console doctrine:migrations:migrate


http://127.0.0.1:8000/products/1/lowest-price


{
    "product_id": 11,
    "quantity" : 5,
    "request_location": "UK",
    "voucherCode": "123",
    "requestDate": "2022-11-30",
    "price": 100,
    "discounted_price": 300,
    "promotion_id": 1,
    "promotion_name": "Buy one and get one for free"
}

insert data to db based on this json
