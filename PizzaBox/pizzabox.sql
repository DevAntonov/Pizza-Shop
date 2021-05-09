CREATE SCHEMA pizzabox;

CREATE TABLE pizzabox.admin ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	admin_name           varchar(100)  NOT NULL    ,
	password             varchar(100)  NOT NULL    
 ) engine=InnoDB;

CREATE TABLE pizzabox.category ( 
	id                   int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL    
 ) engine=InnoDB;

CREATE TABLE pizzabox.customer ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	first_name           varchar(100)  NOT NULL    ,
	last_name            varchar(100)  NOT NULL    ,
	email                varchar(100)  NOT NULL    ,
	password             varchar(100)  NOT NULL    ,
	phone_number         varchar(50)  NOT NULL    ,
	address              varchar(100)  NOT NULL    
 ) engine=InnoDB;

CREATE TABLE pizzabox.product_type ( 
	id                   int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL    
 ) engine=InnoDB;

CREATE TABLE pizzabox.product_item ( 
	id                   int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	type_id              int UNSIGNED NOT NULL    ,
	name                 varchar(100)  NOT NULL    
 ) engine=InnoDB;

CREATE TABLE pizzabox.content ( 
	id                   int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	item_id              int UNSIGNED NOT NULL    
 ) engine=InnoDB;

CREATE TABLE pizzabox.menu_item ( 
	id                   int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	category_id          int UNSIGNED NOT NULL    ,
	name                 varchar(100)  NOT NULL    ,
	image                varchar(100)  NOT NULL    ,
	description          varchar(100)  NOT NULL    ,
	content_id           int UNSIGNED NOT NULL    ,
	price                float(10,2) UNSIGNED NOT NULL    
 ) engine=InnoDB;

CREATE TABLE pizzabox.order_item ( 
	id                   int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	menu_item            int UNSIGNED NOT NULL    ,
	quantity             int UNSIGNED NOT NULL    ,
	specific_description varchar(255)      
 ) engine=InnoDB;

CREATE TABLE pizzabox.order_details ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	customer             bigint UNSIGNED NOT NULL    ,
	item                 int UNSIGNED NOT NULL    ,
	order_date           timestamp  NOT NULL    ,
	total                float(10,2) UNSIGNED NOT NULL    
 ) engine=InnoDB;

ALTER TABLE pizzabox.content ADD CONSTRAINT fk_content_product_item FOREIGN KEY ( item_id ) REFERENCES pizzabox.product_item( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE pizzabox.menu_item ADD CONSTRAINT fk_menu_item_category FOREIGN KEY ( category_id ) REFERENCES pizzabox.category( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE pizzabox.menu_item ADD CONSTRAINT fk_menu_item_content FOREIGN KEY ( content_id ) REFERENCES pizzabox.content( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE pizzabox.order_details ADD CONSTRAINT fk_order_details_customer FOREIGN KEY ( customer ) REFERENCES pizzabox.customer( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE pizzabox.order_details ADD CONSTRAINT fk_order_details_order_item FOREIGN KEY ( item ) REFERENCES pizzabox.order_item( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE pizzabox.order_item ADD CONSTRAINT fk_order_item_menu_item FOREIGN KEY ( menu_item ) REFERENCES pizzabox.menu_item( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE pizzabox.product_item ADD CONSTRAINT fk_product_item_product_type FOREIGN KEY ( type_id ) REFERENCES pizzabox.product_type( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

