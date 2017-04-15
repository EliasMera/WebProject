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
    direccion VARCHAR(50) ,
    titulo VARCHAR(50) ,
	estado VARCHAR(50) ,
    renta VARCHAR(10) ,
    venta VARCHAR(10) ,
    house VARCHAR(10) ,
    departamento VARCHAR(10) ,
    precio VARCHAR(50) ,
    escuelas VARCHAR(50) ,
    mercado VARCHAR(50) ,
    pool VARCHAR(50) ,
    descripcion VARCHAR(300),
    imagen VARCHAR(50)

);