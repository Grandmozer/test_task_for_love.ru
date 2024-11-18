<?php
/** @var array $data */

?>
<li class="user-card"
    data-id="<?= $data['id'] ?>"
    data-name="<?= $data['user_name'] ?>"
    data-age="<?= $data['age'] ?>"
    data-photo-first="<?= $data['photo'][0] ?>"
    data-city="<?= $data['city'] ?>">
    <div class="user-card__background"></div>
    <div class="user-card__top">
        <img src="<?= ($data['photo'][0]) ?>" alt="user photo">
        <div class="user-card__badges">
            <div class="user-card__badges-top">
                <?php
                if ($data['message']) {
                    require "UI/BadgeMessage/layout.php";
                }
                ?>
            </div>
            <div class="user-card__badges-bottom">
                <?php
                require "UI/BadgeDistance/layout.php";
                require "UI/BadgePhoto/layout.php";
                ?>
            </div>
        </div>
    </div>

    <div class="user-card__info">
        <div class="user-card__details">
            <h5 class="user-card__user-name"><?= $data['user_name'] ?>, <?= $data['age'] ?></h5>
            <?php if ($data['online']): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                    <path d="M12 6.5C12 9.81371 9.31371 12.5 6 12.5C2.68629 12.5 0 9.81371 0 6.5C0 3.18629 2.68629 0.5 6 0.5C9.31371 0.5 12 3.18629 12 6.5Z"
                          fill="#7CBC00"/>
                </svg>
            <?php endif; ?>
        </div>
        <div class="user-card__location"><?= $data['city'] ?></div>
    </div>
</li>