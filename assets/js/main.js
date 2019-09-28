console.log('main.js loaded');
var lists = document.getElementsByClassName('listContainer');
var toggleBtn = document.getElementsByClassName('toggleListBtn');
for (var i = 0; i < toggleBtn.length; i++) {
  toggleBtn[i].addEventListener('click', toggleList);
}

function toggleList(){
  this.classList.add('active');
  for (var i = 0; i < toggleBtn.length; i++) {
    toggleBtn[i].classList.remove('active');
  }
  this.classList.add('active');
  for (var i = 0; i < lists.length; i++) {
    lists[i].style.display = 'none';
  }
  var classToShow = document.getElementsByClassName(this.getAttribute('data-show'));
  for (var i = 0; i < classToShow.length; i++) {
    classToShow[i].style.display = 'block';
  }
}
