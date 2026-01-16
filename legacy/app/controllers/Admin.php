<?php
class Admin extends Controller {
    public function __construct(){
        // Check if logged in and is admin
        if(!isLoggedIn() || !isAdmin()){
            header('location: ' . URLROOT . '/users/login');
        }
    }

    public function index(){
        $data = [
            'title' => 'Tableau de bord Administrateur',
            'description' => 'Gérez les membres, entrainements et événements ici.'
        ];

        $this->view('admin/index', $data);
    }

    public function members(){
        // Load Member Model
        $memberModel = $this->model('Member');
        $members = $memberModel->getMembers();

        $data = [
            'members' => $members
        ];

        $this->view('admin/members', $data);
    }

    public function editMember($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST logic here
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'role' => trim($_POST['role']),
                'telephone' => trim($_POST['telephone']),
                'categorie' => trim($_POST['categorie']),
                'statut' => trim($_POST['statut']),
                'name_err' => '',
                'email_err' => ''
            ];

            if(empty($data['name'])){
                $data['name_err'] = 'Nom requis';
            }

            if(empty($data['name_err'])){
                 $memberModel = $this->model('Member');
                 if($memberModel->updateMember($data)){
                     flash('member_message', 'Membre mis à jour');
                     header('location: ' . URLROOT . '/admin/members');
                 } else {
                     die('Erreur base de données');
                 }
            } else {
                 $this->view('admin/edit_member', $data);
            }

        } else {
            $memberModel = $this->model('Member');
            $member = $memberModel->getMemberById($id);

            $data = [
                'id' => $id,
                'name' => $member->name,
                'email' => $member->email,
                'role' => $member->role,
                'telephone' => $member->telephone,
                'categorie' => $member->categorie,
                'statut' => $member->statut
            ];

            $this->view('admin/edit_member', $data);
        }
    }
    
    // --- TRAININGS ---

    public function trainings(){
        $trainingModel = $this->model('Training');
        $trainings = $trainingModel->getTrainings();

        $data = [
            'trainings' => $trainings
        ];

        $this->view('admin/trainings', $data);
    }

    public function addTraining(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'titre' => trim($_POST['titre']),
                'description' => trim($_POST['description']),
                'date_heure' => trim($_POST['date_heure']),
                'lieu' => trim($_POST['lieu']),
                'places_max' => trim($_POST['places_max']),
                'coach_id' => $_SESSION['user_id'], // Assign to current admin/coach
                'titre_err' => '',
                'date_err' => '',
                'lieu_err' => ''
            ];

            // Validate data
            if(empty($data['titre'])){
                $data['titre_err'] = 'Veuillez entrer un titre';
            }
            if(empty($data['date_heure'])){
                $data['date_err'] = 'Veuillez choisir une date';
            }
            if(empty($data['lieu'])){
                $data['lieu_err'] = 'Veuillez entrer un lieu';
            }

            // Make sure no errors
            if(empty($data['titre_err']) && empty($data['date_err']) && empty($data['lieu_err'])){
                // Validated
                $trainingModel = $this->model('Training');
                if($trainingModel->addTraining($data)){
                    flash('training_message', 'Entrainement ajouté avec succès');
                    header('location: ' . URLROOT . '/admin/trainings');
                } else {
                    die('Une erreur est survenue');
                }
            } else {
                // Load view with errors
                $this->view('admin/add_training', $data);
            }

        } else {
            $data = [
                'titre' => '',
                'description' => '',
                'date_heure' => '',
                'lieu' => '',
                'places_max' => '20',
                'titre_err' => '',
                'date_err' => '',
                'lieu_err' => ''
            ];
  
            $this->view('admin/add_training', $data);
        }
    }
    public function editTraining($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'titre' => trim($_POST['titre']),
                'description' => trim($_POST['description']),
                'date_heure' => trim($_POST['date_heure']),
                'lieu' => trim($_POST['lieu']),
                'places_max' => trim($_POST['places_max']),
                'titre_err' => '',
                'date_err' => '',
                'lieu_err' => ''
            ];

            // Validate data
            if(empty($data['titre'])){
                $data['titre_err'] = 'Veuillez entrer un titre';
            }
            if(empty($data['date_heure'])){
                $data['date_err'] = 'Veuillez choisir une date';
            }
            if(empty($data['lieu'])){
                $data['lieu_err'] = 'Veuillez entrer un lieu';
            }

            // Make sure no errors
            if(empty($data['titre_err']) && empty($data['date_err']) && empty($data['lieu_err'])){
                // Validated
                $trainingModel = $this->model('Training');
                
                // Update specific update method in Model needed or reuse add with ID? 
                // We typically need an update method.
                // For now, I'll assume we need to add updateTraining to model.
                // Let's implement the controller logic hoping model update follows.
                // Actually I should proactively add updateTraining to model first, but I can't switch tool context mid-stream.
                // I will add the method to model in next tool call.
                
                if($trainingModel->updateTraining($data)){
                    flash('training_message', 'Entrainement modifié avec succès');
                    header('location: ' . URLROOT . '/admin/trainings');
                } else {
                    die('Une erreur est survenue');
                }
            } else {
                // Load view with errors
                $this->view('admin/edit_training', $data);
            }

        } else {
            // Get existing training from model
            $trainingModel = $this->model('Training');
            $training = $trainingModel->getTrainingById($id);

            // Check for owner or admin rights if necessary
            
            $data = [
                'id' => $id,
                'titre' => $training->titre,
                'description' => $training->description,
                'date_heure' => $training->date_heure,
                'lieu' => $training->lieu,
                'places_max' => $training->places_max,
                'titre_err' => '',
                'date_err' => '',
                'lieu_err' => ''
            ];
  
            $this->view('admin/edit_training', $data);
        }
    }

    public function deleteTraining($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $trainingModel = $this->model('Training');
            if($trainingModel->deleteTraining($id)){
                flash('training_message', 'Entrainement supprimé');
                header('location: ' . URLROOT . '/admin/trainings');
            } else {
                die('Une erreur est survenue');
            }
        } else {
            header('location: ' . URLROOT . '/admin/trainings');
        }
    }

    // --- PAYMENTS ---

    public function payments(){
        $paymentModel = $this->model('Payment');
        $payments = $paymentModel->getPayments();

        $data = [
            'payments' => $payments
        ];

        $this->view('admin/payments', $data);
    }

    public function addPayment(){
        // Get all members for the dropdown
        $memberModel = $this->model('Member');
        $members = $memberModel->getMembers();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'members' => $members,
                'membre_id' => trim($_POST['membre_id']),
                'montant' => trim($_POST['montant']),
                'motif' => trim($_POST['motif']),
                'date_paiement' => trim($_POST['date_paiement']),
                'statut' => trim($_POST['statut']),
                'motif_err' => '',
                'montant_err' => ''
            ];

            if(empty($data['montant'])) $data['montant_err'] = 'Montant requis';
            if(empty($data['motif'])) $data['motif_err'] = 'Motif requis';

            if(empty($data['montant_err']) && empty($data['motif_err'])){
                 $paymentModel = $this->model('Payment');
                 if($paymentModel->addPayment($data)){
                     flash('payment_message', 'Paiement enregistré');
                     header('location: ' . URLROOT . '/admin/payments');
                 } else {
                     die('Erreur');
                 }
            } else {
                $this->view('admin/add_payment', $data);
            }

        } else {
            $data = [
                'members' => $members,
                'membre_id' => '',
                'montant' => '',
                'motif' => '',
                'date_paiement' => date('Y-m-d\TH:i'),
                'statut' => 'payé',
                'motif_err' => '',
                'montant_err' => ''
            ];
            $this->view('admin/add_payment', $data);
        }
    }

    public function editPayment($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'montant' => trim($_POST['montant']),
                'motif' => trim($_POST['motif']),
                'date_paiement' => trim($_POST['date_paiement']),
                'statut' => trim($_POST['statut']),
                'motif_err' => '',
                'montant_err' => ''
            ];

            if(empty($data['montant'])) $data['montant_err'] = 'Montant requis';
            if(empty($data['motif'])) $data['motif_err'] = 'Motif requis';

            if(empty($data['montant_err']) && empty($data['motif_err'])){
                 $paymentModel = $this->model('Payment');
                 if($paymentModel->updatePayment($data)){
                     flash('payment_message', 'Paiement mis à jour');
                     header('location: ' . URLROOT . '/admin/payments');
                 } else {
                     die('Erreur');
                 }
            } else {
                $this->view('admin/edit_payment', $data);
            }

        } else {
            $paymentModel = $this->model('Payment');
            $payment = $paymentModel->getPaymentById($id);

            $data = [
                'id' => $id,
                'membre_id' => $payment->membre_id, // Usually readonly in edit
                'montant' => $payment->montant,
                'motif' => $payment->motif,
                'date_paiement' => $payment->date_paiement,
                'statut' => $payment->statut,
                'motif_err' => '',
                'montant_err' => ''
            ];
            $this->view('admin/edit_payment', $data);
        }
    }

    public function paymentReceipt($id){
        $paymentModel = $this->model('Payment');
        // Fetch payment details joined with user details for the receipt
        // reused getPayments logic but filtered or new JOIN method
        // for simplicity, let's fetch generic details. ideally need member name.
        // Let's rely on a join query in model or simple distinct calls.
        
        // I'll assume I can just fetch the single payment logic again but I need member name.
        // Let's add specific method in model for receipt would be best, but for speed:
        
        $payment = $paymentModel->getPaymentById($id);
        $memberModel = $this->model('Member');
        // getMemberById needs user_id which is in payment->membre_id (actually schema says membre_id linked to users table? let's check schema.sql... users id -> membres user_id. wait. 
        // schema: paiements table has membre_id foreign key references users(id). Correct.
        $member = $memberModel->getMemberById($payment->membre_id); // This fetches by User ID as per Member Model logic

        $data = [
            'payment' => $payment,
            'member' => $member
        ];

        $this->view('admin/payment_receipt', $data);
    }
    public function deleteMember($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $memberModel = $this->model('Member');
            if($memberModel->deleteMember($id)){
                flash('member_message', 'Membre supprimé');
                header('location: ' . URLROOT . '/admin/members');
            } else {
                die('Une erreur est survenue');
            }
        } else {
            header('location: ' . URLROOT . '/admin/members');
        }
    }

    public function deletePayment($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $paymentModel = $this->model('Payment');
            if($paymentModel->deletePayment($id)){
                flash('payment_message', 'Paiement supprimé');
                header('location: ' . URLROOT . '/admin/payments');
            } else {
                die('Une erreur est survenue');
            }
        } else {
            header('location: ' . URLROOT . '/admin/payments');
        }
    }
}
