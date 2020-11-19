<?php

class Form {
    private $formHeading;
    public $isRegisterType;
    public $formType;

    public $callToAction;
    public $actionLink;

    public function __construct($formType) {
        if ($formType === "register") {
            $this->isRegisterType = true;
            $this->formType = "Register";
            $this->callToAction = "Already have an account?" . "&nbsp";
            $this->actionLink = "Login";
        } else if ($formType === "login") {
            $this->isRegisterType = false;
            $this->formType = "Login";
            $this->callToAction = "Don't have an account?" . "&nbsp";
            $this->actionLink = "Register";
        } else {
            var_dump('Form type can only be "login" or "register" ');
        }
    }

    public function setHeading($headingText) {
        $this->formHeading = $headingText;
    }

    public function getHeading() {
        return $this->formHeading;
    }

    public function html() {
        ?>

        <div class="form-container">
        <?php if($this->getHeading()) : ?>
            <h1> <?= $this->getHeading() ?> </h1>
        <?php endif; ?>
    
        <form method="POST">
            
            <?php if($this->isRegisterType) : ?>
                <input type="text" placeholder="Username" name="username">
            <?php endif; ?>
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Password" name="password">
            <button id="login-button" type="submit"> <?= $this->formType ?> </button>
            <div class="form-question">
                <p> <?= $this->callToAction ?> </p><a class="signup-register" href="#"> <?= $this->actionLink ?> </a>
            </div>
        </form>
        </div>

        <?php
    }
}

?>