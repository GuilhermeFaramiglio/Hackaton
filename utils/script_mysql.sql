CREATE DATABASE FEEDCATCH;

USE FEEDCATCH;

CREATE TABLE TB_USUARIO (
    I_COD_USUARIO INT AUTO_INCREMENT PRIMARY KEY,
    S_UNM_USUARIO VARCHAR(50),
    S_PW_USUARIO VARCHAR(32)
);

CREATE TABLE TB_PRODUTO (
    I_COD_PRODUTO INT AUTO_INCREMENT PRIMARY KEY,
    S_NM_PRODUTO VARCHAR(45),
    S_DESC_PRODUTO TEXT,
    S_TAM_PRODUTO CHAR(1),
    S_COR_PRODUTO VARCHAR(45)
);

CREATE TABLE TB_CAMPANHA (
    I_COD_CAMPANHA INT AUTO_INCREMENT PRIMARY KEY,
    S_NM_CAMPANHA VARCHAR(45),
    S_DESC_CAMPANHA TEXT,
    DT_INIC_CAMPANHA DATETIME,
    DT_FIM_CAMPANHA DATETIME
);

CREATE TABLE TB_ITENSCAMPANHA (
    I_COD_ITENSCAMPANHA INT AUTO_INCREMENT PRIMARY KEY,
    I_COD_CAMPANHA INT,
    I_COD_PRODUTO INT,
    FOREIGN KEY (I_COD_CAMPANHA) REFERENCES TB_CAMPANHA(I_COD_CAMPANHA),
    FOREIGN KEY (I_COD_PRODUTO) REFERENCES TB_PRODUTO(I_COD_PRODUTO)
);

CREATE TABLE TB_FEEDBACK (
    I_COD_FEEDBACK INT AUTO_INCREMENT PRIMARY KEY,
    I_COD_CAMPANHA INT,
    S_AUTOR_FEEDBACK VARCHAR(45),
    S_TXT_FEEDBACK TEXT,
    DT_FEEDBACK DATETIME,
    I_SENT_FEEDBACK INT,
    FOREIGN KEY (I_COD_CAMPANHA) REFERENCES TB_CAMPANHA(I_COD_CAMPANHA)
);

CREATE TABLE TB_FEEDBACKCATEG (
    I_COD_FEEDBACKCATEG INT AUTO_INCREMENT PRIMARY KEY,
    I_TIPOCATEGORIA INT(2),
    I_FK_TB_FEEDBACK_ID INT
);

ALTER TABLE TB_FEEDBACKCATEG ADD CONSTRAINT FK_TB_FEEDBACKCATEG_TB_FEEDBACK FOREIGN KEY (I_FK_TB_FEEDBACK_ID) REFERENCES TB_FEEDBACK(I_COD_FEEDBACK);

