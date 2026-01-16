<?php
class Member {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getMembers(){
        // Join users and membres tables
        $this->db->query('SELECT users.id as userId, users.name, users.email, users.role, users.created_at, membres.telephone, membres.categorie, membres.statut, membres.photo 
                          FROM users 
                          LEFT JOIN membres ON users.id = membres.user_id
                          ORDER BY users.created_at DESC');
        return $this->db->resultSet();
    }

    public function getMemberById($id){
        $this->db->query('SELECT users.id as userId, users.name, users.email, users.role, membres.* 
                          FROM users 
                          LEFT JOIN membres ON users.id = membres.user_id 
                          WHERE users.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateMember($data){
        // We need to update both users table (role, etc) and membres table (telephone, categorie, statut)
        
        // Update Users Table
        $this->db->query('UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        
        if(!$this->db->execute()){
            return false;
        }

        // Update Membres Table
        $this->db->query('UPDATE membres SET telephone = :telephone, categorie = :categorie, statut = :statut WHERE user_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':categorie', $data['categorie']);
        $this->db->bind(':statut', $data['statut']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteMember($id){
        // Deleting from users table will cascade to membres table
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
