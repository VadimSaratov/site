<section>
<div class="col-md-12">
    <h1>
<?= $user->data()['user_name'];?>
    </h1>
</div>
    <nav>
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" id="menu">
                <li class="active"><a href="/account/">Home</a></li>
                <li><a href="#">Профиль<span class="caret"></span></a>
                    <ul class="nav">
                        <li><a href="/account/edit" >Редактировать данные</a></li>
                        <li><a href="/account/edit" >Изменить пароль</a></li>
                    </ul>
                </li>
                <li><a href="#">Заказы</a></li>
            </ul>
        </div>
    </nav>
</section>