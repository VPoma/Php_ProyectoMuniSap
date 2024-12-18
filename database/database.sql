CREATE DATABASE muni_ticket;

/*DROP DATABASE muni_ticket;*/
USE muni_ticket;

CREATE TABLE categorias (
id              INT(255) AUTO_INCREMENT NOT NULL,
nombre          VARCHAR(100) NOT NULL,
descripcion     VARCHAR(255),
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE areas (
id              INT(255) AUTO_INCREMENT NOT NULL,
nombre          VARCHAR(100) NOT NULL,
descripcion     VARCHAR(255),
CONSTRAINT pk_areas PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE usuarios(
id              INT(255) AUTO_INCREMENT NOT NULL,
id_area         INT(255),
id_categoria    INT(255),
nombre          VARCHAR(150) NOT NULL,
apellidos       VARCHAR(255) NOT NULL,
email           VARCHAR(255) NOT NULL,
password        VARCHAR(255) NOT NULL,
tipo            VARCHAR(50),
imagen          VARCHAR(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT fk_usuario_area FOREIGN KEY(id_area) REFERENCES areas(id),
CONSTRAINT fk_usuario_categoria FOREIGN KEY(id_categoria) REFERENCES categorias(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE tickets(
id              INT(255) AUTO_INCREMENT NOT NULL,
id_usuario      INT(255) NOT NULL,
id_upersonal    INT(255),
id_categoria    INT(255) NOT NULL,
asunto          varchar(255) NOT NULL,
descripcion     TEXT NOT NULL,
estado          varchar(50),
fecha_ini       DATE NOT NULL,
fecha_fin       DATE,
prioridad       varchar(50),
CONSTRAINT pk_tickets PRIMARY KEY(id),
CONSTRAINT fk_ticket_usuario FOREIGN KEY(id_usuario) REFERENCES usuarios(id),
CONSTRAINT fk_ticket_upersonal FOREIGN KEY(id_upersonal) REFERENCES usuarios(id),
CONSTRAINT fk_ticket_categoria FOREIGN KEY(id_categoria) REFERENCES categorias(id)
)ENGINE=InnoDb;

CREATE TABLE comentarios(
id              INT(255) AUTO_INCREMENT NOT NULL,
id_ticket       INT(255),
id_usuario      INT(255),
mensaje         TEXT NOT NULL,
fecha           DATE NOT NULL,
hora            TIME,
CONSTRAINT pk_comentarios PRIMARY KEY(id),
CONSTRAINT fk_comentario_ticket FOREIGN KEY(id_ticket) REFERENCES tickets(id),
CONSTRAINT fk_comentario_usuario FOREIGN KEY(id_usuario) REFERENCES usuarios(id)
)ENGINE=InnoDb;

/********************************************************************INSERTAR**************************************************************/

INSERT INTO `areas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Informática', 'Área encargada de Tecnologías de la Información'),
(2, 'Personal', 'Área encargada de los Recursos Humanos'),
(3, 'Asesoria Legal', 'Área que se encarga de  los temas legales de la municipalidad'),
(4, 'Urbanistica', 'Área que se encarga del desarrollo del distrito'),
(5, 'Logistica', 'Área encargada de proveer a la municipalidad'),
(6, 'Mantenimiento y Limpieza', 'Área encargada del mantenimiento infraestructural y limpieza');

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, '0-User', 'Categoría de todo usuario que no es \"EMPLEADO\".'),
(14, 'Software', 'Atiende problemas con respecto a programas, S.O, etc(parte lógica).'),
(15, 'Hardware', 'Atiende problemas físicos, repuestos, etc.'),
(16, 'Redes', 'Atiende problemas de conexión dentro de la municipalidad.'),
(43, '1-Admin', 'admin');

INSERT INTO `usuarios` (`id`, `id_area`, `id_categoria`, `nombre`, `apellidos`, `email`, `password`, `tipo`, `imagen`) VALUES
(2, 2, 1, 'Juan', 'Osorio', 'juan@osorio.com', '$2y$04$xS5i.COYxhQmQDc3JVbrTOJ9UrqjkwtAfTWcIyf4pGVith/vUnbmq', 'user', NULL),
(3, 1, 14, 'Pedro', 'Cruz', 'pedro@cruz.com', '$2y$04$TOJ.56X76WZu82cA.zXKfORGy3fRb6Sq/5y4URPi85GcrORoGzoO2', 'employed', 'ajio.jpg'),
(22, 1, 43, 'Victor', 'Poma', 'victor@poma.com', '$2y$04$KQj98cmYll.VqvwBjXl72OSCUk9Yp/gkt6on/0kF2ng/lhPvnXChq', 'admin', 'Elena(no).jpg'),
(23, 1, 15, 'Juan', 'Lopez', 'juan@lopez.com', '$2y$04$aRyRM9hhkVPIkSl6YcXY/.QDfJYY5.Re1bIJPtpB/edEEMrL.rKp6', 'employed', NULL),
(24, 3, 1, 'Meliton', 'Gonzales', 'meliton@gonzales.com', '$2y$04$BSff5izw8k4RKTYf76a7g.u.xs2lZ2RvO7cryHW7g/iJopMbSw.fC', 'user', NULL),
(56, 3, 1, 'Ramon', 'Osorio', 'ramon@osorio.com', '$2y$04$7jFK37powXyqh3qBSZ09aekWpAOiNqcP842VToH8K3KgtT0Mv75.6', 'user', NULL),
(57, 1, 15, 'Samuel', 'Etoo', 'samuel@etoo.com', '$2y$04$suQu4NQ8NvJb4idJPNlt2.SPgS4cLtuuAT7x3gJO7mIx4LDwVNJQa', 'employed', NULL),
(58, 4, 1, 'Aquiles', 'Rujo', 'aquiles@rujo.com', '$2y$04$2Mwoui6UDiZR4F4naQyn9.hUCU2ZBMOB35RR/56GpLWg7bbvgT.ua', 'user', NULL),
(68, 4, 1, 'David', 'Delgadillo', 'david@delgadillo.com', '$2y$04$J0JBbgCrJGKRTYoQPBkw4eaM0IoLQunAyLgugeBBxXuVbZQ5sanoO', 'user', NULL),
(69, 1, 14, 'Alejandro', 'Perez', 'alejandro@perez.com', '$2y$04$iE88URy0QMTILOUolNeqj.xWObdZHN1ozmHBlIfCApjoMWfxM7q46', 'employed', NULL),
(83, 1, 16, 'Yoni', 'Pacheco', 'yoni@pacheco.com', '$2y$04$Uq3.FRGV2PxkFuLXjzMOj.QJRuR8IZFmO0Th5gULi6/d4BDdifstO', 'employed', '80cb5151867a0aa10534d43bcaaf196b.jpg');

INSERT INTO `tickets` (`id`, `id_usuario`, `id_upersonal`, `id_categoria`, `asunto`, `descripcion`, `estado`, `fecha_ini`, `fecha_fin`, `prioridad`) VALUES
(1, 2, 3, 14, 'No abre Microsoft Word', 'Quiero redactar un informe y no se puede abrir el word.', 'CERRADO', '2024-01-12', '2024-02-09', NULL),
(2, 22, 69, 14, 'Prueba 01', 'Prueba 01 de registro de tickets', 'ATENDIDO', '2024-01-13', '2024-02-07', NULL),
(3, 56, 23, 15, 'Monitor no enciende', 'No enciende el monitor', 'PROCESO', '2024-01-19', '2024-02-07', NULL),
(4, 2, 83, 16, 'Sin acceso a internet', 'No puedo abrir la pagina de la municipalidad en mi ordenador', 'PROCESO', '2024-01-19', '2024-02-07', NULL),
(18, 68, 3, 14, 'No puedo abrir el Power Point', 'No puedo abrir el power point, lo necesito pronto para hacer una presentación para gerencia.', 'PROCESO', '2024-01-21', '2024-02-09', NULL),
(38, 2, 69, 14, 'Errores con el sistema de soporte', 'No cargan los estilos y se tienen problemas con el aplicativo!!!', 'CERRADO', '2024-02-09', '2024-02-09', NULL),
(55, 22, 83, 16, 'prueba10', 'Prueba10, prueba para la mejora del sistema, ahora no se podrá eliminar  en seguimiento', 'PENDIENTE', '2024-02-26', '2024-02-26', NULL),
(57, 2, 3, 14, 'Problemas al Generar el reporte', 'No puedo generar el reporte en pdf', 'PENDIENTE', '2024-03-16', '2024-03-16', NULL);

INSERT INTO `comentarios` (`id`, `id_ticket`, `id_usuario`, `mensaje`, `fecha`, `hora`) VALUES
(1, 1, 2, 'Requiero la atención de este incidente lo mas antes posible.', '2023-11-23', '13:14:58'),
(2, 1, 3, 'Recibido, se atenderá su solicitud en breve.', '2023-11-23', '13:15:20'),
(61, 1, 22, 'se procedió a cerrar este ticket debido a que fue atendido en su momento.', '2024-01-29', '22:16:26'),
(63, 1, 3, 'Queda por cerrado el ticket', '2024-02-02', '22:24:01'),
(64, 2, 69, 'Su ticket fue atendido, favor de confirmar la solución.', '2024-02-02', '23:07:52'),
(65, 18, 69, 'Se atenderá este Ticket lo más antes posible.', '2024-02-02', '23:08:22'),
(66, 3, 56, 'Atender este soporte lo antes posible.', '2024-02-02', '23:17:37'),
(67, 4, 2, 'atender el siguiente soporte.', '2024-02-02', '23:18:10'),
(68, 18, 68, 'Estaré pendiente de la pronta solución.', '2024-02-02', '23:19:06'),
(73, 4, 22, 'Se informara con respecto a este problema', '2024-02-07', '18:35:16'),
(74, 2, 22, 'De no confirmar la solución las próximas 24 horas, se dará por entendido que ya se soluciono el incidente y se procederá a cerrar el ticket', '2024-02-07', '18:38:48'),
(75, 38, 2, 'Atender lo más pronto posible, gracias.', '2024-02-09', '01:38:15'),
(76, 38, 69, 'Empezare a resolver esto, le iré informando.', '2024-02-09', '01:39:41'),
(77, 38, 22, 'Atender lo más pronto posible, estaré pendiente del avance.', '2024-02-09', '01:49:14'),
(78, 38, 69, 'Problema Solucionado, favor de comprobar todo el sistema.\r\nInformar después de la comprobación a fin de cerrar el ticket.', '2024-02-09', '01:51:39'),
(79, 38, 2, 'Ya me anda normal el sistema, muchas gracias.', '2024-02-09', '02:03:05'),
(80, 38, 22, 'Alejandro, favor de proceder a cerrar el Ticket.', '2024-02-09', '02:03:49'),
(81, 38, 69, 'Debido a que se logro la solución, queda \"Cerrado\" este Soporte.', '2024-02-09', '02:04:30'),
(82, 18, 3, 'Debido a la Carga de Alejandro Pérez, mi persona se hará cargo de este Ticket, le Iré informando', '2024-02-09', '02:10:39');

/********************************************************************INSERTAR**************************************************************/

/********************************************************************PRUEBAS SQL***********************************************************/
SELECT id FROM usuarios WHERE id_categoria = 15 ORDER BY RAND () LIMIT 1;

SELECT * from usuarios WHERE id = (SELECT id FROM usuarios WHERE id_categoria = 1 ORDER BY RAND () LIMIT 1);

select * from usuarios WHERE id = 22;

select * from usuarios

insert into tickets VALUES(NULL, 22, 57, 15, 'asunto', 'descripción', 'PENDIENTE', CURDATE(), NULL, NULL);

select * from tickets

insert into tickets VALUES(NULL, 22, (SELECT id FROM usuarios WHERE id_categoria = 15 ORDER BY RAND () LIMIT 1), 15, 'asunto', 'descripción', 'PENDIENTE', CURDATE(), NULL, NULL);


SELECT u.*, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u 
    INNER JOIN areas a ON a.id = u.id_area
    INNER JOIN categorias c ON c.id = u.id_categoria;


SELECT * FROM comentarios WHERE id_ticket = 1 ORDER BY id DESC;

SELECT * FROM tickets WHERE asunto LIKE '%p%';

SELECT * FROM USUARIOS WHERE id_categoria = 1 ORDER BY nombre;

SELECT * FROM USUARIOS WHERE id_categoria != 1 ORDER BY nombre;

SELECT u.*, c.nombre As 'catnombre' FROM usuarios u INNER JOIN categorias c ON c.id = u.id_categoria WHERE id_categoria != 1 ORDER BY nombre;

SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t
            INNER JOIN usuarios u ON u.id = t.id_usuario
            INNER JOIN usuarios ue ON ue.id = t.id_upersonal
            INNER JOIN categorias c ON c.id = t.id_categoria WHERE estado = '%a%' ORDER BY id DESC

#Mostrar el nombre de las categorias y al lado cuantas entradas tienen#
SELECT c.nombre, COUNT(e.id) FROM categorias c, entradas e WHERE e.categoria_id = c.id GROUP BY e.categoria_id;
SELECT c.nombre, COUNT(e.id) FROM categorias c INNER JOIN entradas e ON e.categoria_id = c.id GROUP BY e.categoria_id;

select t.id_upersonal, count(t.id) from tickets t GROUP BY t.id_upersonal;

SELECT u.nombre, u.apellidos, COUNT(t.id) FROM tickets t
    INNER JOIN usuarios u WHERE u.id = t.id_upersonal GROUP BY t.id_upersonal;

SELECT u.nombre, u.apellidos, COUNT(t.id) FROM tickets t
    INNER JOIN usuarios u ON u.id = t.id_upersonal GROUP BY t.id_upersonal;


SELECT u.nombre as 'nombre', u.apellidos as 'apellidos', COUNT(t.id) as 'cantidad' FROM tickets t
    INNER JOIN usuarios u ON u.id = t.id_upersonal GROUP BY u.apellidos;

SELECT u.nombre as 'nombre', u.apellidos as 'apellidos', COUNT(t.id) as 'cantidad', c.nombre as 'categoria' FROM tickets t
    INNER JOIN categorias c ON c.id = t.id_categoria
    INNER JOIN usuarios u ON u.id = t.id_upersonal WHERE t.id_categoria like '% %' or t.id_categoria like '%%' GROUP BY u.apellidos;


SELECT u.nombre as 'nombre', u.apellidos as 'apellidos', c.nombre as 'categoria', t.estado, COUNT(t.id) as 'cantidad' FROM tickets t
    INNER JOIN categorias c ON c.id = t.id_categoria
    INNER JOIN usuarios u ON u.id = t.id_upersonal WHERE t.id_upersonal = 3 GROUP BY t.estado DESC;

SELECT up.nombre as 'nombrep', up.apellidos as 'apellidosp', c.nombre as 'categoria', u.nombre as 'nombre', u.apellidos as 'apellidos', t.estado, COUNT(t.id) as 'cantidad' FROM tickets t
    INNER JOIN categorias c ON c.id = t.id_categoria
    INNER JOIN usuarios u on u.id = t.id_usuario
    INNER JOIN usuarios up ON up.id = t.id_upersonal WHERE t.id_upersonal = 3 GROUP BY t.estado DESC;

    DELETE FROM comentarios WHERE id_ticket = 49; #Para eliminar los comentarios#

SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t
        INNER JOIN usuarios u ON u.id = t.id_usuario INNER JOIN usuarios ue ON ue.id = t.id_upersonal INNER JOIN categorias c ON c.id = t.id_categoria 
        WHERE t.fecha_ini like '%%' and u.apellidos like '%%' and ue.apellidos like '%%' ORDER BY id DESC;

SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t
        INNER JOIN usuarios u ON u.id = t.id_usuario INNER JOIN usuarios ue ON ue.id = t.id_upersonal INNER JOIN categorias c ON c.id = t.id_categoria 
        WHERE t.id_upersonal = 3 AND t.id like '%%'
        AND u.apellidos like '%%' AND ue.apellidos like '%%'
        AND t.fecha_ini like '%2024-01-12%' AND t.id_categoria like '%%'
        AND t.estado like '%%' ORDER BY id DESC;

SELECT u.*, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u 
        INNER JOIN areas a ON a.id = u.id_area
        INNER JOIN categorias c ON c.id = u.id_categoria
        WHERE u.nombre like '%%' AND u.apellidos like '%%'
        AND a.id like '%%' ORDER BY c.nombre;


SELECT * FROM categorias where id > 1 AND id != 43;


SELECT * FROM tickets WHERE id_upersonal = '69' AND fecha_ini BETWEEN '2024-01-01' AND '2024-02-28';


SELECT c.nombre as 'categoria', t.estado as 'estado', COUNT(t.id) as 'cantidad' FROM tickets t 
    INNER JOIN categorias c ON c.id = t.id_categoria WHERE fecha_ini BETWEEN '2024-01-01' AND '2024-02-28' GROUP BY t.estado DESC;

SELECT COUNT(id_categoria) AS 'total' FROM tickets;

SELECT COUNT(id_categoria) AS 'total' FROM tickets WHERE id_usuario = '2' AND fecha_ini BETWEEN '2024-01-01' AND '2024-02-28';


SELECT u.id, u.nombre, u.apellidos, u.email, u.tipo, a.nombre As 'arnombre', c.nombre As 'catnombre' FROM usuarios u
                INNER JOIN areas a ON a.id = u.id_area
                INNER JOIN categorias c ON c.id = u.id_categoria
                WHERE u.nombre like '%a%' AND u.apellidos like '%%'
                AND a.id like '%%' LIMIT 6,6;

SELECT t.*, u.nombre as 'nombreu', u.apellidos as 'apellidosu', ue.nombre as 'nombree', ue.apellidos as 'apellidose',c.nombre as 'categoria' FROM tickets t
        INNER JOIN usuarios u ON u.id = t.id_usuario INNER JOIN usuarios ue ON ue.id = t.id_upersonal INNER JOIN categorias c ON c.id = t.id_categoria
        WHERE t.id_usuario = 2 ORDER BY id DESC LIMIT 3,3;

