DROP PROCEDURE IF EXISTS `delete_client_reservation`; 

CREATE PROCEDURE `delete_client_reservation`(IN `p_idcli` INT) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN DELETE FROM reserver WHERE idcli = p_idcli; DELETE FROM client WHERE idcli = p_idcli; END 


CREATE PROCEDURE `delete_client_reservation`(IN `p_idcli` INT) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN DELETE FROM reserver WHERE idcli = p_idcli; DELETE FROM client WHERE idcli = p_idcli; END 