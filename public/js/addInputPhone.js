// menambah input Phone

document.getElementById('add-phone').addEventListener('click', function() {

    var newInput = document.createElement('input');
    newInput.type = 'number';
    newInput.name = 'phone_number[]'; 
    newInput.classList.add('form-control', 'border-2');
    newInput.placeholder = 'Phone';

    document.getElementById('phone-area').appendChild(newInput);
  });


  