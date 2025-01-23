import './bootstrap.js'

$(document).ready(function() {
    function loadTasks() {
        $.ajax({
            url: '/api/tasks?page=1&limit=10',
            method: 'GET',
            success: function(data) {
                $('#tasks').empty();
                let completedTasks = 0;
                data.data.forEach(task => {
                    $('#tasks').append(`
                        <li data-id="${task.id}">
                            <span>${task.name} - ${task.is_done ? 'Выполнена' : 'Не выполнена'}</span>
                            <button class="edit-task">Редактировать</button>
                            <button class="delete-task">Удалить</button>
                        </li>
                    `);
                    if (task.is_done) completedTasks++;
                });
                $('#task-summary').text(`Выполненные задачи: ${completedTasks}/${data.length}`);
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
    let taskBlock = $('#tasks');

    taskBlock.on('click', '.edit-task', function() {
        const taskId = $(this).parent().data('id');
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'GET',
            success: function(task) {
                let done_at  = new Date(Date.parse(task.done_at));

                $('#title').val(task.name);
                $('#description').val(task.description);
                $('#done_at').val(done_at.toISOString().substring(0, 10));
                $('#is_done').val(task.is_done);
                $('#task-form-modal').removeClass('hidden');
                $('#new-task-form').data('task-id', taskId);
                $('#new-task-form button').text('Оновити задачу');
            }
        });
    });

    taskBlock.on('click', '.delete-task', function() {
        const taskId = $(this).parent().data('id');
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'DELETE',
            success: function() {
                loadTasks();
            }
        });
    });
    $('#logout').on('click', '.delete-task', function() {
        const taskId = $(this).parent().data('id');
        $.ajax({
            url: `/api/tasks/${taskId}`,
            method: 'DELETE',
            success: function() {
                loadTasks();
            }
        });
    });

    loadTasks();

    $('#create-task-form-modal').on('click', function() {
        $('#new-task-form button').text('Створити задачу');
        $('#task-form-modal').removeClass('hidden');
    });

    $('#close-task-form-modal').on('click', function() {
        $('#task-form-modal').addClass('hidden');
    });
});
