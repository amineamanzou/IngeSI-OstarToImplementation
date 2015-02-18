#-----------------------------------------------------------------------------
#-----------------------------------------------------------------------------
#   On new product - After insert on product table
BEGIN
    IF NEW.quantitySupply < NEW.limit THEN
        INSERT INTO reorder(quantityReorder,idProduct) 
		VALUES (NEW.quantityToReorder,NEW.idProduct);
    END IF;
END

#-----------------------------------------------------------------------------
#-----------------------------------------------------------------------------
#   On client order - Before update on order
BEGIN
    IF OLD.quantitySupply >= OLD.limit and NEW.quantitySupply < OLD.limit THEN
        INSERT INTO reorder(quantityReorder,idProduct) 
		VALUES (OLD.quantityToReorder,OLD.idProduct);
    END IF;
END