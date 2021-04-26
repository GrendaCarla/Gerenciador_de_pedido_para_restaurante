USE GerenciadorPedidoRestaurante;

INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Arroz", "1 Pessoa", 7.50, "Refeição", "Arroz, alho, sal, cebola", 0);
 
INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Feijão", "1 Pessoa", 9.50, "Refeição", "Feijão, alho, sal", 0);

INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Pão de Queijo", "Médio", 2.50, "Lanche", "", 0);
 
INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Coxinha de Frango", "Médio", 3.00, "Lanche", "Frango, catupiry", 0);

INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Coca-Cola", "350ml", 5.00, "Bebida", "", 0);

INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Água", "1L", 2.50, "Bebida", "", 0);

INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Pudim", "Pequeno", 4.25, "Sobremesa", "", 0);
 
INSERT INTO Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida)
VALUES ("Bala Juquinha - Banana", "Pequeno", 0.10, "Sobremesa", "", 0);
 
 select * from Comida;
 
 
INSERT INTO Mesa (MAC, NomeMesa, DesativarMesa)
VALUES ("11-11-11-11-11-11", "1", 0);

INSERT INTO Mesa (MAC, NomeMesa, DesativarMesa)
VALUES ("22-22-22-22-22-22", "2", 0);

select * from Mesa;


INSERT INTO Pedido (ID_Mesa, ValorTotal, QntPessoa, EncerrarPedido)
VALUES (1, 0.00, 0, 0);

INSERT INTO Pedido (ID_Mesa, ValorTotal, QntPessoa, EncerrarPedido)
VALUES (2, 15.50, 2, 0);

select * from Pedido;



INSERT INTO ItensPedido (ID_Comida, ID_Pedido, Quantidade, PedidoFeito)
VALUES (1, 1, 1, 0);

INSERT INTO ItensPedido (ID_Comida, ID_Pedido, Quantidade, PedidoFeito)
VALUES (2, 1, 1, 0);

INSERT INTO ItensPedido (ID_Comida, ID_Pedido, Quantidade, PedidoFeito)
VALUES (5, 1, 1, 0);

INSERT INTO ItensPedido (ID_Comida, ID_Pedido, Quantidade, PedidoFeito)
VALUES (8, 1, 21, 0);




INSERT INTO ItensPedido (ID_Comida, ID_Pedido, Quantidade, PedidoFeito)
VALUES (3, 2, 2, 0);

INSERT INTO ItensPedido (ID_Comida, ID_Pedido, Quantidade, PedidoFeito)
VALUES (8, 2, 2, 0);

select * from ItensPedido;
