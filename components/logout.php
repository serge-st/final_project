<?php

class Logout {

    public function html() {
        ?>
            <form method="POST">
            <input type="hidden" name="logout">
            <button type="submit" class="btn">Logout</button>
            </form>
        <?php
    }
}
?>