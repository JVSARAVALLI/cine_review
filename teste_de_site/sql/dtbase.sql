DROP DATABASE site_filmes;
CREATE DATABASE site_filmes
DEFAULT CHARACTER SET utf8
DEFAULT collate utf8_general_ci;

-- drop table login;
create table login(
	id_usuario int not null auto_increment,
    senha_usuario varchar(15) not null,
    email_usuario varchar(50) not null,
    nome_usuario varchar(30) not null,
    primary key	(id_usuario)
) default charset = utf8;
desc login;
select * from login;

-- //////////////////////////////////////
-- separação itens

-- drop table cat_filmes;
create table cat_filmes(
	id_filme int not null auto_increment, 
    nome_filme varchar(60) not null default 'Sem Nome',
    tempo_filme int not null,
    diretor_filme varchar(60), 
    dt_lanc date not null, 
    categorias_filmes enum ('AC', 'AV', 'CM', 'DM', 'MS', 'RM', 'SF', 'TR', 'NT') not null default 'NT',
	primary key(id_filme)
);
-- desc cat_filmes;

/*----------------------------------*/

-- drop table cat_animes;
create table cat_animes(
	id_anime int not null auto_increment, 
    nome_anime varchar(60) not null default 'Sem Nome',
    tempo_anime int not null,
    diretor_anime varchar(60), 
    dt_lanc date not null, 
	categorias_animes enum ('AC', 'AV', 'CM', 'DM', 'MS', 'RM', 'MI', 'TR', 'NT') not null default 'NT', 
	primary key(id_anime)
);
-- desc cat_animes;
/*------------------------------------------*/

-- drop table cat_series;
create table cat_series(
	id_serie int not null auto_increment, 
    nome_serie varchar(60) not null default 'Sem Nome',
    tempo_serie int not null,
    diretor_serie varchar(60), 
    dt_lanc date not null, 
	categorias_series enum('DR', 'CM', 'SP', 'AC', 'FN', 'SF', 'RM', 'TR', 'CR', 'DC', 'NT') not null default 'NT', 
	primary key(id_serie)
);
-- desc cat_series;

insert into login values 
(default, '123456789', 'test@gmail.com', 'teste1');