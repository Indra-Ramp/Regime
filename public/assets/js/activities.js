// --- CONTRÔLE DE L'ÉTAT DU FORMULAIRE ---

// 1. Passer le formulaire en mode ÉDITION
function setupEditMode(id, label, variation, frequence) {
    // Modifier les textes
    document.getElementById('form-title').innerText = "Modifier l'activité";
    document.getElementById('form-subtitle').innerText = `Modification de l'activité #${id}`;
    document.getElementById('btn-submit').innerText = "Enregistrer les modifications";
    
    // Afficher le bouton d'annulation
    document.getElementById('btn-cancel').style.display = 'block';

    // Remplir les champs
    document.getElementById('activity_id').value = id;
    document.getElementById('label').value = label;
    document.getElementById('variation_poids').value = variation;
    document.getElementById('frequence').value = frequence;

    // Focus sur le premier champ pour plus de confort
    document.getElementById('label').focus();
}

// 2. Repasser le formulaire en mode CRÉATION (Remise à zéro)
function resetToCreateMode() {
    document.getElementById('activity-form-ajax').reset();
    document.getElementById('activity_id').value = '';
    
    document.getElementById('form-title').innerText = "Créer votre parcours";
    document.getElementById('form-subtitle').innerText = "Remplissez les champs pour ajouter une nouvelle activité.";
    document.getElementById('btn-submit').innerText = "Valider et Créer l'Activité";
    
    document.getElementById('btn-cancel').style.display = 'none';
}

// Notifications Toast (Positionnées en bas à droite avec animation)
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.className = `toast-notification toast-${type}`;
    toast.innerText = message;
    toast.style.display = 'block';
    setTimeout(() => { toast.style.display = 'none'; }, 3000);
}


// --- GESTION DES APPELS AJAX (Fetch API) ---

document.addEventListener('DOMContentLoaded', function() {
    const activityForm = document.getElementById('activity-form-ajax');
    if (activityForm) {
        activityForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('activity_id').value;
            const isEditMode = id !== ""; // Si un ID existe, on modifie, sinon on crée
            
            // URL cible dynamique selon l'état
            const url = isEditMode ? '/admin/activities/updated-activity' : '/admin/create-activity';
            const formData = new FormData(this);

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    if (isEditMode) {
                        // --- MODE MODIFICATION ---
                        showToast("Activité mise à jour !");
                        const row = document.getElementById(`row-${id}`);
                        if (row) {
                            row.querySelector('.cell-label').innerText = data.activity.label;
                            row.querySelector('.cell-variation').innerText = `${data.activity.variation_poids} kg`;
                            row.querySelector('.cell-frequence span').innerText = `${data.activity.frequence} jours`;
                            
                            // Met à jour le bouton d'édition de la ligne de manière sécurisée
                            const btnEdit = row.querySelector('.btn-edit');
                            const escapedLabel = data.activity.label.replace(/'/g, "\\'");
                            btnEdit.setAttribute('onclick', `setupEditMode(${id}, '${escapedLabel}', ${data.activity.variation_poids}, ${data.activity.frequence})`);
                        }
                        resetToCreateMode(); // On repasse en mode création après enregistrement
                    } else {
                        // --- MODE CRÉATION ---
                        showToast("Nouvelle activité ajoutée !");
                        const tbody = document.getElementById('activities-table-body');
                        const escapedLabel = data.activity.label.replace(/'/g, "\\'");
                        
                        const newRow = `
                            <tr id="row-${data.activity.id}">
                                <td><strong>${data.activity.id}</strong></td>
                                <td class="cell-label">${data.activity.label}</td>
                                <td class="cell-variation">${data.activity.variation_poids} kg</td>
                                <td class="cell-frequence"><span class="badge">${data.activity.frequence} jours</span></td>
                                <td>
                                    <button class="btn-edit" onclick="setupEditMode(${data.activity.id}, '${escapedLabel}', ${data.activity.variation_poids}, ${data.activity.frequence})">Modifier</button>
                                    <button class="btn-delete" onclick="deleteActivity(${data.activity.id})">Supprimer</button>
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', newRow);
                        resetToCreateMode(); // Vide le formulaire
                    }
                } else {
                    showToast(data.message || "Une erreur est survenue", "error");
                }
            })
            .catch(err => {
                console.error(err);
                showToast("Erreur de connexion réseau", "error");
            });
        });
    }
});

// SUPPRESSION AJAX
function deleteActivity(id) {
    if(!confirm('Voulez-vous vraiment supprimer cette activité ?')) return;

    fetch(`/admin/activites/delete/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            showToast("Activité supprimée avec succès !");
            const row = document.getElementById(`row-${id}`);
            if(row) row.remove();
            
            // Si l'activité en cours d'édition a été supprimée, on réinitialise le formulaire
            const currentEditId = document.getElementById('activity_id').value;
            if (currentEditId == id) {
                resetToCreateMode();
            }
        } else {
            showToast(data.message || "Impossible de supprimer l'activité", "error");
        }
    })
    .catch(err => {
        console.error(err);
        showToast("Erreur lors de la communication système", "error");
    });
}