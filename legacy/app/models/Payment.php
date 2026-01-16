<?php
class Payment {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPayments(){
        // Join with users to get member names
        $this->db->query('SELECT paiements.*, users.name as member_name, users.email 
                          FROM paiements
                          JOIN users ON paiements.membre_id = users.id
                          ORDER BY paiements.date_paiement DESC');
        return $this->db->resultSet();
    }

    public function addPayment($data){
        $this->db->query('INSERT INTO paiements (membre_id, montant, motif, date_paiement, statut) VALUES (:membre_id, :montant, :motif, :date_paiement, :statut)');
        
        $this->db->bind(':membre_id', $data['membre_id']);
        $this->db->bind(':montant', $data['montant']);
        $this->db->bind(':motif', $data['motif']);
        $this->db->bind(':date_paiement', $data['date_paiement']);
        $this->db->bind(':statut', $data['statut']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getPaymentById($id){
        $this->db->query('SELECT * FROM paiements WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updatePayment($data){
        $this->db->query('UPDATE paiements SET montant = :montant, motif = :motif, date_paiement = :date_paiement, statut = :statut WHERE id = :id');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':montant', $data['montant']);
        $this->db->bind(':motif', $data['motif']);
        $this->db->bind(':date_paiement', $data['date_paiement']);
        $this->db->bind(':statut', $data['statut']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deletePayment($id){
        $this->db->query('DELETE FROM paiements WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
