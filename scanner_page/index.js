let items = document.querySelectorAll('.slider .list .item ');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let stat = document.querySelectorAll('.thumbnail .stat > div')

let countItem = items.length;
let itemActive = 0;


  const roll = document.getElementById("number");
  const form = document.getElementById("attendanceForm");
  let typingTimer;
  const scanDelay = 10; // time in ms to wait after "typing" ends

  //Add Roll in Input after Scan
 roll.addEventListener("keyup", (e) => {
  clearTimeout(typingTimer);

  // Detect manual Enter key press
  if (e.key === "Enter") {
    const val = roll.value.trim();

    if (val.length === 10) {
      form.requestSubmit();
      roll.value = "";
    } else {
      // Invalid entry → clear and prevent submit
      roll.value = "";
      e.preventDefault();
      //console.log("Invalid roll number — must be 10 digits!");
    }

    return; // stop further handling
  }

  // Scanner auto-submit after scanDelay
  typingTimer = setTimeout(() => {
    const val = roll.value.trim();

    if (val !== "" && val.length >= 10) {
      form.requestSubmit();
      roll.value = "";
    }
  }, scanDelay);
});


console.log(items);

next.onclick = function(){
  itemActive = itemActive + 1;
  if(itemActive >= countItem){
    itemActive = 0;
  }
  showSlider();
}

prev.onclick = function(){
  itemActive = itemActive - 1;
  if(itemActive < 0){
    itemActive = countItem - 1;
  }
  showSlider();
  
}

let autoslide = setInterval(() => {
   next.click();
}, 7000);

function updateStat(){

  stat[0].querySelector('img').src = items[itemActive].querySelector('img').src;

  if(itemActive + 1 >= countItem){
    stat[1].querySelector('img').src = items[0].querySelector('img').src;
  }
  else{
    stat[1].querySelector('img').src = items[itemActive + 1].querySelector('img').src;
  }


  if(itemActive + 2 >= countItem){
    stat[2].querySelector('img').src = items[1].querySelector('img').src;
  }
  else{
    stat[2].querySelector('img').src = items[itemActive + 2].querySelector('img').src;
  }

}

updateStat();

for(let i = 0; i < stat.length; i++){
  stat[i].onclick = function(){
    itemActive =  itemActive + i >= countItem ? 0 : itemActive + i  ;
    showSlider();
    clearInterval(autoslide);
    autoslide = setInterval(() => {
      next.click();
    }, 7000);
  }
}

function showSlider(){
  let itemActiveOld = document.querySelector('.slider .list .item.active');

  console.log(items[itemActive].querySelector('img').src);

  updateStat();

  itemActiveOld.classList.remove('active');

  items[itemActive].classList.add('active');

  clearInterval(autoslide);
    autoslide = setInterval(() => {
      next.click();
    }, 7000);
}




// To show message of Update button in nav bar
    
document.getElementById('updateLibraryBtn').addEventListener('click', function () {
  const btn = this;
  const statusEl = document.getElementById('updateStatus');

  // Initial state
  btn.disabled = true;
  statusEl.textContent = '⏳ Updating...';
  statusEl.style.opacity = "1";
  statusEl.style.display = "block";

  fetch('auto_close.php', {
    method: 'POST'
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        if (data.affected > 0) {
          statusEl.textContent = `✅ ${data.affected} records updated at ${data.closing_time}`;
        } else {
          statusEl.textContent = `ℹ️ No records needed updating. (${data.closing_time})`;
        }
      } else {
        statusEl.textContent = '❌ Update failed. Check logs.';
      }
    })
    .catch(error => {
      statusEl.textContent = '⚠️ Network or server error.';
      console.error('Error:', error);
    })
    .finally(() => {
      btn.disabled = false;

      // Auto-hide status after 5 seconds
      setTimeout(() => {
        statusEl.style.opacity = "0";
        setTimeout(() => {
          statusEl.style.display = "none";
          statusEl.textContent = "";
        }, 500); // match CSS transition duration
      }, 5000);
    });
});


// Smooth Animation for Scanned Input
const messageBox = document.getElementById("messageBox");
let messageQueue = [];
let isShowing = false;

function showMessage(msg, duration = 2000) {
  messageQueue.push({ msg, duration });
  if (!isShowing) processQueue();
}

async function processQueue() {
  if (messageQueue.length === 0) return;

  isShowing = true;
  const { msg, duration } = messageQueue.shift();

  messageBox.textContent = msg;
  messageBox.style.display = "flex";
  messageBox.style.animation = "show2 0.4s ease forwards";

  // Wait for show animation + visible duration
  await new Promise((resolve) => setTimeout(resolve, duration));

  // Fade out smoothly
  messageBox.style.animation = "show2 0.4s ease reverse forwards";

  // Wait for fade-out animation to finish
  await new Promise((resolve) => setTimeout(resolve, 400));

  messageBox.style.display = "none";

  isShowing = false;
  processQueue(); // move to next message
}
