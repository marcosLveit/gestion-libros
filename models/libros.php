<?php
	
	class libros_model {
		
		private $db;
		private $libros;
		
		public function __construct(){
			$this->db = Conexion::conectar();
			$this->libros = array();
		}

        public function get_libros()
		{
			$sql = "SELECT * FROM libro";
			$resultado = $this->db->query($sql);
			while($row = $resultado->fetch_assoc())
			{
				$this->libros[] = $row;
			}
			return $this->libros;
		}
    }