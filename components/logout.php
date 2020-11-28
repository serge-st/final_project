<?php

class Logout {

    public function html() {
        ?>
            <form method="POST" class="logout-form">
                <input type="hidden" name="logout">
                <button type="submit" class="btn wide-btn" id="logout-button">Logout</button>
            </form>
        <?php
    }
}
?>