INSERT INTO TB_USUARIO (S_UNM_USUARIO, S_PW_USUARIO) VALUES ('admin', 'admin');
INSERT INTO TB_CAMPANHA (S_NM_CAMPANHA, S_DESC_CAMPANHA, DT_INIC_CAMPANHA, DT_FIM_CAMPANHA)
VALUES ('Inverno com glamour', 'blusas importadas Le Lis Georgia Tricot Feminina.', '2025-04-20', '2025-06-23');
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'P', 'Bege');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 1);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'M', 'Bege');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 2);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'G', 'Bege');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 3);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'P', 'Branca');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 4);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'M', 'Branca');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 5);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'G', 'Branca');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 6);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'P', 'Preta');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 7);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'M', 'Preta');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 8);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Blusa Le Lis Georgia Tricot Feminina', 'Blusa de tricô importada, confortável e estilosa.', 'G', 'Preta');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (1, 9);
INSERT INTO TB_CAMPANHA (S_NM_CAMPANHA, S_DESC_CAMPANHA, DT_INIC_CAMPANHA, DT_FIM_CAMPANHA)
VALUES ('Bota Calça', 'Calça Jeans Feminina.', '2025-02-20', '2025-04-23');
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Calça Jeans Feminina', 'Calça jeans feminina, possui cós com passantes para cinto e fechamento por botões e zíper. A modelagem skinny traz um caimento moderno e ajustado do quadril até a barra.', 'P', 'Azul');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (2, 10);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Calça Jeans Feminina', 'Calça jeans feminina, possui cós com passantes para cinto e fechamento por botões e zíper. A modelagem skinny traz um caimento moderno e ajustado do quadril até a barra.', 'M', 'Azul');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (2, 11);
INSERT INTO TB_PRODUTO (S_NM_PRODUTO, S_DESC_PRODUTO, S_TAM_PRODUTO, S_COR_PRODUTO) VALUES ('Calça Jeans Feminina', 'Calça jeans feminina, possui cós com passantes para cinto e fechamento por botões e zíper. A modelagem skinny traz um caimento moderno e ajustado do quadril até a barra.', 'G', 'Azul');
INSERT INTO TB_ITENSCAMPANHA (I_COD_CAMPANHA, I_COD_PRODUTO) VALUES (2, 12);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Ana Paula', 'Comprei cheia de expectativas, mas a blusa ficou extremamente apertada, me senti desconfortável o dia inteiro.', '2025-05-09 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Ingrid Silva', 'Usei por apenas algumas horas e tive uma reação alérgica intensa, minha pele ficou toda vermelha.', '2025-05-16 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Carla Eduarda', 'A qualidade do tecido é decepcionante, parecia algo premium, mas veio parecendo um pano de chão.', '2025-05-20 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Daniela Moura', 'Fiquei esperando um bom atendimento e recebi grosseria e descaso. Péssima experiência.', '2025-06-23 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Eduarda Lima', 'Recebi o produto com um furo na manga. Me senti enganada, pois paguei caro por isso.', '2025-06-14 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Fernanda Torres', 'Demorou mais de duas semanas para chegar e ainda veio com defeito. Frustrante.', '2025-05-29 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Gabriela Souza', 'A cor da blusa na foto era vibrante, ao vivo é sem graça e completamente diferente.', '2025-05-06 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Helena Rocha', 'Costura mal feita, parece que vai rasgar a qualquer momento. Me senti desrespeitada como cliente.', '2025-05-05 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Maria Mendes', 'Pelo preço que paguei, esperava algo de muito mais qualidade. Me senti roubada.', '2025-05-21 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Joana Prado', 'O tecido é tão fino que parece transparente. Não dá pra usar sem algo por baixo.', '2025-06-03 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Karina Dias', 'Não gostei de nada. Desde a compra até a entrega foi um sofrimento.', '2025-06-05 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Lúcia Oliveira', 'Fiz a solicitação de troca e não obtive retorno. Zero suporte ao consumidor.', '2025-06-03 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Mariana Alves', 'Veio com cheiro forte de mofo, nem consegui usar. Tive que lavar três vezes.', '2025-06-03 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Natália Ribeiro', 'Tive que lidar com um atendimento frio e sem vontade. Pior parte da compra.', '2025-05-28 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Otaviana Nunes', 'Não serviu como deveria. A modelagem é completamente diferente do padrão.', '2025-05-10 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Patrícia Gomes', 'A blusa veio manchada de fábrica. Percebi só ao abrir o pacote. Revoltante.', '2025-06-10 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Rafaela Costa', 'Etiqueta estava errada, parecia produto falsificado.', '2025-05-30 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Sabrina Martins', 'Faltava um dos botões da peça, e não consegui reposição.', '2025-06-05 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Tamara Lima', 'O botão caiu na primeira vez que usei. Nunca mais compro.', '2025-05-23 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Vanessa Cruz', 'Na primeira lavagem, o tecido perdeu toda a forma. Desgastante viver isso.', '2025-06-05 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Diega Rocha', 'A blusa chegou dentro do prazo e parece boa, mas não foi exatamente o que eu esperava.', '2025-05-27 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Ximena Borges', 'Nada demais, cumpre o que promete, mas não encantou.', '2025-05-20 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Jessica Ferreira', 'Um produto razoável, adequado para o inverno, mas esperava um toque mais macio.', '2025-06-15 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Zuleika Matos', 'Veio certo, mas o tecido não é dos melhores. Esperava mais delicadeza.', '2025-04-22 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Bárbara Lins', 'A cor não era tão vibrante quanto no site, mas serviu bem.', '2025-04-30 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Carolina Martins', 'Comprei para minha mãe, ela achou apenas ok, sem empolgação.', '2025-04-21 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Debora Sena', 'A blusa é simples, cumpre o papel, nada surpreendente.', '2025-05-08 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Eliza Carvalho', 'A entrega foi no tempo certo, mas a peça parecia ter sido amassada.', '2025-05-18 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Fábia Lopes', 'Veio tudo certo, mas não sei se compraria de novo. Esperava algo a mais.', '2025-05-31 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Ana Maria Henrique', 'Não foi uma experiência ruim, mas também não foi marcante.', '2025-06-19 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Joana Silva', 'Simplesmente maravilhosa! A blusa tem um toque macio, quentinha e elegante. Me senti linda!', '2025-04-29 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Isadora Almeida', 'Comprei com medo de errar, mas foi uma das melhores compras que já fiz. Amei cada detalhe.', '2025-06-16 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Júlia César', 'Recebi antes do prazo e fiquei encantada com a qualidade e o caimento. Produto impecável!', '2025-05-20 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Letícia Moreira', 'O atendimento foi muito atencioso e a peça veio embalada com cuidado. Amei a experiência.', '2025-05-20 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Márcia Dias', 'Blusa linda, quentinha e leve. Ideal para os dias frios. Recomendo demais!', '2025-05-25 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Nina Castro', 'Fiquei encantada com a cor e o brilho sutil do tecido. Muito sofisticado.', '2025-05-22 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Ofélia Ramos', 'Usei no meu aniversário e todo mundo elogiou. Me senti especial.', '2025-05-01 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Paula Vitoria', 'Super confortável e elegante. Já quero em outras cores!', '2025-05-27 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Quésia Monteiro', 'Tive dúvidas no início, mas assim que vesti, tive certeza de que foi a escolha certa.', '2025-06-20 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (1, 'Renata Lima', 'Produto incrível! Superou todas as minhas expectativas. Comprarei mais!', '2025-06-12 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (2, 'Renata Lima', 'Produto incrível! esta calça superou todas as minhas expectativas. Comprarei mais!', '2025-03-12 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (2, 'Debora Sena', 'A calça é simples, cumpre o papel, nada surpreendente.', '2025-04-08 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (2, 'Ingrid Silva', 'Usei por apenas algumas horas e tive uma reação alérgica intensa, minha pele ficou toda vermelha, calça toxica.', '2025-04-16 00:00:00', NULL);
INSERT INTO TB_FEEDBACK (I_COD_CAMPANHA, S_AUTOR_FEEDBACK, S_TXT_FEEDBACK, DT_FEEDBACK, I_SENT_FEEDBACK) VALUES (2, 'Carla Eduarda', 'A qualidade do tecido é decepcionante, parecia algo premium, mas veio parecendo um pano de chão, pessíma calça.', '2025-03-20 00:00:00', NULL);




