const userRegisterButton = document.querySelector('.user-register__button');
userRegisterButton.addEventListener(
  'click',
  async function (event) {
    event.preventDefault();
    const passwordInput = document.querySelector('.password');
    const password = passwordInput.value;
    const confirmPasswordInput = document.querySelector('.confirm-password');
    const confirmPassword = confirmPasswordInput.value;

    if (password === '') {
      alert('パスワードを入力してください。');
      return;
    } else if (confirmPassword === '') {
      alert('パスワード確認を入力してください。');
      return;
    } else if (password !== confirmPassword) {
      alert('パスワードが一致していません。');
      return;
    }
    const obj = {
      password,
      confirmPassword,
    };
    const body = JSON.stringify(obj);
    const headers = {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    };
    const response = await fetch('Api/complete-user-register.php', {
      method: 'POST',
      headers,
      body,
    });

    const json = await response.json();
    if (json.data.status) {
      const userPasswordDisplay = document.querySelector(
        '.user-password__display'
      );
      const completePassword = document.querySelector('.complete-password');
      userPasswordDisplay.classList.add('remove3');
      completePassword.classList.add('show3');
    }
  },
  false
);
