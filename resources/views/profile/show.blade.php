@extends('layoutsapp.master')
@section('title', 'Mon Profil')

@section('styles')
<style>
    :root {
        --card-border: #e2e8f0;
        --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        --primary-color: #2563eb;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --success-color: #10b981;
        --danger-color: #ef4444;
    }

    .profile-container {
        padding: 32px 24px;
        position: relative;
        min-height: calc(100vh - 58px - 64px);
    }

    .profile-card {
        background: white;
        border: 1px solid var(--card-border);
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
    }

    .profile-header {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        padding: 48px 32px;
        text-align: center;
        position: relative;
    }

    .profile-avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 24px;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .profile-avatar-icon {
        font-size: 60px;
        color: var(--primary-color);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-edit-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 40px;
        height: 40px;
        background: white;
        border: 2px solid var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .avatar-edit-btn:hover {
        background: var(--primary-color);
        transform: scale(1.1);
    }

    .avatar-edit-btn:hover i {
        color: white;
    }

    .avatar-edit-btn i {
        color: var(--primary-color);
        font-size: 16px;
        transition: color 0.2s ease;
    }

    .profile-name {
        color: white;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .profile-email {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        margin: 0;
    }

    .profile-body {
        padding: 40px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
    }

    .section-title i {
        color: var(--primary-color);
    }

    .edit-mode-btn {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .edit-mode-btn:hover {
        background: var(--primary-color);
        color: white;
    }

    .edit-mode-btn.active {
        background: var(--primary-color);
        color: white;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 1px solid var(--card-border);
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.2s ease;
        width: 100%;
        background-color: #f8fafc;
    }

    .form-control:read-only {
        background-color: #f8fafc;
        cursor: not-allowed;
        color: var(--text-secondary);
    }

    .form-control:not(:read-only) {
        background-color: white;
    }

    .form-control:focus:not(:read-only) {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .form-control.is-invalid {
        border-color: var(--danger-color);
    }

    .invalid-feedback {
        display: block;
        color: var(--danger-color);
        font-size: 13px;
        margin-top: 6px;
    }

    .divider {
        height: 1px;
        background: var(--card-border);
        margin: 32px 0;
    }

    .btn-update {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px 32px;
        font-size: 15px;
        font-weight: 500;
        width: 100%;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-update:hover:not(:disabled) {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-update:active {
        transform: translateY(0);
    }

    .btn-update:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn-update.hidden {
        display: none;
    }

    .btn-cancel {
        background: #6b7280;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px 32px;
        font-size: 15px;
        font-weight: 500;
        width: 100%;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 12px;
    }

    .btn-cancel:hover {
        background: #4b5563;
    }

    .btn-cancel.hidden {
        display: none;
    }

    .alert-custom {
        border-radius: 8px;
        border: none;
        padding: 14px 16px;
        margin-bottom: 24px;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .password-strength {
        margin-top: 8px;
        height: 4px;
        border-radius: 2px;
        transition: all 0.3s ease;
        background: var(--card-border);
    }

    .strength-weak {
        background-color: var(--danger-color);
        width: 33%;
    }

    .strength-medium {
        background-color: #f59e0b;
        width: 66%;
    }

    .strength-strong {
        background-color: var(--success-color);
        width: 100%;
    }

    .password-section {
        display: none;
    }

    .password-section.show {
        display: block;
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 24px 16px;
        }

        .profile-header {
            padding: 32px 24px;
        }

        .profile-body {
            padding: 24px;
        }

        .profile-name {
            font-size: 24px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
        }

        .edit-mode-btn {
            position: static;
            transform: none;
            margin-top: 12px;
            width: 100%;
            justify-content: center;
        }

        .section-title {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar-container">
                <div class="profile-avatar" id="profileAvatarContainer">
                    <img id="profileImage" src="" alt="Photo de profil" style="display: none;">
                    <i class="fas fa-user profile-avatar-icon" id="profileIcon"></i>
                </div>
                <div class="avatar-edit-btn" title="Changer l'image de profil" onclick="document.getElementById('profileImageInput').click();">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <input type="file" id="profileImageInput" accept="image/*" style="display: none;">
            <h2 class="profile-name" id="profileName"></h2>
            <p class="profile-email" id="profileEmail"></p>
        </div>

        <div class="profile-body">
            <!-- Alertes -->
            <div id="alertContainer" style="display: none;">
                <div class="alert alert-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <span id="alertMessage"></span>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert"></button>
                </div>
            </div>

            <form id="profileForm">
                <h5 class="section-title">
                    <i class="fas fa-user-edit"></i>
                    <span>Informations personnelles</span>
                    <button type="button" class="edit-mode-btn" id="editInfoBtn">
                        <i class="fas fa-pencil-alt"></i>
                        <span>Modifier</span>
                    </button>
                </h5>

                <div class="form-group">
                    <label class="form-label" for="name">Nom complet</label>
                    <input type="text" id="name" name="name" class="form-control" required readonly>
                    <div class="invalid-feedback" id="nameError"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Adresse email</label>
                    <input type="email" id="email" name="email" class="form-control" required readonly>
                    <div class="invalid-feedback" id="emailError"></div>
                </div>

                <div class="divider"></div>

                <h5 class="section-title">
                    <i class="fas fa-lock"></i>
                    <span>Sécurité</span>
                    <button type="button" class="edit-mode-btn" id="editPasswordBtn">
                        <i class="fas fa-pencil-alt"></i>
                        <span>Modifier</span>
                    </button>
                </h5>

                <div class="password-section" id="passwordSection">
                    <div class="form-group">
                        <label class="form-label" for="current_password">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" class="form-control">
                        <div class="invalid-feedback" id="currentPasswordError"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new_password">Nouveau mot de passe</label>
                        <input type="password" id="new_password" name="new_password" class="form-control">
                        <div class="invalid-feedback" id="newPasswordError"></div>
                        <div class="password-strength" id="passwordStrength"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
                        <div class="invalid-feedback" id="newPasswordConfirmationError"></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-update hidden" id="updateButton">
                    <i class="fas fa-save"></i>
                    <span>Enregistrer les modifications</span>
                </button>

                <button type="button" class="btn btn-cancel hidden" id="cancelButton">
                    <i class="fas fa-times"></i>
                    <span>Annuler</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let isEditingInfo = false;
        let isEditingPassword = false;
        let originalData = {};

        const editInfoBtn = document.getElementById('editInfoBtn');
        const editPasswordBtn = document.getElementById('editPasswordBtn');
        const updateButton = document.getElementById('updateButton');
        const cancelButton = document.getElementById('cancelButton');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordSection = document.getElementById('passwordSection');

        // Fonction pour afficher les alertes
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alertMessage = document.getElementById('alertMessage');
            const alert = alertContainer.querySelector('.alert');

            alertMessage.textContent = message;
            alert.className = `alert alert-${type} alert-dismissible fade show alert-custom`;
            alertContainer.style.display = 'block';

            setTimeout(() => {
                alertContainer.style.display = 'none';
            }, 5000);
        }

        // Fonction pour afficher les erreurs de validation
        function showValidationErrors(errors) {
            // Réinitialiser tous les messages d'erreur
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));

            // Afficher les nouvelles erreurs
            Object.keys(errors).forEach(field => {
                const input = document.getElementById(field);
                const errorDiv = document.getElementById(field + 'Error');
                if (input && errorDiv) {
                    input.classList.add('is-invalid');
                    errorDiv.textContent = errors[field][0];
                }
            });
        }

        // Fonction pour activer le mode édition des infos
        function enableInfoEdit() {
            isEditingInfo = true;
            nameInput.removeAttribute('readonly');
            emailInput.removeAttribute('readonly');
            editInfoBtn.classList.add('active');
            editInfoBtn.innerHTML = '<i class="fas fa-times"></i><span>Annuler</span>';
            updateButton.classList.remove('hidden');
            cancelButton.classList.remove('hidden');

            // Sauvegarder les données originales
            originalData.name = nameInput.value;
            originalData.email = emailInput.value;
        }

        // Fonction pour désactiver le mode édition des infos
        function disableInfoEdit() {
            isEditingInfo = false;
            nameInput.setAttribute('readonly', true);
            emailInput.setAttribute('readonly', true);
            editInfoBtn.classList.remove('active');
            editInfoBtn.innerHTML = '<i class="fas fa-pencil-alt"></i><span>Modifier</span>';
            
            // Restaurer les données originales
            nameInput.value = originalData.name;
            emailInput.value = originalData.email;

            // Masquer les boutons si aucune section n'est en édition
            if (!isEditingPassword) {
                updateButton.classList.add('hidden');
                cancelButton.classList.add('hidden');
            }

            // Nettoyer les erreurs
            nameInput.classList.remove('is-invalid');
            emailInput.classList.remove('is-invalid');
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
        }

        // Fonction pour activer le mode édition du mot de passe
        function enablePasswordEdit() {
            isEditingPassword = true;
            passwordSection.classList.add('show');
            editPasswordBtn.classList.add('active');
            editPasswordBtn.innerHTML = '<i class="fas fa-times"></i><span>Annuler</span>';
            updateButton.classList.remove('hidden');
            cancelButton.classList.remove('hidden');
        }

        // Fonction pour désactiver le mode édition du mot de passe
        function disablePasswordEdit() {
            isEditingPassword = false;
            passwordSection.classList.remove('show');
            editPasswordBtn.classList.remove('active');
            editPasswordBtn.innerHTML = '<i class="fas fa-pencil-alt"></i><span>Modifier</span>';

            // Réinitialiser les champs de mot de passe
            document.getElementById('current_password').value = '';
            document.getElementById('new_password').value = '';
            document.getElementById('new_password_confirmation').value = '';

            // Masquer les boutons si aucune section n'est en édition
            if (!isEditingInfo) {
                updateButton.classList.add('hidden');
                cancelButton.classList.add('hidden');
            }

            // Nettoyer les erreurs
            document.querySelectorAll('#passwordSection .form-control').forEach(input => {
                input.classList.remove('is-invalid');
            });
            document.getElementById('currentPasswordError').textContent = '';
            document.getElementById('newPasswordError').textContent = '';
            document.getElementById('newPasswordConfirmationError').textContent = '';
        }

        // Gérer le clic sur le bouton d'édition des infos
        editInfoBtn.addEventListener('click', function() {
            if (isEditingInfo) {
                disableInfoEdit();
            } else {
                enableInfoEdit();
            }
        });

        // Gérer le clic sur le bouton d'édition du mot de passe
        editPasswordBtn.addEventListener('click', function() {
            if (isEditingPassword) {
                disablePasswordEdit();
            } else {
                enablePasswordEdit();
            }
        });

        // Gérer le clic sur le bouton annuler
        cancelButton.addEventListener('click', function() {
            if (isEditingInfo) {
                disableInfoEdit();
            }
            if (isEditingPassword) {
                disablePasswordEdit();
            }
        });

        // Indicateur de force du mot de passe
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrength');

            if (password.length === 0) {
                strengthBar.className = 'password-strength';
                return;
            }

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;

            strengthBar.className = 'password-strength';
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength === 3) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        });

        // Charger les données du profil
        function loadProfile() {
            fetch('/api/profile', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log(data.data.user);
                        const user = data.data.user;
                        document.getElementById('profileName').textContent = user.name;
                        document.getElementById('profileEmail').textContent = user.email;
                        nameInput.value = user.name;
                        emailInput.value = user.email;

                        // Sauvegarder les données originales
                        originalData.name = user.name;
                        originalData.email = user.email;

                        // Afficher l'image de profil si elle existe
                        const profileImage = document.getElementById('profileImage');
                        const profileIcon = document.getElementById('profileIcon');
                        
                        if (user.profil_image) {
                            // Construire le chemin complet de l'image avec cache-busting
                            const imagePath = `/storage/${user.profil_image}`;
                            const timestamp = new Date().getTime();
                            profileImage.src = `${imagePath}?t=${timestamp}`;
                            profileImage.style.display = 'block';
                            profileIcon.style.display = 'none';
                            
                            // Gérer les erreurs de chargement d'image
                            profileImage.onerror = function() {
                                console.error('Erreur de chargement de l\'image:', imagePath);
                                // Essayer sans cache-busting
                                this.src = imagePath;
                                this.onerror = function() {
                                    console.error('Image introuvable:', imagePath);
                                    this.style.display = 'none';
                                    profileIcon.style.display = 'block';
                                };
                            };
                            
                            // Vérifier que l'image se charge correctement
                            profileImage.onload = function() {
                                console.log('Image chargée avec succès:', imagePath);
                            };
                        } else {
                            profileImage.style.display = 'none';
                            profileIcon.style.display = 'block';
                        }
                    }
                })
                .catch(error => {
                    showAlert('Erreur lors du chargement du profil', 'danger');
                });
        }

        // Gérer l'upload d'image de profil
        document.getElementById('profileImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Vérifier le type de fichier
            if (!file.type.startsWith('image/')) {
                showAlert('Veuillez sélectionner une image valide', 'danger');
                return;
            }

            // Vérifier la taille du fichier (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                showAlert('L\'image ne doit pas dépasser 5MB', 'danger');
                return;
            }

            const formData = new FormData();
            formData.append('profil_image', file);

            // Afficher un indicateur de chargement
            const editBtn = document.querySelector('.avatar-edit-btn');
            const originalContent = editBtn.innerHTML;
            editBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            fetch('/api/profile/upload-image', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert('Image de profil mise à jour avec succès !', 'success');
                        
                        // Mettre à jour l'affichage de l'image
                        const profileImage = document.getElementById('profileImage');
                        const profileIcon = document.getElementById('profileIcon');
                        
                        const imagePath = `/storage/${data.data.profil_image}`;
                        const timestamp = new Date().getTime();
                        profileImage.src = `${imagePath}?t=${timestamp}`;
                        profileImage.style.display = 'block';
                        profileIcon.style.display = 'none';
                        
                        // Gérer les erreurs de chargement d'image
                        profileImage.onerror = function() {
                            console.error('Erreur de chargement de l\'image:', imagePath);
                            // Essayer sans cache-busting
                            this.src = imagePath;
                            this.onerror = function() {
                                console.error('Image introuvable:', imagePath);
                                this.style.display = 'none';
                                profileIcon.style.display = 'block';
                            };
                        };
                        
                        // Mettre à jour la navbar
                        updateNavbarProfileImage(data.data.profil_image);
                    } else {
                        showAlert(data.message || 'Erreur lors de l\'upload de l\'image', 'danger');
                    }
                })
                .catch(error => {
                    showAlert('Erreur lors de l\'upload de l\'image', 'danger');
                })
                .finally(() => {
                    editBtn.innerHTML = originalContent;
                    e.target.value = '';
                });
        });

        // Fonction pour mettre à jour la navbar
        function updateNavbarProfileImage(imagePath) {
            const navbarProfileImage = document.getElementById('navbarProfileImage');
            const navbarProfileIcon = document.getElementById('navbarProfileIcon');
            
            if (imagePath) {
                if (navbarProfileImage) {
                    navbarProfileImage.src = `/storage/${imagePath}`;
                    navbarProfileImage.style.display = 'block';
                }
                if (navbarProfileIcon) {
                    navbarProfileIcon.style.display = 'none';
                }
            }
        }

        // Gérer la soumission du formulaire
        document.getElementById('profileForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const button = updateButton;
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Mise à jour...</span>';
            button.disabled = true;

            const formData = {
                name: nameInput.value,
                email: emailInput.value,
                current_password: document.getElementById('current_password').value,
                new_password: document.getElementById('new_password').value,
                new_password_confirmation: document.getElementById('new_password_confirmation').value
            };

            fetch('/api/profile', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message, 'success');
                        
                        // Recharger le profil
                        loadProfile();
                        
                        // Désactiver les modes d'édition
                        if (isEditingInfo) {
                            disableInfoEdit();
                        }
                        if (isEditingPassword) {
                            disablePasswordEdit();
                        }
                    } else {
                        showAlert(data.message, 'danger');
                        if (data.errors) {
                            showValidationErrors(data.errors);
                        }
                    }
                })
                .catch(error => {
                    showAlert('Une erreur est survenue', 'danger');
                })
                .finally(() => {
                    button.innerHTML = originalContent;
                    button.disabled = false;
                });
        });

        // Charger le profil au chargement de la page
        loadProfile();
    });
</script>
@endsection