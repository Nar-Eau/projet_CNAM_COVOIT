function confirmDelete() {
    // Affichage de la boîte de dialogue de confirmation
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
    if (confirmation) {
        // Si l'utilisateur confirme, soumettre le formulaire
        document.getElementById('deleteForm').submit();
    } else {
        // Si l'utilisateur annule, ne rien faire
        return false;
    }
}