# Тестовое задание:
Создайте простое веб-приложение на Laravel 10, которое будет выполнять следующие функции:

## Авторизация пользователей:

Создайте таск борду с авторизацией по логину(не емейл) и паролю

## Веб вью после логина:
- Просмотр задач
- Создание задачи
- Апдейт задачи
- Удаление задачи

(Все должно работать через API)

В шапке выводим калькуляцию всех задач и выполненых задач (Выполненые задачи 0/10)

## Работа с API:
- Обязательная авторизация для апи роутов
- Реализуйте API для CRUD-операций с сущностью "Задачи".
- Апи должно иметь 4 роута: создание задачи, апдейт задачи, удаление задачи, получить список задач

## Создание тело запроса:
- Название.
- Описание.
- Дата выполнения
- Статус (выполнена/не выполнена).

## Апдейт тело запроса:
- Название.
- Описание.
- Дата выполнения
- Статус (выполнена/не выполнена).

## Удаление тело запроса:
- ид записи

## Получение с фильтрами в запросе:
- статус
- название
- ид

## Интеграция с Telegram API (не использовать библиотеки Laravel):
- уведомление в телеграм чат, про создание задачи

## Создать веб интерфейс:
- Создайте простой веб-интерфейс с использованием HTML5, CSS3 и JavaScript (без использования frontend-фреймворков) адаптивный под мобильные устройства.
Используйте jQuery для работы с AJAX-запросами к API.

## Интеграция с гугл таблицами:
- При создании задачи, задача должна вноситься в приватную гугл таблицу

## Итоги тестового задания:
- Юзер может Просматривать, создавать, редактировать и удалять задачи как с интерфейса веб приложения так и средствами API (для теста, например через Postman).

## Требования к выполнению:
- Предоставьте исходный код и инструкции по запуску.
- Код должен быть размещен на в Git репозитории.
