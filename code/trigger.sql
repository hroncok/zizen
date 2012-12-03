-- Nástřel triggeru, který bude zajišťovat nalezení žízní

CREATE OR REPLACE TRIGGER find_matching_thirsts_on_insert
AFTER INSERT ON thirst
FOR EACH ROW
BEGIN
	
END find_matching_thirsts_on_insert;
/

-- Podobným způsobem je nutné ošetřit i události UPDATE a DELETE
