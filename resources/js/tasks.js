import './bootstrap.js'

$(document).ready(function() {
    function loadTasks() {
        $.ajax({
            url: '/api/tasks',
            method: 'GET',
            success: function(data) {
                $('#tasks').empty();
                let completedTasks = 0;
                data.forEach(task => {
                    $('#tasks').append(`
                        <li data-id="${task.id}">
                            <span>${task.title} - ${task.status ? 'Выполнена' : 'Не выполнена'}</span>
                            <button class="delete-task">Удалить</button>
                        </li>
                    `);
                    if (task.status) completedTasks++;
                });
                $('#task-summary').text(`Выполненные задачи: ${completedTasks}/${data.length}`);
            }
        });
    }

    $('#new-task-form').on('submit', function(event) {
        event.preventDefault();
        const taskData = {
            title: $('#title').val(),
            description: $('#description').val(),
            due_date: $('#due_date').val(),
            status: $('#status').val()
        };
        $.ajax({
            url: '/api/tasks',
            method: 'POST',
            data: taskData,
            success: function() {
                loadTasks();
                $('#new-task-form')[0].reset();
            }
        });
    });

    $('#tasks').on('click', '.delete-task', function() {
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

    $('#open-task-form-modal').on('click', function() {
        $('#task-form-modal').removeClass('hidden');
    });

    $('#close-task-form-modal').on('click', function() {
        $('#task-form-modal').addClass('hidden');
    });
});
