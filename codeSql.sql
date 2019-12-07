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
titre varchar(60) not null UNIQUE,
authorID integer(10) not null,
description LONGTEXT,
dateCreation DATETIME not null,
constraint FK_AUTHORID_ALBUM foreign key(authorID) references Users(userID)
);

create table if not exists Image
(
imageID integer(10) auto_increment primary key,
imageUrl varchar(500) not null,
albumID integer(10) not null,
description longtext,
dateCreation DATETIME not null,
constraint FK_ALBUMID_IMAGE foreign key(albumID) references Album(albumID)
);

create table if not exists Commentaire
(
commentaireID integer(10) auto_increment primary key,
typeCom char(3) not null,
dateCreation DATETIME not null,
contenu LONGTEXT not null,
parentID integer(10),
authorID integer(10),
constraint FK_AUTHORID_COMMENT foreign key(authorID) references Users(userID)
);

create table if not exists User_Albums_Likes
(
userID integer(10),
albumID integer(10),
constraint FK_USERID foreign key(userID) references Users(userID),
constraint FK_ALBUMID foreign key(albumID) references Album(albumID),
constraint PK_USERID_ALBUMID primary key (userID,albumID)
);

create table if not exists User_Images_Likes
(
userID integer(10),
imageID integer(10),
constraint FK_USERID foreign key(userID) references Users(userID),
constraint FK_IMAGEMID foreign key(imageID) references Image(imageID),
constraint PK_USERID_IMAGEID primary key (userID,imageID)
);

create table if not exists User_Comments_Likes
(
userID integer(10),
commentID integer(10),
constraint FK_USERID foreign key(userID) references Users(userID),
constraint FK_COMMENTID foreign key(commentID) references Commentaire(commentaireID),
constraint PK_USERID_COMMENTID primary key (userID,commentID)
);