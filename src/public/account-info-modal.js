const accountInfo = document.querySelector('.account-info');
accountInfo.addEventListener(
  'click',
  async function (event) {
    // event.preventDefault();
    const accountInfoModal = document.querySelector('.account-info-modal');
    if (accountInfoModal.classList.contains('show-modal')) {
      accountInfoModal.classList.remove('show-modal');
    } else {
      accountInfoModal.classList.add('show-modal');
    }
  },
  false
);
