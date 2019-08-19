create table usuario(
    nombre_usuario   varchar(90) primary key,
    nombre_completo  varchar(150) not null,
    pass             varchar(100) not null,
    fecha_nacimiento date
);

create table evento(
    id_evento          int AUTO_INCREMENT primary key,
    fk_usuario         varchar(90) not null,
    titulo             varchar(30) not null,
    fecha_inicio       date not null,
    hora_inicio        time,
    fecha_finalizacion date,
    hora_finalizacion  time,
    ind_dia_completo   boolean,
    
    FOREIGN key (fk_usuario) references usuario(nombre_usuario)
    
);


CREATE USER 'nextu'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'nextu'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `php_calendar`.* TO 'nextu'@'localhost';
REVOKE ALL PRIVILEGES ON `php_calendar`.* FROM 'nextu'@'localhost'; GRANT SELECT, INSERT, UPDATE, DELETE ON `php_calendar`.* TO 'nextu'@'localhost';