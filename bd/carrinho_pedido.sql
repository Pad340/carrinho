CREATE DATABASE carrinho;

USE carrinho;

CREATE TABLE `pedido`
(
    `pedido_id`   int(11)      NOT NULL AUTO_INCREMENT,
    `valor_total` float(10, 2) NOT NULL,
    `data`        datetime     NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`pedido_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;


CREATE TABLE `produto`
(
    `produto_id` int(11)                                                           NOT NULL AUTO_INCREMENT,
    `nome`       varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_nopad_ci NOT NULL,
    `categoria`  varchar(100)                                                      NOT NULL,
    `valor`      float(10, 2)                                                      NOT NULL,
    `quantidade` int(11)                                                           NOT NULL DEFAULT 1,
    `imagem`     varchar(255)                                                               DEFAULT NULL,
    PRIMARY KEY (`produto_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 15
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;


CREATE TABLE `itenspedido`
(
    `item_id`        int(11)      NOT NULL AUTO_INCREMENT,
    `produto_id`     int(11)      NOT NULL,
    `pedido_id`      int(11)      NOT NULL,
    `quantidade`     double       NOT NULL,
    `valor_unitario` float(10, 2) NOT NULL,
    `valor_total`    float(10, 2) NOT NULL,
    PRIMARY KEY (`item_id`),
    KEY `fk_pedido` (`pedido_id`),
    KEY `fk_produto` (`produto_id`),
    CONSTRAINT `fk_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`),
    CONSTRAINT `fk_produto` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 9
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;


INSERT INTO `produto`
VALUES (1, 'Calabresa', 'Salgados', 6.50, 1, 'Salgados.jpg'),
       (2, 'Hambúrguer', 'Salgados', 6.50, 1, 'Salgados.jpg'),
       (3, 'Frango com Bacon', 'Salgados', 6.50, 1, 'Salgados.jpg'),
       (4, 'Carne', 'Salgados', 6.50, 1, 'Salgados.jpg'),
       (5, 'Pirulito', 'Doces', 1.00, 1, 'Doces.png'),
       (6, 'Bala de Iogurte', 'Doces', 0.20, 1, 'Doces.png'),
       (7, 'Bala Branca', 'Doces', 0.15, 1, 'Doces.png'),
       (8, 'Trento', 'Doces', 2.50, 1, 'Doces.png'),
       (9, 'Canudo Frito', 'Doces', 2.50, 1, 'Doces.png'),
       (10, 'Fantasminha', 'Chips', 2.50, 1, 'Chips.jpg'),
       (11, 'Coca-Cola 220 mL', 'Bebidas', 3.00, 1, 'Bebidas.jpg'),
       (12, 'Fanta Laranja 220 mL', 'Bebidas', 3.00, 1, 'Bebidas.jpg'),
       (13, 'Sprite 220 mL', 'Bebidas', 3.00, 1, 'Bebidas.jpg'),
       (14, 'Suco Kapo 220 mL', 'Bebidas', 3.00, 1, 'Bebidas.jpg');