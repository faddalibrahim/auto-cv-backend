drop database if exists `autoCV`;

create database `autoCV`;

use `autoCV`;



-- TABLES

create table person (
    person_id INT PRIMARY KEY,
    fname VARCHAR(20) NOT NULL,
    lname VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL,
    linkedin varchar(30),
    profile_img varchar(30),
    password VARCHAR(40) NOT NULL
);

-- INSERTIONS

insert into person (person_id,fname,lname,email,linkedin,password) values
 (26722023,"Faddal","Ibrahim","faddal.ibrahim@ashesi.edu.gh","faddalibrahim/","dummy_password"),
 (24522023,"Abdul","Wahab","abdul.wahab@ashesi.edu.gh","wahababdul/","dummy_password"),
 (29842021,"Jack","Manus","jack.manus@ashesi.edu.gh","jackmanus/","dummy_password");


-- RETRIEVALS


-- INDEXES
