-- Nástřel triggeru, který bude zajišťovat nalezení žízní
-- Netestováno na datech

CREATE OR REPLACE FUNCTION filter_sex_by_filter_id(fid IN integer) IS
BEGIN
	RETURN (SELECT filter_sex FROM filters WHERE filter_id = fid);
END
/

CREATE OR REPLACE FUNCTION sex_by_user_id(uid IN integer) IS
BEGIN
	RETURN (SELECT sex FROM user WHERE user.user_id = uid);
END
/

CREATE OR REPLACE FUNCTION age_min_by_filter_id(fid IN integer) IS
BEGIN
	RETURN (SELECT age_min FROM filters WHERE filter_id = fid);
END
/

CREATE OR REPLACE FUNCTION age_max_by_filter_id(fid IN integer) IS
BEGIN
	RETURN (SELECT age_max FROM filters WHERE filter_id = fid);
END
/

-- Podobným způsobem deklarovat další použité funkce:
-- user_follows_user(u1,u2)
-- friend_radius_by_filter_id(fid)
-- other_radius_by_filter_id(fid)
-- geo_by_location_id(lid)
-- geo_delta(g1,g2)

CREATE OR REPLACE TRIGGER find_matching_thirsts_on_insert
AFTER INSERT ON thirst
FOR EACH ROW
TYPE thirst_id_table_type IS TABLE OF thirst.thirst_id%TYPE INDEX BY PLS_INTEGER;
thirst_id_table thirst_id_table_type;
my_id_table thirst_id_table_type;
BEGIN
	--Jen nad aktivní žízní
	IF :new.thirst_status=1 THEN
		SELECT :new.thirst_id, thirst_id INTO thirst_ids_table1 FROM thirst
			WHERE thirst_status=1 -- aktivní
			AND user_id <> :new.user_id -- není jeho vlastní
			AND (filter_sex_by_filter_id(:new.filter_id) = NULL OR filter_sex_by_filter_id(:new.filter_id) = sex_by_user_id(user_id)) --sex filtr odpovídá případnému filtru protistrany 
			AND (filter_sex_by_filter_id(filter_id) = NULL OR filter_sex_by_filter_id(filter_id) = sex_by_user_id(:new.user_id))  -- sex filtr protistrany odpovídá případnému filtru
			AND age_min_by_filter_id(:new.filter_id) <= age_by_user_id(user_id) -- protistrana není mladší než limit
			AND age_max_by_filter_id(:new.filter_id) >= age_by_user_id(user_id) -- protistrana není starší než limit
			AND age_min_by_filter_id(filter_id) <= age_by_user_id(:new.user_id) -- nejsme mladší než limit protistrany
			AND age_max_by_filter_id(filter_id) >= age_by_user_id(:new.user_id) -- nejsme starší než limit protistrany
			AND (
				(user_follows_user(:new.user_id,user_id) AND friend_radius_by_filter_id(:new.filter_id) >= geo_delta(geo_by_location_id(:new.location_id),geo_by_location_id(location_id))) -- sledujeme ho, tak použijeme friend radius
				OR
				(other_radius_by_filter_id(:new.filter_id) >= geo_delta(geo_by_location_id(:new.location_id,location_id))) -- nesledujeme, použijeme other radius 
			)
			AND (
				(user_follows_user(user_id,:new.user_id) AND friend_radius_by_filter_id(filter_id) >= geo_delta(geo_by_location_id(:new.location_id),geo_by_location_id(location_id)))) -- sleduje nás, tak použijeme friend radius
				OR
				(other_radius_by_filter_id(filter_id) >= geo_delta(geo_by_location_id(:new.location_id,location_id))) -- nesleduje, použijeme other radius 
			); -- END SELECT
		
		FOR idx IN..(SELECT COUNT(*) FROM thirst_ids_table)
			my_id_table(idx):=:new.thirst_id;
		END FOR;
		
		FORALL idx IN 1..(SELECT COUNT(*) FROM thirst_ids_table)
			INSERT INTO thirst_match (thirst1,thirst2) VALUES (my_id_table(idx), thirst_id_table(idx));
	END IF;
END find_matching_thirsts_on_insert;
/

-- Podobným způsobem je nutné ošetřit i události UPDATE a DELETE
-- Testovací část by bylo lepší napsat jako funkci

