## Laravel Roles Permissions Manager
<h5>Laravel Version : 8</h5>
<hr />
<h4>Previews</h4>


Ariel Ramirez

## License

[MIT license](https://opensource.org/licenses/MIT).

## Usage



<b>Your will be get Login Credentials from seeder file</b> <br>
<b>admin </b> <br>
user: ariel12jona@gmail.com <br>
password: ariel123
<br>

<b>user normal </b> <br>
user: ariel20jona@gmail.com <br>
password: ariel123



-- Volcando estructura para disparador librerialely.venta_articulos_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `venta_articulos_after_insert` AFTER INSERT ON `venta_articulos` FOR EACH ROW BEGIN
	UPDATE articulos SET stock = stock - NEW.cantidad
        WHERE articulos.id =NEW.articulo_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;