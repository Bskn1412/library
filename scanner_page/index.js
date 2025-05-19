let items = document.querySelectorAll('.slider .list .item ');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let stat = document.querySelectorAll('.thumbnail .stat > div')

let countItem = items.length;
let itemActive = 0;

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

