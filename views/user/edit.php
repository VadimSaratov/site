<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
        <div class="row">
            <?php include ROOT . '/views/user/sidebar.php'; ?>
            <div class="col-md-6 well admin-content" id="home">

<?php if (isset($result)): ?>
                 <p>Данные успешно изменены!</p>
<?php else:?>
    <?php if (isset($errors) && is_array($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> - <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="#" method="post" class="form-horizontal">
        <fieldset>
            <legend>Редактировать данные</legend>
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Имя: </label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-md" id="name" name="name" placeholder="Имя" value="<?= $user->data()['user_name'];?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email: </label>
                <div class="col-md-8">
                    <input type="email" class="form-control input-md" id="email" name="email" placeholder="E-mail" value="<?=$user->data()['email'];?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Введите пароль: </label>
                <div class="col-md-8">
                    <input type="password" class="form-control input-md" id="password" name="password" placeholder="Пароль"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-8">
                    <input type="hidden" class="form-control input-md" name="token" value="<?= Token::generate_token();?>" />
                    <button type="submit" id="submit" name="submit" class="btn btn-success">Изменить</button>
                </div>
            </div>
        </fieldset>
    </form>

<?php endif; ?>
            </div>
        </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>