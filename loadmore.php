<?php
    require_once 'config/connection.php';

    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;

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