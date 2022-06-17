const accountInfo = document.querySelector('.account-info-wrapper');
accountInfo.addEventListener(
  'click',
  () => {
    const accountInfoModal = document.querySelector('.account-info-modal');
    if (accountInfoModal.classList.contains('show-modal')) {
      accountInfoModal.classList.remove('show-modal');
    } else {
      accountInfoModal.classList.add('show-modal');
    }
  },
  false
);
