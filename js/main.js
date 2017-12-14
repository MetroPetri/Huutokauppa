'use strict';

try {
  const loginNamiska = document.querySelector('#loginNappi');
  loginNamiska.addEventListener('click', (evt) => {
    evt.preventDefault();
    document.getElementById('login').classList.replace('hidden', 'modal');
  });
} catch (e) {};

try {
const registerNamiska = document.querySelector('#registerNappi');
registerNamiska.addEventListener('click', (evt) => {
  evt.preventDefault();
  document.getElementById('register').classList.replace('hidden', 'modal');
});
} catch (e) {};
try {
const uploadNamiska = document.querySelector('#uploadNappi');
uploadNamiska.addEventListener('click', (evt) => {
  evt.preventDefault();
  document.getElementById('upload').classList.replace('hidden', 'modal');
});
} catch (e) {};
try {
const suljeNapit = document.querySelectorAll('.close');
suljeNapit.forEach( (nappi) => {
  nappi.addEventListener('click', (evt) => {
    evt.preventDefault();
    console.log(nappi.parentNode);
    nappi.parentNode.classList.replace('modal', 'hidden');
  })
});} catch (e) {};







// Get the modal
try {
const loginModal = document.getElementById('login');

// When the user clicks anywhere outside of the modal, close it
window.addEventListener('click', (event) => {
  if (event.target === loginModal) {
    loginModal.classList.replace('modal', 'hidden');
  }
});
} catch (e) {};
try {
// Get the modal
const registerModal = document.getElementById('register');

// When the user clicks anywhere outside of the modal, close it
window.addEventListener('click', (event) => {
  if (event.target === registerModal) {
    registerModal.classList.replace('modal', 'hidden');
  }
});} catch (e) {};
// Get the modal
try {
const uploadModal = document.getElementById('upload');

// When the user clicks anywhere outside of the modal, close it
window.addEventListener('click', (event) => {
  if (event.target === uploadModal) {
    uploadModal.classList.replace('modal', 'hidden');
  }
});} catch (e) {};















/*<script>
  // Get the modal
  var modal = document.getElementById('login');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script>
  // Get the modal
  var modal = document.getElementById('register');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script>
  // Get the modal
  var modal = document.getElementById('upload');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>*/
