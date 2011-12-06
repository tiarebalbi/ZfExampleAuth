
CREATE TABLE IF NOT EXISTS 'tb_usuarios' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'nome' varchar(200) NOT NULL,
  'usuario' varchar(200) NOT NULL,
  'senha' varchar(200) NOT NULL,
  'grupo' varchar(50) NOT NULL,
  'email' varchar(200) NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO 'auth'.'tb_usuarios' ('id', 'nome', 'usuario', 'senha', 'grupo', 'email') 
VALUES 		(NULL, 'Usuario do Site', 'site', MD5('123456'), 'site', 'site@users.com.br'), 
			(NULL, 'Usuario Administrador', 'administrador', MD5('123456'), 'admin', 'admin@users.com.br');
			
		