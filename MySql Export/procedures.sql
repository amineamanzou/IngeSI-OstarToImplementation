DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `newOrder`(IN `quantity` INT(11), IN `idProduct` INT(11), IN `firstname` VARCHAR(64), IN `address` VARCHAR(128), IN `lastname` VARCHAR(64))
    NO SQL
    COMMENT 'Creating a new order (and client)'
BEGIN

	DECLARE quantitySupply int;	
	DECLARE compteur int;
	DECLARE idClient int;

	SET @quantitySupply = 0;
	SET @compteur=0;
	SET @idClient=0;

	SELECT product.quantitySupply into @quantitySupply from product where product.idProduct = idProduct;
	IF quantity <= @quantitySupply THEN
        select count(*) INTO @compteur from client where client.firstname=firstname and client.lastname=lastname;
        IF @compteur=0 THEN
            INSERT INTO client(firstname,lastname,address) values(firstname,lastname,address);
        END IF;
		SELECT client.idClient into @idClient from client where client.firstname=firstname and client.lastname=lastname;
 		INSERT INTO `orders`(`orders`.quantity,`orders`.idProduct,`orders`.idClient) values(quantity,idProduct,@idClient);
        UPDATE product SET product.quantitySupply=product.quantitySupply - quantity where product.idProduct=idProduct;
	END IF;
    

END;;
DELIMITER ;
#--------------------------------------------------------------------------------
#--------------------------------------------------------------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `newProduct`(IN `name` VARCHAR(64), IN `customer` VARCHAR(64), IN `limite` FLOAT, IN `idProduct` INT(11), IN `quantitySupply` INT(11), IN `quantityToReorder` INT(11))
    NO SQL
    COMMENT 'Creating a new product'
BEGIN

	DECLARE compteur int;
	SET @compteur = 0;

	SELECT count(*) INTO @compteur FROM product where product.name = name;
	IF @compteur = 0 THEN
		INSERT INTO product values(idProduct,name,customer,limite,quantitySupply,quantityToReorder);
	END IF;
	

END;;
DELIMITER ;
#--------------------------------------------------------------------------------
#--------------------------------------------------------------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `payeOrder`(IN `idOrder` SERIAL)
    NO SQL
    COMMENT 'Event 5 : Pay the orders'
BEGIN
UPDATE orders SET orders.payed=1 WHERE orders.idOrder=idOrder;
END;;
DELIMITER ;
#--------------------------------------------------------------------------------
#--------------------------------------------------------------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Reorder`(IN `idReorder` SERIAL)
    NO SQL
    COMMENT 'Reorder a product'
BEGIN
	DECLARE quantityToReorder int;
	DECLARE idProduct int;


	SET @quantityToReorder = 0;
	SET @idProduct = null;


	SELECT reorder.quantityToReorder INTO @quantityToReorder FROM reorder where reorder.idReorder = idReorder;
	SELECT reorder.idProduct INTO @idProduct FROM reorder where reorder.idReorder = idReorder;
	UPDATE product SET product.quantitySupply = product.quantitySupply + @quantityToReorder where product.idProduct = @idProduct;	
	UPDATE reorder SET reorder.dateLivraison=NOW() WHERE reorder.idReorder=idReorder;
END;;
DELIMITER ;