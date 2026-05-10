// ─── État global ──────────────────────────────────────────────────────────────
let currentStep = 1;

// ─── Éléments DOM ─────────────────────────────────────────────────────────────
const msgBox       = document.getElementById('msg-box');
const form         = document.getElementById('form-profil');
const sections     = document.querySelectorAll('.form-section');
const btnSubmit    = document.getElementById('btn-submit');
const successPanel = document.getElementById('success-panel');
const btnReset     = document.getElementById('btn-reset');

const inpTel       = document.getElementById('telephone');
const inpDateNaiss = document.getElementById('date_naissance');
const radObjectif  = document.querySelectorAll('input[name="id_objectif"]');
const inpDateObj   = document.getElementById('date_objectif');
const inpValeur    = document.getElementById('valeur');

const errTel       = document.getElementById('err-telephone');
const errDateNaiss = document.getElementById('err-date_naissance');
const errObjectif  = document.getElementById('err-id_objectif');
const errDateObj   = document.getElementById('err-date_objectif');
const errValeur    = document.getElementById('err-valeur');

// ─── Utilitaires ──────────────────────────────────────────────────────────────

function setFieldError(input, errEl, msg) {
    input.classList.add('error-field');
    errEl.textContent = msg;
    errEl.classList.add('visible');
}

function clearField(input, errEl) {
    input.classList.remove('error-field');
    errEl.textContent = '';
    errEl.classList.remove('visible');
}

function clearAllErrors() {
    [[inpTel, errTel], [inpDateNaiss, errDateNaiss], [inpDateObj, errDateObj], [inpValeur, errValeur]]
        .forEach(([inp, err]) => clearField(inp, err));
    radObjectif.forEach(r => r.classList.remove('error-field'));
    errObjectif.textContent = '';
    errObjectif.classList.remove('visible');
    msgBox.className = 'msg-box';
    msgBox.innerHTML = '';
}

function showMsg(type, content) {
    msgBox.className = `msg-box ${type}`;
    if (Array.isArray(content)) {
        msgBox.innerHTML = '<ul>' + content.map(e => `<li>${e}</li>`).join('') + '</ul>';
    } else {
        msgBox.textContent = content;
    }
}

function setLoading(on) {
    btnSubmit.disabled = on;
    btnSubmit.classList.toggle('loading', on);
}

function getSelectedObjectif() {
    for (let r of radObjectif) if (r.checked) return r.value;
    return '';
}

function showStep(step) {
    currentStep = step;
    sections.forEach((sec, idx) => {
        sec.style.display = (idx + 1 === step) ? 'block' : 'none';
    });
    const header = document.querySelector('.login-header');
    if (step === 1) {
        header.querySelector('h1').textContent = 'Compléter votre profil';
        header.querySelector('p').textContent  = 'Remplissez vos informations personnelles';
        btnSubmit.innerHTML = '<span class="btn-text">Continuer</span><svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg><span class="btn-loader"><span class="spinner"></span></span>';
    } else {
        header.querySelector('h1').textContent = 'Votre objectif';
        header.querySelector('p').textContent  = 'Définissez votre objectif et sa valeur cible';
        btnSubmit.innerHTML = '<span class="btn-text">Enregistrer</span><svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span class="btn-loader"><span class="spinner"></span></span>';
    }
}

// ─── Validation ───────────────────────────────────────────────────────────────

function validateStep1() {
    let valid = true;
    const tel = inpTel.value.trim();
    if (!tel) {
        setFieldError(inpTel, errTel, "Le téléphone est requis.");
        valid = false;
    } else if (!/^\+?[0-9]{7,15}$/.test(tel)) {
        setFieldError(inpTel, errTel, "Format invalide (ex: 0321234567).");
        valid = false;
    } else {
        clearField(inpTel, errTel);
    }

    const dn = inpDateNaiss.value;
    if (!dn) {
        setFieldError(inpDateNaiss, errDateNaiss, "La date de naissance est requise.");
        valid = false;
    } else if (new Date(dn) > new Date()) {
        setFieldError(inpDateNaiss, errDateNaiss, "La date ne peut pas être dans le futur.");
        valid = false;
    } else {
        clearField(inpDateNaiss, errDateNaiss);
    }
    return valid;
}

