-- Create database prueba
-- use prueba

create table registroUsuario(
    usuario varchar(15) not null primary key,
    pass varchar(15) not null,
    fotoUsuario varchar(100)
);

create table contacto(
    idContacto int not null primary key auto_increment,
    idUsuario varchar(15) not null,
    nombre varchar(50),
    tel varchar (13),
    cel varchar (13),
    email varchar(35),
    direccion varchar(100),
    fotoContacto varchar(100),
    foreign key (idUsuario) REFERENCES registroUsuario(usuario) on delete cascade on update cascade
)


delimiter &&
create procedure iniSesion(in us varchar(15), in psw varchar(15))
begin
select * 
from registroUsuario
where usuario = us 
and pass = psw;
end &&
delimiter ;

--Insertar nuevos registros en contacto cada vez que se registra un nuevo usuario
delimiter ## 
create trigger nuevoUsuario 
AFTER INSERT on registroUsuario 
for each row 
begin 
insert into contacto (idUsuario, nombre, tel, cel, email, direccion, fotoContacto) values (new.usuario, "WebMaps", "5572008061", "4477889944", "contacto@webmaps.com.mx", "Tlalnepantla", "img/fotoContactos/webmaps.jpg"); 
end ## 
delimiter ;

--Evento que verifica que la foto de un usuario no este vacia, si lo está elimina ese registro 
CREATE EVENT
	borradoUsuarioFoto4
    ON SCHEDULE EVERY 1 SECOND STARTS '2017-05-15 16:53:00'
	COMMENT 'Ha sido facil, ¿verdad?'
    DO SELECT * from registroUsuario;