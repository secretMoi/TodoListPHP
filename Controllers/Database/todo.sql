CREATE DATABASE todo;

CREATE TABLE todo.Status (
	ID INT NOT NULL,
	Nom varchar(30),
	PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE todo.Personnes (
    ID int NOT NULL,
    Nom varchar(30),
    Prenom varchar(30),
    AdresseMail varchar(100),
    MotDePasse char(64),
	Status int,
	PRIMARY KEY (ID),
	FOREIGN KEY (Status) REFERENCES Status(ID)
) ENGINE=InnoDB;

CREATE TABLE todo.Todo (
    ID int NOT NULL,
    Titre varchar(30),
    DateCreation DateTime,
    DateModif DateTime,
    Contenu varchar(100),
	Status int,
	PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE todo.Gerer (
	ID INT NOT NULL,
	IDPers INT,
	IDTodo INT,
	PRIMARY KEY (ID),
	FOREIGN KEY (IDPers) REFERENCES Personnes(ID),
	FOREIGN KEY (IDTodo) REFERENCES Todo(ID)
) ENGINE=InnoDB;
