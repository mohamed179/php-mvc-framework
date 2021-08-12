<?php

use App\Core\Forms\Form;

/**
 * @var $model \App\Models\LoginModel
 */

?>
<h1>Login</h1>
<?php $form = Form::begin(Form::ACTION_POST, '/login') ?>
    <?= $form->inputField($model, 'email')->emailInput(); ?>
    <?= $form->inputField($model, 'password')->passwordInput(); ?>
    <button type="submit" class="btn btn-primary">Login</button>
<?php $form->end(); ?>