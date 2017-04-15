CREATE TABLE Users (
	fName VARCHAR(30) NOT NULL,
    lName VARCHAR(30) NOT NULL,
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    state VARCHAR(20) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    passwrd VARCHAR(50) NOT NULL
    
);


CREATE TABLE uploadedImages(
    direccion VARCHAR(50) NOT NULL,
    titulo VARCHAR(50) NOT NULL,
	estado VARCHAR(50) NOT NULL,
    renta VARCHAR(10) NOT NULL,
    venta VARCHAR(10) NOT NULL,
    house VARCHAR(10) NOT NULL,
    departamento VARCHAR(10) NOT NULL,
    precio VARCHAR(50) NOT NULL,
    escuelas VARCHAR(50) NOT NULL,
    mercado VARCHAR(50) NOT NULL,
    pool VARCHAR(50) NOT NULL,
    descripcion VARCHAR(300) NOT NULL

);