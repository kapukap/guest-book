create table users (
    id int(11) not null AUTO_INCREMENT primary key,
    name varchar(100) not null,
    email varchar(150) not null,
    password varchar(100) not null,
    date_created timestamp default  current_timestamp);

create table comments (
    comment_id int(11) not null AUTO_INCREMENT primary key,
    user_id int not null,
    comment_created_at timestamp default  current_timestamp,
    FOREIGN KEY (user_id) REFERENCES users(id));