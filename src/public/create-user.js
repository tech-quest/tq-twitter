const userCreateInput = document.querySelector('.user-create__next');
userCreateInput.addEventListener(
  'click',
  async function (event) {
    event.preventDefault();
    const nameInput = document.querySelector('.name');
    const name = nameInput.value;
    const emailInput = document.querySelector('.email');
    const email = emailInput.value;

    if (name.length > 5 || name.length < 1) {
      const nameErrorMessage = document.querySelector('.name-error__output');
      nameErrorMessage.classList.add('name');
      return;
    }

    if (email.length === 0) {
      const emailErrorMessage = document.querySelector('.email-error__output');
      emailErrorMessage.classList.add('email');
      return;
    }

    const obj = {
      name,
      email,
    };

    const body = JSON.stringify(obj);

    const headers = {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    };

    const response = await fetch(
      'Api/send-user-register-certification-code.php',
      {
        method: 'POST',
        headers,
        body,
      }
    );

    const json = await response.json();
    if (json.data.status) {
      const userCreate = document.querySelector('.user-create');
      const userCertification = document.querySelector('.user-certification');
      userCreate.classList.add('remove');
      userCertification.classList.add('show');
    } else {
      const errorMessage = document.querySelector('.errorMessage');
      const output = document.querySelector('.output');
      output.classList.add('active');
      errorMessage.innerHTML = 'メールアドレスが登録されています。';

      setTimeout(() => {
        output.classList.remove('active');
      }, 2000);
    }
  },
  false
);
const sendCertificateButton = document.querySelector(
  '.send-certification__button'
);
sendCertificateButton.addEventListener(
  'click',
  async function (event) {
    event.preventDefault();
    const codeInput = document.querySelector('.send-certification');
    const code = codeInput.value;
    const obj = {
      code,
    };
    const body = JSON.stringify(obj);
    const headers = {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    };
    const response = await fetch(
      'Api/confirm-user-register-certification-code-input.php',
      {
        method: 'POST',
        headers,
        body,
      }
    );

    const json = await response.json();

    if (json.data.status) {
      const UserCertificationDisplay = document.querySelector(
        '.user-certification__display'
      );
      const userPassword = document.querySelector('.user-password');

      UserCertificationDisplay.classList.add('remove2');
      userPassword.classList.add('show2');
    } else {
      alert('認証コードを入力してください。');
    }

    const name = document.querySelector('.name-output');
    name.textContent = json.data['name'];
    const email = document.querySelector('.email-output');
    email.innerHTML = json.data['email'];
  },
  false
);
