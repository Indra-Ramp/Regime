// --- CONTRÔLE DE L'ÉTAT DU FORMULAIRE ---

// 1. Passer le formulaire en mode ÉDITION
function setupEditModeRegime(id, percViande, percPoisson, percVolaille, variationPoids, duree, price) {
    // Modifier les textes
    document.getElementById('regime-form-title').innerText = "Modifier le régime";
    document.getElementById('regime-form-subtitle').innerText = `Modification du régime #${id}`;
    document.getElementById('regime-btn-submit').innerText = "Enregistrer les modifications";
    
    // Afficher le bouton d'annulation
    document.getElementById('regime-btn-cancel').style.display = 'block';

    // Remplir les champs
    document.getElementById('regime_id').value = id;
    document.getElementById('perc_viande').value = percViande;
    document.getElementById('perc_poisson').value = percPoisson;
    document.getElementById('perc_volaille').value = percVolaille;
    document.getElementById('variation_poids').value = variationPoids;
    document.getElementById('duree').value = duree;
    document.getElementById('price').value = price;

    // Focus sur le premier champ pour plus de confort
    document.getElementById('perc_viande').focus();
}

// 2. Repasser le formulaire en mode CRÉATION (Remise à zéro)
function resetToCreateModeRegime() {
    document.getElementById('regime-form-ajax').reset();
    document.getElementById('regime_id').value = '';
    
    document.getElementById('regime-form-title').innerText = "Créer un régime";
    document.getElementById('regime-form-subtitle').innerText = "Remplissez les champs pour ajouter un nouveau régime.";
    document.getElementById('regime-btn-submit').innerText = "Valider et Créer le Régime";
    
    document.getElementById('regime-btn-cancel').style.display = 'none';
}

// Notifications Toast
function showToastRegime(message, type = 'success') {
    const toast = document.getElementById('toast-regime');
    if (!toast) return;
    toast.className = `toast-notification toast-${type}`;
    toast.innerText = message;
    toast.style.display = 'block';
    setTimeout(() => { toast.style.display = 'none'; }, 3000);
}

// --- GESTION DES APPELS AJAX (Fetch API) ---

document.addEventListener('DOMContentLoaded', function() {
    const regimeForm = document.getElementById('regime-form-ajax');
    if (regimeForm) {
        regimeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('regime_id').value;
            const isEditMode = id !== ""; // Si un ID existe, on modifie, sinon on crée
            
            // URL cible dynamique selon l'état
            const url = isEditMode ? '/admin/regimes/updated-regime' : '/admin/create-regime';
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
                        showToastRegime("Régime mis à jour !");
                        const row = document.getElementById(`regime-row-${id}`);
                        if (row) {
                            row.querySelector('.cell-viande').innerText = `${data.regime.perc_viande}%`;
                            row.querySelector('.cell-poisson').innerText = `${data.regime.perc_poisson}%`;
                            row.querySelector('.cell-volaille').innerText = `${data.regime.perc_volaille}%`;
                            row.querySelector('.cell-variation').innerText = `${data.regime.variation_poids} kg`;
                            row.querySelector('.cell-duree').innerText = `${data.regime.duree}`;
                            row.querySelector('.cell-price').innerText = `${data.regime.price} €`;
                            
                            // Met à jour le bouton d'édition de la ligne
                            const btnEdit = row.querySelector('.btn-edit');
                            btnEdit.setAttribute('onclick', `setupEditModeRegime(${id}, ${data.regime.perc_viande}, ${data.regime.perc_poisson}, ${data.regime.perc_volaille}, ${data.regime.variation_poids}, ${data.regime.duree}, ${data.regime.price})`);
                        }
                        resetToCreateModeRegime(); // On repasse en mode création après enregistrement
                    } else {
                        // --- MODE CRÉATION ---
                        showToastRegime("Nouveau régime ajouté !");
                        const tbody = document.getElementById('regimes-table-body');
                        
                        const newRow = `
                            <tr id="regime-row-${data.regime.id}">
                                <td><strong>${data.regime.id}</strong></td>
                                <td class="cell-viande">${data.regime.perc_viande}%</td>
                                <td class="cell-poisson">${data.regime.perc_poisson}%</td>
                                <td class="cell-volaille">${data.regime.perc_volaille}%</td>
                                <td class="cell-variation">${data.regime.variation_poids} kg</td>
                                <td class="cell-duree">${data.regime.duree}</td>
                                <td class="cell-price">${data.regime.price} €</td>
                                <td>
                                    <button class="btn-edit" onclick="setupEditModeRegime(${data.regime.id}, ${data.regime.perc_viande}, ${data.regime.perc_poisson}, ${data.regime.perc_volaille}, ${data.regime.variation_poids}, ${data.regime.duree}, ${data.regime.price})">Modifier</button>
                                    <button class="btn-delete" onclick="deleteRegime(${data.regime.id})">Supprimer</button>
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', newRow);
                        resetToCreateModeRegime(); // Vide le formulaire
                    }
                } else if(data.error) {
                    showToastRegime(data.error, "error");
                } else {
                    showToastRegime(data.message || "Une erreur est survenue", "error");
                }
            })
            .catch(err => {
                console.error(err);
                showToastRegime("Erreur de connexion réseau", "error");
            });
        });
    }
});

// SUPPRESSION AJAX
function deleteRegime(id) {
    if(!confirm('Voulez-vous vraiment supprimer ce régime ?')) return;

    fetch(`/admin/regimes/delete/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            showToastRegime("Régime supprimé avec succès !");
            const row = document.getElementById(`regime-row-${id}`);
            if(row) row.remove();
            
            // Si le régime en cours d'édition a été supprimé, on réinitialise le formulaire
            const currentEditId = document.getElementById('regime_id').value;
            if (currentEditId == id) {
                resetToCreateModeRegime();
            }
        } else if(data.error) {
            showToastRegime(data.error, "error");
        } else {
            showToastRegime(data.message || "Impossible de supprimer le régime", "error");
        }
    })
    .catch(err => {
        console.error(err);
        showToastRegime("Erreur lors de la communication système", "error");
    });
}
