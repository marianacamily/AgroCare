SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE Fazendeiro (
	cpf_Fazendeiro char(14) PRIMARY KEY NOT NULL, 
	nome_Fazendeiro varchar(50) NOT NULL,
	dt_nascFazendeiro Date NOT NULL,
	telefone_Fazendeiro char(14) NOT NULL,
	email_Fazendeiro varchar(50) NOT NULL,
	senha_Fazendeiro varchar(50) NOT NULL
); 
/* criação da tabela fazendeiro */

CREATE TABLE Fazenda (
	id_Fazenda int PRIMARY KEY NOT NULL,
	nome_Fazenda varchar(50) NOT NULL,
	endereço_Fazenda varchar(50) NOT NULL,
    bairro_Fazenda varchar(30) NOT NULL,
    numero_Fazenda varchar(10) NOT NULL,
    cidade_Fazenda varchar(30) NOT NULL,
    estado_Fazenda varchar(15) NOT NULL,
    cep_Fazenda varchar(9) NOT NULL,
	FK_cpf_Fazendeiro char(14), FOREIGN KEY (FK_cpf_Fazendeiro) REFERENCES Fazendeiro (cpf_Fazendeiro)
);
/* criação da tabela fazenda com as FKs vindas das outras tabelas (os cpfs)*/

ALTER TABLE Fazenda MODIFY id_Fazenda int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE Funcionário (
	cpf_Func char(14) PRIMARY KEY NOT NULL, 
	nome_Func varchar(50) NOT NULL,
	dt_nascFunc Date NOT NULL,
	telefone_Func char(14) NOT NULL,
	email_Func varchar(50) NOT NULL,
	senha_Func varchar(50) NOT NULL,
	FK_id_Fazenda int, FOREIGN KEY (FK_id_Fazenda) REFERENCES Fazenda (id_Fazenda)
);
/* criação da tabela funcionário */

CREATE TABLE Veterinário (
	cpf_Vet char(14) PRIMARY KEY NOT NULL, 
	nome_Vet varchar(50) NOT NULL,
	dt_nascVet Date NOT NULL,
	telefone_Vet char(14) NOT NULL,
	email_Vet varchar(50) NOT NULL,
	senha_Vet varchar(50) NOT NULL,
    FK_id_Fazenda int, FOREIGN KEY (FK_id_Fazenda) REFERENCES Fazenda (id_Fazenda)
);
/* criação da tabela veterinário */


CREATE TABLE Vaca (
    num_ID_Vaca varchar(10) PRIMARY KEY NOT NULL,
    data_Nasc_Vaca Date NOT NULL,
    raça_Vaca varchar(25) NOT NULL,
    FK_id_Fazenda int, FOREIGN KEY (FK_id_Fazenda) REFERENCES Fazenda (id_Fazenda)
);

/*Não está Funcionando*/
CREATE TABLE Login_Fazendeiro (
    id_Login_Faz int PRIMARY KEY NOT NULL,
    FK_id_Fazenda int, FOREIGN KEY (FK_id_Fazenda) REFERENCES Fazenda (id_Fazenda),
    FK_email_Fazendeiro varchar(50), FOREIGN KEY (FK_email_Fazendeiro) REFERENCES Fazendeiro (email_Fazendeiro)
);

ALTER TABLE Login_Fazendeiro MODIFY id_Login_Faz int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE Login_Veterinário (
    id_Login_Vet int PRIMARY KEY NOT NULL,
    FK_id_Fazenda int, FOREIGN KEY (FK_id_Fazenda) REFERENCES Fazenda (id_Fazenda),
    FK_email_Vet varchar(50), FOREIGN KEY (FK_email_Vet) REFERENCES Veterinário (email_Vet)
);

ALTER TABLE Login_Veterinário MODIFY id_Login_Vet int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;