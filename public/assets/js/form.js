/**
 * form.js — Formulaire multi-étapes
 * Étape 1 → table profil     (id_user, telephone, date_naissance)
 * Étape 2 → table objectif_user (id_user, id_objectif, date_objectif, valeur)
 *
 * Chaque étape envoie une requête AJAX vers le handler PHP correspondant.
 * Handler attendu : save_form.php  (POST: step, + champs de l'étape)
 */

const HANDLER_URL = 'profil/form.php';

// ─── État global ───────────────────────────────────────────────────────────────
let idUserGlobal = null; // mémorisé après l'étape 1 pour l'étape 2

// ─── Éléments DOM ─────────────────────────────────────────────────────────────

// Communs
const msgBox     = document.getElementById('msg-box');
const stepTitle  = document.getElementById('step-title');
const stepSub    = document.getElementById('step-subtitle');
const dot1       = document.getElementById('dot-1');
const dot2       = document.getElementById('dot-2');
const stepLine   = document.getElementById('step-line');

// Panels
const panel1     = document.getElementById('panel-1');
const panel2     = document.getElementById('panel-2');
const panelOk    = document.getElementById('panel-success');

// Étape 1
const inpIdUser   = document.getElementById('id_user');
const inpTel      = document.getElementById('telephone');
const inpDateNaiss= document.getElementById('date_naissance');
const errIdUser   = document.getElementById('err-id_user');
const errTel      = document.getElementById('err-telephone');
const errDateNaiss= document.getElementById('err-date_naissance');
const btnStep1    = document.getElementById('btn-step1');

// Étape 2
const selObjectif = document.getElementById('id_objectif');
const inpDateObj  = document.getElementById('date_objectif');
const inpValeur   = document.getElementById('valeur');
const errObjectif = document.getElementById('err-id_objectif');
const errDateObj  = document.getElementById('err-date_objectif');
const errValeur   = document.getElementById('err-valeur');
const btnStep2    = document.getElementById('btn-step2');
const btnBack     = document.getElementById('btn-back');

// Succès
const btnReset    = document.getElementById('btn-reset');

// ─── Utilitaires ──────────────────────────────────────────────────────────────

