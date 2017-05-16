<?php

//Константы ошибок
define('ERROR_NOT_FOUND', 1);
define('ERROR_TEMPLATE_EMPTY', 2);

/**
 * Обрабатывает указанный шаблон, подставляя нужные переменные
*/
function renderPage($page_name, $variables = [])
{
    $file = TPL_DIR . "/" . $page_name . ".tpl";

    if (!is_file($file)) {
      	echo 'Template file "' . $file . '" not found';
      	exit(ERROR_NOT_FOUND);
    }

    if (filesize($file) === 0) {
      	echo 'Template file "' . $file . '" is empty';
      	exit(ERROR_TEMPLATE_EMPTY);
    }

    // если переменных для подстановки не указано, просто
    // возвращаем шаблон как есть
    if (empty($variables)) {
	      $templateContent = file_get_contents($file);
    }
    else {
      	$templateContent = file_get_contents($file);

        // заполняем значениями
        $templateContent = pasteValues($variables, $page_name, $templateContent);
    }

    return $templateContent;
}

/**
 * Расстановка переменных в шаблоне
 * @param $variables
 * @param $page_name
 * @param $templateContent
 * @return mixed
 */
function pasteValues($variables, $page_name, $templateContent){
    foreach ($variables as $key => $value) {
            // собираем ключи
            $p_key = '{{' . strtoupper($key) . '}}';

            if(is_array($value)){
                // замена массивом
                $result = "";
                foreach ($value as $value_key => $item){
                    $itemTemplateContent = file_get_contents(TPL_DIR . "/" . $page_name ."_".$key."_item.tpl");

                    foreach($item as $item_key => $item_value){
                        $i_key = '{{' . strtoupper($item_key) . '}}';

                        $itemTemplateContent = str_replace($i_key, $item_value, $itemTemplateContent);
                    }

                    $result .= $itemTemplateContent;
                }
            }
            else
                $result = $value;

            $templateContent = str_replace($p_key, $result, $templateContent);
    }

    return $templateContent;
}

/**
 * Подготовка переменных для разных страниц
 * @param $page_name
 * @return array
 */
function prepareVariables($page_name){
    $vars = [];
    switch ($page_name){
        case "index":
            $vars["greetings"] = "";

            if(isset($_SESSION['user']['user_name']))
                $vars["greetings"] = "Привет, ". $_SESSION['user']['user_name'];
        case "news":
            $vars["newsfeed"] = getNews();
            $vars["test"] = 123;
            break;
        case "newspage":
            $content = getNewsContent($_GET['id_news']);
            $vars["news_title"] = $content["news_title"];
            $vars["news_content"] = $content["news_content"];

            break;

        case "cabinet":

            if (!alreadyLoggedIn()){
                $vars["AUTHERROR"] = 'Сначала нужно авторизоваться!';
                $vars["GREATING"] = '';
                $vars["LOGIN"] = '';
                break;
            } else {
                $vars["AUTHERROR"] = '';
                $vars["GREATING"] = 'Добро пожаловать,'.$_SESSION['user']['user_name'];
                $vars["LOGIN"] = 'Ваш логин для входа '.$_SESSION['user']['user_login'];
            }
            break;
        case "catalog":
            $vars["catalogfeed"] = getGoods();
            $vars["cname"] = 'Каталожище';
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                foreach ($_POST as $key => $value){
                    $_SESSION[$key] = $_SESSION[$key] + $value;
                }
            }

            break;
        case "goods":
            $content = getGoodsContent($_GET['id_good']);
            $vars["good_title"] = $content["good_title"];
            $vars["good_content"] = $content["good_content"];
            break;

            case "buy":
            if(isset($_POST['clear']))
                $vars["buyfeed"] = ClearBuy();
            else
               $vars["buyfeed"] = FeedBuy();
            break;


        case "feedback":
            if(isset($_POST['name']))
                $vars["response"] = setFeedback();
            else
                $vars["response"] = "";

            $vars["feedbackfeed"] = getFeedbacksFeed();

            break;
        case "login":
            // если уже залогинен, то выбрасываем на главную
            if(alreadyLoggedIn()){
                header("Location: /");
            }

            // если есть куки, то авторизуем сразу
            if(checkAuthWithCookie()){
                header("Location: /");
            }
            // иначе пробуем авторизовать по логину и паролю
            else{
                $vars["autherror"] = "";
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if(!authWithCredentials()){
                        $vars["autherror"] = "Неправильный логин/пароль";
                        unset($_SESSION["user"]);
                        session_destroy();
                    }
                    else{
                        header("Location: /");
                    }
                }


                /*$vars["username"] = "admin";
                $vars["password"] = hashPassword("12345");*/
            }
            break;
        case "register":
            // если уже залогинен, то выбрасываем на главную
            if(alreadyLoggedIn()){
                header("Location: /");
            }

            // если есть куки, то авторизуем сразу
            if(checkAuthWithCookie()){
                header("Location: /");
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   $vars["autherror"] = setReg();
                }
                else {
                    $vars["autherror"] = "";

                }
                break;
            }
        case "logout":
            unset($_SESSION["user"]);
            session_destroy();
            header("Location: /");
            break;
    }

    return $vars;
}

