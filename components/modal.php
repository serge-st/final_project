<?php

class PopUpModal {
    private $modalMessage;
    private $closeManualy;

    public function setMessage($messageText) {
        $this->modalMessage = $messageText;
    }

    public function setCloseManually($boolean) {
        $this->closeManualy = $boolean;
    }

    public function getClosing(){
        return $this->closeManualy;
    }

    public function getMessage(){
        return $this->modalMessage;
    }

    public function html(){
        ?>
        <div class="popup-modal-wrapper">
                <div class="popup-modal">
                    <h3> <?= $this->getMessage() ?> </h3>

                    <?php if($this->getClosing()) : ?>
                        <button class="btn wide-btn popup-btn" onclick="closePopup()">Close</button>
                    <?php endif; ?>
                </div>
        </div>
        <script src="./js/components/closePopUp.js"></script>
        <?php
    }
}

?>