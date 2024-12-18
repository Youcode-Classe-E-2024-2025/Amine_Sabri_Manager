
// ################## form logout  #####################
document.getElementById("signupForm").addEventListener("submit", function(event) {
  
  var fullname = document.getElementById("fullname").value;
  var fullnamePattern = /^[A-Za-z\s]+$/;
  if (!fullnamePattern.test(fullname) || fullname.trim() === "") {
      alert("Le nom complet ne doit contenir que des lettres et des espaces.");
      event.preventDefault(); 
      return;
  }

  var email = document.getElementById("email").value;
  var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailPattern.test(email) || email.trim() === "") {
      alert("Veuillez entrer un email valide.");
      event.preventDefault();
      return;
  }

  var password = document.getElementById("password").value;
  if (password.length < 4 || password.trim() === "") {
      alert("Le mot de passe doit contenir au moins 6 caractères.");
      event.preventDefault();
      return;
  }
});

