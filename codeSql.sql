create table if not exists Usager
(
userId integer(10) auto_increment primary key,
username varchar(30) not null,
email varchar(25) unique not null,
password VARCHAR(250) NOT NULL,
imageProfil LONGTEXT not null
);

create table if not exists Album
(
albumId integer(10) auto_increment primary key,
titre varchar(60) not null,
authorId integer(10) not null,
description LONGTEXT,
dateCreation date not null,

constraint FK_AUTHORID_ALBUM foreign key(authorID) references Usager(userID)
);

create table if not exists Image
(
imageId integer(10) auto_increment primary key,
imageUrl LONGTEXT not null,
albumId integer(10) not null,
description longtext,
dateCreation date not null,

constraint FK_albumID_Image foreign key(albumId) references Album(albumId)
);

create table if not exists Commentaire
(
commentaireId integer(10) auto_increment primary key,
type char(3) constraint type_commentaire check(type = 'IMG' or type = 'ALB'),
dateCreation date not null,
contenu LONGTEXT not null
);