<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="row">
            <?php include ROOT . '/views/user/sidebar.php'; ?>
        <div class="col-md-9 well admin-content" id="home">
            <p>
                Hello <?= $user->data()['user_name'];?>! This is a forked snippet.<br>
                It is for users, which use one-page layouts.
            </p>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>