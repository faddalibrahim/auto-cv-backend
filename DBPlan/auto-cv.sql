drop database if exists auto_cv;

create database auto_cv;

use auto_cv;

-- TABLES
create table person (
	person_id varchar(6) primary key,
    fname varchar(50), 
    lname varchar(50),
    email varchar(250),
    password varchar(255),
    isVerified boolean default 0,
    token varchar(200)
);

create table student(
	student_id  varchar(6) primary key,
    class_of char(4),
    foreign key (student_id) references person(person_id) on delete cascade on update cascade
);

create table admin(
	admin_id  varchar(6) primary key,
    foreign key (admin_id) references person(person_id)
);

create table resume(
	resume_id int auto_increment primary key,
    student_id varchar(6),
    isPublic boolean,
    created_at datetime default current_timestamp on update current_timestamp,
    isViewed boolean,
    foreign key(student_id) references student(student_id) on delete cascade on update cascade
);

create table review(
	reviewer_id varchar(6) not null,
    resume_id int not null,
    feedback text,
    created_at datetime default current_timestamp on update current_timestamp,
    primary key (reviewer_id, resume_id),
    foreign key(reviewer_id) references admin(admin_id) on delete cascade on update cascade,
    foreign key(resume_id) references resume(resume_id) on delete cascade on update cascade
);

create table opportunity(
	opportunity_id int auto_increment primary key,
    admin_id varchar(6),
    content text,
    created_at datetime default current_timestamp on update current_timestamp,
    foreign key(admin_id) references admin(admin_id)
);

-- INSERTIONS
insert into person (person_id, fname, lname, email, password, token) VALUES ("SD1","Faddal","Ibrahim","faddal.ibrahim@ashesi.edu.gh","faddalspassword", "hahaha");
insert into person (person_id, fname, lname, email, password, token) VALUES ("SD2","Kasim","Ibrahim","kassim.ibrahim@ashesi.edu.gh","kassimsspassword", "hahaha");
insert into person (person_id, fname, lname, email, password, token) VALUES ("AD1","Alhassan","Hassan","alhassan.hassan@ashesi.edu.gh","alhassansspassword", "hahaha");
insert into person (person_id, fname, lname, email, password, token) VALUES ("AD2","Linda","Arthur","linda.arthur@ashesi.edu.gh","lindaspassword", "hahaha");


insert into student VALUES ("SD1","2023");
insert into student VALUES ("SD2","2023");
insert into admin VALUES ("AD1");
insert into admin VALUES("AD2");
