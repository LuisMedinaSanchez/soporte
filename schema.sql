create database soporte;
use soporte; 
set sql_mode='';
create table user (
	id int not null auto_increment primary key,
	username varchar(50),
	name varchar(50),
	lastname varchar(50),
	email varchar(255),
	password varchar(60),
	is_active boolean not null default 1,
	kind int not null default 1,
	created_at datetime
	);
insert into user (username,name,lastname,email,password,kind,is_active,created_at)
value ("admin","Luis","Medina","soporte@transpheric.com",sha1(md5("admin")),1,1,NOW()),
      ("aflores","Alejandro","Flores","aflores@transpheric.com",sha1(md5("solomancera")),1,1,NOW()),
      ("soportetoluca","Enrique","Urbina","soportetoluca@transpheric.com",sha1(md5("LUms5847")),1,1,NOW());



create table person (
	id int not null auto_increment primary key,
	name varchar(50),
	lastname varchar(50),
	email varchar(255),
	is_active boolean not null default 1,
	kind int not null,
	created_at datetime
	);
insert into person (name,lastname,email,is_active,kind,created_at)
value ("Agelica","Hernández Aguilar","anhernandez@transpheric.com",1,1,NOW()),
("Alberto","De La Cruz Garcia","adelacruz@transpheric.com",1,1,NOW()),
("Alejandra","Ochoa Barranco","aochoa@transpheric.com",1,1,NOW()),
("Alejandro","Flores Mancera","aflores@transpheric.com",1,1,NOW()),
("Alejandro","Rojo Mendez","asociado@grupoaduanal.com",1,1,NOW()),
("Ali Enrique","Marin Urbina","soportetoluca@transpheric.com",1,1,NOW()),
("Alma Lilia","Hernandez  Martinez","ahernandez@transpheric.com",1,1,NOW()),
("Ana Cecilia","Vilchis Lopez","cobranza@transpheric.com",1,1,NOW()),
("Antonio","Granados Hernandez","clasificacion@transpheric.com",1,1,NOW()),
("Antonio Misael","Zamudio Barrientos","azamudio@transpheric.com",1,1,NOW()),
("Aram Alejandro","Montiel Hermosillo","tramitacion15@transpheric.com",1,1,NOW()),
("Bernardo Ramon","Mejia Hernandez","bmejia@transpheric.com",1,1,NOW()),
("Carlos Andres","Rubio Macias","crubio@transpheric.com",1,1,NOW()),
("Charyti","Vizuet Hernandez","asistente@transpheric.com",1,1,NOW()),
("Daniel","Molina Perez","dmolina@transpheric.com",1,1,NOW()),
("Daniel","Perez Ramirez","dperez@transpheric.com",1,1,NOW()),
("Dario Abraham","Garcia Briseño","dgarcia@transpheric.com",1,1,NOW()),
("Dulce Lucero","Hernandez Bonifacio","tramitacion7@transpheric.com",1,1,NOW()),
("Eduardo","Alfaro Ongay","tramitacion9@transpheric.com",1,1,NOW()),
("Efrain","Carrasco Flores","ecarrasco@transpheric.com",1,1,NOW()),
("Elisa Yaeli","Moreno Ramirez","emoreno@transpheric.com",1,1,NOW()),
("Emmanuel","Zuñiga Gonzalez","contabilidad@transpheric.com",1,1,NOW()),
("Erica","Martinez Hidalgo","tramitacion14@transpheric.com",1,1,NOW()),
("Ernesto","Ortiz Ruiz","soporte2@transpheric.com",1,1,NOW()),
("Felix Francisco","Pestaña Velasco","tramitacion16@transpheric.com",1,1,NOW()),
("Francisco Javier","Cid Mercado","fcid@gtranspheric.com",1,1,NOW()),
("Gustavo Armando","Toriz Martinez","chofer@transpheric.com",1,1,NOW()),
("Hector","Medran Gomez","hmedran@transpheric.com",1,1,NOW()),
("Humberto Heron","Perez Marquez","recepcion@transpheric.com",1,1,NOW()),
("Israel","Falcon Salinas","almacen@transpheric.com",1,1,NOW()),
("Jesus Alberto","Olivares Rangel","salidas1@transpheric.com",1,1,NOW()),
("Jorge","Aguiar Gonzalez","salidas2@transpheric.com",1,1,NOW()),
("Jorge","De La Torre Medrano","asociado@grupoaduanal.com",1,1,NOW()),
("Jorge","Mejia Hernandez","jmejia@transpheric.com",1,1,NOW()),
("Jose Antonio","Badillo Medina","jbadillo@transpheric.com",1,1,NOW()),
("Jose Manuel","Ortiz Oceguera","recoleccion@transpheric.com",1,1,NOW()),
("Josefa Patricia","Magaña Ramirez","jmagana@transpheric.com",1,1,NOW()),
("Juan Carlos","Agüero González","jgonzalez@transpheric.com",1,1,NOW()),
("Lorenzo Daniel","Zuazua Gonzalez","dzuazua@transpheric.com",1,1,NOW()),
("Luis","Medina Sánchez","soporte@transpheric.com",1,1,NOW()),
("Luis Alberto","Lazcano Solis","tramitacion13@transpheric.com",1,1,NOW()),
("Luis Erasto","Marin Moreno","salidastol@transpheric.com",1,1,NOW()),
("Luis Fernando","Flores Garcia","lfernandez@transpheric.com",1,1,NOW()),
("Magali Guadalupe","Velazquez Solache","calidad@transpheric.com",1,1,NOW()),
("Marco Antonio","Tapia Lopez","mtapia@transpheric.com",1,1,NOW()),
("Maria Bertha","Zavala Olvera","bzavala@transpheric.com",1,1,NOW()),
("Maria De Lourdes","Fernandez Lopez","lfernandez@transpheric.com",1,1,NOW()),
("Maria Elena","Mancera Escandon","mancera@transpheric.com",1,1,NOW()),
("Maria Patricia","Perez Marquez","mperez@grupoaduanal.com",1,1,NOW()),
("Maribel","Llamas Mancilla","juridico@transpheric.com",1,1,NOW()),
("Mayra Gabriela","Villavicencio Hernandez","mvillavicencio@transpheric.com",1,1,NOW()),
("Moises","Carbajal Garcia","tramitacion8@transpheric.com",1,1,NOW()),
("Monica","Lira Gudiño","analistacontable@transpheric.com",1,1,NOW()),
("Nancy","Barajas Chavez","nbarajas@transpheric.com",1,1,NOW()),
("Omar Elias","Camacho Ramos","ocamacho@transpheric.com",1,1,NOW()),
("Orlando Miguel","Saldaña  Palacios","osaldana@transpheric.com",1,1,NOW()),
("Rene","Cortes Zepeda","tramitacion11@transpheric.com",1,1,NOW()),
("Rocío","Juárez Sandoval","atracciondetalento@transpheric.com",1,1,NOW()),
("Ruben","Monroy Serrano","tramitacion1@transpheric.com",1,1,NOW()),
("Ruperto Erasmo","Flores Y Fernandez","presidencia@grupoaduanal.com",1,1,NOW()),
("Veronica Lizbeth","Mendoza Alvarez","vmendoza@transpheric.com",1,1,NOW()),
("Victor Manuel","Montes Garcia","vmontes@grupoaduanal.com",1,1,NOW()),
("Yania Monserrat","Martinez Gonzalez","juridico@transpheric.com",1,1,NOW());





