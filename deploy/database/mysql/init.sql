CREATE DATABASE drinkshop;

CREATE ROLE 'drinkshop_role';
GRANT ALL PRIVILEGES ON drinkshop.* TO 'drinkshop_role';
CREATE USER 'drink_user'@'%' IDENTIFIED BY 'your_password';
GRANT 'drinkshop_role' TO 'drink_user'@'%';
SET DEFAULT ROLE 'drinkshop_role' TO 'drink_user'@'%';
FLUSH PRIVILEGES;

