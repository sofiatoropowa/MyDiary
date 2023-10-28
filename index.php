<?php
    require_once 'config/connection.php';
    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой дневничок</title>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <div class="modal-wrap"></div>
    <div class="container">
        <header>
            <div class="header">
                <a class="header__logo" href="/">
                    <img src="assets/images/Logo.png" alt="logo">
                </a>
                <button class="button button-dark button-dark--desktop create">Написать</button>
                <button class="button button-dark button-dark--mobile create"><img src="assets/images/icons/icon-create.svg" alt="logo"></button>
            </div>
        </header>

        <main>
            <div class="main">
                <div class="main-wrap">
                    <h1 class="main__title">Мой дневничок</h1>
                    <div class="main__filter">
                        <form method="post" action="">
                            <input type="hidden" name="sortType" id="sortType" value="new">
                            <button class="button button-filter
                            <?php
                            if (isset($_POST['sortType']) && !empty($_POST['sortType']) && $_POST['sortType'] != 'old') {
                                ?>
                                active
                                <?php
                            }
                            ?>
                            "
                            type="submit" id="filter-new">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H14M4 18H8" stroke="#050F28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 16L18 20M18 20L22 16M18 20L18 4" stroke="#88A1DE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Сначала новые</span>
                            </button>
                        </form>

                        <form method="post" action="">
                            <input type="hidden" name="sortType" id="sortType" value="old">
                            <button class="button button-filter
                            <?php
                            if (isset($_POST['sortType']) && !empty($_POST['sortType']) && $_POST['sortType'] == 'old') {
                                ?>
                                active
                                <?php
                            }
                            ?>
                            " type="submit" id="filter-old">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_4_999)">
                                    <path d="M4 6H20M4 12H14M4 18H8" stroke="#050F28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 8L18 4M18 4L22 8M18 4L18 20" stroke="#88A1DE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_4_999">
                                    <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                                <span>Сначала старые</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="notes" id="notes">
                    <?php
                        $sort = 'new';                 
                        if (isset($_POST['sortType']) && !empty($_POST['sortType'])) {
                            $sort = $_POST['sortType'];
                        }

                        if ($sort == 'old') {
                            $query = "SELECT * FROM `notes` ORDER BY `dateTime` DESC LIMIT $offset, 3";
                        } else {
                            $query = "SELECT * FROM `notes` ORDER BY `dateTime` ASC LIMIT $offset, 3";
                        }
                        $result = mysqli_query($connect, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $formattedDate = date('d.m.Y', strtotime($row['dateTime']));
                            $formattedTime = date('H:i', strtotime($row['dateTime']));
                            ?>
                            <div class="note">
                                <div>
                                    <h3 class="note__title"><?php echo $row['title']; ?></h3>
                                    <div class="note__text">
                                        <?php echo $row['text']; ?>
                                    </div>
                                </div>

                                <div class="note__footer">
                                    <div class="note__footer-date">
                                        <img src="assets/images/icons/date.svg" alt="date">
                                        <?php echo $formattedDate; ?>
                                    </div>
                                    <div class="note__footer-time">
                                        <img src="assets/images/icons/time.svg" alt="time">
                                        <?php echo $formattedTime; ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>

                <button class="button button-more" id="load-more">Показать больше</button>
            </div>

            <div class="modal-create">
                <h2 class="modal-create__title">Новая запись</h2>
                <button class="modal-create__icon" id="modal-close">
                    <img src="assets/images/icons/icon-close.svg" alt="close">
                </button>
                <form method="post" action="add.php">
                    <div class="modal-create__row">
                        <div class="modal-create__row-el">
                            <legend>Заголовок</legend>
                            <input type="text" name="title">
                        </div>
                        <div class="modal-create__row-el">
                            <legend>Дата</legend>
                            <input type="datetime-local" name="date">
                        </div>
                    </div>
                    <div class="modal-create__textarea">
                        <legend>Заметка</legend>
                        <textarea name="text" id="text"></textarea>
                    </div>
                    <button class="button button-dark" type="submit">Поделиться наболевшим</button>
                </form>
            </div>
        </main>

        <footer class="footer">
            <div class="footer__logo">Мой Дневничок</div>
        </footer>
    </div>

    <script src="index.js"></script>
</body>
</html>