CREATE DATABASE GerenciadorPedidoRestaurante;
USE GerenciadorPedidoRestaurante;

CREATE TABLE Mesa (
  ID_Mesa INT PRIMARY KEY AUTO_INCREMENT,
  MAC VARCHAR (17) NOT NULL,
  NomeMesa VARCHAR (20) NOT NULL,
  DesativarMesa INT CHECK (DesativarMesa =0 OR DesativarMesa =1) DEFAULT (0)  NOT NULL
);

CREATE TABLE Comida (
	ID_Comida INT PRIMARY KEY AUTO_INCREMENT,
	Nome VARCHAR(50) NOT NULL,
    Tamanho VARCHAR(50) NOT NULL,
    Preco DECIMAL(6, 2) NOT NULL,
	Categoria VARCHAR(10) CHECK (Categoria ='Refeição' OR Categoria ='Lanche' OR Categoria = 'Bebida' OR Categoria = 'Sobremesa') DEFAULT ('Refeição')  NOT NULL,
    Ingredientes VARCHAR(300) NULL,
    DesativarComida INT CHECK (DesativarComida =0 OR DesativarComida =1) DEFAULT (0)  NOT NULL
	
 );
 
  
CREATE TABLE Pedido (
  ID_Pedido INT PRIMARY KEY AUTO_INCREMENT,
  ID_Mesa INT NOT NULL,
  ValorTotal DECIMAL(6, 2) NOT NULL,
  QntPessoa INT NOT NULL,
  EncerrarPedido INT CHECK (EncerrarPedido =0 OR EncerrarPedido =1) DEFAULT (0)  NOT NULL,
  PedidoPago INT CHECK (PedidoPago =0 OR PedidoPago =1) DEFAULT (0)  NOT NULL,
  
  FOREIGN KEY(ID_Mesa) REFERENCES Mesa(ID_Mesa)
);

CREATE TABLE ItensPedido (
  ID_ItensPedido INT PRIMARY KEY AUTO_INCREMENT,
  ID_Comida INT NOT NULL,
  ID_Pedido INT NOT NULL,
  Quantidade INT NOT NULL,
  PedidoFeito INT CHECK (PedidoFeito =0 OR PedidoFeito =1) DEFAULT (0)  NOT NULL,

  FOREIGN KEY (ID_Comida) REFERENCES Comida (ID_Comida), 
  
  FOREIGN KEY (ID_Pedido) REFERENCES Pedido (ID_Pedido)
);


INSERT INTO Mesa (MAC, NomeMesa, DesativarMesa)
VALUES ("Servidor", "Servidor", 0);