CREATE TABLE Templates (
    id int NOT NULL AUTO_INCREMENT,
    title varchar (255),
    contents varchar (10000),
    comments TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE Applicants (
    id int NOT NULL AUTO_INCREMENT,
    name varchar (100),
    position varchar (100),
    email varchar (100),
    phone int (25),
    PRIMARY KEY (id)
);