function showPanel(id) {
    [panel1, panel2, panelOk].forEach(p => p.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}

function updateStepper(step) {
    if (step === 1) {
        dot1.classList.add('active');    dot1.classList.remove('done');
        dot2.classList.remove('active','done');
        stepLine.classList.remove('done');
        stepTitle.textContent = 'Créer un profil';
        stepSub.textContent   = 'Étape 1 sur 2 — Informations personnelles';
    } else if (step === 2) {
        dot1.classList.remove('active'); dot1.classList.add('done');
        dot2.classList.add('active');    dot2.classList.remove('done');
        stepLine.classList.add('done');
        stepTitle.textContent = 'Votre objectif';
        stepSub.textContent   = 'Étape 2 sur 2 — Objectif & valeur cible';
    } else {
        // Succès : tout coché
        dot1.classList.remove('active'); dot1.classList.add('done');
        dot2.classList.remove('active'); dot2.classList.add('done');
        stepLine.classList.add('done');
        stepTitle.textContent = 'Inscription terminée';
        stepSub.textContent   = 'Toutes les données sont enregistrées';
    }
}

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

function clearMsg() {
    msgBox.className = 'msg-box';
    msgBox.innerHTML = '';
}

function showMsg(type, content) {
    msgBox.className = `msg-box ${type}`;
    msgBox.innerHTML = Array.isArray(content)
        ? '<ul>' + content.map(e => `<li>${e}</li>`).join('') + '</ul>'
        : content;
}

function setLoading(btn, on) {
    btn.disabled = on;
    btn.classList.toggle('loading', on);
}

// ─── Validation étape 1 ────────────────────────────────────────────────────────

function validateStep1() {
    let ok = true;

    const id  = inpIdUser.value.trim();
    const tel = inpTel.value.trim();
    const dn  = inpDateNaiss.value;

    if (!id || isNaN(id) || Number(id) <= 0) {
        setFieldError(inpIdUser, errIdUser, "L'ID utilisateur doit être un entier positif."); ok = false;
    } else { clearField(inpIdUser, errIdUser); }

    if (!tel) {
        setFieldError(inpTel, errTel, "Le téléphone est requis."); ok = false;
    } else if (!/^\+?[0-9]{7,15}$/.test(tel)) {
        setFieldError(inpTel, errTel, "Format invalide (ex: 0321234567)."); ok = false;
    } else { clearField(inpTel, errTel); }

    if (!dn) {
        setFieldError(inpDateNaiss, errDateNaiss, "La date de naissance est requise."); ok = false;
    } else if (new Date(dn) > new Date()) {
        setFieldError(inpDateNaiss, errDateNaiss, "La date ne peut pas être dans le futur."); ok = false;
    } else { clearField(inpDateNaiss, errDateNaiss); }

    return ok;
}

// ─── Validation étape 2 ────────────────────────────────────────────────────────

function validateStep2() {
    let ok = true;

    const obj = selObjectif.value;
    const dob = inpDateObj.value;
    const val = inpValeur.value.trim();

    if (!obj) {
        setFieldError(selObjectif, errObjectif, "Veuillez sélectionner un objectif."); ok = false;
    } else { clearField(selObjectif, errObjectif); }

    if (!dob) {
        setFieldError(inpDateObj, errDateObj, "La date cible est requise."); ok = false;
    } else { clearField(inpDateObj, errDateObj); }

    if (val === '' || isNaN(val) || Number(val) < 0) {
        setFieldError(inpValeur, errValeur, "La valeur doit être un entier positif."); ok = false;
    } else { clearField(inpValeur, errValeur); }

    return ok;
}

// ─── Envoi AJAX ───────────────────────────────────────────────────────────────

async function postStep(fields) {
    const fd = new FormData();
    for (const [k, v] of Object.entries(fields)) fd.append(k, v);
    const res = await fetch(HANDLER_URL, { method: 'POST', body: fd });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    return res.json();
}

// ─── Handlers ─────────────────────────────────────────────────────────────────

btnStep1.addEventListener('click', async () => {
    clearMsg();
    if (!validateStep1()) return;

    setLoading(btnStep1, true);
    try {
        const data = await postStep({
            step:           1,
            id_user:        inpIdUser.value.trim(),
            telephone:      inpTel.value.trim(),
            date_naissance: inpDateNaiss.value,
        });

        if (data.success) {
            idUserGlobal = inpIdUser.value.trim();
            showMsg('success-msg', data.message ?? 'Profil enregistré !');
            setTimeout(() => {
                clearMsg();
                updateStepper(2);
                showPanel('panel-2');
            }, 700);
        } else {
            showMsg('error', data.errors ?? [data.message ?? 'Erreur serveur.']);
        }
    } catch (e) {
        showMsg('error', 'Impossible de contacter le serveur.');
        console.error(e);
    } finally {
        setLoading(btnStep1, false);
    }
});

btnBack.addEventListener('click', () => {
    clearMsg();
    updateStepper(1);
    showPanel('panel-1');
});

btnStep2.addEventListener('click', async () => {
    clearMsg();
    if (!validateStep2()) return;

    setLoading(btnStep2, true);
    try {
        const data = await postStep({
            step:          2,
            id_user:       idUserGlobal,
            id_objectif:   selObjectif.value,
            date_objectif: inpDateObj.value,
            valeur:        inpValeur.value.trim(),
        });

        if (data.success) {
            updateStepper(3);
            showPanel('panel-success');
        } else {
            showMsg('error', data.errors ?? [data.message ?? 'Erreur serveur.']);
        }
    } catch (e) {
        showMsg('error', 'Impossible de contacter le serveur.');
        console.error(e);
    } finally {
        setLoading(btnStep2, false);
    }
});

btnReset.addEventListener('click', () => {
    // Reset formulaire complet
    [inpIdUser, inpTel, inpDateNaiss, inpDateObj, inpValeur].forEach(el => el.value = '');
    if (selObjectif) selObjectif.value = '';
    [inpIdUser, inpTel, inpDateNaiss, selObjectif, inpDateObj, inpValeur]
        .forEach((el, i) => {
            el.classList.remove('error-field');
            const errs = [errIdUser, errTel, errDateNaiss, errObjectif, errDateObj, errValeur];
            errs[i].textContent = '';
            errs[i].classList.remove('visible');
        });
    clearMsg();
    idUserGlobal = null;
    updateStepper(1);
    showPanel('panel-1');
});

// ─── Validation live au blur ───────────────────────────────────────────────────

inpIdUser.addEventListener('blur', () => {
    const v = inpIdUser.value.trim();
    if (v && (isNaN(v) || Number(v) <= 0))
        setFieldError(inpIdUser, errIdUser, "L'ID utilisateur doit être un entier positif.");
    else if (v) clearField(inpIdUser, errIdUser);
});

inpTel.addEventListener('blur', () => {
    const v = inpTel.value.trim();
    if (v && !/^\+?[0-9]{7,15}$/.test(v))
        setFieldError(inpTel, errTel, "Format invalide (ex: 0321234567).");
    else if (v) clearField(inpTel, errTel);
});

inpDateNaiss.addEventListener('blur', () => {
    const v = inpDateNaiss.value;
    if (v && new Date(v) > new Date())
        setFieldError(inpDateNaiss, errDateNaiss, "La date ne peut pas être dans le futur.");
    else if (v) clearField(inpDateNaiss, errDateNaiss);
});

inpValeur.addEventListener('blur', () => {
    const v = inpValeur.value.trim();
    if (v && (isNaN(v) || Number(v) < 0))
        setFieldError(inpValeur, errValeur, "La valeur doit être un entier positif.");
    else if (v) clearField(inpValeur, errValeur);
});

// Touche Entrée
[inpIdUser, inpTel, inpDateNaiss].forEach(el =>
    el.addEventListener('keydown', e => { if (e.key === 'Enter') btnStep1.click(); })
);
[selObjectif, inpDateObj, inpValeur].forEach(el =>
    el.addEventListener('keydown', e => { if (e.key === 'Enter') btnStep2.click(); })
);