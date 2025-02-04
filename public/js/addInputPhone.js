// menambah input Phone

// document.getElementById('add-phone').addEventListener('click', function() {

//     var newInput = document.createElement('input');
//     newInput.type = 'number';
//     newInput.name = 'phone_number[]'; 
//     newInput.classList.add('form-control', 'border-2');
//     newInput.placeholder = 'Phone';

//     document.getElementById('phone-area').appendChild(newInput);
//   });  


document.getElementById('add-phone').addEventListener('click', function() {
  var newInputContainer = document.createElement('div');
  newInputContainer.classList.add('flex', 'w-full', 'items-center', 'mb-2');

  var newInput = document.createElement('input');
  newInput.type = 'number';
  newInput.name = 'phone_number[]'; 
  newInput.classList.add('form-control', 'border-2', 'w-full');
  newInput.placeholder = 'Phone';

  var deleteBtn = document.createElement('button');
  deleteBtn.textContent = 'x';
  deleteBtn.classList.add('px-2', 'text-base', 'bg-red-500', 'text-white', 'ml-2', 'items-center');
  
  deleteBtn.addEventListener('click', function() {
      newInputContainer.remove();
  });

  newInputContainer.appendChild(newInput);
  newInputContainer.appendChild(deleteBtn);

  document.getElementById('phone-area').appendChild(newInputContainer);
});