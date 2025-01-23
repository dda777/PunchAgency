import './bootstrap.js'

$(document).ready(function () {
    function renderButton() {
        return `
            <div class="flex">
                 <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2" id="view-task">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </button>

                <button class="focus:outline-none text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 edit-task" id="edit-task">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                       <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                    </svg>
                </button>

                <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" id="delete-task">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                    </svg>
                </button>
            </div>
        `;
    }

    function loadTasks() {
        $.ajax({
            url: '/api/tasks',
            method: 'GET',
            success: function (data) {
                let doneTasks = $('#done_tasks');
                let incompleteTasks = $('#incomplete_tasks');
                let overdueTasks = $('#overdue_task');
                doneTasks.empty();
                incompleteTasks.empty();
                overdueTasks.empty();
                let completedTasks = 0;
                data.data.forEach(task => {
                    let done_at = '';
                    if (task.done_at) {
                        done_at = new Date(Date.parse(task.done_at));
                        done_at = done_at.toISOString().substring(0, 10);
                    }

                    if (task.is_done) {
                        completedTasks++;
                        $('#done_tasks').append(`
                        <li data-id="${task.id}">
                            <span class="text-wrap break-all pr-6">${task.name} | Статус -  Виконана | Дата виконання - ${done_at}</span>
                            ${renderButton()}
                        </li>
                    `);
                    } else {
                        if (done_at < new Date().toISOString().substring(0, 10)) {
                            $('#overdue_task').append(`
                                <li data-id="${task.id}">
                                    <span class="text-pretty break-all pr-6">${task.name} | Статус -  Протермінована | Дата коли планував виконати - ${done_at ? done_at : 'Невідома'} </span>
                                    ${renderButton()}
                                </li>
                            `);
                        }
                        $('#incomplete_tasks').append(`
                        <li data-id="${task.id}">
                            <span class="text-pretty break-all pr-6">${task.name} | Статус -  Не виконана | До коли треба виконати - ${done_at} </span>
                            ${renderButton()}
                        </li>
                    `);
                    }


                });
                if (doneTasks.children().length === 0) {
                    doneTasks.append('<li>Немає виконаних задач</li>');
                }
                if (incompleteTasks.children().length === 0) {
                    incompleteTasks.append('<li>Немає невиконаних задач</li>');
                }
                if (overdueTasks.children().length === 0) {
                    overdueTasks.append('<li>Немає протермінованих задач</li>');
                }
                $('#task-summary').text(`Виконані задачі: ${completedTasks}/${data.data.length}`);
            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    }

    $('#settings-form').on('submit', function (event) {
        event.preventDefault();
        const settingsData = {
            google_auth_data: $('#google_auth_data').val(),
            telegram_auth_data: $('#telegram_auth_data').val()
        };
        $.ajax({
            url: '/api/user/settings',
            method: 'PUT',
            data: settingsData,
            success: function () {
                showMessage('success', 'Налаштування збережено');
                $('#settings-form-modal').addClass('hidden');
            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    });

    $('#new-task-form').on('submit', function (event) {
        event.preventDefault();
        const taskId = $(this).data('task-id');
        const taskData = {
            name: $('#title').val(),
            description: $('#description').val(),
            done_at: $('#done_at').val(),
            is_done: $('#is_done').val()
        };
        const method = taskId ? 'PUT' : 'POST';
        const url = taskId ? `/api/tasks/${taskId}` : '/api/tasks/store';
        if (taskId) taskData.id = taskId;
        $.ajax({
            url: url,
            method: method,
            data: taskData,
            success: function () {
                loadTasks();
                if (taskId) {
                    showMessage('success', `Задачу з id - ${taskId} оновлено`);
                } else {
                    showMessage('success', 'Задачу створено');
                }
                let taskForm = $('#new-task-form');
                taskForm[0].reset();
                $('#task-form-modal').addClass('hidden');
                taskForm.removeData('task-id');
            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    });
    let taskBlock = $('#done_tasks, #incomplete_tasks, #overdue_task');

    taskBlock.on('click', '#edit-task', function () {
        const taskId = $(this).parent().parent().data('id');
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'GET',
            success: function (task) {
                let done_at = '';
                if (task.done_at) {
                    done_at = new Date(Date.parse(task.done_at));
                    done_at = done_at.toISOString().substring(0, 10);
                }

                $('#title').val(task.name);
                $('#description').val(task.description);
                $('#done_at').val(done_at);
                $('#is_done').val(task.is_done);
                $('#task-form-modal').removeClass('hidden');
                $('#new-task-form').data('task-id', taskId);
                $('#new-task-form button').text('Оновити задачу');

            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    });

    $('#settings').on('click', function () {
        $.ajax({
            url: `/api/user/settings`,
            method: 'GET',
            success: function (settings) {
                $('#google_auth_data').val(JSON.stringify(settings.data.google_auth_data));
                $('#telegram_auth_data').val(JSON.stringify(settings.data.telegram_auth_data));
                $('#settings-form-modal').removeClass('hidden');
            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    });

    taskBlock.on('click', '#view-task', function () {
        const taskId = $(this).parent().parent().data('id');
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'GET',
            success: function (task) {
                let done_at = '';
                if (task.done_at) {
                    done_at = new Date(Date.parse(task.done_at));
                    done_at = done_at.toISOString().substring(0, 10);
                }

                $('#view_title').text(task.name);
                $('#view_description').text(task.description);
                $('#view_done_at').text(done_at);
                $('#view_is_done').text(task.is_done ? 'Виконана' : done_at && done_at < new Date().toISOString().substring(0, 10) ? 'Протермінована' : 'Не виконана');
                $('#view_id').text(task.id);
                $('#task-view-modal').removeClass('hidden');
            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    });

    taskBlock.on('click', '#delete-task', function () {
        const taskId = $(this).parent().parent().data('id');
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'DELETE',
            success: function () {
                showMessage('success', `Задачу з id ${taskId} видалено`);
                loadTasks();
            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    });

    $('#logout').on('click', function () {
        $.ajax({
            url: `/api/auth/logout`,
            method: 'POST',
            success: function () {
                location.reload();
            },
            errors: function ($xhr) {
                showMessage('error', $xhr.responseJSON.message);
            }
        });
    });

    loadTasks();

    $('#create-task-form-modal').on('click', function () {
        $('#title').val(null);
        $('#description').val(null);
        $('#done_at').val(null);
        $('#is_done').val(null);
        $('#new-task-form button').text('Створити задачу');
        $('#task-form-modal').removeClass('hidden');
    });

    $('#close-task-form-modal').on('click', function () {
        $('#task-form-modal').addClass('hidden');
    });

    $('#close-view-modal').on('click', function () {
        $('#task-view-modal').addClass('hidden');
    });

    $('#close-btn-settings-form-modal, #close-settings-form-modal').on('click', function () {
        $('#settings-form-modal').addClass('hidden');
    });
});
