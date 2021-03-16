CREATE database if not exists BPC_BDD3;
use BPC_BDD3;

CREATE TABLE users (
  id_u int(10) NOT NULL AUTO_INCREMENT ,
  firstName varchar(255) default NULL,
  lastName varchar(255) default NULL,
  email varchar(255) default NULL,
  mdp varchar(255) default NULL,
  adresse varchar(255)default NULL,
  primary key(id_u)
);

CREATE TABLE inputDevis (
  id_devis int(10) AUTO_INCREMENT ,
  probleme varchar(250),
  machine varchar(250),
  problemeDescription varchar(255),
  machineDescription varchar(255),
  primary key(id_devis)
);

CREATE TABLE inputMail (
  id_mail int(10) AUTO_INCREMENT ,
  id_u int(10),
  id_devis int(10),
  mail varchar (350),
  primary key(id_mail),
  FOREIGN key (id_u) references users (id_u),
  FOREIGN key (id_devis) references inputDevis (id_devis)
);