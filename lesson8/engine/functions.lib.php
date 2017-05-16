<?php

//Константы ошибок
define('ERROR_NOT_FOUND', 1);
define('ERROR_TEMPLATE_EMPTY', 2);

/**
 * Подготовка переменных для разных страниц
 * @param $page_name
 * @return array
 */
function prepareVariables($page_name, $action = ""){
    $vars = [
        "title" => SITE_TITLE,
        "logout" => ""
    ];

    if(isset($_SESSION['user'])) {
        $vars["greetings"] = "Привет, " . $_SESSION['user']['user_name'];
        $vars["logout"] = renderPage("logout_block");
    }
    else{
        $vars["logout"] = renderPage("login_block");
    }

    switch ($page_name){
        case "index":
            $vars["greetings"] = "";

            break;
        case "news":
            $vars["newsfeed"] = getNews();
            $vars["test"] = 123;
            break;
        case "newspage":
            $content = getNewsContent($_GET['id_news']);
            $vars["news_title"] = $content["news_title"];
            $vars["news_content"] = $content["news_content"];
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
                    }
                    else{
                        header("Location: /");
                    }
                }


                $vars["username"] = "admin";
                $vars["password"] = hashPassword("12345");
            }
            break;
        case "logout":
            unset($_SESSION["user"]);
            session_destroy();
            header("Location: /");
            break;
        case "cabinet":
            prepareCabinet();
            break;
        case "basket":
            if($action == "")
                prepareBasketPage($vars);
            else
                $vars['response'] = doActionWithBasket($action);

            break;
        case "catalogue":
            print_r($_POST);
            if (isset($_POST['id_good'])){
                echo doActionWithBasket('add');
            }
            prepareCataloguePage($vars);
            break;
    }

    // корзина есть везде, но только для залогиненных пользователей
    $vars["basket"] = prepareBasketBlock();

    // генерируем переменные для статических блоков
    $clear_vars = $vars;
    $clear_vars["main_menu_links"] = getMainMenuLinks();
    $clear_vars["main_menu"] = renderPage("main_menu_block", $clear_vars);

    $vars["header"] = renderPage("header_block", $clear_vars);
    $vars["footer"] = renderPage("footer_block", $clear_vars);

    return $vars;
}

function getMainMenuLinks(){
    return [
        [
          "link" => "/",
          "link_title" => "Главная"
        ],
        [
            "link" => "/catalogue/",
            "link_title" => "Каталог"
        ],
        [
            "link" => "/feedback/",
            "link_title" => "Отзывы"
        ],
    ];
}
