document.addEventListener('DOMContentLoaded', () => {
    //Открытие модалки
    const createBtns = document.querySelectorAll('.create');
    const createModal = document.querySelector('.modal-create');
    const closeModal = document.getElementById('modal-close');
    const wrapModal = document.querySelector('.modal-wrap');
    const bodyElement = document.querySelector('body');

    createBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            if (!createModal.classList.contains('active')) {
                createModal.classList.add('active');
                bodyElement.classList.add('modal-open');
                wrapModal.classList.add('active');
            } else {
                createModal.classList.remove('active');
            }
        })
    })

    closeModal.addEventListener('click', () => {
        if (!createModal.classList.contains('active')) {
            createModal.classList.add('active');
        } else {
            createModal.classList.remove('active');
            bodyElement.classList.remove('modal-open');
            wrapModal.classList.remove('active');
        }
    })

    const loadMoreButton = document.getElementById('load-more');
    const notesContainer = document.getElementById('notes');
    let offset = 0;
    let responseData;

    loadMoreButton.addEventListener('click', () => {
        offset += 3;

        fetch('loadmore.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'offset=' + offset,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            notesContainer.innerHTML += data;
        })
        .catch(error => {
            console.error('Error during fetch operation:', error);
        });
    });
});

