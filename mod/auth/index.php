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
    <link rel="stylesheet" href="../style/auth.css">
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
                                <li><a href="" class="menu__link">Статистика</a></li>
                                <li><a href="" class="menu__link">О проекте</a></li>
                                <li><a href="" class="menu__link">Контакты</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nav__actions act-nav">
                       <a class="act-nav__region"><span>поиск</span></a>
                    </div>
            </div>
            </div>
        </div>
				<?php
	if(isset($_POST['email']) AND isset($_POST['password'])){
		include_once '../main.php';
		$module=new Main();
		if($module->auth($_POST['email'],$_POST['password'])){
      if(isset($_COOKIE['redir'])){
        echo "<script>window.location='/".$_COOKIE['redir']."';</script>";
      }else{
        echo "<script>window.location='/';</script>";
      }
		}
		else{
			echo "Something went wrong((<br><br><form method='post' action=''>
				Email<input type='email' name='email'><br>
				Password<input type='password' name='password'><br>
				<input type='submit'>
			</form>(";
		}
	}
	else{
		echo'
		<form method="post" action="" class="form-reg">
		<div class="tabs__body">
			<div class="tabs__block" id="tab_02">
								<div class="tabs__top">
										<div class="tabs__title">Авторизация</div>
										<div class="tabs__red"></div>
								</div>
								<hr>
								<div class="tabs__info">
										<div class="tabs__list tabs-list">
												<div class="tabs-list__conent">
														<div class="tabs-list__email tabs-list__item">E-mail</div>
									<div class="tabs-list__password tabs-list__item">Пароль</div>
												</div>
										</div>
										<div class="tabs__input tabs-input">
												<div class="tabs-input__text1 tabs-input__item"><input required type="email" placeholder="E-mail"
																																							 tabindex="1"
																																							 name="name"></div>

												<div class="tabs-input__text2 tabs-input__item"><input required type="password" placeholder="Пароль"
																																							 tabindex="2"
																																							 name="password"></div>
										</div>
								</div>

								<div class="submit">
									<input type="submit" class="submit__btn" value="Войти">
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
