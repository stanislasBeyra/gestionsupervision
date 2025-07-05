@extends('layoutsapp.master')

@section('content')
    <style>
        .profile-container {
            /* margin-top: 80px; */
            margin-bottom: 50px;
        }

        .profile-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            padding: 40px 20px;
            text-align: center;
            position: relative;
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2ecc71, #f39c12, #e74c3c);
        }

        .profile-icon-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            transition: transform 0.3s ease;
        }

        .profile-icon-container:hover {
            transform: scale(1.05);
        }

        .profile-icon {
            font-size: 60px;
            color: #2c3e50;
        }

        .profile-name {
            color: #fff;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-email {
            color: #ecf0f1;
            font-size: 16px;
            opacity: 0.9;
        }

        .profile-body {
            padding: 40px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 25px;
            position: relative;
            padding-left: 15px;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background-color: #3498db;
            border-radius: 2px;
        }

        .form-outline {
            margin-bottom: 25px;
        }

        .form-outline input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 35px 0;
        }

        .btn-update {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 14px 30px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-update:hover {
            background-color: #34495e;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
        }

        .btn-update:active {
            transform: translateY(0);
        }

        .alert-custom {
            border-radius: 8px;
            border: none;
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

        .stats-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-item {
            text-align: center;
            color: #fff;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 600;
            display: block;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.8;
        }

        .password-strength {
            margin-top: 5px;
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background-color: #e74c3c;
            width: 33%;
        }

        .strength-medium {
            background-color: #f39c12;
            width: 66%;
        }

        .strength-strong {
            background-color: #27ae60;
            width: 100%;
        }

        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: #3498db;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-icon:hover {
            background-color: #2980b9;
            transform: scale(1.1);
        }
    </style>

    <div class="container-fluid profile-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card profile-card">
                    <div class="profile-header">
                        <div class="profile-icon-container">
                            <div id="profileImageContainer">
                                <img id="profileImage" src="" alt="Photo de profil" style="width: 100%; height: 100%; object-fit: cover; border-radius: 100%; display: none;">
                                <i class="fas fa-user profile-icon" id="profileIcon"></i>
                            </div>
                            <div class="edit-icon" title="Changer l'image de profil" onclick="document.getElementById('profileImageInput').click();">
                                <i class="fas fa-camera fa-sm"></i>
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
                                <i class="fas fa-user-edit me-2"></i>Informations personnelles
                            </h5>

                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" id="name" name="name" class="form-control" required>
                                <label class="form-label" for="name">Nom complet</label>
                                <div class="invalid-feedback" id="nameError"></div>
                            </div>

                            <div class="form-outline" data-mdb-input-init>
                                <input type="email" id="email" name="email" class="form-control" required>
                                <label class="form-label" for="email">Adresse email</label>
                                <div class="invalid-feedback" id="emailError"></div>
                            </div>

                            <div class="divider"></div>

                            <h5 class="section-title">
                                <i class="fas fa-lock me-2"></i>Sécurité
                            </h5>

                            <div class="form-outline" data-mdb-input-init>
                                <input type="password" id="current_password" name="current_password" class="form-control">
                                <label class="form-label" for="current_password">Mot de passe actuel</label>
                                <div class="invalid-feedback" id="currentPasswordError"></div>
                            </div>

                            <div class="form-outline" data-mdb-input-init>
                                <input type="password" id="new_password" name="new_password" class="form-control">
                                <label class="form-label" for="new_password">Nouveau mot de passe</label>
                                <div class="invalid-feedback" id="newPasswordError"></div>
                                <div class="password-strength" id="passwordStrength"></div>
                            </div>

                            <div class="form-outline" data-mdb-input-init>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="form-control">
                                <label class="form-label" for="new_password_confirmation">Confirmer le nouveau mot de
                                    passe</label>
                            </div>

                            <button type="submit" class="btn btn-update btn-lg w-100 mt-4" id="updateButton">
                                <i class="fas fa-save me-2"></i>Mettre à jour le profil
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialisation des form-outline de MDB
            document.querySelectorAll('.form-outline').forEach((formOutline) => {
                new mdb.Input(formOutline).init();
            });

            // Fonction pour afficher les alertes
            function showAlert(message, type = 'success') {
                const alertContainer = document.getElementById('alertContainer');
                const alertMessage = document.getElementById('alertMessage');
                const alert = alertContainer.querySelector('.alert');

                alertMessage.textContent = message;
                alert.className = `alert alert-${type} alert-dismissible fade show`;
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
                            const user = data.data.user;
                            document.getElementById('profileName').textContent = user.name;
                            document.getElementById('profileEmail').textContent = user.email;
                            document.getElementById('name').value = user.name;
                            document.getElementById('email').value = user.email;

                            // Afficher l'image de profil si elle existe
                            const profileImage = document.getElementById('profileImage');
                            const profileIcon = document.getElementById('profileIcon');
                            
                            if (user.profil_image) {
                                profileImage.src = `/storage/${user.profil_image}`;
                                profileImage.style.display = 'block';
                                profileIcon.style.display = 'none';
                            } else {
                                profileImage.style.display = 'none';
                                profileIcon.style.display = 'block';
                            }

                            // Réinitialiser les form-outline
                            document.querySelectorAll('.form-outline').forEach((formOutline) => {
                                new mdb.Input(formOutline).init();
                            });
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
                const editIcon = document.querySelector('.edit-icon');
                const originalContent = editIcon.innerHTML;
                editIcon.innerHTML = '<i class="fas fa-spinner fa-spin fa-sm"></i>';

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
                             
                             profileImage.src = `/storage/${data.data.profil_image}`;
                             profileImage.style.display = 'block';
                             profileIcon.style.display = 'none';
                             
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
                         editIcon.innerHTML = originalContent;
                         // Réinitialiser l'input file
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
                     } else {
                         // Créer l'élément image s'il n'existe pas
                         const newImage = document.createElement('img');
                         newImage.src = `/storage/${imagePath}`;
                         newImage.alt = 'Photo de profil';
                         newImage.className = 'rounded-circle';
                         newImage.width = 32;
                         newImage.height = 32;
                         newImage.style = 'object-fit: cover;';
                         newImage.id = 'navbarProfileImage';
                         
                         const dropdownToggle = document.querySelector('.nav-link.dropdown-toggle');
                         dropdownToggle.innerHTML = '';
                         dropdownToggle.appendChild(newImage);
                     }
                     
                     if (navbarProfileIcon) {
                         navbarProfileIcon.style.display = 'none';
                     }
                 } else {
                     if (navbarProfileImage) {
                         navbarProfileImage.style.display = 'none';
                     }
                     if (navbarProfileIcon) {
                         navbarProfileIcon.style.display = 'block';
                     }
                 }
             }

            // Gérer la soumission du formulaire
            document.getElementById('profileForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const button = document.getElementById('updateButton');
                const originalText = button.innerHTML;
                button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mise à jour...';
                button.disabled = true;

                const formData = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
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
                            loadProfile();
                            // Réinitialiser les champs de mot de passe
                            document.getElementById('current_password').value = '';
                            document.getElementById('new_password').value = '';
                            document.getElementById('new_password_confirmation').value = '';
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
                        button.innerHTML = originalText;
                        button.disabled = false;
                    });
            });

            // Charger le profil au chargement de la page
            loadProfile();
        });
    </script>
    
@endsection
