<?php

class TicketData {

    public static $tablename = "ticket";

    public function TicketData() {
        $this->name = "";
        $this->lastname = "";
        $this->email = "";
        $this->password = "";
        $this->created_at = "NOW()";
    }

    public function getProject() {
        return ProjectData::getById($this->project_id);
    }

    public function getPriority() {
        return PriorityData::getById($this->priority_id);
    }

    public function getStatus() {
        return StatusData::getById($this->status_id);
    }

    public function getKind() {
        return KindData::getById($this->kind_id);
    }

    public function getCategory() {
        return CategoryData::getById($this->category_id);
    }

    public function add() {
        //VALIDAMOS SI YA VIENE CON EVIDENCIA O SIN ELLA
        if (!empty($this->evidencia)) {
            $sql = "insert into ticket (title,description,category_id,project_id,priority_id,user_id,status_id,kind_id,created_at,person_id,evidencia_id) ";
            $sql .= "value (\"$this->title\",\"$this->description\",\"$this->category_id\",\"$this->project_id\",$this->priority_id,$this->user_id,1,$this->kind_id,$this->created_at,\"$this->person_id\",\"$this->evidencia\")";
            return Executor::doit($sql);
        } else {
            $sql = "insert into ticket (title,description,category_id,project_id,priority_id,user_id,status_id,kind_id,created_at,person_id,evidencia_id) ";
            $sql .= "value (\"$this->title\",\"$this->description\",\"$this->category_id\",\"$this->project_id\",$this->priority_id,$this->user_id,1,$this->kind_id,$this->created_at,\"$this->person_id\",null)";
            return Executor::doit($sql);
        }
    }

    public function addHistory() {
        //VALIDAMOS SI YA VIENE CON EVIDENCIA O SIN ELLA
        if (!empty($this->evidenciahistory_id)) {
            $sql = "insert into tickethistory (ticket_id,description,created_at,user_id,evidenciahistory_id) ";
            $sql .= "value ($this->ticket_id,\"$this->description\",NOW(),$this->user_id,\"$this->evidenciahistory_id\")";
            return Executor::doit($sql);
        } else {
            $sql = "insert into tickethistory (ticket_id,description,created_at,user_id,evidenciahistory_id) ";
            $sql .= "value ($this->ticket_id,\"$this->description\",NOW(),$this->user_id,\"$this->evidenciahistory_id\")";
            return Executor::doit($sql);
        }
    }

    public static function delById($id) {
        $sql = "delete from " . self::$tablename . " where id=$id";
        Executor::doit($sql);
    }

    public function del() {
        $sql = "delete from " . self::$tablename . " where id=$this->id";
        Executor::doit($sql);
    }

// partiendo de que ya tenemos creado un objecto TicketData previamente utilizamos el contexto
    public function update() {
        $sql = "update " . self::$tablename . " set title=\"$this->title\",description=\"$this->description\",updated_at=NOW(),kind_id=\"$this->kind_id\",project_id=\"$this->project_id\",category_id=\"$this->category_id\",priority_id=\"$this->priority_id\",status_id=\"$this->status_id\",evidencia_id=\"$this->evidencia\",person_id=\"$this->person_id\" where id=$this->id";
        Executor::doit($sql);
    }
    
    public function update_status_id() {
        $sql = "update " . self::$tablename . " set updated_at=NOW(),status_id=\"$this->status_id\" where id= $this->ticket_id ";
        Executor::doit($sql);
    }

    public function updateCategory() {
        $sql = "update " . self::$tablename . " set category_id=\"$this->category_id\",project_id=\"$this->project_id\",priority_id=\"$this->priority_id\",status_id=\"$this->status_id\",kind_id=\"$this->kind_id\",updated_at=NOW() where id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id) {
        $sql = "select * from " . self::$tablename . " where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new TicketData());
    }

    public static function getRepeated($pacient_id, $medic_id, $date_at, $time_at) {
        $sql = "select * from " . self::$tablename . " where pacient_id=$pacient_id and medic_id=$medic_id and date_at=\"$date_at\" and time_at=\"$time_at\"";
        $query = Executor::doit($sql);
        return Model::one($query[0], new TicketData());
    }

    public static function getByMail($mail) {
        $sql = "select * from " . self::$tablename . " where mail=\"$mail\"";
        $query = Executor::doit($sql);
        return Model::one($query[0], new TicketData());
    }

    public static function getEvery() {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getAll() {
        $sql = "select * from " . self::$tablename . " order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getAllPendings() {
        $sql = "select * from " . self::$tablename . " where status_id=1";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getAllDeveloping() {
        $sql = "select * from " . self::$tablename . " where status_id=2";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getAllTerminated() {
        $sql = "select * from " . self::$tablename . " where status_id=3";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getAllCancel() {
        $sql = "select * from " . self::$tablename . " where status_id=4";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getAllByPacientId($id) {
        $sql = "select * from " . self::$tablename . " where pacient_id=$id order by created_at";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getAllByMedicId($id) {
        $sql = "select * from " . self::$tablename . " where medic_id=$id order by created_at";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getBySQL($sql) {
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getOld() {
        $sql = "select * from " . self::$tablename . " where date(date_at)<date(NOW()) order by date_at";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

    public static function getLike($q) {
        $sql = "select * from " . self::$tablename . " where title like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TicketData());
    }

}

?>