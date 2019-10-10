
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


// Control birth date input
var input = document.querySelectorAll('input[name="birthNumber"]')[0];
if(input){input.classList.add('unvalid');}
var btn = document.getElementsByClassName('member-btn')[0];

if(input) {input.addEventListener('keyup', controlFormat);}

function controlFormat(e) {
  if(input){
    if( !input.value.match(/[0-9]/) ) {
      input.classList.remove('valid');
      input.classList.add('unvalid');
      btn.setAttribute('disabled', '');
    } else if ( !input.value.match(/[a-zA-Z]/) && input.value.length == 10) {
      input.classList.remove('unvalid');
      input.classList.add('valid');
      btn.removeAttribute('disabled');
    }
  }
}
