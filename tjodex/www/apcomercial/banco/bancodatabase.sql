#criando o banco de dados apdatabase
create database apdatabase;
use apdatabase;
create table usuario(
idusuario int auto_increment primary key,
email varchar(100) not null,
senha varchar(200) not null,
nome varchar(50) not null,
cpf varchar(20) not null,
telefone varchar(20) not null,
foto varchar (100) not null
);

create table produtos(
idproduto int auto_increment primary key,
nomeproduto varchar(50) not null,
descricao text not null,
preco decimal(10,2) not null,
img1 varchar(100) not null,
img2 varchar(100) not null,
img3 varchar(100) not null,
img4 varchar(100) not null
);

create table pedidos(
idpedido int auto_increment primary key,
idusuario int not null,
datapedido timestamp default current_timestamp(),
constraint `fk_us_pk_us` foreign key(`idusuario`) 
references `usuarios`(`idusuario`)
);

create table detalhespedido(
iddetalhespedido int auto_increment primary key,
idpedido int not null,
idproduto int not null,
quantidade int not null,
constraint `fk_pedido_` foreign key(`idpedido`)
references `pedidos`(`idpedido`),

constraint `fk_produto_pk_produto` foreign key(`idproduto`)
 references `produtos` (`idproduto`)
);

create table pagamento(
idpagamento int auto_increment primary key,
idpedido int not null,
idusuario int not null,
bandeira varchar(20) not null,
numero varchar(20) not null,
numerocvc varchar(5) not null,
validade varchar (8) not null,
valor decimal (10,2) not null,
parcelas int not null,
constraint `fk_pag_pk_pedidos` foreign key(`idpedido`)
references `pedidos`(`idpedido`),

constraint `fk_pag_pk_usuaurio` foreign key (`idusuario`)
references `usuarios`(`idusuario`)
);


