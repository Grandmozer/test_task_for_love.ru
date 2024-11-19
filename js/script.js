const userModal = document.querySelector('.user-modal');

// Модальное окно юзера
function userModalHandler() {
    const userCards = document.querySelectorAll('.user-card');
    userCards.forEach(card => {
        card.addEventListener('click', () => {
            const userId = card.dataset.id;
            const userName = card.dataset.name;
            const userAge = card.dataset.age;
            const userPhoto = card.dataset.photoFirst;
            const userCity = card.dataset.city;

            const modalImage = userModal.querySelector('.user-modal__image img');
            modalImage.src = userPhoto;
            modalImage.alt = userName;

            const modalName = userModal.querySelector('.user-modal__name');
            modalName.textContent = `${userName}, ${userAge}`;

            const modalTown = userModal.querySelector('.user-modal__town');
            modalTown.textContent = userCity;

            userModal.dataset.currentUserId = userId;
            const savedChoice = localStorage.getItem(`user_${userId}_choice`);
            const likeButton = userModal.querySelector('.user-modal__like');
            const dislikeButton = userModal.querySelector('.user-modal__dislike');

            likeButton.classList.remove('active');
            dislikeButton.classList.remove('active');

            if (savedChoice === 'like') {
                likeButton.classList.add('active');
            } else if (savedChoice === 'dislike') {
                dislikeButton.classList.add('active');
            }

            likeButton.addEventListener('click', () => {
                const userId = userModal.dataset.currentUserId;
                if (likeButton.classList.contains('active')) {
                    // Если кнопка уже активна - снимаем выбор
                    likeButton.classList.remove('active');
                    localStorage.removeItem(`user_${userId}_choice`);
                } else {
                    // Активируем лайк и убираем active с дизлайка
                    likeButton.classList.add('active');
                    dislikeButton.classList.remove('active');
                    localStorage.setItem(`user_${userId}_choice`, 'like');
                }
            });

            dislikeButton.addEventListener('click', () => {
                const userId = userModal.dataset.currentUserId;
                if (dislikeButton.classList.contains('active')) {
                    // Если кнопка уже активна - снимаем выбор
                    dislikeButton.classList.remove('active');
                    localStorage.removeItem(`user_${userId}_choice`);
                } else {
                    // Активируем дизлайк и убираем active с лайка
                    dislikeButton.classList.add('active');
                    likeButton.classList.remove('active');
                    localStorage.setItem(`user_${userId}_choice`, 'dislike');
                }
            });

            userModal.showModal();
            addModalCloseHandler(userModal);
            document.body.classList.add('scroll-lock');
        });
    });
}

document.addEventListener('DOMContentLoaded', userModalHandler);

function unlockScreen() {
    document.querySelector("html").classList.remove(".scroll-lock");
}

// Закрытие модальных окон по backdrop
function addModalCloseHandler(modal) {
    const closeButton = modal.querySelector('.user-modal__close');
    modal.addEventListener('click', (event) => {
        closeButton.addEventListener('click', () => {
        modal.close();
        })
        unlockScreen();
        const rect = modal.getBoundingClientRect();
        const isInDialog = (
            rect.top <= event.clientY &&
            event.clientY <= rect.top + rect.height &&
            rect.left <= event.clientX &&
            event.clientX <= rect.left + rect.width
        );
        if (!isInDialog) {
            modal.close();
            document.body.classList.remove('scroll-lock');
        }
    });
}

//фильтр пользователей
function filterModalHandler() {
    const button = document.querySelector('.header__filter');
    const modalFilter = document.querySelector('.filter-modal');
    const closeButton = modalFilter.querySelector('.filter-modal__close');
    const form = modalFilter.querySelector('.filter-modal__form');
    const ageInput = form.querySelector('input[name="age"]');
    const townInput = form.querySelector('input[name="town"]');


    // Открытие модального окна
    button.addEventListener('click', () => {
        modalFilter.show();
        document.body.classList.add('scroll-lock');
    });

    // Закрытие модального окна
    closeButton.addEventListener('click', () => {
        modalFilter.close();
        document.body.classList.remove('scroll-lock');
    });
    addModalCloseHandler(modalFilter);
    // Обработка ввода в поля фильтра (для мгновенной фильтрации)
    let filterTimeout;

    function applyFilters() {
        const age = ageInput.value;
        const town = townInput.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.user-card');

        cards.forEach(card => {
            let showCard = true;

            // Проверка возраста
            if (age) {
                const cardAge = parseInt(card.dataset.age);
                if (cardAge !== parseInt(age)) {
                    showCard = false;
                }
            }

            // Проверка города
            if (town && showCard) {
                const cardTown = card.dataset.city.toLowerCase();
                if (!cardTown.includes(town)) {
                    showCard = false;
                }
            }

            // Показываем или скрываем карточку
            if (showCard) {
                card.style.display = '';
                card.classList.remove('hidden');
            } else {
                card.style.display = 'none';
                card.classList.add('hidden');
            }
        });

        // Проверяем, есть ли видимые карточки
        const visibleCards = document.querySelectorAll('.user-card:not(.hidden)');
        const noResultsMessage = document.querySelector('.no-results-message');

        if (visibleCards.length === 0) {
            if (!noResultsMessage) {
                const message = document.createElement('div');
                message.className = 'no-results-message';
                message.textContent = 'Нет пользователей, соответствующих фильтрам';
                document.querySelector('.users-container').appendChild(message); // Замените на актуальный селектор контейнера карточек
            }
        } else {
            if (noResultsMessage) {
                noResultsMessage.remove();
            }
        }
    }

    ageInput.addEventListener('input', (e) => {
        // Проверяем введенное значение
        let value = parseInt(e.target.value);

        if (value < 18) {
            e.target.value = 18;
        } else if (value > 100) {
            e.target.value = 100;
        }

        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(applyFilters, 300);
    });

    townInput.addEventListener('input', () => {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(applyFilters, 300);
    });

    const resetFilters = () => {
        ageInput.value = '';
        townInput.value = '';
        applyFilters();
    };

    const resetButton = document.querySelector('button');
    resetButton.addEventListener('click', (e) => {
        e.preventDefault();
        resetFilters();
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        applyFilters();
    });
};
document.addEventListener('DOMContentLoaded', filterModalHandler);

