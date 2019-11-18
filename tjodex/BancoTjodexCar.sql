create database tjodexCar;
use tjodexCar;


create table tb_usuarios(
id int auto_increment primary key,
loginUsuario varchar(20) unique not null,
senhaUsuario varchar(200) not null
);

insert into tb_usuarios (loginUsuario,senhaUsuario) values ('admin','123');

describe tb_usuarios;

create table tb_clientes(
idCliente int primary key auto_increment,
nomeCliente varchar(50) not null,
foneCliente varchar(15),
cpf varchar(15) not null,
rg varchar(12) not null,
email varchar(50),
cep varchar(15) not null,
endereco varchar(50) not null,
numero int(5) not null,
complemento varchar(50),
estado varchar(20) not null,
cidade varchar(20) not null,
bairro varchar(20) not null
);



insert into tb_clientes (nomeCliente, foneCliente, cpf, rg, email, cep, endereco, numero, complemento, estado, cidade,bairro)
values('Jacob', '94022-9503','555.555.555.55','55.555.555-3','leonardo@gmail.com','03951220','rua tuiti','1000','bloco 3','sao paulo','sao paulo','tatuape');

insert into tb_clientes (nomeCliente, foneCliente, cpf, rg, email, cep, endereco, numero, complemento, estado, cidade,bairro)
values('Murilo Solano', '95178-8801','555.555.555.55','55.555.555-3','solano@gmail.com','03951220','jose','1000','bloco 3','sao paulo','sao paulo','carão');




select * from tb_usuarios;

create table tb_veiculos(
codigoVeiculo int primary key auto_increment,
marca varchar(100) not null,
modelo varchar(100) not null,
ano int (4) not null,
preco decimal(10,3) not null,-- (10,2) duas casas decimais
kilometragem decimal(10,3) not null,
cambio varchar(50) not null,
carroceria varchar(50) not null,
combustivel varchar(50) not null,
finalPlaca int (1) not null,
cor varchar(30) not null,
ipvaPago varchar(15) not null,
estoque int,
imagem1 varchar(200),
imagem2 varchar(200),
imagem3 varchar(200)
 );

insert into tb_veiculos(marca,modelo,ano,preco,kilometragem,cambio,carroceria,combustivel,finalPlaca,cor,ipvaPago,estoque,imagem1,imagem2,imagem3)
values ('Fiat', 'Palio',2008,15000,110000,'manual','hatch','gasolina',2,'cinza','ipvaPago',6,'../imagem/palio1.jpg','../imagem/palio2.jpg','../imagem/palio3.jpg');
insert into tb_veiculos(marca,modelo,ano,preco,kilometragem,cambio,carroceria,combustivel,finalPlaca,cor,ipvaPago,estoque,imagem1,imagem2,imagem3)
values ('Volkswagen', 'Golf GTI',2019, 150.000,5.000,'automatico','hatch','flex',7,'preto','ipvaPago',3,'../imagem/golfgti1.jpg','../imagem/golfgti2.jpg','../imagem/golfgti3.jpg');
insert into tb_veiculos(marca,modelo,ano,preco,kilometragem,cambio,carroceria,combustivel,finalPlaca,cor,ipvaPago,estoque,imagem1,imagem2,imagem3)
values ('Volkswagen', 'Fusca',1969, 12.000,180.000,'manual','hatch','gasolina',2,'cinza','ipvaPago',3,'../imagem/fusca1.jpg','../imagem/fusca2.jpg','../imagem/fusca3.jpg');
insert into tb_veiculos(marca,modelo,ano,preco,kilometragem,cambio,carroceria,combustivel,finalPlaca,cor,ipvaPago,estoque,imagem1,imagem2,imagem3)
values ('Chevrolet', 'Onix',2014, 32.500,52.000,'manual','hatch','flex',1,'branco','ipvaPago',2,'../imagem/onix1.jpg','../imagem/onix2.jpg','../imagem/onix3.jpg');
insert into tb_veiculos(marca,modelo,ano,preco,kilometragem,cambio,carroceria,combustivel,finalPlaca,cor,ipvaPago,estoque,imagem1,imagem2,imagem3)
values ('Ford', 'Fusion',2013, 57.900,71.000,'automatico','sedã','flex',4,'prata','ipvaPago',1,'../imagem/fusion1.jpg','../imagem/fusion2.jpg','../imagem/fusion3.jpg');
insert into tb_veiculos(marca,modelo,ano,preco,kilometragem,cambio,carroceria,combustivel,finalPlaca,cor,ipvaPago,estoque,imagem1,imagem2,imagem3)
values ('Honda', 'Civic',2012, 54.640,49.900,'automatico','sedã','flex',8,'preto','ipvaPago',4,'../imagem/civic1.jpg','../imagem/civic2.jpg','../imagem/civic3.jpg');
insert into tb_veiculos(marca,modelo,ano,preco,kilometragem,cambio,carroceria,combustivel,finalPlaca,cor,ipvaPago,estoque,imagem1,imagem2,imagem3)
values ('Toyota', 'Corolla',2010, 81.913,43.800,'automatico','sedã','flex',1,'cinza','ipvaPago',2,'../imagem/corolla1.jpg','../imagem/corolla2.jpg','../imagem/corolla3.jpg');
 
select * from tb_clientes;
select * from tb_veiculos;

create table tb_pedidos(
notaFis int primary key auto_increment,
dataPed timestamp default current_timestamp,
dataEnv date,
idCliente int not null ,
precoNota decimal(10,3) not null);

describe tb_pedidos;

insert into tb_pedidos (dataEnv,idCliente,precoNota)
values (curdate(),1,30.000);

select * from tb_clientes;
select * from tb_veiculos;
select * from tb_pedidos;

create table tb_carrinho(
notaFis int not null,
codigoVeiculo varchar(100) not null,
quant int not null,
prcUnitario decimal(10,3) not null
);

alter table tb_carrinho
add constraint produto_carrinho
foreign key(codigoVeiculo)
references tb_veiculos(codigoVeiculo)
on delete no action;

insert into tb_carrinho (notaFis,codigoVeiculo,quant,prcUnitario)
values (1,'1000',1,15.000);
insert into tb_carrinho (notaFis,codigoVeiculo,quant,prcUnitario)
values (1,'1002',1,12.000);
select * from tb_carrinho;

