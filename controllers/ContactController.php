<?php

class ContactController {
private $contactDAO;

public function __construct(ContactDAO $contactDAO) {
$this->contactDAO = $contactDAO;
}

public function getAllContacts() {
// Récupérer tous les contacts
$contacts = $this->contactDAO->getAll();

// Retourner les contacts (peut être utilisé pour affichage, etc.)
return $contacts;
}

public function getContactById($id) {
// Récupérer un contact par son ID
$contact = $this->contactDAO->getById($id);

// Retourner le contact (peut être utilisé pour affichage, etc.)
return $contact;
}

public function saveContact(Contact $contact) {
// Enregistrer un nouveau contact
$success = $this->contactDAO->save($contact);

// Retourner le succès de l'opération
return $success;
}

public function updateContact(Contact $contact) {
// Mettre à jour un contact existant
$success = $this->contactDAO->update($contact);

// Retourner le succès de l'opération
return $success;
}

public function deleteContact(Contact $contact) {
// Supprimer un contact
$success = $this->contactDAO->delete($contact);

// Retourner le succès de l'opération
return $success;
}
}

?>