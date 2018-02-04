drop database if EXISTS epicerie;
create database epicerie;
	use epicerie;


create table TypeProduit(
id INT PRIMARY KEY auto_increment NOT NULL,
nom varchar(100)
);

create table Produit( 
	id int primary key auto_increment not null,
	nom varchar(100),
	prix double,
	mois int,
	stock int,
	image VARCHAR(100),
	idType int not null,
	foreign key(idType) references TypeProduit(id)
	);

create TABLE User(
id int PRIMARY KEY auto_increment not null,
login varchar(100) not null UNIQUE ,
password VARCHAR(20) not null
);

insert into TypeProduit(nom) values("fruit"),("légume");

insert into Produit(nom, prix, mois, stock, idType, image)
 values("Tomate",2.5,5,25,1,null),
	("Mangue",10,8,2,1,null),
	("Salade",1,1,50,2,"salade.jpg");

insert into User(login, password) VALUE ("dev","dev");
