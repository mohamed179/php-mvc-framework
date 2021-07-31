<?php

/**
 * @var $model \App\Models\User
 */

?>
<h1>Register</h1>
<form method="post" action="/register">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input id="firstname"
               type="text"
               name="firstname"
               value="<?= $model->firstname ?>"
               class="form-control<?= $model->hasError('firstname') ? ' is-invalid' : '' ?>">
        <?php if($model->hasError('firstname')): ?><div class="invalid-feedback">
             <?= $model->getFirstError('firstname') ?>
        </div><?php endif ?>
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input id="lastname"
               type="text"
               name="lastname"
               value="<?= $model->lastname ?>"
               class="form-control<?= $model->hasError('lastname') ? ' is-invalid' : '' ?>">
        <?php if($model->hasError('lastname')): ?><div class="invalid-feedback">
             <?= $model->getFirstError('lastname') ?>
        </div><?php endif ?>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email"
               type="email"
               name="email"
               value="<?= $model->email ?>"
               class="form-control<?= $model->hasError('email') ? ' is-invalid' : '' ?>">
        <?php if($model->hasError('email')): ?><div class="invalid-feedback">
             <?= $model->getFirstError('email') ?>
        </div><?php endif ?>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password"
               type="password"
               name="password"
               class="form-control<?= $model->hasError('password') ? ' is-invalid' : '' ?>">
        <?php if($model->hasError('password')): ?><div class="invalid-feedback">
             <?= $model->getFirstError('password') ?>
        </div><?php endif ?>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input id="confirm_password"
               type="password"
               name="confirm_password"
               class="form-control<?= $model->hasError('confirm_password') ? ' is-invalid' : '' ?>">
        <?php if($model->hasError('confirm_password')): ?><div class="invalid-feedback">
             <?= $model->getFirstError('confirm_password') ?>
        </div><?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>