/**
 * Логирование
 * @param $s
 * @param string $suffix
 * @return mixed|string
 */
function _log($s, $suffix='')
	{
		if (is_array($s) || is_object($s)) $s = print_r($s, 1);
		$s="### ".date("d.m.Y H:i:s")."\r\n".$s."\r\n\r\n\r\n";

		if (mb_strlen($suffix))
			$suffix = "_".$suffix;
			
		      _writeToFile($_SERVER['DOCUMENT_ROOT']."/_log/logs".$suffix.".log",$s,"a+");

		return $s;
	}

/**
 * Запись в файл
 * @param $fileName
 * @param $content
 * @param string $mode
 * @return bool
 */
function _writeToFile($fileName, $content, $mode="w")
	{
		$dir=mb_substr($fileName,0,strrpos($fileName,"/"));
		if (!is_dir($dir))
		{
			_makeDir($dir);
		}

		if($mode != "r")
		{
			$fh=fopen($fileName, $mode);
			if (fwrite($fh, $content))
			{
				fclose($fh);
				@chmod($fileName, 0644);
				return true;
			}
		}

		return false;
	}

/**
 * Создание директории
 * @param $dir
 * @param bool $is_root
 * @param string $root
 * @return bool|string
 */
function _makeDir($dir, $is_root = true, $root = '')
        {
            $dir = rtrim($dir, "/");
            if (is_dir($dir)) return true;
            if (mb_strlen($dir) <= mb_strlen($_SERVER['DOCUMENT_ROOT'])) 
return true;
            if (str_replace($_SERVER['DOCUMENT_ROOT'], "", $dir) == $dir) 
return true;

            if ($is_root)
            {
                $dir = str_replace($_SERVER['DOCUMENT_ROOT'], '', $dir);
                $root = $_SERVER['DOCUMENT_ROOT'];
            }
            $dir_parts = explode("/", $dir);

            foreach ($dir_parts as $step => $value)
            {
                if ($value != '')
                {
                    $root = $root . "/" . $value;
                    if (!is_dir($root))
                    {
                        mkdir($root, 0755);
                        chmod($root, 0755);
                    }
                }
            }
            return $root;
        }

// блок нвоостей
function getNews(){
    $sql = "SELECT id_news, news_title, news_preview FROM news";
    $news = getAssocResult($sql);

    return $news;
}

function getNewsContent($id_news){
    $id_news = (int)$id_news;

    $sql = "SELECT * FROM news WHERE id_news = ".$id_news;
    $news = getAssocResult($sql);

    $result = [];
    if(isset($news[0]))
        $result = $news[0];

    return $result;
}

// каталог

function getGoods(){
    $sql = "SELECT id_good, good_title, good_preview FROM catalog";
    $goods = getAssocResult($sql);

    return $goods;
}

function getGoodsContent($id_good){
    $id_good = (int)$id_good;

    $sql = "SELECT * FROM catalog WHERE id_good = ".$id_good;
    $goods = getAssocResult($sql);

    $result = [];
    if(isset($goods[0]))
        $result = $goods[0];

    return $result;
}

function ClearBuy(){

    foreach ($_SESSION as $key => $value){
        if (!strpos($key,'count')){
            unset($_SESSION[$key]);
        }

    }
    return 'Корзина очищена';
}

