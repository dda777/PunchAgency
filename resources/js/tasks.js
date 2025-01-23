import './bootstrap.js'

$(document).ready(function() {
    function renderButton() {
        return `
            <div class="flex">
                <button class="focus:outline-none text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 edit-task">
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
            url: '/api/tasks?page=1&limit=10',
            method: 'GET',
            success: function(data) {
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
                        done_at  = new Date(Date.parse(task.done_at));
                        done_at = done_at.toISOString().substring(0, 10);
                    }

                    if (task.is_done) {
                        completedTasks++;
                        $('#done_tasks').append(`
                        <li data-id="${task.id}">
                            <span>${task.name} | Статус -  Виконана | Дата виконання - ${done_at}</span>
                            ${renderButton()}
                        </li>
                    `);
                    } else {
                        if (done_at < new Date().toISOString().substring(0, 10)) {
                            $('#overdue_task').append(`
                                <li data-id="${task.id}">
                                    <span>${task.name} | Статус -  Протермінована | Дата коли планував виконати - ${done_at ? done_at : 'Невідома'} </span>
                                    <div class="flex">
                                        <button class="focus:outline-none text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 edit-task">
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
                                </li>
                            `);
                        }
                        $('#incomplete_tasks').append(`
                        <li data-id="${task.id}">
                            <span>${task.name} | Статус -  Не виконана | До коли треба виконати - ${done_at} </span>
                            <div class="flex">
                                <button class="focus:outline-none text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 edit-task">
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
                    overdueTasks.append('<h1>Немає протермінованих задач</h1>');
                }
                $('#task-summary').text(`Виконані задачі: ${completedTasks}/${data.data.length}`);
            }
        });
    }

    $('#new-task-form').on('submit', function(event) {
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
            success: function() {
                loadTasks();
                let taskForm = $('#new-task-form');
                taskForm[0].reset();
                $('#task-form-modal').addClass('hidden');
                taskForm.removeData('task-id');
            }
        });
    });
    let taskBlock = $('#done_tasks, #incomplete_tasks, #overdue_task');

    taskBlock.on('click', '.edit-task', function() {
        const taskId = $(this).parent().parent().data('id');
        console.log($(this).parent());
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'GET',
            success: function(task) {
                let done_at = '';
                if (task.done_at) {
                    done_at  = new Date(Date.parse(task.done_at));
                    done_at = done_at.toISOString().substring(0, 10);
                }


                $('#title').val(task.name);
                $('#description').val(task.description);
                $('#done_at').val(done_at);
                $('#is_done').val(task.is_done);
                $('#task-form-modal').removeClass('hidden');
                $('#new-task-form').data('task-id', taskId);
                $('#new-task-form button').text('Оновити задачу');
            }
        });
    });

    taskBlock.on('click', '#delete-task', function() {
        const taskId = $(this).parent().parent().data('id');
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'DELETE',
            success: function() {
                loadTasks();
            }
        });
    });

    $('#logout').on('click', function() {
        $.ajax({
            url: `/api/auth/logout`,
            method: 'POST',
            success: function() {
                location.reload();
            }
        });
    });

    loadTasks();

    $('#create-task-form-modal').on('click', function() {
        $('#title').val(null);
        $('#description').val(null);
        $('#done_at').val(null);
        $('#is_done').val(null);
        $('#new-task-form button').text('Створити задачу');
        $('#task-form-modal').removeClass('hidden');
    });

    $('#close-task-form-modal').on('click', function() {
        $('#task-form-modal').addClass('hidden');
    });
});
