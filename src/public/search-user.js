const userInputName = document.querySelector('.name');
const userInputEmail = document.querySelector('.email');

userInputName.addEventListener('click', (e) => {
  const name = e.target;
  const nameLabel = name.previousElementSibling;
  nameLabel.classList.add('move');
});

userInputName.addEventListener('blur', (e) => {
  const name = e.target;
  const nameLabel = name.previousElementSibling;
  if (name.value === '') {
    nameLabel.classList.remove('move');
  }
});

userInputEmail.addEventListener('click', (e) => {
  const email = e.target;
  const emailLabel = email.previousElementSibling;
  emailLabel.classList.add('move');
});

userInputEmail.addEventListener('blur', (e) => {
  const email = e.target;
  const emailLabel = email.previousElementSibling;
  if (email.value === '') {
    emailLabel.classList.remove('move');
  }
});
