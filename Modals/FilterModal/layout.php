<dialog class="filter-modal">
    <div class="filter-modal__block">
        <h3 class="filter-modal__title">Фильтры</h3>
         <form class="filter-modal__form" action="">
            <label class="filter-modal__label" for="age">Возраст</label>
            <input type="number" name="age" min="18" max="100" placeholder="30">
            <label class="filter-modal__label" for="town">Город</label>
            <input type="text" name="town" placeholder="Москва">
            <button class="filter-modal__reset">Сбросить фильтры</button>
        </form>
        <button class="filter-modal__close">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <path d="M12 36L36 12M12 12L36 36" stroke="#999999" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</dialog>
