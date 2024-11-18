<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="ru">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!--    FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet">
    <!--    LESS-->
    <script defer src="
https://cdn.jsdelivr.net/npm/less@4.2.0/dist/less.min.js
"></script>
    <!--    STYLES-->
    <link rel="stylesheet/less" type="text/css" href="/less/index.less">
    <!--    SCRIPTS-->
    <script defer src="js/script.js"></script>
    <title>Поиск пары</title>
</head>
<body>
<?php
$users =json_decode(file_get_contents('users.json'), true);
?>
<header class="header container wrapper">
    <h1 class="header__title">Поиск пары</h1>
    <button class="header__filter">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path d="M7.5 3H17.25M7.5 3C7.5 3.39782 7.34196 3.77936 7.06066 4.06066C6.77936 4.34196 6.39782 4.5 6 4.5C5.60218 4.5 5.22064 4.34196 4.93934 4.06066C4.65804 3.77936 4.5 3.39782 4.5 3M7.5 3C7.5 2.60218 7.34196 2.22064 7.06066 1.93934C6.77936 1.65804 6.39782 1.5 6 1.5C5.60218 1.5 5.22064 1.65804 4.93934 1.93934C4.65804 2.22064 4.5 2.60218 4.5 3M4.5 3H0.75M7.5 15H17.25M7.5 15C7.5 15.3978 7.34196 15.7794 7.06066 16.0607C6.77936 16.342 6.39782 16.5 6 16.5C5.60218 16.5 5.22064 16.342 4.93934 16.0607C4.65804 15.7794 4.5 15.3978 4.5 15M7.5 15C7.5 14.6022 7.34196 14.2206 7.06066 13.9393C6.77936 13.658 6.39782 13.5 6 13.5C5.60218 13.5 5.22064 13.658 4.93934 13.9393C4.65804 14.2206 4.5 14.6022 4.5 15M4.5 15H0.75M13.5 9H17.25M13.5 9C13.5 9.39782 13.342 9.77936 13.0607 10.0607C12.7794 10.342 12.3978 10.5 12 10.5C11.6022 10.5 11.2206 10.342 10.9393 10.0607C10.658 9.77936 10.5 9.39782 10.5 9M13.5 9C13.5 8.60218 13.342 8.22064 13.0607 7.93934C12.7794 7.65804 12.3978 7.5 12 7.5C11.6022 7.5 11.2206 7.65804 10.9393 7.93934C10.658 8.22064 10.5 8.60218 10.5 9M10.5 9H0.75"
                  stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <?php
    require "Modals/UserModal/layout.php";
    require "Modals/FilterModal/layout.php";
    ?>
</header>
<section class="users container wrapper">
    <ul class="users__list">
        <?php foreach ($users as $user): ?>
            <?php
            $data = [
                'id' => $user['id'],
                'user_name' => $user['user_name'],
                'city' => $user['city'],
                'age' => $user['age'],
                'online' => $user['online'],
                'photo' => $user['photo'],
                'distance' => $user['distance'] ?? '0',
                'message' => $user['message'],
            ];
            require "Components/UserCard/layout.php";
            ?>
        <?php endforeach; ?>
    </ul>
</section>
</body>
</html>
