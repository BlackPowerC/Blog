<div class="row">
    <?php echo form($action, "POST") ?>
    <fieldset>
        <legend>Informations</legend>
        <!-- Pseudo -->
        <div class="form-group">
            <?php
            echo form_label("Pseudo", "pseudo");
            echo form_input([
                "type" => "text",
                "class" => "form-control",
                "placeholder" => "Saisir pseudo",
                "name" => "pseudo",
                "required" => ""
            ]);
            ?>
        </div>
        <!-- Email -->
        <div class="form-group">
            <?php
            echo form_label("Email", "email");
            echo form_input([
                "type" => "e-mail",
                "class" => "form-control",
                "placeholder" => "Saisir adresse électonique",
                "name" => "email",
                "required" => ""
            ]);
            ?>
        </div>
    </fieldset>
    <div class="form_control_content" style="width: 200px; margin: auto">
        <?php
        echo form_input(["type" => "submit", "class" => "btn btn-primary"]);
        echo form_input(["type" => "reset", "class" => "btn btn-primary"]);
        ?>
    </div>
</form>
</div>