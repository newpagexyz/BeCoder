
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BeCoder</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/null.css">

    <link rel="stylesheet" href="../style/nav.css">

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <link rel="shortcut icon" href="../icon/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../style/reg.css">
    <link rel="stylesheet" href="../style/null.css">

    <link rel="stylesheet" href="../style/nav.css">
</head>
	<body>
		<div id="app">
    <div class="wrapper">
        <div class="nav">
        <div class="container">


                <div class="nav__row">
                    <div class="null">
                        <div class="logo__list">
                        <div><a href="" class="nav__logo"><img src="../icon/logo.svg"></a></div>

                        </div>
                    </div>
                    <div class="nav__menu menu">
                        <div class="menu__icon icon__menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <nav class="menu__body">
                            <ul class="menu__list">
                                <li><a href="" class="menu__link">Профиль</a></li>
                                <li><a href="" class="menu__link">Проекты</a></li>
                                <li><a href="" class="menu__link">Статистика</a></li>
                                <li><a href="" class="menu__link">Контакты</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nav__actions act-nav">
                       <a class="act-nav__region"><span>Поиск</span></a>
                    </div>
            </div>
            </div>
        </div>

<?php
	if(isset($_POST['name']) AND isset($_POST['surname']) AND isset($_POST['email']) AND isset($_POST['password'])){
		include_once '../main.php';
		$module=new Main();
		if($module->reg_user($_POST['email'],$_POST['password'],$_POST['name'],$_POST['surname'])){
			echo"Please check your email";
		}
		else{
			echo"Email already registered";
		}
	}
	else{
		echo'
		<form method="post" action="" class="form-reg">
		<div class="tabs__body">
			<div class="tabs__block" id="tab_02">
								<div class="tabs__top">
										<div class="tabs__title">Регистрация</div>
										<div class="tabs__red"></div>
								</div>
								<hr>
								<div class="tabs__info">
										<div class="tabs__list tabs-list">
												<div class="tabs-list__conent">
														<div class="tabs-list__title tabs-list__item">Имя</div>
														<div class="tabs-list__text tabs-list__item">Фамилия</div>
														<div class="tabs-list__email tabs-list__item">E-mail</div>
									<div class="tabs-list__password tabs-list__item">Пароль</div>
												</div>
										</div>
										<div class="tabs__input tabs-input">
												<div class="tabs-input__text1 tabs-input__item"><input type="text" placeholder="Имя"
																																							 tabindex="1"
																																							 name="name" required></div>
												<div class="tabs-input__text2 tabs-input__item"><input type="text" required placeholder="Фамилия"
																																							 tabindex="2"
																																							 name="surname"></div>
												<div class="tabs-input__text2 tabs-input__item"><input type="email" required placeholder="E-mail"
																																							 tabindex="3"
																																							 name="email"></div>
												<div class="tabs-input__text2 tabs-input__item"><input type="password" required placeholder="Пароль"
																																							 tabindex="4"
																																							 name="password"></div>
										</div>
								</div>

								<div class="submit">
									<input type="submit" class="submit__btn" tabindex="5" value="Зарегистрироваться">
									<p>Регистрируясь, Вы соглашаетесь с <a href="#" style="text-decoration: underline; color: red;">правилами сервиса.</a></p>
									<a href="/auth/" style="padding-top: 1em">Вход</a>
								</div>
						</div>
		</form>
		';
	}
?>

</div>
</div>
<script type="text/javascript" src="../js/scrip.js"></script>
</body>
</html>
