Описание проекта:

В данном проекте я реализовал небольшое API.
Суть его заключается в том, чтобы сохранять переданную информацию о пользователе, а именно: ФИО, Компания, Телефон пользователя и т.д. Такая небольшая записная книжка. Данную информацию можно обновлять, читать, удалять, посылая соответствующие запросы. Я не использовал методы авторизации пользователя, поэтому, запрос может вводить, грубо говоря, каждый.

Я создал маршруты в файле api.php папки resources простой командой Route::resource('v1/notebook',[NotebookController::class]);
Данная команда автоматически ссылается на методы контроллера NotebookController для работы с запросами:create,read,update,delete. Командой в терминале - php artisan make:controller NotebookController --resource я создал контроллер со всеми необходимыми функциями.

Запросы я посылал с помощью инструмента тестирования API - Postman.

Проект запускал через Docker.

Для просмотра сохраненных записей я использовал программу для работы с базами данных TablePlus.
