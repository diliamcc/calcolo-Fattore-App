document.getElementById('calculate_kxpo').addEventListener('click', function (event) {
    event.preventDefault();

    let formData = new FormData(document.getElementById('kxpo-form'));
    document.getElementById('error-message').style.display = 'none';
    document.getElementById('loading-message').style.display = 'block';  // Mostrar el mensaje de "Cargando"
    document.getElementById('error-list').innerHTML = '';

    fetch('/calculate-kxpo', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        return response.json().then(data => {
            if (!response.ok) {
                throw data;
            }
            return data;
        });
    })
    .then(data => {
      
        setTimeout(() => {
            document.getElementById('loading-message').style.display = 'none';  

            
            document.getElementById('kxpo-result').innerHTML = data.kxpo.toFixed(4);
            document.getElementById('cg-h-result').innerHTML = data.cg_h;

            let resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
            resultModal.show();
        }, 60000);
    })
    .catch(error => {
        document.getElementById('loading-message').style.display = 'none';

        if (error.errors) {
            Object.values(error.errors).forEach(errArray => {
                errArray.forEach(err => {
                    const li = document.createElement('li');
                    li.textContent = err;
                    document.getElementById('error-list').appendChild(li);
                });
            });
            document.getElementById('error-message').style.display = 'block';
        } else {
            const li = document.createElement('li');
            li.textContent = 'An unexpected error occurred. Please try again.';
            document.getElementById('error-list').appendChild(li);
            document.getElementById('error-message').style.display = 'block';
        }
    });
});

document.getElementById('close-error-btn').addEventListener('click', function () {
    document.getElementById('error-message').style.display = 'none';
});

document.getElementById('reset-btn').addEventListener('click', function () {
    document.getElementById('kxpo-form').reset();
    document.getElementById('error-message').style.display = 'none';
    document.getElementById('loading-message').style.display = 'none';
});

