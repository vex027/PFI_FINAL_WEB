create database if not exists webfinal;
use webfinal;

create table if not exists Users
(
userID integer(10) auto_increment primary key,
username varchar(30) not null UNIQUE,
email varchar(25) unique not null,
password VARCHAR(250) NOT NULL,
imageProfil varchar(500) not null default 'Images_Profil/default.jpg'
);

create table if not exists Album
(
albumID integer(10) auto_increment primary key,
titre varchar(60) not null,
authorID integer(10) not null,
description LONGTEXT,
dateCreation date not null,
constraint FK_AUTHORID_ALBUM foreign key(authorID) references Users(userID)
);

create table if not exists Image
(
imageID integer(10) auto_increment primary key,
imageUrl varchar(500) not null,
albumID integer(10) not null,
description longtext,
dateCreation date not null,
likes int default 0
);

create table if not exists Commentaire
(
commentaireID integer(10) auto_increment primary key,
typeCom char(3) not null,
dateCreation date not null,
contenu LONGTEXT not null,
parentID integer(10)
);