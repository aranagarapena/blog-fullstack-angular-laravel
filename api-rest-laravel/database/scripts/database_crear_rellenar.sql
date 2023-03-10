CREATE DATABASE IF NOT EXISTS fullstack_blogs_db;
use fullstack_blogs_db;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS posts;

CREATE TABLE users (
  id int(255) auto_increment not null primary key,
  name varchar(50) not null,
  surname varchar(100),
  email varchar(255) not null,
  role varchar(20),
  password varchar(255) not null,
  description text,
  image varchar(255),
  create_at datetime default null,
  updated_at datetime default null,
  remember_token varchar(255)
  
) engine=InnoDb;

create table categories(
id int(255) auto_increment not null primary key,
name varchar(100),
create_at datetime default null,
updated_at datetime default null

)engine=InnoDb;

create table posts(
id int(255) auto_increment not null primary key,
user_id int(255) not null,
category_id int(255) not null,
title varchar(255) not null,
content text not null,
image varchar(255),
create_at datetime default null,
updated_at datetime default null,

constraint fk_user foreign key(user_id) references users(id),
constraint fk_cateroy foreign key(category_id) references categories(id)

)engine=InnoDb;
select * from users;


INSERT INTO users (name, surname, email, role, password, description, image, create_at, updated_at, remember_token) 
VALUES 
('Juan', 'Pérez', 'juan.perez@example.com', 'admin', 'password1', 'Descripción del usuario Juan', 'image1.jpg', NOW(), NOW(), 'token1'),
('María', 'García', 'maria.garcia@example.com', 'user', 'password2', 'Descripción del usuario María', 'image2.jpg', NOW(), NOW(), 'token2'),
('Pedro', 'Martínez', 'pedro.martinez@example.com', 'user', 'password3', 'Descripción del usuario Pedro', 'image3.jpg', NOW(), NOW(), 'token3'),
('Ana', 'Sánchez', 'ana.sanchez@example.com', 'user', 'password4', 'Descripción del usuario Ana', 'image4.jpg', NOW(), NOW(), 'token4'),
('Luis', 'Fernández', 'luis.fernandez@example.com', 'admin', 'password5', 'Descripción del usuario Luis', 'image5.jpg', NOW(), NOW(), 'token5'),
('Marta', 'López', 'marta.lopez@example.com', 'user', 'password6', 'Descripción del usuario Marta', 'image6.jpg', NOW(), NOW(), 'token6'),
('Jorge', 'Hernández', 'jorge.hernandez@example.com', 'user', 'password7', 'Descripción del usuario Jorge', 'image7.jpg', NOW(), NOW(), 'token7'),
('Sofía', 'Díaz', 'sofia.diaz@example.com', 'user', 'password8', 'Descripción del usuario Sofía', 'image8.jpg', NOW(), NOW(), 'token8'),
('Pablo', 'Jiménez', 'pablo.jimenez@example.com', 'admin', 'password9', 'Descripción del usuario Pablo', 'image9.jpg', NOW(), NOW(), 'token9'),
('Carla', 'González', 'carla.gonzalez@example.com', 'user', 'password10', 'Descripción del usuario Carla', 'image10.jpg', NOW(), NOW(), 'token10');

SELECT * from users;

INSERT INTO categories (name, create_at, updated_at)
VALUES 
('Tecnología', NOW(), NOW()),
('Deportes', NOW(), NOW()),
('Entretenimiento', NOW(), NOW()),
('Ciencia', NOW(), NOW()),
('Cocina', NOW(), NOW()),
('Moda', NOW(), NOW()),
('Música', NOW(), NOW()),
('Arte', NOW(), NOW()),
('Negocios', NOW(), NOW()),
('Viajes', NOW(), NOW()),
('Política', NOW(), NOW()),
('Educación', NOW(), NOW()),
('Salud', NOW(), NOW()),
('Mascotas', NOW(), NOW()),
('Medio ambiente', NOW(), NOW());

-- Publicaciones del usuario 1
INSERT INTO posts (user_id, category_id, title, content, image, create_at, updated_at)
VALUES (1, 2, 'Partido de fútbol', 'Ayer fuimos a ver el partido de fútbol y fue increíble. El marcador quedó 3-2 a favor de nuestro equipo favorito. ¡Qué emocionante!', 'imagen1.jpg', NOW(), NOW());

INSERT INTO posts (user_id, category_id, title, content, image, create_at, updated_at)
VALUES (1, 7, 'Concierto de rock', 'El concierto de rock de anoche fue simplemente espectacular. Los músicos dieron lo mejor de sí y la audiencia enloqueció. Aquí les comparto algunas fotos que tomé.', 'imagen2.jpg', NOW(), NOW());

-- Publicaciones del usuario 2
INSERT INTO posts (user_id, category_id, title, content, image, create_at, updated_at)
VALUES (2, 1, 'Nuevo teléfono inteligente', 'Acabo de adquirir el nuevo modelo de teléfono inteligente y estoy impresionado con sus características y rendimiento. ¡Muy recomendado!', 'imagen3.jpg', NOW(), NOW());

INSERT INTO posts (user_id, category_id, title, content, image, create_at, updated_at)
VALUES (2, 8, 'Exposición de arte', 'Fui a la exposición de arte que se realizó en la galería del centro y quedé fascinado con las obras expuestas. Aquí les comparto algunas fotos que tomé.', 'imagen4.jpg', NOW(), NOW());

-- Publicaciones del usuario 3
INSERT INTO posts (user_id, category_id, title, content, image, create_at, updated_at)
VALUES (3, 3, 'Película de ciencia ficción', 'La película de ciencia ficción que vi anoche fue impresionante. La trama, los efectos especiales y la música crearon una experiencia única en el cine. ¡Muy recomendada!', 'imagen5.jpg', NOW(), NOW());

INSERT INTO posts (user_id, category_id, title, content, image, create_at, updated_at)
VALUES (3, 9, 'Conferencia de negocios', 'Asistí a una conferencia de negocios en el centro de convenciones y aprendí muchas cosas nuevas sobre marketing y finanzas. ¡Fue muy enriquecedor!', 'imagen6.jpg', NOW(), NOW());

-- Publicaciones del usuario 4
INSERT INTO posts (user_id, category_id, title, content, image, create_at, updated_at)
VALUES (4, 4, 'Nueva investigación científica', 'Los resultados de una nueva investigación científica fueron publicados en una revista especializada y son muy prometedores para el tratamiento de enfermedades crónicas. Aquí les comparto algunos detalles interesantes.', 'imagen7.jpg', NOW(), NOW());
