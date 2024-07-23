<div class="user-profile-menu">
  <img src="img/icon_profil.png" alt="Photo de profil" class="user-profile-menu__image" onclick="toggleProfileMenu()">
  <div class="user-profile-menu__content" id="profileMenu">
    <div class="user-card">
      <img src="img/profil-de-lutilisateur3.png" alt="Photo de profil" class="user-card__image">
      <p class="user-card__name">Pseudo</p>
      <div class="user-grid-container">
        <div class="user-grid-child-posts">
          nombre de posts
        </div>
        <div class="user-grid-child-followers">
          nombre de likes
        </div>
      </div>
      <button class="user-card__button user-draw-border">Abonnés</button>
      <button class="user-card__button user-draw-border">Conversation</button>

    <button class="user-card__button user-card-gear-button" onclick="editProfile()">
        <img src="img/gear-icon.png" alt="Edit Profile" class="user-card__icon">
    </button>

    </div>
  </div>
</div>

<div id="editProfileModal" class="user-modal">
  <div class="user-modal-content">
    <span class="user-modal-close" onclick="closeEditProfileModal()">&times;</span>
    <form>
      <label for="username">Nouveau Pseudo :</label>
      <input type="text" id="username" name="username" value=""><br>
      <label for="email">Nouvel Email :</label>
      <input type="email" id="email" name="email" value=""><br>
      <label for="password">Nouveau Mot de passe :</label>
      <input type="password" id="password" name="password"><br>
      <button type="submit" class="user-card__button user-draw-border">Sauvegarder</button>
    </form>
  </div>
</div>


<script>
function toggleProfileMenu() {
  var menu = document.getElementById("profileMenu");
  menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
}

function editProfile() {
  document.getElementById("editProfileModal").style.display = "block";
}

function closeEditProfileModal() {
  document.getElementById("editProfileModal").style.display = "none";
}
</script>
