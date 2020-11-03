use MoviePass;

insert into cuentas(email,password,privilegios) values
('admin@admin', 'admin',0),
('matias@matias', 'matias',1),
('pepe@pepe', 'pepe',1);

insert into profiles(idCuenta, dni, nombre, apellido, telefono, direccion) values
(1,1234,'Matias', 'Hidalgo', 1111,"calle 1"),
(2,4321,'Pepe', 'Pep', 2222, "calle 2");

