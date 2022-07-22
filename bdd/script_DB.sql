CREATE DATABASE school_tp1
    DEFAULT CHARACTER SET = 'utf8mb4';

use school_tp1;

CREATE Table categorie(
     idCat INT(15) NOT NULL AUTO_INCREMENT,
     libCat VARCHAR(35) NOT NULL,
     constraint pk_idCat PRIMARY KEY(idCat));


CREATE Table role(
    idRole INT(15) NOT NULL AUTO_INCREMENT,
    libRole VARCHAR(20) NOT NULL,
    constraint pk_idRole PRIMARY KEY(idRole)
);


CREATE Table utilisateur(
    matUtil VARCHAR(15) NOT NULL,
    nomUtil VARCHAR(15) NOT NULL,
    prenomUtim VARCHAR(40) NOT NULL,
    contUtil VARCHAR(25) NOT NULL,
    loginUtil VARCHAR(10) NOT NULL,
    passwordUtil VARCHAR(50) NOT NULL,
    idRole INT(15) NOT NULL,
    constraint pk_matUtil PRIMARY KEY(matUtil),
    constraint fk_idRole FOREIGN KEY(idRole) REFERENCES role(idRole)
);

CREATE Table article(
    idArt INT(15) NOT NULL AUTO_INCREMENT,
    codeArt VARCHAR(5) NOT NULL,
    libArt VARCHAR(30) NOT NULL,
    prixArt FLOAT(10) NOT NULL,
    stock INT(10) NOT NULL,
    matUtil VARCHAR(15) NOT NULL,
    idCat INT(15) NOT NULL,
    pic VARCHAR(400) NOT NULL,
    constraint pk_idArt PRIMARY KEY(idArt),
    constraint fk_matUtil FOREIGN KEY(matUtil) REFERENCES utilisateur(matUtil),
    constraint fk_idCat FOREIGN KEY(idCat) REFERENCES categorie(idCat)
);