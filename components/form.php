<?php

class Form {
    private $formHeading;
    public $formType;

    public $callToAction;
    public $actionLink;

    public function __construct($formType) {
        if ($formType === "register") {
            $this->formType = "Register";
            $this->callToAction = "Already have an account?" . "&nbsp";
            $this->actionLink = "login";
        } else if ($formType === "login") {
            $this->formType = "Login";
            $this->callToAction = "Don't have an account?" . "&nbsp";
            $this->actionLink = "register";
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
            
            <?php if($this->formType === "Register") : ?>
                <input type="text" placeholder="Username" name="username" required>
            <?php endif; ?>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <button id="login-button" type="submit"  class="btn"> <?= $this->formType ?> </button>
            <div class="form-question">
                <p> <?= $this->callToAction ?> </p><a class="signup-register" href=" <?= '/final_project/' . $this->actionLink . '.php' ?> "> <?= $this->actionLink ?> </a>
            </div>
        </form>
        </div>

        <?php
    }
}

?>