create table project (
	id int not null auto_increment primary key,

	name varchar(200),
	description text
,
	evidencia_id varchar(100)
	);
insert into project (name,description) 
value ("Ninguno",null);


create table category (
	id int not null auto_increment primary key,
	name varchar(200)
	);
insert into category (id,name)
values	(1,"CTRAWIN"),
	(2,"CSAAIWIN"),
	(3,"CVALWIN"),
	(4,"CCGWIN"),
	(5,"CCAJWIN"),
	(6,"CNOTIFICA"),
	(7,"CGESTOR"),
	(8,"CTRAWEB"),
	(9,"CARTAS-NOM"),
	(10,"DESPACHADOR"),
	(11,"ISO TOOLS"),
	(12,"VALIDADOR"),
	(13,"E-PREVIOS"),
	(14,"RADIO"),
	(15,"EXTENCION"),
	(16,"CORREO"),
	(17,"INTERNET");



create table kind (
	id int not null auto_increment primary key,
	name varchar(100)
	);
insert into kind (id,name)
values (1,"Ticket"), (2,"Bug"),(3,"Sugerencia"),(4,"Caracteristica");



create table status (
	id int not null auto_increment primary key,
	name varchar(100)
	);
insert into status (id,name)
values (1,"Pendiente"), (2,"En Desarrollo"),(3,"Terminado"),(4,"Cancelado");



create table priority (
	id int not null auto_increment primary key,
	name varchar(100)
	);
insert into priority (id,name)
values  (1,"Critico"),(2,"Alto"),(3,"Medio"),(4,"Bajo");



create table ticket(
	id int not null auto_increment primary key,
	title varchar(100),
	description text,
	updated_at datetime,
	created_at datetime,
	kind_id int not null,
	user_id int not null,
	asigned_id int,
	project_id int,
	category_id int,
	priority_id int not null default 1,
    	status_id int not null default 1,
	person_id int,
    	evidencia_id varchar(255),
	foreign key (kind_id) references kind(id),
	foreign key (user_id) references user(id),
	foreign key (project_id) references project(id),
	foreign key (category_id) references category(id),
	foreign key (priority_id) references priority(id),
	foreign key (status_id) references status(id),
    	foreign key (person_id) references person(id)
	);

create table tickethistory(
	id int not null auto_increment primary key,
	ticket_id int not null,
	description text,
	created_at datetime,
	user_id int not null,
    	evidenciahistory_id varchar(255),
	foreign key (user_id) references user(id),
	foreign key (user_id) references user(id)
	);

/*insert into tickethistory (ticket_id,description,created_at,user_id,evidenciahistory_id)
values  (20,"Prueba de foto",NOW(),1,"evidencias/images.jpeg");*/