<div class="profile-menu" id="profileMenu">
    <h2>Mon Profil</h2>
    <form id="profileForm">
        <div class="custom-form-group">
            <label for="profilePic">Changer la photo de profil :</label>
            <input type="file" id="profilePic" accept="image/*">
        </div>
        <div class="custom-form-group">
            <label for="email">Changer l'email :</label>
            <input type="email" id="email" value="">
        </div>
        <div class="custom-form-group">
            <label for="password">Changer le mot de passe :</label>
            <input type="password" id="password" value="">
        </div>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>

    <script>
       
        document.getElementById('profileMenuToggle').addEventListener('click', function() {
            var profileMenu = document.getElementById('profileMenu');
            profileMenu.classList.toggle('visible');
        });
    </script>