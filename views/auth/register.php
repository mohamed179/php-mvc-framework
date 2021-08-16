<?php

use Mohamed179\Core\Forms\Form;

/**
 * @var $model \App\Models\User
 */

?>
<h1>Register</h1>
<?php $form = Form::begin(Form::ACTION_POST, '/register'); ?>
    <?= $form->inputField($model, 'firstname'); ?>
    <?= $form->inputField($model, 'lastname'); ?>
    <?= $form->inputField($model, 'email')->emailInput(); ?>
    <?= $form->inputField($model, 'password')->passwordInput(); ?>
    <?= $form->inputField($model, 'confirm_password')->passwordInput(); ?>
    <button type="submit" class="btn btn-primary">Register</button>
<?php $form->end(); ?>