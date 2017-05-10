-- Create database prueba
-- use prueba

create table registroUsuario(
    usuario varchar(15) not null primary key,
    pass varchar(15) not null
);

create table contacto(
    idContacto int not null primary key auto_increment,
    idUsuario varchar(15) not null,
    nombre varchar(50),
    tel varchar (13),
    cel varchar (13),
    email varchar(35),
    direccion varchar(100),
    foreign key (idUsuario) REFERENCES registroUsuario(usuario) on delete cascade on update cascade
)
