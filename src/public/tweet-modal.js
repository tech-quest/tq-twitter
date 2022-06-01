const tweetButton = document.querySelector('.tweet-button');
tweetButton.addEventListener(
  'click',
  async function (event) {
    event.preventDefault();
    const tweetModal = document.querySelector('.tweet-modal');
    tweetModal.classList.add('show-modal');
  },
  false
);

const sendTweet = document.querySelector('.send-tweet');
sendTweet.addEventListener(
  'click',
  async function (event) {
    event.preventDefault();
    const tweetInput = document.querySelector('.tweet');
    const tweet = tweetInput.value;
    const obj = {
      tweet,
    };
    const body = JSON.stringify(obj);
    const headers = {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    };
    const response = await fetch('Api/complete-user-tweet.php', {
      method: 'POST',
      headers,
      body,
    });
    const json = await response.json();
    if (json.data.status) {
      const tweetModal = document.querySelector('.tweet-modal');
      tweetModal.classList.remove('show-modal');
      window.location.reload();
    }
  },
  false
);

const inputValue = document.getElementById('inputForm');
inputValue.addEventListener(
  'keyup',
  (event) => {
    const input = inputValue.value;
    const sendTweetButton = document.querySelector('.send-tweet');
    const currentTweetCount = document.querySelector('.current-tweet-count');
    currentTweetCount.textContent = input.length;
    console.log('input', input);
    if (input.length > 140) {
      inputValue.classList.add('color');
      sendTweetButton.classList.add('hover');
      sendTweetButton.disabled = true;
    } else {
      inputValue.classList.remove('color');
      sendTweetButton.classList.remove('hover');
      sendTweetButton.disabled = false;
    }
  },
  false
);

const tweetModal = document.querySelector('.tweet-modal');
tweetModal.addEventListener(
  'click',
  (event) => {
    if (!tweetModal.classList.contains('show-modal')) {
      return;
    }
    if (event.target === event.target.closest('.tweet-modal')) {
      tweetModal.classList.remove('show-modal');
    }
  },
  false
);
