// --- CONTRÔLE DE L'ÉTAT DU FORMULAIRE ---

// 1. Passer le formulaire en mode ÉDITION
function setupEditModeCode(id, code, idUser, statut, dateTrack) {
    // Modifier les textes
    document.getElementById('code-form-title').innerText = "Modifier le code";
    document.getElementById('code-form-subtitle').innerText = `Modification du code #${id}`;
    document.getElementById('code-btn-submit').innerText = "Enregistrer les modifications";
    
    // Afficher le bouton d'annulation
    document.getElementById('code-btn-cancel').style.display = 'block';

    // Remplir les champs
    document.getElementById('code_id').value = id;
    document.getElementById('code').value = code;
    document.getElementById('id_user').value = idUser;
    document.getElementById('statut').value = statut;
    document.getElementById('date_track').value = dateTrack;

    // Focus sur le premier champ pour plus de confort
    document.getElementById('code').focus();
}

// 2. Repasser le formulaire en mode CRÉATION (Remise à zéro)
function resetToCreateModeCode() {
    document.getElementById('code-form-ajax').reset();
    document.getElementById('code_id').value = '';
    
    document.getElementById('code-form-title').innerText = "Créer un code";
    document.getElementById('code-form-subtitle').innerText = "Remplissez les champs pour ajouter un nouveau code.";
    document.getElementById('code-btn-submit').innerText = "Valider et Créer le Code";
    
    document.getElementById('code-btn-cancel').style.display = 'none';
}

// Notifications Toast
function showToastCode(message, type = 'success') {
    const toast = document.getElementById('toast-code');
    if (!toast) return;
    toast.className = `toast-notification toast-${type}`;
    toast.innerText = message;
    toast.style.display = 'block';
    setTimeout(() => { toast.style.display = 'none'; }, 3000);
}

// --- CHARGEMENT DES UTILISATEURS ---
// document.addEventListener('DOMContentLoaded', function() {
    
//     // Charger les utilisateurs pour le select
//     fetch('/admin/codes', {
//         method: 'GET',
//         headers: { 'X-Requested-With': 'XMLHttpRequest' }
//     })
//     .then(res => res.json())
//     .then(data => {
//         if(data.success) {
//             const userSelect = document.getElementById('id_user');
//             data.users.forEach(user => {
//                 const option = document.createElement('option');
//                 option.value = user.id;
//                 option.textContent = `${user.nom} ${user.prenom} (${user.email})`;
//                 userSelect.appendChild(option);
//             });
//         }
//     })
//     .catch(err => console.error('Erreur lors du chargement des utilisateurs:', err));
// });

// --- GESTION DES APPELS AJAX (Fetch API) ---

document.addEventListener('DOMContentLoaded', function() {
    const codeForm = document.getElementById('code-form-ajax');
    if (codeForm) {
        codeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('code_id').value;
            const isEditMode = id !== ""; // Si un ID existe, on modifie, sinon on crée
            
            // URL cible dynamique selon l'état
            const url = isEditMode ? '/admin/codes/update' : '/admin/codes/create';
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
                        showToastCode("Code mis à jour !");
                        const row = document.getElementById(`code-row-${id}`);
                        if (row) {
                            row.querySelector('.cell-code').innerText = data.code.code;
                            row.querySelector('.cell-user').innerText = data.code.id_user;
                            row.querySelector('.cell-statut').innerText = data.code.statut;
                            row.querySelector('.cell-date').innerText = data.code.date_track;
                            
                            // Met à jour le bouton d'édition de la ligne
                            const btnEdit = row.querySelector('.btn-edit');
                            btnEdit.setAttribute('onclick', `setupEditModeCode(${id}, '${data.code.code}', ${data.code.id_user}, '${data.code.statut}', '${data.code.date_track}')`);
                        }
                        resetToCreateModeCode(); // On repasse en mode création après enregistrement
                    } else {
                        // --- MODE CRÉATION ---
                        showToastCode("Nouveau code ajouté !");
                        const tbody = document.getElementById('codes-table-body');
                        
                        const newRow = `
                            <tr id="code-row-${data.code.id}">
                                <td><strong>${data.code.id}</strong></td>
                                <td class="cell-code">${data.code.code}</td>
                                <td class="cell-user">${data.code.id_user}</td>
                                <td class="cell-statut">${data.code.statut}</td>
                                <td class="cell-date">${data.code.date_track}</td>
                                <td>
                                    <button class="btn-edit" onclick="setupEditModeCode(${data.code.id}, '${data.code.code}', ${data.code.id_user}, '${data.code.statut}', '${data.code.date_track}')">Modifier</button>
                                    <button class="btn-delete" onclick="deleteCode(${data.code.id})">Supprimer</button>
                                </td>
                                <td>
                                    ${data.code.statut === 'en attente' ? `<button class="btn-edit" onclick="validateCode(${data.code.id})">Valider</button>
                                    <button class="btn-delete" onclick="refuseCode(${data.code.id})">Refuser</button>` : ''}
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', newRow);
                        resetToCreateModeCode(); // Vide le formulaire
                    }
                } else {
                    showToastCode(data.message || "Une erreur est survenue", "error");
                }
            })
            .catch(err => {
                console.error(err);
                showToastCode("Erreur de connexion réseau", "error");
            });
        });
    }
});

// SUPPRESSION AJAX
function deleteCode(id) {
    if(!confirm('Voulez-vous vraiment supprimer ce code ?')) return;

    fetch(`/admin/codes/delete/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            showToastCode("Code supprimé avec succès !");
            const row = document.getElementById(`code-row-${id}`);
            if(row) row.remove();
            
            // Si le code en cours d'édition a été supprimé, on réinitialise le formulaire
            const currentEditId = document.getElementById('code_id').value;
            if (currentEditId == id) {
                resetToCreateModeCode();
            }
        } else {
            showToastCode(data.message || "Impossible de supprimer le code", "error");
        }
    })
    .catch(err => {
        console.error(err);
        showToastCode("Erreur lors de la communication système", "error");
    });
}

function validateCode(id) {

    fetch(`/admin/codes/validate/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            showToastCode("Code valide avec succès !");
            const row = document.getElementById(`code-row-${id}`);
            if(row) row.remove();
            
            // Si le code en cours d'édition a été supprimé, on réinitialise le formulaire
            const currentEditId = document.getElementById('code_id').value;
            if (currentEditId == id) {
                resetToCreateModeCode();
            }
        } else {
            showToastCode(data.message || "Impossible de valider le code", "error");
        }
    })
    .catch(err => {
        console.error(err);
        showToastCode("Erreur lors de la communication système", "error");
    });
}

function refuseCode(id) {

    fetch(`/admin/codes/refuse/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            showToastCode("Code refuse avec succès !");
            const row = document.getElementById(`code-row-${id}`);
            if(row) row.remove();
            
            // Si le code en cours d'édition a été supprimé, on réinitialise le formulaire
            const currentEditId = document.getElementById('code_id').value;
            if (currentEditId == id) {
                resetToCreateModeCode();
            }
        } else {
            showToastCode(data.message || "Impossible de refuser le code", "error");
        }
    })
    .catch(err => {
        console.error(err);
        showToastCode("Erreur lors de la communication système", "error");
    });
}
