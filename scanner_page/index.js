let items = document.querySelectorAll('.slider .list .item ');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let thumbnails = document.querySelectorAll('.thumbnail .item');

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

function showSlider(){
  let itemActiveOld = document.querySelector('.slider .list .item.active');
  let thumbnailActiveOld = document.querySelector('.thumbnail .item.active');
  itemActiveOld.classList.remove('active');
  thumbnailActiveOld.classList.remove('active');

  items[itemActive].classList.add('active');
  thumbnails[itemActive].classList.add('active');
}

thumbnails.forEach((thumbnail, index) => {
  thumbnail.addEventListener('click',()=>{
    itemActive = index;
    showSlider();
  })
})

let autoslide = setInterval(() => {
   next.click();
}, 7000);