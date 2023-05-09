SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/* para colocar o código no phpMyAdmin é necessário tirar todas as aspas ~ Bia */

CREATE TABLE 'Fazendeiro' (
	'cpf_Fazendeiro' char(14) PRIMARY KEY NOT NULL, 
	'nome_Fazendeiro' varchar(50) NOT NULL,
	'dt_nascFazendeiro' Date NOT NULL,
	'telefone_Fazendeiro' char(14) NOT NULL,
	'email_Fazendeiro' varchar(50) NOT NULL,
	'senha_Fazendeiro' varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/* criação da tabela fazendeiro */

CREATE TABLE 'Veterinário' (
	'cpf_Vet' char(14) PRIMARY KEY NOT NULL, 
	'nome_Vet' varchar(50) NOT NULL,
	'dt_nascVet' Date NOT NULL,
	'telefone_Vet' char(14) NOT NULL,
	'email_Vet' varchar(50) NOT NULL,
	'senha_Vet' varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/* criação da tabela veterinário */

CREATE TABLE 'Funcionário' (
	'cpf_Func' char(14) PRIMARY KEY NOT NULL, 
	'nome_Func' varchar(50) NOT NULL,
	'dt_nascFunc' Date NOT NULL,
	'telefone_Func' char(14) NOT NULL,
	'email_Func' varchar(50) NOT NULL,
	'senha_Func' varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/* criação da tabela funcionário */

CREATE TABLE 'Fazenda' (
	'id_Fazenda' int PRIMARY KEY NOT NULL,
	'nome_Fazenda' varchar(50) NOT NULL,
	'endereço_Fazenda' varchar(50) NOT NULL,
    'bairro_Fazenda' varchar(30) NOT NULL,
    'numero_Fazenda' varchar(10) NOT NULL,
    'cidade_Fazenda' varchar(30) NOT NULL,
    'estado_Fazenda' varchar(15) NOT NULL,
    'cep_Fazenda' varchar(9) NOT NULL,
	'FK_cpf_Fazendeiro' char(14), FOREIGN KEY ('FK_cpf_Fazendeiro') REFERENCES 'Fazendeiro' ('cpf_Fazendeiro'),
	'FK_cpf_Vet' char(14), FOREIGN KEY ('FK_cpf_Vet') REFERENCES Veterinário ('cpf_Vet'),
	'FK_cpf_Func' char(14), FOREIGN KEY ('FK_cpf_Func') REFERENCES Funcionário ('cpf_Func')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/* criação da tabela fazenda com as FKs vindas das outras tabelas (os cpfs)*/

ALTER TABLE 'Fazenda' MODIFY 'id_Fazenda' int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/* fazendo com que cada id novo de uma fazenda seja incrementado por 15 */
