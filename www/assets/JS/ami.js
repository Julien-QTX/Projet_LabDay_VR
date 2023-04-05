const form = document.querySelector('form');
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Empêcher l'envoi du formulaire
  const searchInput = document.querySelector('#search');
  const searchTerm = searchInput.value;
  fetch(`/users?search=${encodeURIComponent(searchTerm)}`)
    .then(response => response.json())
    .then(users => {
      // Afficher les utilisateurs correspondants
    })
    .catch(error => {
      console.error(error);
    });
});

function envoyerDemande(id) {
    fetch('/demandes', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id: id })
    })
      .then(response => {
        // Afficher un message de confirmation
      })
      .catch(error => {
        console.error(error);
      });
  }

  fetch('/demandes')
  .then(response => response.json())
  .then(demandes => {
    // Afficher les demandes d'amis en attente
    demandes.forEach(demande => {
      const div = document.createElement('div');
      div.innerHTML = `
        <p>${demande.from} vous a envoyé une demande d'amis</p>
        <button onclick="accepterDemande(${demande.id})">Accepter</button>
        <button onclick="refuserDemande(${demande.id})">Refuser</button>
      `;
      document.body.appendChild(div);
    });
  })
  .catch(error => {
    console.error(error);
  });

function accepterDemande(id) {
  fetch(`/demandes/${id}`, { method: 'PUT' })
    .then(response => {
      // Afficher un message de confirmation
    })
    .catch(error => {
      console.error(error);
    });
}

function refuserDemande(id) {
  fetch(`/demandes/${id}`, { method: 'DELETE' })
    .then(response => {
      // Afficher un message de confirmation
    })
    .catch(error => {
      console.error(error);
});
}