// Update Hobby di halaman yang sama

const editButtons = document.querySelectorAll('#button-edit');
            
editButtons.forEach(button => {
    button.addEventListener('click', function() {
        
        const id = this.getAttribute('data-id');
        const hobby = this.getAttribute('data-hobby');
        
        document.getElementById('hobby').value = hobby;
        document.getElementById('hobby_id').value = id;
    });
});
