<?php
    spl_autoload_register(function ($class_name) {
        include "{$class_name}.php";
    });

    $task = new Task(1,1);

    assert($task->getNextStatus(TaskInterface::ACTION_CANCEL) === 'Отменено', 'Действие "' . TaskInterface::ACTION_CANCEL . '", не найдено!');
    assert(empty(array_diff($task->getAvailableActions(TaskInterface::STATUS_NEW), ['Откликнуться', 'Отменить'])), 'Массив доступных действий при статусе "' . TaskInterface::STATUS_NEW . '", не совпадает!');

