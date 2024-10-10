/* Banco de dados Software de Carona: */

DROP DATABASE IF EXISTS Software_De_Carona;
CREATE DATABASE Software_De_Carona;
USE Software_De_Carona;

DROP TABLE IF EXISTS Software_De_Carona.Usuario;
CREATE TABLE Software_De_Carona.Usuario (
                                            Matricula varchar(50) PRIMARY KEY,
                                            Genero char(1) NOT NULL,
                                            Nome varchar(250) NOT NULL,
                                            Email varchar(250) NOT NULL UNIQUE,
                                            Senha varchar(40) NOT NULL,
                                            CNH varchar(11)
);

DROP TABLE IF EXISTS Software_De_Carona.Carona;
CREATE TABLE Software_De_Carona.Carona (
                                           Cod int PRIMARY KEY AUTO_INCREMENT,
                                           DataCriacao datetime NOT NULL,
                                           DataFinalizacao datetime NOT NULL,
                                           LocalPartida varchar(250) NOT NULL,
                                           LocalDestino varchar(250) NOT NULL,
                                           prefGenero char(1),
                                           fk_Passageiro_Matricula varchar(50),
                                           fk_Motorista_Matricula varchar(50),
                                           Finalizada tinyint,
                                           Cancelada tinyint
);

DROP TABLE IF EXISTS Software_De_Carona.Postagem;
CREATE TABLE Software_De_Carona.Postagem (
                                             Cod int PRIMARY KEY AUTO_INCREMENT,
                                             DataCriacao datetime NOT NULL,
                                             Texto varchar(500),
                                             FotoBin mediumblob,
                                             Excluida tinyint,
                                             fk_Usuario_Matricula varchar(50)
);

DROP TABLE IF EXISTS Software_De_Carona.AvaliacaoCarona;
CREATE TABLE Software_De_Carona.AvaliacaoCarona (
                                                    Cod int PRIMARY KEY AUTO_INCREMENT,
                                                    fk_Passageiro_Matricula varchar(50),
                                                    fk_Carona_Cod int,
                                                    Comentario varchar(250),
                                                    Estrelas int(5)
);

DROP TABLE IF EXISTS Software_De_Carona.AvaliacaoPostagem;
CREATE TABLE Software_De_Carona.AvaliacaoPostagem (
                                                      fk_Usuario_Matricula varchar(50),
                                                      fk_Postagem_Cod int,
                                                      Cod int PRIMARY KEY AUTO_INCREMENT,
                                                      Comentario varchar(250),
                                                      Curtida tinyint,
                                                      DataCriacao datetime NOT NULL
);

DROP TABLE IF EXISTS Software_De_Carona.Chat;
CREATE TABLE Software_De_Carona.Chat (
                                         Cod int PRIMARY KEY AUTO_INCREMENT,
                                         datahora timestamp NOT NULL,
                                         fk_Carona_Cod int
);

DROP TABLE IF EXISTS Software_De_Carona.Mensagem;
CREATE TABLE Software_De_Carona.Mensagem (
                                             Cod int PRIMARY KEY AUTO_INCREMENT,
                                             texto varchar(144) NOT NULL,
                                             datahora timestamp NOT NULL,
                                             fk_Chat_Cod int,
                                             fk_Remetente_Matricula varchar(50)
);

SET GLOBAL max_allowed_packet=16777215;

ALTER TABLE Software_De_Carona.Carona ADD CONSTRAINT FK_Carona_Passageiro
    FOREIGN KEY (fk_Passageiro_Matricula)
        REFERENCES Software_De_Carona.Usuario (Matricula)
        ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Software_De_Carona.Carona ADD CONSTRAINT FK_Carona_Motorista
    FOREIGN KEY (fk_Motorista_Matricula)
        REFERENCES Software_De_Carona.Usuario (Matricula)
        ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Software_De_Carona.Postagem ADD CONSTRAINT FK_Postagem_Usuario
    FOREIGN KEY (fk_Usuario_Matricula)
        REFERENCES Software_De_Carona.Usuario (Matricula)
        ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Software_De_Carona.AvaliacaoCarona ADD CONSTRAINT FK_AvaliacaoCarona_Passageiro
    FOREIGN KEY (fk_Passageiro_Matricula)
        REFERENCES Software_De_Carona.Usuario (Matricula)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE Software_De_Carona.AvaliacaoCarona ADD CONSTRAINT FK_AvaliacaoCarona_Carona
    FOREIGN KEY (fk_Carona_Cod)
        REFERENCES Software_De_Carona.Carona (Cod)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE Software_De_Carona.AvaliacaoPostagem ADD CONSTRAINT FK_AvaliacaoPostagem_Usuario
    FOREIGN KEY (fk_Usuario_Matricula)
        REFERENCES Software_De_Carona.Usuario (Matricula)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE Software_De_Carona.AvaliacaoPostagem ADD CONSTRAINT FK_AvaliacaoPostagem_Postagem
    FOREIGN KEY (fk_Postagem_Cod)
        REFERENCES Software_De_Carona.Postagem (Cod)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE Software_De_Carona.Chat ADD CONSTRAINT FK_Chat_Carona
    FOREIGN KEY (fk_Carona_Cod)
        REFERENCES Software_De_Carona.Carona (Cod)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE Software_De_Carona.Mensagem ADD CONSTRAINT FK_Mensagem_Usuario
    FOREIGN KEY (fk_Remetente_Matricula)
        REFERENCES Software_De_Carona.Usuario (Matricula)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE Software_De_Carona.Mensagem ADD CONSTRAINT FK_Mensagem_Chat
    FOREIGN KEY (fk_Chat_Cod)
        REFERENCES Software_De_Carona.Chat (Cod)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE Software_De_Carona.Carona
    ALTER DataCriacao SET DEFAULT NOW();

ALTER TABLE Software_De_Carona.Postagem
    ALTER DataCriacao SET DEFAULT current_timestamp();

ALTER TABLE Software_De_Carona.AvaliacaoPostagem
    ALTER DataCriacao SET DEFAULT current_timestamp();

ALTER TABLE Software_De_Carona.Carona
    ALTER prefGenero SET DEFAULT NULL;

ALTER TABLE Software_De_Carona.Mensagem
    ALTER datahora SET DEFAULT current_timestamp();

ALTER TABLE Software_De_Carona.Chat
    ALTER datahora SET DEFAULT current_timestamp();