function FeedBuy(){

    $i=0;
    foreach ($_SESSION as $key => $value){
        if (!strpos($key,'count')){
            $id = str_replace('count','',$key);
            $sql = "SELECT good_title FROM catalog WHERE id_good=".$id;
            $res = getRowResult($sql);
            $goods[$i]['good'] = $res['good_title'];
            $goods[$i]['count'] = $value;
            $i++;
        }

    }
    if ($goods == NULL) $goods = 'Корзина пуста';

    return $goods;
}


// блок отзывов
function getFeedbacksFeed(){
    $sql = "SELECT * FROM feedback";
    $feed = getAssocResult($sql);

    return $feed;
}

function setFeedback(){
    $response = "";
    $db_link = getConnection();

    $feedback_user = mysqli_real_escape_string($db_link, (string)htmlspecialchars(strip_tags($_POST['name'])));
    $feedback_body = mysqli_real_escape_string($db_link, (string)htmlspecialchars(strip_tags($_POST['review'])));




    $sql = "INSERT INTO feedback (feedback_body, feedback_user) VALUES('$feedback_body', '$feedback_user')";
    $res = executeQuery($sql, $db_link);

    if(!$res)
        $response = "Произошла ошибка!";
    else
        $response = "Отзыв добавлен";

    return $response;
}

// блок функций авторизации


    function setReg(){
        $response = "";
        $db_link = getConnection();

        $name = mysqli_real_escape_string($db_link, (string)htmlspecialchars(strip_tags($_POST['name'])));
        $login = mysqli_real_escape_string($db_link, (string)htmlspecialchars(strip_tags($_POST['login'])));
        $password = mysqli_real_escape_string($db_link, (string)htmlspecialchars(strip_tags($_POST['password'])));
        $password = hashPassword($password);



        $sql = "INSERT INTO user (user_name, user_login, user_password) VALUES('$name','$login','$password')";
        $res = executeQuery($sql, $db_link);

        if(!$res)
            $response = "Произошла ошибка! Возможно такой пользователь уже существует.";
        else
            $response = "Пользователь добавлен.";

        return $response;
    }



/**
 * валидация пользовательского куки
 * @return bool
 */
function checkAuthWithCookie(){
    $result = false;

    if(isset($_COOKIE['id_user']) && isset($_COOKIE['cookie_hash'])){
        // получаем данные пользователя по id
        $link = getConnection();
        $sql = "SELECT id_user, user_name, user_password,user_login FROM user WHERE id_user = '".mysqli_real_escape_string($link, $_COOKIE['user_id'])."'";
        $user_data = getRowResult($sql, $link);

        if(($user_data['user_password'] !== $_COOKIE['user_hash']) || ($user_data['id_user'] !== $_COOKIE['id_user'])){
            setcookie("id", "", time() - 3600*24*30*12, "/");
            setcookie("hash", "", time() - 3600*24*30*12, "/");
        }
        else{
            header("Location: /");
        }

    }

    return $result;
}

/**
 * авторизация через логин и пароль
 */
function authWithCredentials(){
    $username = $_POST['login'];
    $password = $_POST['password'];

    // получаем данные пользователя по логину
    $link = getConnection();
    $sql = "SELECT id_user, user_name, user_password,user_login FROM user WHERE user_login = '".mysqli_real_escape_string($link, $username)."'";

    /*$user_data = executeQuery($sql, $link);*/
    $user_data = getRowResult($sql, $link);


    $isAuth = 0;

    // проверяем соответствие логина и пароля

    if ($user_data) {

        if(checkPassword($password, $user_data['user_password'])){
            $isAuth = 1;
        }
    }

    // если стояла галка, то запоминаем пользователя на сутки
    if(isset($_POST['rememberme']) && $_POST['rememberme'] == 'on'){
        setcookie("id_user", $user_data['id_user'], time()+86400);
        setcookie("cookie_hash", $user_data['user_password'], time()+86400);
    }

    // сохраним данные в сессию
    $_SESSION['user'] = $user_data;

    return $isAuth;
}

function hashPassword($password)
{
    $salt = md5(uniqid(SALT2, true));
    $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
    /*echo crypt($password, '$2a$08$' . $salt);*/
    return crypt($password, '$2a$08$' . $salt);
}

/**
 * Сверяем введённый пароль и хэш
 * @param $password
 * @param $hash
 * @return bool
 */
function checkPassword($password, $hash){

    return crypt($password, $hash) === $hash;
}

function alreadyLoggedIn(){

    return isset($_SESSION['user']);
}

