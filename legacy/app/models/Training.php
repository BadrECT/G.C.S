<?php
class Training {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getTrainings(){
        $this->db->query('SELECT * FROM entrainements ORDER BY date_heure DESC');
        return $this->db->resultSet();
    }

    public function addTraining($data){
        $this->db->query('INSERT INTO entrainements (titre, description, date_heure, lieu, coach_id, places_max) VALUES(:titre, :description, :date_heure, :lieu, :coach_id, :places_max)');
        
        // Bind values
        $this->db->bind(':titre', $data['titre']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date_heure', $data['date_heure']);
        $this->db->bind(':lieu', $data['lieu']);
        $this->db->bind(':coach_id', $data['coach_id']);
        $this->db->bind(':places_max', $data['places_max']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    // Get single training
    public function getTrainingById($id){
        $this->db->query('SELECT * FROM entrainements WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function updateTraining($data){
        $this->db->query('UPDATE entrainements SET titre = :titre, description = :description, date_heure = :date_heure, lieu = :lieu, places_max = :places_max WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':titre', $data['titre']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date_heure', $data['date_heure']);
        $this->db->bind(':lieu', $data['lieu']);
        $this->db->bind(':places_max', $data['places_max']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteTraining($id){
        $this->db->query('DELETE FROM entrainements WHERE id = :id');
        $this->db->bind(':id', $id);
        
        if($this->db->execute()){
             return true;
        } else {
             return false;
        }
    }
}
