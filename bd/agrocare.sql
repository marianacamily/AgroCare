SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE 'Fazenda' (
    'nome_Fazenda' varchar(50) NOT NULL,
    'id_Fazenda' PRIMARY KEY int(6) NOT NULL,
    'endereço_Fazenda' varchar(50) NOT NULL,
    'bairro_Fazenda' varchar(30) NOT NULL,
    'numero_Fazenda' varchar(10) NOT NULL,
    'cidade_Fazenda' varchar(30) NOT NULL,
    'estado_Fazenda' varchar(15) NOT NULL,
    'cep_Fazenda' varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE 'Fazendeiro' (
    'nome_Fazendeiro' varchar(50) NOT NULL,
    'cpf_Fazendeiro' PRIMARY KEY char(14) NOT NULL,
    'dt_NascFazendeiro' Date NOT NULL,
    'telefone_Fazendeiro' char(14) NOT NULL,
    'senha_Fazendeiro' varchar(50) NOT NULL,
    'email_Fazendeiro' varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE 'Fazenda'
    MODIFY 'id_Fazenda' int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

    
CREATE TABLE 'Veterinário' (
    'nome_Vet' varchar(50) NOT NULL,
    'cpf_Vet' char(14) NOT NULL,
    'dt_NascVet' Date NOT NULL,
    'telefone_Vet' char(14) NOT NULL,
    'senha_Vet' varchar(50) NOT NULL,
    'email_Vet' varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE 'Funcionário'(
    'nome_Funci' varchar(50) NOT NULL,
    'cpf_Funci' char(14) NOT NULL,
    'dt_NascFunci' Date NOT NULL,
    'telefone_Funci' char(14) NOT NULL,
    'senha_Funci' varchar(50) NOT NULL,
    'email_Funci' varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    

ALTER TABLE 'Veterinário'
    ADD PRIMARY KEY ('cpf_Vet');


ALTER TABLE 'Funcionário'
    ADD PRIMARY KEY ('cpf_Funci');

