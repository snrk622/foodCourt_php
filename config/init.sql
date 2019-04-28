create database foodCourt_php;

grant all on foodCourt_php.* to fcuser@localhost identified by 'g8mvuudw';

use foodCourt_php;

create table users (
    id int not null auto_increment primary key,
    email varchar(255) unique,
    password varchar(255),
    created datetime,
    modified datetime
);

desc users;

create table menu (
    id int not null auto_increment primary key,
    name varchar(255) not null,
    price int not null,
    cal int,
    created datetime,
    modified datetime
);