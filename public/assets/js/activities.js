function toggleForm(mode, data = null) {
    const zone = document.getElementById('form-zone');
    const title = document.getElementById('form-title');
    const form = document.getElementById('activity-form');
    
    // Reset du formulaire
    form.reset();
    document.getElementById('input-id').value = "";
    
    if (mode == 'add') {
        title.innerText = "Nouvelle Activité";
        form.action = "/admin/create-activity"; // Ton URL d'insertion
    } else {
        title.innerText = "Modifier l'activité #" + data.id;
        form.action = "/admin/activites/update_process"; // Ton URL de mise à jour
        
        // Remplissage des champs
        document.getElementById('input-id').value = data.id;
        document.getElementById('input-label').value = data.label;
        document.getElementById('input-variation').value = data.variation_poids;
        document.getElementById('input-frequence').value = data.frequence;
    }

    const xhr = new XMLHttpRequest();

    form.addEventListener('submit', function(event){
        event.preventDefault();
        const formData = new FormData(form);
        xhr.onreadystatechange = function(e) {
            if(xhr.status == 200){
                if(xhr.readyState == 4){
                    const response = JSON.parse(xhr.responseText);
                    if(response['errors']){
                        const error = document.getElementById('error');
                        error.innerText = response['errors'];
                    }
                }
            }
        }
        xhr.open('POST', form.action);
        xhr.send(formData);
    });
    
    zone.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function closeForm() {
    document.getElementById('form-zone').style.display = 'none';
}