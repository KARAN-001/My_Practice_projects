Create a tree structure in MySql table that could store the following tree structure: http://prnt.sc/wcbzth  
CREATE DATABASE sqltest 
CREATE TABLE electronicstree(id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, name varchar(255) NOT NULL, parent_key int(11) unsigned DEFAULT NULL )
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES ("ELECTRONICS",NULL)
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Laptops & PC',1);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Laptops',2);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('PC',2);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Cameras & photo',1); 
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Camera',5);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Phones & Accessories',1);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Smartphones',7);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Android',8);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('iOS',8);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Other Smartphones',8);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Batteries',7);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Headsets',7);
INSERT INTO `electronicstree`( `name`, `parent_key`) VALUES('Screen Protectors',7);

Write a query to find the root node.   SELECT * FROM `electronicstree` WHERE parent_key IS NULL          


2) Write a query to find leaf node. SELECT t1.id,t1.name FROM electronicstree t1 LEFT JOIn electronicstree t2 ON t2.parent_key = t1.id WHERE t2.id IS NULL

3) Write a query to find non-leaf node. SELECT DISTINCT t1.name,t1.id FROM electronicstree t1 RIGHT JOIN electronicstree t2 on t1.id=t2.parent_key

4) Write a query to find the path of each node. e.g. http://prnt.sc/wcc4bg 

5) Write a function to calculate node level. e.g. Electronics is at 0 level, Camera is on level 2 and iOs is on level 3. 


6) Write a procedure to get the immediate children. 
QUERY FOR IMMEDIATE CHID={ SELECT id,name FROM electronicstree WHERE parent_key=””;} 
DELIMITER $$
CREATE PROCEDURE immediatechild(IN `ID` INT(11))
BEGIN
SELECT t1.name FROM
electronicstree t1
  LEFT JOIN
  electronicstree t2
   ON
   t1.parent_key=t2.id
   WHERE
   t2.id=ID;
END$$
DELIMITER ;