function validateStep2() {
    let valid = true;
    const obj = getSelectedObjectif();
    if (!obj) {
        errObjectif.textContent = "Veuillez sélectionner un objectif.";
        errObjectif.classList.add('visible');
        radObjectif.forEach(r => r.classList.add('error-field'));
        valid = false;
    } else {
        errObjectif.textContent = '';
        errObjectif.classList.remove('visible');
        radObjectif.forEach(r => r.classList.remove('error-field'));
    }

    const dob = inpDateObj.value;
    if (!dob) {
        setFieldError(inpDateObj, errDateObj, "La date cible est requise.");
        valid = false;
    } else {
        clearField(inpDateObj, errDateObj);
    }

    const val = inpValeur.value.trim();
    if (val === '' || isNaN(val)) {
        setFieldError(inpValeur, errValeur, "Veuillez entrer une valeur valide.");
        valid = false;
    } else {
        clearField(inpValeur, errValeur);
    }
    return valid;
}

// ─── Submit ───────────────────────────────────────────────────────────────────

btnSubmit.addEventListener('click', async (e) => {
    e.preventDefault();
    if (btnSubmit.disabled) return;
    clearAllErrors();

    if (currentStep === 1) {
        if (!validateStep1()) return;
        setLoading(true);
        try {
            const fd = new FormData();
            fd.append('telephone', inpTel.value.trim());
            fd.append('date_naissance', inpDateNaiss.value);

            const response = await fetch(`${BASE_URL}/profil/step1`, {
                method: 'POST',
                body: fd,
                credentials: 'include'
            });

            if (!response.ok) throw new Error('Erreur HTTP : ' + response.status);
            const result = await response.json();

            if (result.success) {
                showMsg('success', 'Profil enregistré avec succès.');
                setTimeout(() => { clearAllErrors(); showStep(2); }, 500);
            } else {
                showMsg('error', result.message || 'Erreur lors de l\'enregistrement.');
            }
        } catch (error) {
            showMsg('error', error.message);
        } finally {
            setLoading(false);
        }

    } else if (currentStep === 2) {
        if (!validateStep2()) return;
        setLoading(true);
        try {
            const fd = new FormData();
            fd.append('id_objectif', getSelectedObjectif());
            fd.append('date_objectif', inpDateObj.value);
            fd.append('valeur', inpValeur.value.trim());

            const response = await fetch(`${BASE_URL}/profil/step2`, {
                method: 'POST',
                body: fd,
                credentials: 'include'
            });

            if (!response.ok) throw new Error('Erreur HTTP : ' + response.status);
            const result = await response.json();

            if (result.success) {
                form.style.display = 'none';
                successPanel.classList.add('active');
            } else {
                showMsg('error', result.message || 'Erreur lors de l\'enregistrement.');
            }
        } catch (error) {
            showMsg('error', error.message);
        } finally {
            setLoading(false);
        }
    }
});

// ─── Reset ────────────────────────────────────────────────────────────────────

btnReset.addEventListener('click', () => {
    form.reset();
    form.style.display = 'block';
    clearAllErrors();
    successPanel.classList.remove('active');
    showStep(1);
});

// ─── Validation live ──────────────────────────────────────────────────────────

inpTel.addEventListener('blur', () => {
    const v = inpTel.value.trim();
    if (v && !/^\+?[0-9]{7,15}$/.test(v)) setFieldError(inpTel, errTel, "Format invalide (ex: 0321234567).");
    else if (v) clearField(inpTel, errTel);
});

inpDateNaiss.addEventListener('blur', () => {
    const v = inpDateNaiss.value;
    if (v && new Date(v) > new Date()) setFieldError(inpDateNaiss, errDateNaiss, "La date ne peut pas être dans le futur.");
    else if (v) clearField(inpDateNaiss, errDateNaiss);
});

inpDateObj.addEventListener('blur', () => { if (inpDateObj.value) clearField(inpDateObj, errDateObj); });

inpValeur.addEventListener('blur', () => {
    const v = inpValeur.value.trim();
    if (v && isNaN(v)) setFieldError(inpValeur, errValeur, "Veuillez entrer une valeur valide.");
    else if (v) clearField(inpValeur, errValeur);
});

[inpTel, inpDateNaiss, inpDateObj, inpValeur].forEach(inp => {
    inp.addEventListener('keydown', e => { if (e.key === 'Enter') { e.preventDefault(); btnSubmit.click(); } });
});

// ─── Init ─────────────────────────────────────────────────────────────────────

window.addEventListener('load', () => { showStep(1); });