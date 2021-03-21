CREATE TABLE Templates (
    id int NOT NULL AUTO_INCREMENT,
    title varchar (255),
    contents varchar (10000),
    comments TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE Applicants (
    id int NOT NULL AUTO_INCREMENT,
    name varchar (100) UNIQUE,
    email varchar (100),
    phone BIGINT (25),
    PRIMARY KEY (id)
);

CREATE TABLE Roles (
    id int NOT NULL AUTO_INCREMENT,
    title varchar (100),
    PRIMARY KEY (id)
);

CREATE TABLE Applicants_Roles(
    applicant_id int NOT NULL,
    role_id int NOT NULL,
    FOREIGN KEY (applicant_id) REFERENCES Applicants (id),
    FOREIGN KEY (role_id) REFERENCES Roles (id)
);

CREATE TABLE Users(
    id int NOT NULL AUTO_INCREMENT,
    username varchar (100) DEFAULT NULL, 
    password varchar (200) DEFAULT NULL,
    name_surname varchar (100) DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (username)
);
