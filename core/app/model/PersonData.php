<?php
class PersonData {
	public static $tablename = "person";

	public function PersonData(){
		$this->name = "";
		$this->lastname = "";
		$this->is_active = "1";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name,lastname,email,kind,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->email\",1,NOW())";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto KindData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",email=\"$this->email\",lastname=\"$this->lastname\",is_active=$this->is_active,kind=$this->kind where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new KindData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new KindData());

	}
        
        public static function getAct(){
		$sql = "select * from ".self::$tablename." where is_active = 1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new KindData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new KindData());
	}


}

?>
